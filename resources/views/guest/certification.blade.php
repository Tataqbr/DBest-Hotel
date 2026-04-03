@extends('layouts.guest')

@section('content')
<section class="relative h-[50vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        {{-- Background hero utama --}}
        <img src="{{ asset('assets/home.jpeg') }}" 
             alt="d'best Hotel Bandung Certification" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10 text-center">
        <span class="text-sm tracking-[0.4em] uppercase text-gray-200 mb-4 block animate-fade-in">
            Commitment to Excellence
        </span>
        <h1 class="text-4xl md:text-6xl font-serif text-white mb-6 italic">
            Our Certifications
        </h1>
        <div class="w-20 h-[1px] bg-white/40 mx-auto"></div>
    </div>
</section>

<section class="pt-20 pb-10 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto text-center">
            <span class="text-sm tracking-[0.3em] uppercase text-gray-400 mb-4 block font-medium">Trust & Quality</span>
            <div class="w-12 h-[1px] bg-gray-300 mx-auto mb-8"></div>
            <p class="text-gray-500 leading-relaxed max-w-2xl mx-auto font-light text-lg">
                d'best Hotel Bandung is committed to maintaining the highest operational standards. The following official documentation and certifications demonstrate our dedication to your comfort and safety.
            </p>
        </div>
    </div>
</section>

<section class="py-20 bg-[#fcfcfc]">
    <div class="container mx-auto px-6 lg:px-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 lg:gap-24">
            
            <div class="group">
                <div class="relative overflow-hidden bg-white p-4 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] transition-all duration-500 group-hover:shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15)] group-hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[1/1.41] bg-gray-50 overflow-hidden relative border border-gray-100">
                        {{-- ASSET GAMBAR (Thumbnail) --}}
                        <img src="{{ asset('assets/certifications/sippa.png') }}" 
                             alt="Izin Sippa Preview" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            {{-- ASSET PDF (Dokumen Asli) --}}
                            <a href="{{ asset('assets/certifications/4. Izin Sippa Dbest 23 Jan 2026 - 23 Jan 2031.pdf') }}" target="_blank" class="bg-white text-gray-900 px-6 py-3 text-xs tracking-[0.2em] uppercase hover:bg-gray-900 hover:text-white transition-all duration-300 shadow-xl">
                                View Full Document
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <h3 class="text-2xl font-serif text-gray-800 mb-2 italic">Izin Sippa Dbest 23 Jan 2026 - 23 Jan 2031</h3>
                </div>
            </div>

            <div class="group">
                <div class="relative overflow-hidden bg-white p-4 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] transition-all duration-500 group-hover:shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15)] group-hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[1/1.41] bg-gray-50 overflow-hidden relative border border-gray-100">
                        {{-- ASSET GAMBAR (Thumbnail) --}}
                        <img src="{{ asset('assets/certifications/izin-lingkungan.png') }}" 
                             alt="Izin Lingkungan" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            {{-- ASSET PDF (Dokumen Asli) --}}
                            <a href="{{ asset('assets/certifications/Izin lingkungan No. 503.660.pdf') }}" target="_blank" class="bg-white text-gray-900 px-6 py-3 text-xs tracking-[0.2em] uppercase hover:bg-gray-900 hover:text-white transition-all duration-300 shadow-xl">
                                View Full Document
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <h3 class="text-2xl font-serif text-gray-800 mb-2 italic">Izin lingkungan No. 503.660</h3>
                </div>
            </div>

            <div class="group">
                <div class="relative overflow-hidden bg-white p-4 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] transition-all duration-500 group-hover:shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15)] group-hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[1/1.41] bg-gray-50 overflow-hidden relative border border-gray-100">
                        {{-- ASSET GAMBAR (Thumbnail) --}}
                        <img src="{{ asset('assets/certifications/tdup.png') }}" 
                             alt="TDUP NO. 556_TDUP-00000894_DISBUDPAR 2013" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            {{-- ASSET PDF (Dokumen Asli) --}}
                            <a href="{{ asset('assets/certifications/TDUP NO. 556_TDUP-00000894_DISBUDPAR 2013.pdf') }}" target="_blank" class="bg-white text-gray-900 px-6 py-3 text-xs tracking-[0.2em] uppercase hover:bg-gray-900 hover:text-white transition-all duration-300 shadow-xl">
                                View Full Document
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <h3 class="text-2xl font-serif text-gray-800 mb-2 italic">TDUP NO. 556_TDUP-00000894_DISBUDPAR 2013</h3>
                </div>
            </div>

            <div class="group">
                <div class="relative overflow-hidden bg-white p-4 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] transition-all duration-500 group-hover:shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15)] group-hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[1/1.41] bg-gray-50 overflow-hidden relative border border-gray-100">
                        {{-- ASSET GAMBAR (Thumbnail) --}}
                        <img src="{{ asset('assets/certifications/appreciate.png') }}" 
                             alt="Sertifikat Appreciate Best Hotel" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            {{-- ASSET PDF (Dokumen Asli) --}}
                            <a href="{{ asset('assets/certifications/30. sertifikat appreciate best hotel.pdf') }}" target="_blank" class="bg-white text-gray-900 px-6 py-3 text-xs tracking-[0.2em] uppercase hover:bg-gray-900 hover:text-white transition-all duration-300 shadow-xl">
                                View Full Document
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <h3 class="text-2xl font-serif text-gray-800 mb-2 italic">Sertifikat Appreciate Best Hotel</h3>
                </div>
            </div>

            <div class="group">
                <div class="relative overflow-hidden bg-white p-4 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] transition-all duration-500 group-hover:shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15)] group-hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[1/1.41] bg-gray-50 overflow-hidden relative border border-gray-100">
                        {{-- ASSET GAMBAR (Thumbnail) --}}
                        <img src="{{ asset('assets/certifications/hygiene.png') }}" 
                             alt="Sertifikat layak hygiene 2014" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            {{-- ASSET PDF (Dokumen Asli) --}}
                            <a href="{{ asset('assets/certifications/29. Sertifikat layak hygiene 2014.pdf') }}" target="_blank" class="bg-white text-gray-900 px-6 py-3 text-xs tracking-[0.2em] uppercase hover:bg-gray-900 hover:text-white transition-all duration-300 shadow-xl">
                                View Full Document
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <h3 class="text-2xl font-serif text-gray-800 mb-2 italic">Sertifikat Layak Hygiene 2014</h3>
                </div>
            </div>

            <div class="group">
                <div class="relative overflow-hidden bg-white p-4 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.1)] transition-all duration-500 group-hover:shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15)] group-hover:-translate-y-2 border border-gray-100">
                    <div class="aspect-[1/1.41] bg-gray-50 overflow-hidden relative border border-gray-100">
                        {{-- ASSET GAMBAR (Thumbnail) --}}
                        <img src="{{ asset('assets/certifications/pelatihan.png') }}" 
                             alt="Sertifikat Pelatihan Herdian" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            {{-- ASSET PDF (Dokumen Asli) --}}
                            <a href="{{ asset('assets/certifications/sertifikat pelatihan herdian.pdf') }}" target="_blank" class="bg-white text-gray-900 px-6 py-3 text-xs tracking-[0.2em] uppercase hover:bg-gray-900 hover:text-white transition-all duration-300 shadow-xl">
                                View Full Document
                            </a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <h3 class="text-2xl font-serif text-gray-800 mb-2 italic">Sertifikat Pelatihan Herdian</h3>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:italic,wght@400;700&display=swap');
    
    .font-serif {
        font-family: 'Playfair Display', serif;
    }

    /* Animasi halus untuk hero text */
    .animate-fade-in {
        animation: fadeIn 1.2s ease-out forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection