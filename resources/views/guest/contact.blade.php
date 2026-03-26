@extends('layouts.guest')
@section('title', 'Contact Us - D\'best Hotel Bandung')

@section('content')

    {{-- 1. HERO SECTION (Consistent with Other Pages) --}}
    <section class="relative h-[50vh] flex items-center justify-center overflow-hidden">
        <img src="https://i.pinimg.com/1200x/3d/15/3e/3d153e1f606885d339fb816417def8cc.jpg" 
             class="absolute w-full h-full object-cover scale-105 animate-slow-zoom" 
             alt="Contact D'best Hotel">
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-transparent to-black/70"></div>
        <div class="relative text-center text-white px-6">
            <span class="text-[10px] uppercase tracking-[0.6em] text-gold mb-4 block animate-fade-in">Connect With Us</span>
            <h1 class="font-luxury text-6xl lg:text-7xl mb-4 drop-shadow-2xl italic">Contact Us</h1>
            <div class="w-24 h-[1px] bg-gold mx-auto"></div>
        </div>
    </section>

    {{-- 2. CONTACT CONTENT SECTION --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                
                {{-- Left: Office & Support Info --}}
                <div class="lg:col-span-5 space-y-12">
                    <div>
                        <h2 class="font-luxury text-4xl text-dark mb-6 leading-tight">Personalized <br><span class="italic font-light text-gray-400 font-sans text-2xl uppercase tracking-[0.2em]">Guest Assistance</span></h2>
                        <p class="text-gray-500 font-light leading-relaxed max-w-sm">Whether you have questions about your reservation or special requests for your stay, our concierge team is available 24/7 to assist you.</p>
                    </div>

                    <div class="space-y-10">
                        {{-- Address --}}
                        <div class="flex gap-6 group">
                            <div class="w-12 h-12 bg-dark flex items-center justify-center text-gold transition-all duration-500 group-hover:bg-gold group-hover:text-dark">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark text-[10px] uppercase tracking-[0.2em] mb-2">Primary Location</h4>
                                <p class="text-sm text-gray-500 font-light leading-relaxed">Jl. Otto Iskandardinata No. 460, <br>Bandung 40242, West Java, Indonesia</p>
                            </div>
                        </div>

                        {{-- Phone/WA --}}
                        <div class="flex gap-6 group">
                            <div class="w-12 h-12 bg-dark flex items-center justify-center text-gold transition-all duration-500 group-hover:bg-gold group-hover:text-dark">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark text-[10px] uppercase tracking-[0.2em] mb-2">Direct Inquiry</h4>
                                <p class="text-sm text-gray-500 font-light">(022) 522 8899 <br>+62 811 222 3334 (WhatsApp Only)</p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="flex gap-6 group">
                            <div class="w-12 h-12 bg-dark flex items-center justify-center text-gold transition-all duration-500 group-hover:bg-gold group-hover:text-dark">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark text-[10px] uppercase tracking-[0.2em] mb-2">Digital Correspondence</h4>
                                <p class="text-sm text-gray-500 font-light">info@dbesthotel.com <br>reservation@dbesthotel.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Informative Content (Replaces Form) --}}
<div class="lg:col-span-7">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        {{-- Card 1: Arrival & Transportation --}}
        <div class="bg-gray-50 p-8 border border-gray-100 group hover:bg-dark transition-all duration-500">
            <span class="text-gold font-luxury text-4xl block mb-6 group-hover:text-white">01</span>
            <h3 class="text-dark font-bold text-xs uppercase tracking-[0.2em] mb-4 group-hover:text-gold">Arrival Information</h3>
            <p class="text-gray-500 text-sm font-light leading-relaxed group-hover:text-gray-300">
                Located in the heart of Bandung, we are 15 minutes away from Stasiun Bandung and 20 minutes from Pasteur Toll Gate. We offer airport/station pick-up services upon request.
            </p>
            
        </div>

        {{-- Card 2: Essential FAQs --}}
        <div class="bg-gray-50 p-8 border border-gray-100 group hover:bg-dark transition-all duration-500">
            <span class="text-gold font-luxury text-4xl block mb-6 group-hover:text-white">02</span>
            <h3 class="text-dark font-bold text-xs uppercase tracking-[0.2em] mb-4 group-hover:text-gold">Guest Policies</h3>
            <p class="text-gray-500 text-sm font-light leading-relaxed group-hover:text-gray-300">
                Standard check-in is at 14:00 and check-out at 12:00. Early check-in is subject to availability. Our reception and security are active 24/7 for your convenience.
            </p>
            <div class="mt-6">
                <a href="{{ route('terms') }}" class="text-[10px] font-bold uppercase tracking-widest text-gold border-b border-gold/30 pb-1">View Full FAQ</a>
            </div>
        </div>

    </div>

    {{-- Highlight Box: Instant Support --}}
    <div class="mt-8 bg-dark p-10 relative overflow-hidden group">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
            <div>
                <h3 class="text-white font-luxury text-3xl italic mb-2">Need Instant Response?</h3>
                <p class="text-gray-400 text-sm font-light">Skip the email. Chat directly with our concierge via WhatsApp for faster assistance.</p>
            </div>
            <a href="https://wa.me/628112223334" target="_blank" class="bg-gold text-dark px-8 py-4 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-white transition-colors whitespace-nowrap">
                Chat on WhatsApp
            </a>
        </div>
        {{-- Decorative background icon --}}
        <i class="fab fa-whatsapp absolute -right-4 -bottom-4 text-white/5 text-9xl"></i>
    </div>

    {{-- Nearby Landmarks --}}
    <div class="mt-12">
        <h4 class="text-dark font-bold text-[10px] uppercase tracking-[0.3em] mb-6 flex items-center">
            <span class="w-8 h-[1px] bg-gold mr-4"></span> Nearby Destinations
        </h4>
        <div class="flex flex-wrap gap-4">
            <span class="px-4 py-2 bg-gray-100 text-[10px] text-gray-500 uppercase tracking-widest">Alun-Alun Bandung (5 min)</span>
            <span class="px-4 py-2 bg-gray-100 text-[10px] text-gray-500 uppercase tracking-widest">Pasar Baru (8 min)</span>
            <span class="px-4 py-2 bg-gray-100 text-[10px] text-gray-500 uppercase tracking-widest">Sudirman Street Food (10 min)</span>
        </div>
    </div>
</div>

            </div>
        </div>
    </section>

    {{-- 3. MAP SECTION (Crucial for PG Verification) --}}
    <section class="h-[450px] w-full bg-gray-200">
        {{-- Ganti src dengan link Google Maps resmi d'best Hotel Bandung jika ada --}}
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.67188212994!2d107.59845658480077!3d-6.9297657499460685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e89e736eb5ad%3A0xb4679720b2356d75!2sd&#39;best%20Hotel!5e0!3m2!1sid!2sid!4v1774517160087!5m2!1sid!2sid" 
        width="100%" 
            height="100%" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

@endsection