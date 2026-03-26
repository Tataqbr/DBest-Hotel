@extends('layouts.guest')
@section('title', 'Accommodations & Meeting Spaces - d\'best Hotel Bandung')

@section('content')
    {{-- HEADER SECTION --}}
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <img src="{{ asset('assets/accommodation.avif') }}" class="absolute w-full h-full object-cover scale-105 animate-slow-zoom" alt="Luxury Accommodations">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/60"></div>
        <div class="relative text-center text-white px-6">
            <span class="text-[10px] uppercase tracking-[0.6em] text-gold mb-4 block animate-fade-in">Luxury Redefined</span>
            <h1 class="font-luxury text-6xl lg:text-8xl mb-4 drop-shadow-2xl">Suites & Venues</h1>
            <div class="w-24 h-[1px] bg-gold mx-auto mb-8"></div>
        </div>
    </section>

    {{-- ROOM LISTING SECTION --}}
    <section class="py-32 bg-[#FDFDFD]">
        <div class="max-w-[1300px] mx-auto px-6">
            <div class="space-y-40">
                @php
                $rooms = [
                    ['Standard Room', 'https://ik.imagekit.io/tvlk/generic-asset/dgXfoyh24ryQLRcGq00cIdKHRmotrWLNlvG-TxlcLxGkiDwaUSggleJNPRgIHCX6/hotel/asset/10000253-6cc12484758bfa094a2a20a43c699dee.jpeg', '20-22 m²', 'Twin Bed', '850.000', 'Efficiently designed for the modern traveler, offering a seamless blend of comfort and utility.'],
                    ['Superior Room', 'https://ik.imagekit.io/tvlk/generic-asset/Ixf4aptF5N2Qdfmh4fGGYhTN274kJXuNMkUAzpL5HuD9jzSxIGG5kZNhhHY-p7nw/hotel/asset/10000253-bc5f963cc5d35e8222f27a54df9a4401.jpeg', '24-26 m²', 'Twin or Double', '1.100.000', 'Elevate your stay with extra space and premium city views in our signature Superior suites.'],
                    ['Deluxe Room', 'https://ik.imagekit.io/tvlk/generic-asset/dgXfoyh24ryQLRcGq00cIdKHRmotrWLNlvG-TxlcLxGkiDwaUSggleJNPRgIHCX6/hotel/asset/10000253-1024x683-FIT_AND_TRIM-3d865bf931bad8d8e484708e246c9ac2.jpeg', '29-31 m²', 'Twin or Double', '1.350.000', 'The perfect balance of luxury and space, featuring expanded floor plans for ultimate relaxation.'],
                    ['Executive Room', 'https://ik.imagekit.io/tvlk/generic-asset/dgXfoyh24ryQLRcGq00cIdKHRmotrWLNlvG-TxlcLxGkiDwaUSggleJNPRgIHCX6/hotel/asset/10000253-472f2b2178062895d6d62c33b851d289.jpeg', '35-37 m²', 'King or Twin', '1.650.000', 'Our most prestigious accommodation, designed for the discerning executive seeking unparalleled comfort.']
                ];
                @endphp

                @foreach($rooms as $index => $room)
                <div class="group grid lg:grid-cols-12 gap-0 items-center bg-white shadow-sm hover:shadow-2xl transition-all duration-700 rounded-sm overflow-hidden border border-gray-100">
                    {{-- Image Container --}}
                    <div class="lg:col-span-7 overflow-hidden relative {{ $index % 2 != 0 ? 'lg:order-last' : '' }}">
                        <img src="{{ $room[1] }}" class="w-full h-[500px] object-cover transition duration-1000 group-hover:scale-110" alt="{{ $room[0] }}">
                        <div class="absolute top-6 left-6 bg-dark/80 backdrop-blur-md text-white px-6 py-2 text-[10px] font-bold tracking-[0.2em] uppercase border-l-2 border-gold">
                            Featured Room
                        </div>
                    </div>

                    {{-- Content Container --}}
                    <div class="lg:col-span-5 p-12 lg:p-16">
                        <h3 class="font-luxury text-4xl text-dark mb-4 group-hover:text-gold transition-colors duration-500">{{ $room[0] }}</h3>
                        <p class="text-gray-500 font-light leading-relaxed mb-8 text-sm italic">"{{ $room[5] }}"</p>
                        
                        <div class="flex gap-8 mb-10 text-[10px] uppercase tracking-[0.2em] text-gray-400">
                            <span class="flex items-center gap-2"><b class="text-dark">{{ $room[2] }}</b></span>
                            <span class="flex items-center gap-2"><b class="text-dark">{{ $room[3] }}</b></span>
                        </div>

                        <div class="flex flex-col gap-6">
                            <div class="flex flex-col">
                                <span class="text-[9px] uppercase text-gray-400 tracking-widest mb-1">Nightly Rate From</span>
                                <span class="text-3xl font-luxury text-dark">IDR {{ $room[4] }}</span>
                            </div>
                            
                            {{-- HIGHLIGHTED HOOK BUTTON --}}
                            <a href="/booking?type={{ strtolower(explode(' ', $room[0])[0]) }}" 
                               class="relative inline-flex items-center justify-center px-10 py-5 overflow-hidden font-bold tracking-[0.3em] text-[10px] uppercase transition duration-500 ease-out border-2 border-gold group/btn shadow-xl hover:shadow-gold/20">
                                <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-500 -translate-x-full bg-gold group-hover/btn:translate-x-0 ease">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </span>
                                <span class="absolute flex items-center justify-center w-full h-full text-gold transition-all duration-500 transform group-hover/btn:translate-x-full ease">Confirm Reservation</span>
                                <span class="relative invisible">Confirm Reservation</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- MEETING ROOMS SECTION - Professional Focus --}}
    <section class="py-32 bg-dark text-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center mb-24">
                <span class="text-gold text-[10px] uppercase tracking-[0.5em] mb-4 block">Corporate Excellence</span>
                <h2 class="font-luxury text-5xl mb-6">Venues & Events</h2>
                <div class="w-20 h-[1px] bg-gold/50 mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                @foreach([
                    ['Boardroom', '20 Pax', 'Modern AV Systems', asset('assets/event-1.avif')],
                    ['The Grand Poet', '100 Pax', 'Banqueting & Theater', asset('assets/event-2.avif')],
                    ['Business Suite', '10 Pax', 'Private Consultations', asset('assets/event-3.avif')]
                ] as $meet)
                <div class="group relative overflow-hidden bg-[#111] p-1 border border-white/5 hover:border-gold/30 transition-all duration-700">
                    <div class="overflow-hidden h-64 mb-8">
                        <img src="{{ $meet[3] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition duration-700" alt="{{ $meet[0] }}">
                    </div>
                    <div class="px-6 pb-8">
                        <h4 class="font-luxury text-2xl mb-2">{{ $meet[0] }}</h4>
                        <div class="flex justify-between text-[10px] uppercase tracking-widest text-gray-500 mb-8">
                            <span>Capacity: {{ $meet[1] }}</span>
                            <span>•</span>
                            <span>{{ $meet[2] }}</span>
                        </div>
                        
                        {{-- SUBTLE HOOK FOR MEETING --}}
                        <a href="{{ route('contact') }}" class="inline-block text-[10px] font-bold uppercase tracking-[0.3em] text-gold group-hover:text-white transition-colors duration-500">
                            Request Proposal <span class="ml-2 inline-block transition-transform group-hover:translate-x-2">→</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FLOATING STYLE CALL TO ACTION --}}
    <section class="py-24 bg-white">
        <div class="max-w-[1000px] mx-auto px-6">
            <div class="bg-gold p-12 lg:p-20 text-center relative overflow-hidden shadow-2xl">
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute inset-0" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 40px 40px;"></div>
                </div>
                <h2 class="font-luxury text-4xl lg:text-5xl text-white mb-6 relative z-10">Experience the d'best Standard</h2>
                <p class="text-white/80 mb-10 tracking-widest text-xs uppercase relative z-10">Direct booking guarantees the best available rate</p>
                <a href="{{ route('contact') }}" class="relative z-10 inline-block bg-white text-dark px-12 py-5 text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-dark hover:text-white transition-all duration-500 shadow-xl">
                    Inquire for Direct Rates
                </a>
            </div>
        </div>
    </section>
@endsection