<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class BookingController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }

     public function showForm($slug)
    {
        $roomType = DB::table('room_types')->where('slug', $slug)->first();
        
        if (!$roomType) abort(404);

        $availableRooms = DB::table('rooms')
            ->where('room_type_id', $roomType->id)
            ->where('status', 'available')
            ->get();

        return view('guest.booking', compact('roomType', 'availableRooms'));
    }

public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        // 1. Cek Gateway Aktif
        $activeGateway = DB::table('payment_gateways')->where('status', 'active')->first();
        if (!$activeGateway) {
            return response()->json(['success' => false, 'message' => 'No active payment method.'], 500);
        }

        DB::beginTransaction();
        try {
            // 2. Kalkulasi Finansial
            $room = DB::table('rooms')
                ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
                ->where('rooms.id', $request->room_id)
                ->select('rooms.*', 'room_types.base_price', 'room_types.name as type_name')
                ->first();

            $checkIn = Carbon::parse($request->check_in);
            $checkOut = Carbon::parse($request->check_out);
            $nights = $checkIn->diffInDays($checkOut);
            $nights = $nights > 0 ? $nights : 1;
            
            $subtotal = $room->base_price * $nights;
            $tax = $subtotal * 0.11;
            $totalAmount = $subtotal + $tax;
            $transactionId = 'DBST-' . strtoupper(Str::random(10));

            // 3. Simpan Booking
            DB::table('bookings')->insert([
                'transaction_id' => $transactionId,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'room_id' => $request->room_id,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'total_nights' => $nights,
                'subtotal' => $subtotal,
                'tax_service' => $tax,
                'total_amount' => $totalAmount,
                'gateway_name' => $activeGateway->code,
                'payment_status' => 'unpaid',
                'booking_status' => 'pending',
                'created_at' => now(), 
                'updated_at' => now()
            ]);

            // 4. Update Status Kamar (Agar tidak double booking)
            DB::table('rooms')->where('id', $request->room_id)->update(['status' => 'booked']);

            // --- LOGIKA GATEWAY ---
            
            // A. MIDTRANS
            if ($activeGateway->code === 'midtrans') {
                // SET KONFIGURASI DI SINI AGAR TIDAK NULL
                Config::$serverKey = config('services.midtrans.serverKey');
                Config::$isProduction = config('services.midtrans.isProduction');
                Config::$isSanitized = true;
                Config::$is3ds = true;

                $params = [
                    'transaction_details' => ['order_id' => $transactionId, 'gross_amount' => (int)$totalAmount],
                    'customer_details' => [
                        'first_name' => $request->customer_name, 
                        'email' => $request->customer_email, 
                        'phone' => $request->customer_phone
                    ],
                ];
                
                $snapToken = Snap::getSnapToken($params);
                
                // Simpan snap_token ke database
                DB::table('bookings')->where('transaction_id', $transactionId)->update(['snap_token' => $snapToken]);
                
                DB::commit();
                return response()->json([
                    'success' => true, 
                    'type' => 'midtrans', 
                    'snap_token' => $snapToken, 
                    'transaction_id' => $transactionId
                ]);
            }

           // B. XENDIT
else if ($activeGateway->code === 'xendit') {
    $response = Http::withHeaders(['Authorization' => 'Basic ' . base64_encode(env('XENDIT_SECRET_KEY') . ':')])
        ->post('https://api.xendit.co/v2/invoices', [
            'external_id' => $transactionId,
            'amount' => (int)$totalAmount,
            'payer_email' => $request->customer_email,
            'description' => 'Booking Room: ' . $room->type_name,
            // PERBAIKAN DI SINI: Samakan nama parameter dengan di route (transaction_id)
            'success_redirect_url' => route('booking.success', ['transaction_id' => $transactionId]),
        ]);

    if ($response->successful()) {
        $invoice = $response->json();
        DB::table('bookings')->where('transaction_id', $transactionId)->update(['payment_url' => $invoice['invoice_url']]);
        DB::commit();
        return response()->json([
            'success' => true, 
            'type' => 'xendit', 
            'invoice_url' => $invoice['invoice_url'],
            'transaction_id' => $transactionId // Tambahkan ini agar frontend konsisten
        ]);
    }
    throw new \Exception("Xendit Error: " . $response->body());
}

            // C. MANUAL
            else {
                DB::commit();
                return response()->json(['success' => true, 'type' => 'manual', 'transaction_id' => $transactionId]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

   // Tambahkan parameter $transactionId di sini
public function successPage(Request $request, $transactionId) 
{
    // Cari berdasarkan parameter URL $transactionId
    $booking = DB::table('bookings')
        ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
        ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
        ->where('bookings.transaction_id', $transactionId) // Gunakan variabel $transactionId
        ->select('bookings.*', 'room_types.name as room_type_name', 'rooms.room_number')
        ->first();

    if (!$booking) {
        return abort(404, 'Booking not found.');
    }

    // SYNC STATUS REAL-TIME
    if ($booking->gateway_name === 'midtrans' && $booking->payment_status === 'unpaid') {
        try {
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            
            // Gunakan $transactionId untuk cek ke Midtrans
            $status = \Midtrans\Transaction::status($transactionId);
            
            if (in_array($status->transaction_status, ['settlement', 'capture'])) {
                DB::table('bookings')->where('transaction_id', $transactionId)->update([
                    'payment_status' => 'paid',
                    'booking_status' => 'confirmed',
                    'paid_at' => now()
                ]);
                
                // Update objek agar tampilan di view langsung berubah jadi 'paid'
                $booking->payment_status = 'paid';
            }
        } catch (\Exception $e) {
            // Log error jika perlu: Log::error($e->getMessage());
        }
    }
    // SYNC STATUS XENDIT (Tambahkan di bawah blok Midtrans)
if ($booking->gateway_name === 'xendit' && $booking->payment_status === 'unpaid') {
    try {
        $response = Http::withHeaders(['Authorization' => 'Basic ' . base64_encode(env('XENDIT_SECRET_KEY') . ':')])
            ->get('https://api.xendit.co/v2/invoices?external_id=' . $transactionId);

        if ($response->successful()) {
            $invoices = $response->json();
            // Xendit mengembalikan array, ambil invoice pertama yang cocok
            if (!empty($invoices)) {
                $status = $invoices[0]['status']; // SETTLED atau PAID
                if (in_array($status, ['SETTLED', 'PAID'])) {
                    DB::table('bookings')->where('transaction_id', $transactionId)->update([
                        'payment_status' => 'paid',
                        'booking_status' => 'confirmed',
                        'paid_at' => now()
                    ]);
                    $booking->payment_status = 'paid';
                }
            }
        }
    } catch (\Exception $e) {
        // Log::error($e->getMessage());
    }
}

    return view('guest.booking-success', compact('booking'));
}

public function downloadContract($transactionId)
{
    // 1. Ambil data (Pastikan nama kolom sesuai DB D'Best Hotel)
    $booking = DB::table('bookings')
        ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
        ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
        ->where('bookings.transaction_id', $transactionId)
        ->select(
            'bookings.*', 
            'room_types.name as room_type_name', 
            'rooms.room_number'
        )
        ->first();

    // Jika data tidak ada atau belum lunas, hentikan
    if (!$booking || $booking->payment_status !== 'paid') {
        return abort(404, 'Data tidak ditemukan atau belum lunas.');
    }

    // 2. Handle Logo dengan Aman (Penyebab utama Error 500/505)
    $logoData = null;
    $path = public_path('assets/logo.png'); 
    
    // Cek apakah file benar-benar ada sebelum dibaca
    if (file_exists($path) && is_file($path)) {
        try {
            $fileContent = file_get_contents($path);
            $base64 = base64_encode($fileContent);
            $mime = mime_content_type($path);
            $logoData = 'data:' . $mime . ';base64,' . $base64;
        } catch (\Exception $e) {
            $logoData = null; // Abaikan logo jika gagal baca file
        }
    }

    // 3. Render PDF (Gunakan try-catch untuk melihat error spesifik)
    try {
        // Pastikan variabel yang dikirim adalah 'data', bukan 'booking' 
        // karena di view Lanusa kita pakai $data->...
        $pdf = Pdf::loadView('pdf.booking_contract', [
            'data' => $booking, 
            'logo' => $logoData
        ]);

        $pdf->setPaper('a4', 'portrait');
        
        // Atur opsi agar dompdf lebih stabil
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'logOutputFile' => storage_path('logs/dompdf.log.html'),
            'tempDir' => storage_path('app/public')
        ]);

        return $pdf->download('DBest_Contract_' . $transactionId . '.pdf');

    } catch (\Exception $e) {
        // Jika masih error, tampilkan pesan error aslinya untuk debug
        return response()->json([
            'message' => 'Gagal merender PDF',
            'error' => $e->getMessage()
        ], 500);
    }
}
}