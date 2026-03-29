@extends('layouts.guest')
@section('title', 'Privacy Policy - D\'best Hotel Bandung')

@section('content')

    {{-- 1. HERO SECTION (Consistent Photo-Based Layout) --}}
    <section class="relative h-[50vh] flex items-center justify-center overflow-hidden">
        {{-- Menggunakan foto interior yang bersih dan profesional --}}
        <img src="{{ asset('assets/privacy.jpg') }}" 
             class="absolute w-full h-full object-cover scale-105 animate-slow-zoom" 
             alt="Privacy Policy">
        
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/60"></div>
        
        <div class="relative text-center text-white px-6">
            <span class="text-[10px] uppercase tracking-[0.6em] text-gold mb-4 block animate-fade-in">Legal Framework</span>
            <h1 class="font-luxury text-6xl lg:text-7xl mb-4 drop-shadow-2xl italic">Privacy Policy</h1>
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
                    <p class="text-sm">At D'best Hotel Bandung, your privacy is our priority. This Privacy Policy outlines how we collect, use, and protect the personal information you provide when using our website and reservation services. By using our platform, you consent to the practices described below.</p>
                </div>

                {{-- Policy Content --}}
                <div class="space-y-12">
                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">1. Data Collection</h3>
                        <p class="text-sm pl-6">We collect personal information such as your name, email, contact number, and payment details during the reservation process. We do not store sensitive payment card information directly on our servers.</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">2. Use of Information</h3>
                        <p class="text-sm pl-6">Your data is utilized exclusively for reservation fulfillment, service customization, and customer support. We adhere to strict internal protocols to ensure your data is never sold or shared with unauthorized third parties.</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">3. Security Standards</h3>
                        <p class="text-sm pl-6">All financial transactions are routed through industry-certified, encrypted payment gateways. We utilize advanced security measures to safeguard against unauthorized access to your personal information.</p>
                    </div>

                    <div>
                        <h3 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4 border-l-2 border-gold pl-4">4. Cookies and Tracking</h3>
                        <p class="text-sm pl-6">Our website utilizes cookies to optimize your browsing experience. These small text files help us understand user preferences and improve site functionality. You maintain full control over cookie permissions via your browser settings.</p>
                    </div>
                </div>



                {{-- Contact Block --}}
                <div class="pt-8 border-t border-gray-100">
                    <h4 class="font-bold text-dark uppercase tracking-[0.2em] text-[11px] mb-4">Privacy Inquiries</h4>
                    <p class="text-sm">For questions regarding our privacy practices or data removal requests, please contact:</p>
                    <ul class="text-sm mt-4 space-y-1 font-medium">
                        <li>Email: privacy@dbesthotel.com</li>
                        <li>Phone: (022) 522 8899</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

@endsection