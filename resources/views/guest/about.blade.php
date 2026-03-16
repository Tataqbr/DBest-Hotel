@extends('layouts.guest')
@section('title', 'Our Story - d\'best Hotel Bandung')

@section('content')
    {{-- 1. HEADER SECTION --}}
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <img src="https://i.pinimg.com/1200x/1a/f3/82/1af382c158f5ea1d3557dd92c81e757a.jpg" class="absolute w-full h-full object-cover" alt="About d'best Hotel">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative text-center text-white px-6 mt-16">
            <span class="text-[10px] uppercase tracking-[0.5em] text-gold mb-4 block">Established with Passion</span>
            <h1 class="font-luxury text-5xl lg:text-7xl">Our Story</h1>
        </div>
    </section>

    {{-- 2. VISION & MISSION SECTION --}}
    <section class="py-24 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="relative">
                    <div class="absolute -bottom-6 -right-6 w-full h-full border-2 border-gold/20 -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1544124499-58912cbddaad?auto=format&fit=crop&q=80&w=1000" class="w-full h-[600px] object-cover shadow-2xl" alt="Hotel Interior">
                </div>
                <div>
                    <span class="text-gold text-[10px] uppercase tracking-[0.4em] mb-6 block">Legacy of Excellence</span>
                    <h2 class="font-luxury text-4xl text-dark mb-8">A Sanctuary in the City's Heart</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        Strategically located on Jl. Otto Iskandardinata 460, d'best Hotel Bandung stands as a premier representation of West Javanese hospitality blended with modern comfort standards. Since our inception, we have been committed to being a "home away from home" for business professionals and travelers seeking tranquility amidst Bandung’s vibrant trade district.
                    </p>
                    <div class="space-y-8 mt-12">
                        <div class="flex gap-6">
                            <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center border border-gold text-gold font-luxury text-xl italic">V</div>
                            <div>
                                <h4 class="font-bold text-dark uppercase tracking-widest text-sm mb-2">Our Vision</h4>
                                <p class="text-gray-500 text-sm leading-relaxed">To be Bandung's leading hospitality choice, prioritizing professional efficiency while maintaining a warm, personal touch in every guest interaction.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center border border-gold text-gold font-luxury text-xl italic">M</div>
                            <div>
                                <h4 class="font-bold text-dark uppercase tracking-widest text-sm mb-2">Our Mission</h4>
                                <p class="text-gray-500 text-sm leading-relaxed">To provide high-quality facilities, ensure maximum rest for our guests, and serve authentic culinary experiences that reflect our heritage.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. STATS SECTION - Global Metrics --}}
    <section class="py-20 bg-dark text-white">
        <div class="max-w-[1200px] mx-auto px-6 grid grid-cols-2 lg:grid-cols-4 gap-12 text-center">
            <div>
                <span class="font-luxury text-5xl text-gold block mb-2">53</span>
                <span class="text-[10px] uppercase tracking-widest text-gray-400">Guest Rooms</span>
            </div>
            <div>
                <span class="font-luxury text-5xl text-gold block mb-2">23:00</span>
                <span class="text-[10px] uppercase tracking-widest text-gray-400">Late Dining</span>
            </div>
            <div>
                <span class="font-luxury text-5xl text-gold block mb-2">100+</span>
                <span class="text-[10px] uppercase tracking-widest text-gray-400">Banquet Capacity</span>
            </div>
            <div>
                <span class="font-luxury text-5xl text-gold block mb-2">4.5</span>
                <span class="text-[10px] uppercase tracking-widest text-gray-400">Guest Rating</span>
            </div>
        </div>
    </section>

    {{-- 4. STRATEGIC LOCATION SECTION --}}
    <section class="py-24 bg-gray-50">
        <div class="max-w-[1200px] mx-auto px-6 text-center">
            <h2 class="font-luxury text-4xl text-dark mb-16">Prime Connectivity</h2>
            <div class="grid lg:grid-cols-3 gap-12 text-left">
                <div class="bg-white p-10 border border-gray-100 shadow-sm hover:shadow-xl transition-shadow duration-500">
                    <h5 class="font-bold text-dark mb-4 tracking-widest uppercase text-xs">Shopping Hubs</h5>
                    <p class="text-gray-500 text-sm leading-relaxed">Steps away from ITC Kebon Kalapa and Pasar Baru Trade Center—the ultimate destinations for Bandung's world-famous textile shopping.</p>
                </div>
                <div class="bg-white p-10 border border-gray-100 shadow-sm hover:shadow-xl transition-shadow duration-500">
                    <h5 class="font-bold text-dark mb-4 tracking-widest uppercase text-xs">Transit Access</h5>
                    <p class="text-gray-500 text-sm leading-relaxed">Only 15 minutes from Bandung Central Railway Station and a short drive to Husein Sastranegara International Airport.</p>
                </div>
                <div class="bg-white p-10 border border-gray-100 shadow-sm hover:shadow-xl transition-shadow duration-500">
                    <h5 class="font-bold text-dark mb-4 tracking-widest uppercase text-xs">Cultural Center</h5>
                    <p class="text-gray-500 text-sm leading-relaxed">Easy access to the historic Alun-Alun Bandung, Asia Afrika heritage sites, and the vibrant culinary scene of Jalan Lengkong.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. PHILOSOPHY SECTION --}}
    <section class="py-24 bg-white">
        <div class="max-w-[1200px] mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-gold text-[10px] uppercase tracking-[0.4em] mb-4 block">Our Commitment</span>
                <h2 class="font-luxury text-4xl text-dark mb-6">Unrivaled Hospitality</h2>
                <p class="text-gray-600 leading-relaxed mb-10">
                    Our team is trained to anticipate your needs before you even voice them. At d'best Hotel, we don't just provide a room; we provide peace of mind for corporate travelers on duty and families creating lasting memories.
                </p>
                <a href="/contact" class="inline-block bg-dark text-white px-12 py-4 text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-gold transition-all duration-500">Get in Touch</a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <img src="https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&q=80&w=600" class="rounded-sm" alt="Luxury Suite Detail">
                <img src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7?auto=format&fit=crop&q=80&w=600" class="rounded-sm mt-12 shadow-2xl" alt="Hospitality Service">
            </div>
        </div>
    </section>
@endsection