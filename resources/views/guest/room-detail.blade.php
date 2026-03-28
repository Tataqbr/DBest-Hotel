@extends('layouts.guest')

@section('content')
<style>
    /* Professional Typography & Reset */
    * { border-radius: 0 !important; }
    .font-serif { font-family: 'Playfair Display', serif; }
    
    /* Smooth Transition for Hero Overlay */
    .hero-gradient-top {
        background: linear-gradient(to bottom, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 30%, rgba(0,0,0,0) 100%);
    }
    /* .hero-gradient-bottom {
        background: linear-gradient(to top, rgba(255, 255, 255, 0.616) 0%, rgba(100, 98, 98, 0.158) 40%, rgba(255,255,255,0) 100%);
    } */

    /* Minimalist Scrollbar */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: #111; }
</style>

<div class="min-h-screen bg-white">
    
    <div class="relative h-[80vh] w-full overflow-hidden bg-black">
        <img src="{{ asset('assets/room_types/' . $roomType->image_thumbnail) }}" 
             class="w-full h-full object-cover opacity-70" alt="{{ $roomType->name }}">
        
        <div class="absolute inset-0 hero-gradient-top"></div>
        <div class="absolute inset-0 hero-gradient-bottom"></div>
        
        <div class="absolute bottom-24 left-0 w-full">
            <div class="container mx-auto px-12">
                <div class="overflow-hidden mb-4">
                    <span class="text-[10px] text-white font-bold uppercase tracking-[0.6em] block transform translate-y-full animate-slide-up">
                        Refined Accommodation
                    </span>
                </div>
                <h1 class="font-serif text-7xl md:text-9xl text-white uppercase tracking-tighter leading-[0.85] mb-6">
                    {{ $roomType->name }}
                </h1>
            </div>
        </div>
    </div>

    <div class="border-y border-gray-100 bg-white sticky top-0 z-40">
        <div class="container mx-auto px-12">
            <div class="flex flex-wrap md:flex-nowrap py-10">
                <div class="w-1/2 md:w-1/4 border-r border-gray-100 pr-8">
                    <p class="text-[8px] text-gray-400 uppercase tracking-[0.3em] mb-2 font-bold">Dimensions</p>
                    <p class="text-xs font-bold text-black uppercase tracking-widest">34 SQM / 366 SQF</p>
                </div>
                <div class="w-1/2 md:w-1/4 border-r md:px-12 pr-8 md:pr-0 border-gray-100">
                    <p class="text-[8px] text-gray-400 uppercase tracking-[0.3em] mb-2 font-bold">Capacity</p>
                    <p class="text-xs font-bold text-black uppercase tracking-widest">{{ $roomType->capacity }} Adults</p>
                </div>
                <div class="w-1/2 md:w-1/4 border-r md:px-12 mt-6 md:mt-0 border-gray-100">
                    <p class="text-[8px] text-gray-400 uppercase tracking-[0.3em] mb-2 font-bold">Bed Configuration</p>
                    <p class="text-xs font-bold text-black uppercase tracking-widest">King / Luxury Twin</p>
                </div>
                <div class="w-1/2 md:w-1/4 md:pl-12 mt-6 md:mt-0">
                    <p class="text-[8px] text-gray-400 uppercase tracking-[0.3em] mb-2 font-bold">Status</p>
                    <p class="text-xs font-bold text-black uppercase tracking-widest flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-green-500"></span>
                        {{ $availableRooms->count() }} Available Units
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-12 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-24">
            
            <div class="lg:col-span-7">
                <section class="mb-24">
                    <h3 class="text-[10px] font-bold uppercase tracking-[0.5em] text-gray-400 mb-12 italic">The Concept</h3>
                    <div class="text-gray-700 leading-[2.2] text-sm lg:text-base max-w-2xl font-light">
                        {!! nl2br(e($roomType->description)) !!}
                    </div>
                </section>

                <section class="pt-24 border-t border-gray-100">
                    <h3 class="text-[10px] font-bold uppercase tracking-[0.5em] text-gray-400 mb-16">Features & Comforts</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-12 gap-x-8">
                        @foreach($amenities as $item)
                        <div class="border-l border-gray-200 pl-6 py-1 hover:border-black transition-colors duration-500">
                            <span class="text-[10px] font-bold uppercase tracking-[0.25em] text-black block mb-1">{{ trim($item) }}</span>
                            <span class="text-[8px] text-gray-400 uppercase tracking-widest">Included</span>
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>

            <div class="lg:col-span-5">
                <div class="sticky top-40 bg-white border border-gray-100 p-16 shadow-[0_40px_100px_-20px_rgba(0,0,0,0.1)]">
                    <div class="mb-12">
                        <span class="text-[9px] text-gray-400 uppercase tracking-[0.4em] block mb-4">Starting Rate</span>
                        <div class="flex items-baseline gap-2">
                            <span class="text-5xl font-bold text-black tracking-tighter">
                                <span class="text-xs font-normal text-gray-400 mr-2 uppercase tracking-normal">IDR</span>{{ number_format($roomType->base_price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-12">
                        <label class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.3em] block mb-6 italic">Select Floor Location</label>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach($availableRooms->pluck('floor')->unique()->sort() as $floor)
                                <div class="py-4 border border-gray-100 text-center text-[10px] font-bold text-black tracking-widest hover:bg-black hover:text-white transition-all cursor-pointer">
                                    FL {{ $floor }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('booking.form', $roomType->slug) }}" 
                    class="block w-full bg-black text-white text-center py-6 text-[11px] font-bold uppercase tracking-[0.5em] hover:bg-gray-800 transition-all duration-700 shadow-xl">
                        Reserve Now
                    </a>

                    <div class="mt-12 pt-8 border-t border-gray-50 grid grid-cols-3 gap-4">
                        <div class="text-center">
                            <span class="text-[8px] text-gray-400 uppercase tracking-widest block font-bold">Wifi</span>
                            <span class="text-[8px] text-black uppercase font-bold tracking-tighter">Complimentary</span>
                        </div>
                        <div class="text-center">
                            <span class="text-[8px] text-gray-400 uppercase tracking-widest block font-bold">Breakfast</span>
                            <span class="text-[8px] text-black uppercase font-bold tracking-tighter">Included</span>
                        </div>
                        <div class="text-center">
                            <span class="text-[8px] text-gray-400 uppercase tracking-widest block font-bold">Cancellation</span>
                            <span class="text-[8px] text-black uppercase font-bold tracking-tighter">Flexible</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    @keyframes slide-up {
        from { transform: translateY(100%); }
        to { transform: translateY(0); }
    }
    .animate-slide-up { animation: slide-up 1s ease-out forwards; }
</style>
@endsection