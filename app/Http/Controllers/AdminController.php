<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserAccountCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function Dashboard()
    {
        $totalRevenue = DB::table('bookings')->where('payment_status', 'paid')->sum('total_amount');
        $totalBookings = DB::table('bookings')->count();
        $occupancy = DB::table('rooms')->where('status', 'occupied')->count();
        $totalRooms = DB::table('rooms')->count();
        $occupancyRate = $totalRooms > 0 ? round(($occupancy / $totalRooms) * 100) : 0;

         $dataGateways = DB::table('payment_gateways')->select('*')->get();

        if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }
        return view('super-admin.dashboard', compact('dataGateways', 'totalRevenue', 'totalBookings', 'occupancy', 'totalRooms', 'occupancyRate'));
    }

    public function Rooms()
    {
        $roomTypes = DB::table('room_types')->orderBy('id', 'desc')->get();
        $rooms = DB::table('rooms')
            ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
            ->select('rooms.*', 'room_types.name as type_name', 'room_types.image_thumbnail', 'room_types.base_price')
            ->orderBy('rooms.room_number', 'asc')
            ->get();

            if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }

        return view('super-admin.rooms', compact('roomTypes', 'rooms'));
    }

public function storeType(Request $request)
{
    $fileName = null;
    if ($request->hasFile('image_thumbnail')) {
        $file = $request->file('image_thumbnail');
        // Buat nama file unik: room_type_timestamp.jpg
        $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
        // Pindahkan file langsung ke public/assets/room_types
        $file->move(public_path('assets/room_types'), $fileName);
    }

    DB::table('room_types')->insert([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'base_price' => $request->base_price,
        'capacity' => $request->capacity,
        'amenities' => $request->amenities,
        'image_thumbnail' => $fileName, // Simpan nama filenya saja
        'created_at' => now()
    ]);

    return back()->with('success', 'New Category Added');
}

public function updateType(Request $request, $id)
{
    $data = [
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'base_price' => $request->base_price,
        'capacity' => $request->capacity,
        'amenities' => $request->amenities,
        'updated_at' => now()
    ];

    if ($request->hasFile('image_thumbnail')) {
        $old = DB::table('room_types')->where('id', $id)->first();
        
        // Hapus foto lama dari folder public/assets/room_types jika ada
        if ($old->image_thumbnail && file_exists(public_path('assets/room_types/' . $old->image_thumbnail))) {
            unlink(public_path('assets/room_types/' . $old->image_thumbnail));
        }

        $file = $request->file('image_thumbnail');
        $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/room_types'), $fileName);
        
        $data['image_thumbnail'] = $fileName;
    }

    DB::table('room_types')->where('id', $id)->update($data);
    return back()->with('success', 'Category Updated');
}
    public function deleteType($id) {
        DB::table('room_types')->where('id', $id)->delete();
        return back()->with('success', 'Category Deleted');
    }

    // --- CRUD ROOM UNITS (Tetap sama namun pastikan updated_at terisi) ---
    public function storeRoom(Request $request) {
        DB::table('rooms')->insert([
            'room_number' => $request->room_number,
            'room_type_id' => $request->room_type_id,
            'floor' => $request->floor,
            'status' => 'available',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Room Added');
    }

    public function updateRoom(Request $request, $id) {
        DB::table('rooms')->where('id', $id)->update([
            'room_number' => $request->room_number,
            'room_type_id' => $request->room_type_id,
            'floor' => $request->floor,

            'updated_at' => now(),
        ]);
        return back()->with('success', 'Room Updated');
    }

    public function deleteRoom($id) {
        DB::table('rooms')->where('id', $id)->delete();
        return back()->with('success', 'Room Deleted');
    }   


   public function Reservations()
{
    $bookings = DB::table('bookings')
        ->leftJoin('rooms', 'bookings.room_id', '=', 'rooms.id')
        ->leftJoin('room_types', 'rooms.room_type_id', '=', 'room_types.id')
        ->select(
            'bookings.*', 
            'rooms.room_number', 
            'room_types.name as room_type_name'
        )
        ->orderBy('bookings.created_at', 'desc')
        ->get();

        if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }

    return view('super-admin.reservation', compact('bookings'));
}

public function Dining()
    {
        $menus = DB::table('dining_menus')->orderBy('created_at', 'desc')->get();
        $categories = DB::table('dining_menus')->distinct()->pluck('category');
        
        if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }
        return view('super-admin.dining', compact('menus', 'categories'));
    }

    

    public function StoreDining(Request $request)
{
    $request->validate([
        'image' => 'required',
        'name' => 'required',
        'category' => 'required',
        'price' => 'required|numeric',
    ]);

    // Handle Upload ke public/assets/dining
    $file = $request->file('image');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('assets/dining'), $filename);

    DB::table('dining_menus')->insert([
        'category' => $request->category,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'is_available' => $request->is_available,
        'image_path' => $filename, // Simpan nama filenya saja
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Menu created!');
}

public function UpdateDining(Request $request, $id)
{
    $menu = DB::table('dining_menus')->where('id', $id)->first();
    $data = [
        'category' => $request->category,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'is_available' => $request->is_available,
        'updated_at' => now(),
    ];

    if ($request->hasFile('image')) {
        // Hapus foto lama jika ada
        if ($menu->image_path && file_exists(public_path('assets/dining/' . $menu->image_path))) {
            unlink(public_path('assets/dining/' . $menu->image_path));
        }
        
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/dining'), $filename);
        $data['image_path'] = $filename;
    }

    DB::table('dining_menus')->where('id', $id)->update($data);
    return redirect()->back()->with('success', 'Menu updated!');
}

public function DeleteDining($id)
{
    try {
        $menu = DB::table('dining_menus')->where('id', $id)->first();

        if ($menu) {
            // Hapus file fisik dari folder public/assets/dining
            $filePath = public_path('assets/dining/' . $menu->image_path);
            if (file_exists($filePath) && !empty($menu->image_path)) {
                unlink($filePath);
            }

            // Hapus record dari database
            DB::table('dining_menus')->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Menu berhasil dihapus!');
        }

        return redirect()->back()->withErrors(['msg' => 'Data tidak ditemukan.']);
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['msg' => 'Gagal menghapus: ' . $e->getMessage()]);
    }
}
}
