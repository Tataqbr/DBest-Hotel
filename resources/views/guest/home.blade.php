@extends('layouts.guest')
@section('title', 'Luxury in Bandung City Center - d\'best Hotel Bandung')

@section('content')
    {{-- 1. HERO SECTION - Full Screen with Elegant Typography --}}
    <section class="h-screen relative flex items-center justify-center overflow-hidden">
        <img src="{{ asset('assets/home.jpeg') }}" class="absolute w-full h-full object-cover" alt="d'best Hotel Bandung Hero">
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
                    <a href="{{ route('about-us') }}" class="inline-flex items-center gap-4 text-[11px] font-bold uppercase tracking-[0.3em] group">
                        Discover Our Story 
                        <span class="w-12 h-[1px] bg-dark group-hover:w-20 transition-all duration-500"></span>
                    </a>
                </div>
            </div>
            <div class="lg:col-span-7 grid grid-cols-2 gap-6 relative">
                <div class="mt-12 overflow-hidden shadow-2xl">
                    <img src="{{ asset('assets/about-home-1.avif') }}" class="w-full h-[500px] object-cover hover:scale-105 transition-transform duration-700" alt="Lobby">
                </div>
                <div class="overflow-hidden shadow-2xl">
                    <img src="{{ asset('assets/about-home-2.avif') }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" alt="Architecture">
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
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($roomTypes as $type)
    <div class="group relative bg-white overflow-hidden h-[550px] shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100">
        
        <div class="h-[60%] overflow-hidden relative bg-gray-100">
            <img src="{{ asset('assets/room_types/' . $type->image_thumbnail) }}" 
                 class="w-full h-full object-cover transition-transform duration-[1.2s] group-hover:scale-110" 
                 alt="{{ $type->name }}">
            
            <div class="absolute top-0 right-0 bg-black/80 backdrop-blur-sm px-4 py-2">
                <span class="text-[9px] text-white font-bold uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-users text-[8px]"></i>
                    {{ $type->capacity }} Persons
                </span>
            </div>
        </div>

        <div class="p-8 flex flex-col justify-between h-[40%] bg-white">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-6 h-[1px] bg-black"></div>
                    <span class="text-[9px] text-gray-400 font-bold uppercase tracking-[0.3em]">Accommodation</span>
                </div>
                <h4 class="font-serif text-2xl text-black uppercase tracking-tight mb-2">{{ $type->name }}</h4>
                
                <p class="text-[11px] text-gray-500 leading-relaxed line-clamp-2 italic">
                    {{ $type->description }}
                </p>
            </div>

            <div class="flex items-end justify-between mt-4 pt-4 border-t border-gray-50">
                <div class="flex flex-col">
                    <span class="text-[8px] text-gray-400 uppercase tracking-widest mb-1">Price per night</span>
                    <p class="text-black font-bold text-lg leading-none">
                        <span class="text-gray-400 text-[10px] font-normal mr-1">IDR</span>{{ number_format($type->base_price, 0, ',', '.') }}
                    </p>
                </div>

                <a href="{{ route('room.detail', $type->slug) }}" 
                   class="bg-black text-white px-6 py-3 text-[9px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-colors duration-300">
                    View Details
                </a>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full h-[2px] bg-black scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
    </div>
    @endforeach
</div>
            
            <div class="mt-16 text-center">
                <a href="{{ route('accommodation') }}" class="inline-block border border-dark/20 px-12 py-4 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-dark hover:text-white transition-all">Explore All Suites</a>
            </div>
        </div>
    </section>

    {{-- 4. FACILITIES - Clean Modern Icons Grid --}}
    <section class="py-32 bg-white">
        <div class="max-w-[1200px] mx-auto px-6 text-center">
            <h2 class="font-luxury text-5xl text-dark mb-20">Hotel Facilities</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach([
                    ['Swimming Pool', 'Relaxing outdoor pool with city views', asset('assets/facilities-1.avif')],
                    ['Fast Wi-Fi', 'High-speed internet in all areas', asset('assets/facilities-2.avif')],
                    ['Free Parking', 'Secure and spacious parking lots', asset('assets/facilities-3.avif')],
                    ['24h Service', 'Round-the-clock security & reception', asset('assets/facilities-4.avif')]
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
                <img src="{{ asset('assets/dining-home.avif') }}" class="w-full h-[600px] object-cover shadow-2xl" alt="Dining">
            </div>
            <div>
                <span class="text-gold text-[10px] uppercase tracking-[0.5em] mb-6 block">Gastronomy & Business</span>
                <h2 class="font-luxury text-6xl mb-8 leading-tight">D'Poet Restaurant <br>& Meeting Spaces</h2>
                <p class="text-gray-400 leading-relaxed mb-10 text-lg">
                    Experience a curated culinary journey from 06:00 to 23:00. From local Sundanese heritage to international favorites, we serve excellence on every plate. Our meeting rooms are designed with professional focus in mind, hosting up to 100 delegates with full banquet support.
                </p>
                <div class="flex flex-wrap gap-6">
                    <a href="{{ route('dining') }}" class="bg-white text-dark px-10 py-4 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-gold hover:text-white transition duration-500 shadow-xl">Explore Menu</a>
                    <a href="{{ route('event') }}" class="border border-white/20 px-10 py-4 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-white hover:text-dark transition duration-500">Banquet Details</a>
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
                <img src="{{ asset('assets/maps.png') }}" class="w-full h-full object-cover" alt="Map Location">
            </div>
            <p class="text-gray-500 mb-12 max-w-xl mx-auto italic">Jl. Otto Iskandardinata 460, Bandung, Indonesia</p>
            <a href="{{ route('contact') }}" class="inline-block bg-dark text-white px-16 py-5 text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-gold transition-colors duration-500 shadow-2xl">Contact Receptionist</a>
        </div>
    </section>
@endsection