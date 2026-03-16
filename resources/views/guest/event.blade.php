@extends('layouts.guest')
@section('title', 'Events & Banquets - D\'best Hotel Bandung')

@section('content')

    {{-- 1. HERO SECTION --}}
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?auto=format&fit=crop&q=80&w=2000" 
             class="absolute w-full h-full object-cover scale-105 animate-slow-zoom">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative text-center text-white px-6">
            <span class="text-[10px] uppercase tracking-[0.6em] text-gold mb-4 block">Banquets & Celebrations</span>
            <h1 class="font-luxury text-7xl mb-6 italic">Event Venues</h1>
            <div class="w-24 h-[1px] bg-gold mx-auto"></div>
        </div>
    </section>

    {{-- 2. COMPLEX EDITORIAL OVERVIEW --}}
    <section class="py-32 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-20 items-start">
                {{-- Sidebar Info --}}
                <div class="lg:col-span-4 sticky top-32">
                    <span class="text-gold text-[10px] uppercase tracking-[0.4em] mb-4 block">Venues Portfolio</span>
                    <h2 class="font-luxury text-5xl italic leading-tight mb-8">Architecture of Occasions</h2>
                    <p class="text-gray-500 font-light leading-relaxed mb-8">
                        D'best Hotel orchestrates high-stakes corporate summits and bespoke wedding galas with surgical precision. Our venues are engineered to reflect the gravity of your vision.
                    </p>
                    <div class="space-y-4">
                        <a href="#inquiry" class="block text-[10px] font-bold uppercase tracking-[0.3em] border-b border-gold pb-1 w-max hover:text-gold transition-all">Download Floor Plans</a>
                        <a href="#inquiry" class="block text-[10px] font-bold uppercase tracking-[0.3em] border-b border-gold pb-1 w-max hover:text-gold transition-all">View Catering Menus</a>
                    </div>
                </div>

                {{-- Complex Image Gallery Grid --}}
                <div class="lg:col-span-8 grid grid-cols-2 gap-6">
                    <div class="h-[500px] bg-gray-100 relative group overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute bottom-8 left-8 text-white z-10">
                            <h4 class="font-bold text-sm uppercase tracking-widest">Grand Ballroom</h4>
                            <p class="text-[10px] opacity-70">Capacity: 300 Pax</p>
                        </div>
                    </div>
                    <div class="h-[500px] bg-gray-100 relative group overflow-hidden mt-16">
                        <img src="https://images.unsplash.com/photo-1577412647305-991150c7d163?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute bottom-8 left-8 text-white z-10">
                            <h4 class="font-bold text-sm uppercase tracking-widest">Executive Boardroom</h4>
                            <p class="text-[10px] opacity-70">Capacity: 20 Pax</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. TECHNICAL SPECIFICATIONS (Dense Data Table) --}}
    <section class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-[1000px] mx-auto px-6">
            <h4 class="text-center font-luxury text-3xl mb-16 italic">Technical Specifications</h4>
            <div class="bg-white p-2 border border-gray-200">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-gray-100 text-[9px] uppercase tracking-[0.3em] text-gray-500">
                            <th class="p-6">Venue Name</th>
                            <th class="p-6 text-center">Area (m²)</th>
                            <th class="p-6 text-center">Theater</th>
                            <th class="p-6 text-center">Classroom</th>
                            <th class="p-6 text-center">U-Shape</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach([
                            ['The Poet Ballroom', '450', '350', '200', '150'], 
                            ['Meeting Room A', '60', '40', '25', '20'], 
                            ['Meeting Room B', '55', '35', '20', '15'],
                            ['Boardroom Alpha', '30', '-', '-', '12']
                        ] as $row)
                        <tr class="hover:bg-gold/5 transition-colors">
                            <td class="p-6 font-bold text-dark">{{ $row[0] }}</td>
                            <td class="p-6 text-center text-gray-500">{{ $row[1] }}</td>
                            <td class="p-6 text-center text-gray-500">{{ $row[2] }}</td>
                            <td class="p-6 text-center text-gray-500">{{ $row[3] }}</td>
                            <td class="p-6 text-center text-gray-500">{{ $row[4] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- 4. CONCIERGE & BOOKING (Unified Bottom Section) --}}
    <section id="inquiry" class="py-32 bg-white relative">
        <div class="max-w-[1000px] mx-auto px-6 grid md:grid-cols-2 gap-20">
            <div>
                <h2 class="font-luxury text-5xl mb-8 italic">Ready to Begin?</h2>
                <p class="text-gray-500 mb-10 text-sm leading-relaxed italic">
                    Our dedicated events team is at your disposal to craft a bespoke proposal. Whether you are hosting a gala or a summit, we ensure every technical and logistical requirement is met with perfection.
                </p>
                <div class="flex gap-6">
                    <a href="/contact" class="px-10 py-4 bg-dark text-white font-bold text-[10px] uppercase tracking-[0.3em] hover:bg-gold transition-all duration-500">Event Proposal</a>
                    <a href="tel:+6222XXXXX" class="px-10 py-4 border border-dark text-[10px] font-bold uppercase tracking-[0.3em] hover:bg-dark hover:text-white transition-all duration-500">Planner Call</a>
                </div>
            </div>
            
            {{-- Professional Checklist --}}
            <div class="border-l border-gold pl-10">
                <h5 class="text-sm font-bold uppercase tracking-widest mb-8">What We Provide</h5>
                <ul class="space-y-4 text-xs text-gray-500">
                    <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 bg-gold"></span> High-Speed Fiber Optic Connectivity</li>
                    <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 bg-gold"></span> Integrated Digital Projection Systems</li>
                    <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 bg-gold"></span> Dedicated Event Concierge Manager</li>
                    <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 bg-gold"></span> Full-Service In-House Catering Team</li>
                    <li class="flex items-center gap-3"><span class="w-1.5 h-1.5 bg-gold"></span> Bespoke Floral & Theme Styling</li>
                </ul>
            </div>
        </div>
    </section>

@endsection