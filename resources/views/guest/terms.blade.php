@extends('layouts.guest')
@section('title', 'Terms & Conditions - D\'best Hotel Bandung')

@section('content')

    {{-- 1. HERO SECTION (Consistent with other pages) --}}
    <section class="relative h-[50vh] flex items-center justify-center overflow-hidden">
        {{-- Foto latar belakang yang profesional & relevan --}}
        <img src="{{ asset('assets/terms.jpg') }}" 
             class="absolute w-full h-full object-cover scale-105 animate-slow-zoom" 
             alt="Legal Documentation">
        
        {{-- Gradien overlay agar teks mudah dibaca dan konsisten --}}
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/60"></div>
        
        <div class="relative text-center text-white px-6">
            <span class="text-[10px] uppercase tracking-[0.6em] text-gold mb-4 block animate-fade-in">Legal Framework</span>
            <h1 class="font-luxury text-6xl lg:text-7xl mb-4 drop-shadow-2xl italic">Terms of Service</h1>
            <div class="w-24 h-[1px] bg-gold mx-auto"></div>
        </div>
    </section>

    {{-- 2. CONTENT SECTION (Consistent Typography) --}}
    <section class="py-24 bg-white">
        <div class="max-w-[800px] mx-auto px-6">
            <div class="space-y-16 text-gray-600 font-light leading-relaxed">
                
                {{-- Intro --}}
                <div class="border-b border-gray-100 pb-12">
                    <p class="text-sm italic text-gray-400 mb-6">Last Updated: March 2026</p>
                    <p class="text-sm">Welcome to D'best Hotel Bandung. By accessing our website and utilizing our online booking services, you agree to comply with and be bound by the following terms and conditions. These terms govern the use of our services and ensure a transparent relationship between our hotel and our guests.</p>
                </div>

                {{-- Terms Content --}}
                <div class="space-y-12">
                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">1. Booking and Reservations</h3>
                        <p class="text-sm pl-6">All reservations made through our website are subject to availability and confirmation. A valid credit card is required to guarantee your booking. You must be at least 18 years of age to make a reservation.</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">2. Payment Terms</h3>
                        <p class="text-sm pl-6">Payments are processed via secure third-party gateways. By providing payment details, you authorize us to charge the total amount due. All prices are quoted in Indonesian Rupiah (IDR).</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">3. Cancellation and Refund</h3>
                        <p class="text-sm pl-6">Cancellations must be submitted in writing. Non-refundable rates are final. For refundable rates, cancellations must be made at least 48 hours prior to the scheduled check-in time.</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">4. Hotel Policies</h3>
                        <p class="text-sm pl-6">Check-in time is 14:00; check-out is 12:00. Guests are expected to maintain appropriate behavior; the hotel reserves the right to evict any guest who violates hotel policies or local laws.</p>
                    </div>
                </div>


                {{-- Contact Block --}}
                <div class="pt-8 border-t border-gray-100">
                    <h4 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4">Inquiries</h4>
                    <p class="text-sm">For any questions regarding these terms, please contact us:</p>
                    <ul class="text-sm mt-4 space-y-1 font-medium">
                        <li>D'best Hotel Bandung</li>
                        <li>Jl. Otto Iskandardinata 460, Bandung</li>
                        <li>info@dbest-hotel.com | (022) 522 8899</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

@endsection