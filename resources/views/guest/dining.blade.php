@extends('layouts.guest')
@section('title', 'D\'Poet Restaurant - Culinary Excellence in Bandung')

@section('content')

{{-- 1. HERO SECTION - Aligned with Accommodations Page --}}
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        {{-- Video/Image background yang konsisten dengan halaman sebelumnya --}}
        <img src="{{ asset('assets/dining.avif') }}" 
             class="absolute w-full h-full object-cover scale-105 animate-slow-zoom" 
             alt="Dining Experience">
        
        {{-- Gradien overlay agar teks mudah dibaca dan konsisten --}}
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/60"></div>
        
        <div class="relative text-center text-white px-6">
            <span class="text-[10px] uppercase tracking-[0.6em] text-gold mb-4 block animate-fade-in">Culinary Artistry</span>
            <h1 class="font-luxury text-6xl lg:text-8xl mb-4 drop-shadow-2xl italic">D'Poet Restaurant</h1>
            <div class="w-24 h-[1px] bg-gold mx-auto mb-8"></div>
            
            {{-- Tombol dengan gaya yang sama seperti halaman Rooms --}}
            <a href="#menu" 
               class="inline-block px-10 py-4 border border-white/50 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-gold hover:border-gold transition-all duration-500">
                View Our Menu
            </a>
        </div>
    </section>

    {{-- 2. PHILOSOPHY & CULINARY NARRATIVE --}}
    <section class="py-32 bg-white">
        <div class="max-w-[1200px] mx-auto px-6 grid lg:grid-cols-2 gap-24 items-center">
            <div>
                <span class="text-gold font-accent text-[10px] tracking-[0.5em] mb-8 block uppercase">The Culinary Mandate</span>
                <h2 class="font-luxury text-5xl text-dark mb-10 leading-tight">Where Heritage Meets Culinary Innovation</h2>
                <div class="space-y-6 text-gray-600 font-light leading-relaxed">
                    <p>At D'Poet, our kitchen is a sanctuary of flavor. We harmonize the rich, complex spices of Sundanese heritage with the refined precision of French gastronomy, creating an experience that is both nostalgic and avant-garde.</p>
                    <p>Our commitment to terroir is absolute. We partner with artisanal farmers in the Bandung Highlands to ensure our ingredients—from heirloom vegetables to sustainably sourced meats—are delivered to our kitchen within hours of harvest.</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <img src="{{ asset('assets/culinary-1.avif') }}" class="h-96 w-full object-cover shadow-2xl">
                <img src="{{ asset('assets/culinary-2.avif') }}" class="h-96 w-full object-cover mt-16 shadow-2xl">
            </div>
        </div>
    </section>

    {{-- 3. SIGNATURE MENU COLLECTIONS --}}
<section id="menu" class="py-32 bg-[#121212] text-white">
    <div class="max-w-[1100px] mx-auto px-6">
        <h2 class="font-luxury text-5xl text-center mb-24 text-gold italic">Chef's Signature Selections</h2>
        
        <div class="space-y-32">
            {{-- Loop Pertama: Berdasarkan Kategori --}}
            @foreach($menu as $category => $items)
            <div>
                <h3 class="font-luxury text-4xl mb-16 border-b border-white/10 pb-6 uppercase tracking-widest">
                    {{ $category }}
                </h3>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-12">
                    {{-- Loop Kedua: Item di dalam Kategori tersebut --}}
                    @foreach($items as $item)
                    <div class="group cursor-default">
                        {{-- Image Container --}}
                        <div class="h-64 overflow-hidden mb-6 border border-white/10 relative">
                            <img src="{{ asset('assets/dining/' . $item->image_path) }}" 
                                 class="w-full h-full object-cover transition duration-700 grayscale group-hover:grayscale-0 group-hover:scale-110"
                                 alt="{{ $item->name }}">
                            
                            {{-- Overlay jika stok habis (jaga-jaga jika is_available logic ada di view) --}}
                            @if(!$item->is_available)
                            <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                <span class="text-[10px] tracking-[0.3em] uppercase font-bold text-white border border-white px-4 py-2">Sold Out</span>
                            </div>
                            @endif
                        </div>

                        {{-- Header Menu --}}
                        <div class="flex justify-between items-baseline mb-2">
                            <h5 class="font-bold text-lg group-hover:text-gold transition-colors duration-500">
                                {{ $item->name }}
                            </h5>
                            <span class="text-gold font-mono text-sm">
                                IDR {{ number_format($item->price, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- Description --}}
                        <p class="text-[12px] text-gray-400 leading-relaxed italic font-light line-clamp-3">
                            {{ $item->description }}
                        </p>
                        
                        <div class="mt-4 h-[1px] w-0 group-hover:w-full bg-gold/30 transition-all duration-700"></div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

 {{-- 4. REFINED CONCIERGE & OPERATIONS (Light Theme) --}}
<section class="py-32 bg-gray-50 relative">
    <div class="max-w-[1200px] mx-auto px-6">
        
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            {{-- Left: Stats & Philosophy --}}
            <div class="space-y-12">
                <div>
                    <span class="text-gold text-[10px] uppercase tracking-[0.4em] mb-4 block">Concierge Desk</span>
                    <h2 class="font-luxury text-5xl text-dark">The Dining Experience</h2>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="border border-gray-200 p-8 bg-white shadow-sm hover:border-gold transition-all duration-500">
                        <span class="block text-gold font-luxury text-3xl mb-2">06:00</span>
                        <span class="text-gray-400 text-[10px] uppercase tracking-widest">Early Breakfast</span>
                    </div>
                    <div class="border border-gray-200 p-8 bg-white shadow-sm hover:border-gold transition-all duration-500">
                        <span class="block text-gold font-luxury text-3xl mb-2">80</span>
                        <span class="text-gray-400 text-[10px] uppercase tracking-widest">Guest Capacity</span>
                    </div>
                </div>

                <blockquote class="text-gray-500 italic border-l-2 border-gold pl-6 text-sm">
                    "From sunrise coffee at the terrace to candlelit dinners, every detail is orchestrated to match your pace."
                </blockquote>
            </div>

            {{-- Right: Smart List (More Detailed) --}}
            <div class="bg-white p-12 border border-gray-200 shadow-xl relative">
                <div class="absolute -top-3 left-12 bg-gray-50 px-4 text-gold uppercase tracking-[0.2em] text-[9px] font-bold">Essential Info</div>
                
                <div class="space-y-10">
                    {{-- Item 1 --}}
                    <div class="group flex items-start gap-6">
                        <div class="w-12 h-12 flex items-center justify-center border border-gold/20 text-gold group-hover:bg-gold group-hover:text-white transition-all duration-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h5 class="text-dark font-bold text-sm mb-2">Service Schedule</h5>
                            <p class="text-gray-500 text-[11px] leading-relaxed">Breakfast: 06:00 – 10:00 | Lunch: 12:00 – 15:00 | Dinner: 18:00 – 23:00. Private dining arrangements are available upon request.</p>
                        </div>
                    </div>

                    {{-- Item 2 --}}
                    <div class="group flex items-start gap-6 border-t border-gray-100 pt-8">
                        <div class="w-12 h-12 flex items-center justify-center border border-gold/20 text-gold group-hover:bg-gold group-hover:text-white transition-all duration-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <div>
                            <h5 class="text-dark font-bold text-sm mb-2">Dress Code & Access</h5>
                            <p class="text-gray-500 text-[11px] leading-relaxed">Smart casual attire is appreciated for dinner services. The restaurant is located at the Lobby Level with full accessibility.</p>
                        </div>
                    </div>

                    {{-- Item 3 --}}
                    <div class="group flex items-start gap-6 border-t border-gray-100 pt-8">
                        <div class="w-12 h-12 flex items-center justify-center border border-gold/20 text-gold group-hover:bg-gold group-hover:text-white transition-all duration-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                        </div>
                        <div>
                            <h5 class="text-dark font-bold text-sm mb-2">Concierge & Inquiries</h5>
                            <p class="text-gray-500 text-[11px] leading-relaxed">For bespoke culinary events, wine pairings, or special occasions, please contact our restaurant manager directly.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection