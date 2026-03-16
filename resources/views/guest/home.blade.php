@extends('layouts.guest')
@section('title', 'Luxury in Bandung City Center - d\'best Hotel Bandung')

@section('content')
    {{-- 1. HERO SECTION - Full Screen with Elegant Typography --}}
    <section class="h-screen relative flex items-center justify-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=2000" class="absolute w-full h-full object-cover" alt="d'best Hotel Bandung Hero">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative text-center text-white px-6">
            <span class="text-[10px] uppercase tracking-[0.6em] text-gold mb-6 block drop-shadow-lg">A New Standard of Urban Elegance</span>
            <h1 class="font-luxury text-6xl lg:text-9xl mb-8 drop-shadow-2xl">d'best Hotel</h1>
            <p class="font-light italic text-xl max-w-2xl mx-auto leading-relaxed opacity-90">
                Where professional business meets refined leisure in the heart of Bandung’s historic trade district.
            </p>
            <div class="mt-12">
                <a href="#rooms" class="bg-gold hover:bg-white text-white hover:text-dark px-12 py-5 text-[10px] font-bold uppercase tracking-[0.3em] transition-all duration-500 shadow-xl">Explore Suites</a>
            </div>
        </div>
        {{-- Floating Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center">
            <div class="w-[1px] h-20 bg-gradient-to-b from-white to-transparent"></div>
        </div>
    </section>

    {{-- 2. ABOUT US - Asymmetrical Luxury Layout --}}
    <section id="about" class="py-32 bg-white overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-6 grid lg:grid-cols-12 gap-16 items-center">
            <div class="lg:col-span-5 relative">
                <span class="font-luxury text-9xl text-gray-100 absolute -top-16 -left-10 z-0">Heritage</span>
                <div class="relative z-10">
                    <h2 class="font-luxury text-5xl text-dark mb-8">Refining Your Comfort Since Day One</h2>
                    <p class="text-gray-600 leading-relaxed mb-8 text-lg">
                        Conveniently located at Jalan Otto Iskandardinata 460, d'best Hotel Bandung stands as a beacon of hospitality in the city's most vibrant trade hub. 
                    </p>
                    <p class="text-gray-500 leading-relaxed mb-10 italic">
                        "Our mission is to provide a sanctuary where business travelers find efficiency and families find a home."
                    </p>
                    <a href="/about" class="inline-flex items-center gap-4 text-[11px] font-bold uppercase tracking-[0.3em] group">
                        Discover Our Story 
                        <span class="w-12 h-[1px] bg-dark group-hover:w-20 transition-all duration-500"></span>
                    </a>
                </div>
            </div>
            <div class="lg:col-span-7 grid grid-cols-2 gap-6 relative">
                <div class="mt-12 overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&q=80&w=800" class="w-full h-[500px] object-cover hover:scale-105 transition-transform duration-700" alt="Lobby">
                </div>
                <div class="overflow-hidden shadow-2xl">
                    <img src="https://images.trvl-media.com/lodging/10000000/9590000/9585500/9585440/c4be5e06.jpg?impolicy=fcrop&w=1200&h=800&quality=medium" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" alt="Architecture">
                </div>
            </div>
        </div>
    </section>

    {{-- 3. ACCOMMODATIONS - Horizontal Scroll/Grid Mix --}}
    <section id="rooms" class="py-32 bg-[#F9F9F9]">
        <div class="max-w-[1400px] mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                <div>
                    <span class="text-gold text-[10px] uppercase tracking-[0.4em] mb-4 block underline underline-offset-8">Private Sanctuaries</span>
                    <h2 class="font-luxury text-6xl text-dark">Rooms & Suites</h2>
                </div>
                <p class="text-gray-500 max-w-md text-right leading-relaxed">
                    Featuring 53 elegantly appointed units designed with a blend of modern minimalism and classical warmth.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Room Card Logic --}}
                @php
                $roomData = [
                    ['Standard', '20-22 m²', 'Twins', '850.000', 'https://ik.imagekit.io/tvlk/generic-asset/dgXfoyh24ryQLRcGq00cIdKHRmotrWLNlvG-TxlcLxGkiDwaUSggleJNPRgIHCX6/hotel/asset/10000253-6cc12484758bfa094a2a20a43c699dee.jpeg'],
                    ['Superior', '24-26 m²', 'Twins/Double', '1.100.000', 'https://ik.imagekit.io/tvlk/generic-asset/Ixf4aptF5N2Qdfmh4fGGYhTN274kJXuNMkUAzpL5HuD9jzSxIGG5kZNhhHY-p7nw/hotel/asset/10000253-bc5f963cc5d35e8222f27a54df9a4401.jpeg'],
                    ['Deluxe', '29-31 m²', 'Twins/Double', '1.350.000', 'https://ik.imagekit.io/tvlk/generic-asset/dgXfoyh24ryQLRcGq00cIdKHRmotrWLNlvG-TxlcLxGkiDwaUSggleJNPRgIHCX6/hotel/asset/10000253-1024x683-FIT_AND_TRIM-3d865bf931bad8d8e484708e246c9ac2.jpeg'],
                    ['Executive', '35-37 m²', 'Twins/Double', '1.650.000', 'https://ik.imagekit.io/tvlk/generic-asset/dgXfoyh24ryQLRcGq00cIdKHRmotrWLNlvG-TxlcLxGkiDwaUSggleJNPRgIHCX6/hotel/asset/10000253-472f2b2178062895d6d62c33b851d289.jpeg']
                ];
                @endphp

                @foreach($roomData as $room)
                <div class="relative overflow-hidden group h-[500px]">
                    <img src="{{ $room[4] }}" class="w-full h-full object-cover transition duration-1000 group-hover:scale-110" alt="{{ $room[0] }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-8 w-full">
                        <h4 class="font-luxury text-3xl text-white mb-2">{{ $room[0] }}</h4>
                        <div class="flex gap-4 text-[10px] text-gray-300 uppercase tracking-widest mb-6">
                            <span>{{ $room[1] }}</span>
                            <span>•</span>
                            <span>{{ $room[2] }}</span>
                        </div>
                        <div class="flex items-center justify-between ">
                            <span class="text-gold font-bold">IDR {{ $room[3] }}</span>
                            <a href="/booking?type={{ strtolower($room[0]) }}" class="text-white text-[10px] font-bold uppercase tracking-widest border-b border-white pb-1">Book Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-16 text-center">
                <a href="/rooms" class="inline-block border border-dark/20 px-12 py-4 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-dark hover:text-white transition-all">Explore All Suites</a>
            </div>
        </div>
    </section>

    {{-- 4. FACILITIES - Clean Modern Icons Grid --}}
    <section class="py-32 bg-white">
        <div class="max-w-[1200px] mx-auto px-6 text-center">
            <h2 class="font-luxury text-5xl text-dark mb-20">Hotel Facilities</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach([
                    ['Swimming Pool', 'Relaxing outdoor pool with city views', 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?auto=format&fit=crop&q=80&w=400'],
                    ['Fast Wi-Fi', 'High-speed internet in all areas', 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&q=80&w=400'],
                    ['Free Parking', 'Secure and spacious parking lots', 'https://images.unsplash.com/photo-1506521781263-d8422e82f27a?auto=format&fit=crop&q=80&w=400'],
                    ['24h Service', 'Round-the-clock security & reception', 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=400']
                ] as $fac)
                <div class="group cursor-default text-left">
                    <div class="overflow-hidden mb-6 h-48">
                        <img src="{{ $fac[2] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500" alt="{{ $fac[0] }}">
                    </div>
                    <h5 class="font-bold text-dark text-lg mb-2">{{ $fac[0] }}</h5>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $fac[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 5. DINING & EVENTS - Split View with Video-like Feel --}}
    <section id="dining" class="py-32 bg-dark text-white overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">
            <div class="relative">
                <div class="absolute -top-10 -left-10 w-40 h-40 border border-gold/30"></div>
                <img src="https://images.trvl-media.com/lodging/10000000/9590000/9585500/9585440/fd7d1bc6.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill" class="w-full h-[600px] object-cover shadow-2xl" alt="Dining">
            </div>
            <div>
                <span class="text-gold text-[10px] uppercase tracking-[0.5em] mb-6 block">Gastronomy & Business</span>
                <h2 class="font-luxury text-6xl mb-8 leading-tight">D'Poet Restaurant <br>& Meeting Spaces</h2>
                <p class="text-gray-400 leading-relaxed mb-10 text-lg">
                    Experience a curated culinary journey from 06:00 to 23:00. From local Sundanese heritage to international favorites, we serve excellence on every plate. Our meeting rooms are designed with professional focus in mind, hosting up to 100 delegates with full banquet support.
                </p>
                <div class="flex flex-wrap gap-6">
                    <a href="/dining" class="bg-white text-dark px-10 py-4 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-gold hover:text-white transition duration-500 shadow-xl">Explore Menu</a>
                    <a href="/events" class="border border-white/20 px-10 py-4 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-white hover:text-dark transition duration-500">Banquet Details</a>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. LOCATION / FINAL CTA - Minimalist & High Contrast --}}
    <section class="py-32 bg-white relative">
        <div class="max-w-[1200px] mx-auto px-6 text-center">
            <div class="mb-16">
                <span class="text-gold text-[10px] uppercase tracking-[0.4em] mb-4 block underline underline-offset-8">Visit Us</span>
                <h2 class="font-luxury text-5xl text-dark">Heart of the City</h2>
            </div>
            <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl h-[400px] grayscale hover:grayscale-0 transition-all duration-1000">
                {{-- Mock Map Image - Ganti dengan Google Map Embed jika perlu --}}
                <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="Map Location">
            </div>
            <p class="text-gray-500 mb-12 max-w-xl mx-auto italic">Jl. Otto Iskandardinata 460, Bandung, Indonesia</p>
            <a href="/contact" class="inline-block bg-dark text-white px-16 py-5 text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-gold transition-colors duration-500 shadow-2xl">Contact Receptionist</a>
        </div>
    </section>
@endsection