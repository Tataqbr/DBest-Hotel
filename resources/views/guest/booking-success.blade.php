@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-white">
    {{-- Header Gambar (Hero Section) --}}
    <div class="relative h-[40vh] w-full bg-gray-900">
        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=2070&auto=format&fit=crop" 
             class="w-full h-full object-cover opacity-60" 
             alt="Resort Header">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center pt-20"> {{-- pt-20 untuk memberi ruang bagi navbar --}}
                <p class="text-white text-[10px] uppercase tracking-[0.5em] mb-4 opacity-80">Reservation Status</p>
                <h1 class="font-serif text-5xl md:text-7xl text-white uppercase tracking-tighter italic">
                    {{ $booking->payment_status === 'paid' ? 'Confirmed' : 'Pending' }}
                </h1>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-8 -mt-20 relative z-10 pb-24">
        {{-- Main Card --}}
        <div class="bg-white border border-gray-100 shadow-2xl p-8 md:p-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                
                {{-- Detail Transaksi (Kiri - 2/3) --}}
                <div class="lg:col-span-2">
                    <div class="mb-12">
                        <h2 class="text-[11px] font-bold uppercase tracking-[0.3em] text-gray-400 mb-8 pb-2 border-b border-gray-100">Guest Information</h2>
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <p class="text-[9px] uppercase text-gray-400 tracking-widest mb-1">Name</p>
                                <p class="text-sm font-bold tracking-widest uppercase">{{ $booking->customer_name }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] uppercase text-gray-400 tracking-widest mb-1">ID Transaksi</p>
                                <p class="text-sm font-bold tracking-widest uppercase">{{ $booking->transaction_id }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-12">
                        <h2 class="text-[11px] font-bold uppercase tracking-[0.3em] text-gray-400 mb-8 pb-2 border-b border-gray-100">Stay Details</h2>
                        <div class="flex items-center gap-12">
                            <div>
                                <p class="text-[9px] uppercase text-gray-400 tracking-widest mb-1">Check In</p>
                                <p class="text-lg font-serif italic">{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</p>
                            </div>
                            <div class="h-[1px] w-12 bg-gray-200"></div>
                            <div>
                                <p class="text-[9px] uppercase text-gray-400 tracking-widest mb-1">Check Out</p>
                                <p class="text-lg font-serif italic">{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Info Tambahan / Privacy Policy --}}
                    <div class="mt-16 p-6 bg-gray-50 border-l-2 border-black">
                        <h3 class="text-[10px] font-bold uppercase tracking-widest mb-3 italic">Terms & Privacy Notes:</h3>
                        <ul class="text-[9px] text-gray-500 uppercase tracking-widest leading-loose list-disc ml-4">
                            <li>Check-in time is 14:00 PM; Check-out is 12:00 PM.</li>
                            <li>Please present this digital confirmation or a valid ID upon arrival.</li>
                            <li>Your data is protected under our Privacy Policy and will not be shared with third parties.</li>
                            <li>Cancellations are subject to our terms of service and resort policy.</li>
                        </ul>
                    </div>
                </div>

                {{-- Summary & Action (Kanan - 1/3) --}}
                <div class="bg-gray-50 p-8 flex flex-col justify-between border border-gray-100">
                    <div>
                        <h2 class="text-[11px] font-bold uppercase tracking-[0.3em] text-gray-400 mb-6">Payment Summary</h2>
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-[10px] tracking-widest">
                                <span class="text-gray-400 uppercase">Subtotal</span>
                                <span class="font-bold">IDR {{ number_format($booking->subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-[10px] tracking-widest">
                                <span class="text-gray-400 uppercase">Tax (11%)</span>
                                <span class="font-bold">IDR {{ number_format($booking->tax_service, 0, ',', '.') }}</span>
                            </div>
                            <div class="pt-4 border-t border-gray-200 flex justify-between">
                                <span class="text-[11px] font-bold uppercase">Total</span>
                                <span class="text-lg font-serif italic font-bold">IDR {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-8">
                        @if($booking->payment_status === 'paid')
                            <a href="{{ route('booking.download', $booking->transaction_id) }}" 
                               class="block w-full bg-black text-white text-center py-5 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl">
                                Download Contract
                            </a>
                        @else
                            <p class="text-[9px] text-orange-600 font-bold uppercase tracking-widest text-center mb-4">Awaiting Payment...</p>
                            <a href="{{ $booking->payment_url ?? '#' }}" 
                               class="block w-full border-2 border-black text-black text-center py-5 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-black hover:text-white transition-all">
                                Pay Now
                            </a>
                        @endif
                        <a href="/" class="block text-center text-[9px] text-gray-400 uppercase tracking-[0.4em] hover:text-black mt-4">Back to Home</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection