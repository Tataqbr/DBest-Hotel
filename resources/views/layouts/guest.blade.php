<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { colors: { 'gold': '#B89650', 'dark': '#0A1D37', 'gray-custom': '#F4F4F4' } } } }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-luxury { font-family: 'Cormorant Garamond', serif; }
            [x-cloak] { display: none !important; }
    /* Pastikan font tetap terbaca rapi */
    .nav-link { transition: all 0.3s ease; }
    </style>
</head>
<body class="bg-white text-dark antialiased">

    {{-- NAVIGATION --}}

<nav x-data="{ scrolled: false, mobileOpen: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 50)"
     :class="scrolled ? 'bg-white text-dark shadow-md py-4' : 'bg-transparent text-white py-6'"
     class="fixed w-full z-[100] transition-all duration-500 ease-in-out border-b border-white/10">
    
    <div class="max-w-[1400px] mx-auto px-6 flex items-center justify-between">
        {{-- Logo --}}
        <a href="/">
            <img src="{{ asset('assets/logo.png') }}" class="h-20 transition-all duration-300" :class="scrolled ? 'brightness-100' : 'brightness-0 invert'" alt="Logo">
        </a>
        
        {{-- Desktop Menu --}}
        <div class="hidden lg:flex gap-8 text-[11px] font-bold tracking-[0.2em] uppercase">
            <a href="{{ route('about-us') }}" class="hover:text-gold transition">About Us</a>
            <a href="{{ route('accommodation') }}" class="hover:text-gold transition">Accommodations</a>
            <a href="{{ route('dining') }}" class="hover:text-gold transition">Dining</a>
            <a href="{{ route('event') }}" class="hover:text-gold transition">Events</a>
        </div>

        <a href="{{ route('accommodation') }}" class="hidden lg:block border border-gold px-8 py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-gold transition">Reserve Now</a>

        {{-- Mobile Hamburger --}}
        <button @click="mobileOpen = true" class="lg:hidden p-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" d="M4 6h16M4 12h16m-7 6h7"/></svg>
        </button>
    </div>

    {{-- Mobile Overlay (Smooth Transition) --}}
    <div x-show="mobileOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 -translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-full"
         class="fixed inset-0 bg-dark z-[200] flex flex-col items-center justify-center gap-8 text-white">
        
        <button @click="mobileOpen = false" class="absolute top-8 right-8 p-2 hover:text-gold">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <a href="{{ route('about-us') }}" @click="mobileOpen = false" class="text-3xl font-luxury hover:text-gold">About Us</a>
        <a href="{{ route('accommodation') }}" @click="mobileOpen = false" class="text-3xl font-luxury hover:text-gold">Accommodations</a>
        <a href="{{ route('dining') }}" @click="mobileOpen = false" class="text-3xl font-luxury hover:text-gold">Dining</a>
        <a href="{{ route('event') }}" @click="mobileOpen = false" class="text-3xl font-luxury hover:text-gold">Events</a>
    </div>
</nav>

    <main>@yield('content')</main>

   {{-- FOOTER --}}
<footer class="bg-dark text-white pt-20 pb-10">
    <div class="max-w-[1400px] mx-auto px-6 grid md:grid-cols-4 gap-12">
        {{-- Brand Info --}}
        <div>
            <h4 class="font-luxury text-2xl text-gold mb-6">d'best Hotel</h4>
            <p class="text-[11px] leading-loose text-gray-400">Jl. Otto Iskandardinata 460, Bandung 40242, Indonesia. Experience the perfect blend of central trade accessibility and comfort.</p>
        </div>

        {{-- Discover Links --}}
        <div>
            <h5 class="text-[10px] uppercase tracking-[0.3em] text-gold mb-6">Discover</h5>
            <ul class="text-[11px] space-y-4 text-gray-400 uppercase tracking-wider">
                <li><a href="{{ route('accommodation') }}" class="hover:text-gold transition">Rooms & Suites</a></li>
                <li><a href="{{ route('dining') }}" class="hover:text-gold transition">D'Poet Restaurant</a></li>
                <li><a href="{{ route('event') }}" class="hover:text-gold transition">Banquet & Meeting</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-gold transition">Inquiries & Contact</a></li>
            </ul>
        </div>

        {{-- Connect --}}
        <div>
            <h5 class="text-[10px] uppercase tracking-[0.3em] text-gold mb-6">Connect</h5>
            <ul class="text-[11px] space-y-4 text-gray-400">
                <li>Phone: (022) 522 8899</li>
                <li>Email: info@dbesthotel.com</li>
                <li>Check-in: 14:00 | Check-out: 12:00</li>
            </ul>
        </div>

        {{-- Location / Maps Placeholder --}}
        <div>
            <h5 class="text-[10px] uppercase tracking-[0.3em] text-gold mb-6">Location</h5>
            <div class="w-full h-32 bg-gray-800 flex items-center justify-center text-[10px] text-gray-500 italic hover:bg-gray-700 transition cursor-pointer">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7328.557514733815!2d107.60332336438016!3d-6.930377587261665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e89e736eb5ad%3A0xb4679720b2356d75!2sd&#39;best%20Hotel!5e1!3m2!1sid!2sid!4v1774517716240!5m2!1sid!2sid" style="border:0; filter: grayscale(100%) contrast(1.2) opacity(0.8); allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    {{-- Legal Links Section (Mandatory for Payment Gateways) --}}
    <div class="max-w-[1400px] mx-auto px-6 mt-16 pt-10 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="text-[10px] text-gray-500 uppercase tracking-widest">
            &copy; 2026 d'best Hotel Bandung. All Rights Reserved.
        </div>
        
        <nav class="flex gap-8 text-[10px] uppercase tracking-[0.2em] text-gray-400">
            <a href="{{ route('terms') }}" class="hover:text-gold transition">Terms of Service</a>
            <a href="{{ route('privacy') }}" class="hover:text-gold transition">Privacy Policy</a>
            <a href="{{ route('refund') }}" class="hover:text-gold transition">Refund Policy</a>
        </nav>
    </div>
</footer>
</body>
</html>