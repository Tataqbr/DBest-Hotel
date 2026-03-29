@extends('layouts.guest')
@section('title', 'Refund Policy - D\'best Hotel Bandung')

@section('content')

    {{-- 1. HERO SECTION (Consistent Photo-Based Layout) --}}
    <section class="relative h-[50vh] flex items-center justify-center overflow-hidden">
        {{-- Foto yang merepresentasikan layanan premium dan ketenangan --}}
        <img src="{{ asset('assets/refunds.avif') }}" 
             class="absolute w-full h-full object-cover scale-105 animate-slow-zoom" 
             alt="Refund Policy">
        
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/60"></div>
        
        <div class="relative text-center text-white px-6">
            <span class="text-[10px] uppercase tracking-[0.6em] text-gold mb-4 block animate-fade-in">Legal Framework</span>
            <h1 class="font-luxury text-6xl lg:text-7xl mb-4 drop-shadow-2xl italic">Refund Policy</h1>
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
                    <p class="text-sm">At D'best Hotel Bandung, we strive to ensure a seamless experience for every guest. This Refund Policy details the conditions under which refund requests are processed for bookings and services purchased through our website.</p>
                </div>

                {{-- Policy Content --}}
                <div class="space-y-12">
                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">1. Refund Eligibility</h3>
                        <p class="text-sm pl-6">Refunds are only applicable to bookings made under 'Refundable' rate categories. Bookings made under 'Non-Refundable' or 'Special Promotion' rates are strictly non-refundable under any circumstances, regardless of the date of cancellation.</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">2. Cancellation Timeline</h3>
                        <p class="text-sm pl-6">To be eligible for a refund on a qualifying booking, you must submit a written cancellation request at least 48 hours prior to the official check-in time (14:00 local time). Requests made within the 48-hour window will not be eligible for a refund.</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">3. Processing Time</h3>
                        <p class="text-sm pl-6">Once a refund request is approved, the processing period typically takes 7 to 14 business days. Refunds will be credited back to the original payment method used during the initial transaction. Please note that bank processing times may vary.</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">4. Exceptions</h3>
                        <p class="text-sm pl-6">In the event of extraordinary circumstances (e.g., government travel restrictions or force majeure), we reserve the right to review refund requests on a case-by-case basis. Our management's decision regarding such exceptions is final.</p>
                    </div>
                </div>



                {{-- Contact Block --}}
                <div class="pt-8 border-t border-gray-100">
                    <h4 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4">Refund Support</h4>
                    <p class="text-sm">If you have inquiries regarding a pending refund, please reach out to our Finance Department:</p>
                    <ul class="text-sm mt-4 space-y-1 font-medium">
                        <li>Email: billing@dbesthotel.com</li>
                        <li>Phone: (022) 522 8899</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

@endsection