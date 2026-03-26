@extends('layouts.admin')

@section('admin_content')

    {{-- HEADER SECTION --}}
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="font-luxury text-3xl text-dark italic">Executive Dashboard</h1>
            <p class="text-[11px] uppercase tracking-[0.3em] text-gray-400 mt-1">Operational Overview & Analytics</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-right hidden md:block">
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Current Time</p>
                <p class="text-xs font-bold text-dark">{{ date('D, d M Y | H:i') }} WIB</p>
            </div>
            <button class="bg-dark text-gold p-3 rounded-xl shadow-lg hover:bg-gold hover:text-dark transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        @php
            $stats = [
                ['label' => 'Total Revenue', 'value' => 'IDR 124.5M', 'change' => '+12.5%', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['label' => 'Total Bookings', 'value' => '842', 'change' => '+5.2%', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['label' => 'Room Occupancy', 'value' => '78%', 'change' => '-2.1%', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                ['label' => 'Pending Events', 'value' => '12', 'change' => '+2', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-dark group-hover:bg-dark group-hover:text-gold transition-colors duration-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"></path></svg>
                </div>
                <span class="text-[10px] font-bold px-2 py-1 rounded-lg {{ str_contains($stat['change'], '+') ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                    {{ $stat['change'] }}
                </span>
            </div>
            <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">{{ $stat['label'] }}</p>
            <h3 class="text-2xl font-bold text-dark mt-1">{{ $stat['value'] }}</h3>
        </div>
        @endforeach
    </div>

    {{-- RECENT ACTIVITY TABLE --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-dark uppercase tracking-widest text-xs">Recent Reservations</h3>
            <button class="text-[10px] font-bold text-gold uppercase tracking-widest hover:text-dark transition-colors">View All</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-[10px] uppercase tracking-[0.2em] text-gray-400">
                        <th class="px-8 py-4 font-bold">Guest Name</th>
                        <th class="px-8 py-4 font-bold">Room Type</th>
                        <th class="px-8 py-4 font-bold">Check In</th>
                        <th class="px-8 py-4 font-bold">Status</th>
                        <th class="px-8 py-4 font-bold text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @php
                        $bookings = [
                            ['name' => 'Alexander Wright', 'room' => 'Presidential Suite', 'date' => '18 Mar 2026', 'status' => 'Confirmed', 'amount' => 'IDR 4.500.000'],
                            ['name' => 'Sophia Lorenza', 'room' => 'Deluxe King', 'date' => '19 Mar 2026', 'status' => 'Pending', 'amount' => 'IDR 1.250.000'],
                            ['name' => 'Michael Chen', 'room' => 'Executive Room', 'date' => '20 Mar 2026', 'status' => 'Confirmed', 'amount' => 'IDR 2.100.000'],
                        ];
                    @endphp

                    @foreach($bookings as $booking)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-8 py-5">
                            <p class="text-sm font-bold text-dark">{{ $booking['name'] }}</p>
                            <p class="text-[10px] text-gray-400">#RES-99{{ $loop->index }}</p>
                        </td>
                        <td class="px-8 py-5 text-sm text-gray-600">{{ $booking['room'] }}</td>
                        <td class="px-8 py-5 text-sm text-gray-600">{{ $booking['date'] }}</td>
                        <td class="px-8 py-5">
                            <span class="text-[9px] font-bold uppercase tracking-widest px-3 py-1 rounded-full {{ $booking['status'] == 'Confirmed' ? 'bg-blue-50 text-blue-600' : 'bg-orange-50 text-orange-600' }}">
                                {{ $booking['status'] }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-sm font-bold text-dark text-right">{{ $booking['amount'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection