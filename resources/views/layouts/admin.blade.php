<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Console - d'best Hotel Bandung</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&family=Playfair+Display:italic,wght@0,400;0,700&display=swap" rel="stylesheet">
    
    {{-- Tailwind CSS via CDN (Aman & Tanpa Build) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Alpine.js (Untuk Interaktivitas Sidebar) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        // Konfigurasi Tailwind Custom agar class 'gold' dan 'dark' tetap jalan
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: '#B8924A',
                        dark: '#1A1A1A',
                    },
                    fontFamily: {
                        luxury: ['Playfair Display', 'serif'],
                        sans: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom scrollbar untuk sidebar */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(184, 146, 74, 0.3); border-radius: 10px; }
        
        /* Animasi sederhana */
        .animate-slow-zoom { animation: slow-zoom 20s infinite alternate; }
        @keyframes slow-zoom { from { transform: scale(1); } to { transform: scale(1.1); } }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-700 overflow-hidden">

    <div class="flex h-screen" x-data="{ sidebarOpen: true }">
        
        {{-- SIDEBAR --}}
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-[#1A1A1A] min-h-screen transition-all duration-300 flex flex-col shadow-2xl z-50">
            {{-- Brand Logo --}}
            <div class="h-20 flex items-center px-6 border-b border-white/5 overflow-hidden">
                <span class="text-gold font-luxury text-xl font-bold tracking-wider whitespace-nowrap" x-show="sidebarOpen">d'best <span class="text-white">Admin</span></span>
                <span class="text-gold font-luxury text-xl font-bold mx-auto" x-show="!sidebarOpen">D</span>
            </div>

<nav class="flex-1 py-6 space-y-1 overflow-y-auto custom-scrollbar">

    {{-- 1. DASHBOARD --}}
    @php $isActive = request()->routeIs('dashboard-admin'); @endphp
    <a href="{{ route('dashboard-admin') }}" 
       class="flex items-center px-6 py-4 transition-all group relative {{ $isActive ? 'text-white bg-white/5 border-l-2 border-gold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
        @if($isActive) <div class="absolute inset-y-0 left-0 w-[2px] bg-gold shadow-[0_0_15px_rgba(184,146,74,0.8)]"></div> @endif
        <svg class="w-5 h-5 {{ $isActive ? 'text-gold' : 'group-hover:text-gold' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        <span class="ml-4 text-[11px] font-bold uppercase tracking-[0.2em] {{ $isActive ? 'text-white' : '' }}" x-show="sidebarOpen">Dashboard</span>
    </a>

    {{-- 2. ROOMS --}}
    @php $isActive = request()->routeIs('rooms-admin'); @endphp
    <a href="{{ route('rooms-admin') }}" 
       class="flex items-center px-6 py-4 transition-all group relative {{ $isActive ? 'text-white bg-white/5 border-l-2 border-gold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
        @if($isActive) <div class="absolute inset-y-0 left-0 w-[2px] bg-gold shadow-[0_0_15px_rgba(184,146,74,0.8)]"></div> @endif
        <svg class="w-5 h-5 {{ $isActive ? 'text-gold' : 'group-hover:text-gold' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <span class="ml-4 text-[11px] font-bold uppercase tracking-[0.2em] {{ $isActive ? 'text-white' : '' }}" x-show="sidebarOpen">Rooms</span>
    </a>

    {{-- 3. RESERVATIONS --}}
    @php $isActive = request()->routeIs('reservations-admin'); @endphp
    <a href="{{ route('reservations-admin') }}" 
       class="flex items-center px-6 py-4 transition-all group relative {{ $isActive ? 'text-white bg-white/5 border-l-2 border-gold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
        @if($isActive) <div class="absolute inset-y-0 left-0 w-[2px] bg-gold shadow-[0_0_15px_rgba(184,146,74,0.8)]"></div> @endif
        <svg class="w-5 h-5 {{ $isActive ? 'text-gold' : 'group-hover:text-gold' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <span class="ml-4 text-[11px] font-bold uppercase tracking-[0.2em] {{ $isActive ? 'text-white' : '' }}" x-show="sidebarOpen">Reservations</span>
    </a>

    {{-- 4. DINING & BAR --}}
    @php $isActive = request()->routeIs('dining-admin'); @endphp
    <a href="{{ route('dining-admin') }}" 
       class="flex items-center px-6 py-4 transition-all group relative {{ $isActive ? 'text-white bg-white/5 border-l-2 border-gold' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
        @if($isActive) <div class="absolute inset-y-0 left-0 w-[2px] bg-gold shadow-[0_0_15px_rgba(184,146,74,0.8)]"></div> @endif
        <svg class="w-5 h-5 {{ $isActive ? 'text-gold' : 'group-hover:text-gold' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2v20m0-20c-2.5 0-4 2-4 5v3m4-8c2.5 0 4 2 4 5v3m-8 0h8M6 20h2a2 2 0 002-2V8m4 10a2 2 0 002 2h2m-6-10V4"></path>
        </svg>
        <span class="ml-4 text-[11px] font-bold uppercase tracking-[0.2em] {{ $isActive ? 'text-white' : '' }}" x-show="sidebarOpen">Dining & Bar</span>
    </a>

</nav>
            {{-- Logout Section --}}
            <div class="p-6 border-t border-white/5">
                <a href="#" class="flex items-center text-gray-400 hover:text-red-400 transition-colors group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="ml-4 text-[11px] font-bold uppercase tracking-widest" x-show="sidebarOpen">Sign Out</span>
                </a>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            {{-- TOPBAR --}}
            <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8 z-40">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 bg-gray-50 rounded-lg text-slate-400 hover:text-dark transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div class="hidden md:block">
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">System Status</p>
                        <p class="text-xs text-green-500 font-bold">● Live Operational</p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-dark uppercase tracking-tight">Main Administrator</p>
                        <p class="text-[10px] text-gray-400">info@dbest-hotel.com</p>
                    </div>
                    <div class="w-10 h-10 bg-dark rounded-xl flex items-center justify-center text-gold font-bold shadow-lg shadow-black/10 border border-white/10">
                        AD
                    </div>
                </div>
            </header>

            {{-- CONTENT AREA --}}
            <section class="flex-1 overflow-y-auto p-10 bg-[#F8FAFC]">
                <div class="max-w-7xl mx-auto">
                    @yield('admin_content')
                </div>
            </section>

        </main>
    </div>

</body>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- Alpine.js harus sebelum Flowbite jika Anda memakai keduanya --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.tailwindcss.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable dengan opsi drawCallback
            // Ini PENTING agar Flowbite membaca ulang tombol modal setelah tabel berubah (paging/search)
            const tableConfig = {
                pageLength: 5,
                drawCallback: function() {
                    if (typeof initFlowbite === 'function') {
                        initFlowbite(); // Memanggil ulang inisialisasi Flowbite
                    }
                }
            };

            // Daftarkan semua ID tabel Anda di sini
            const tableIds = [
                '#booking-data', '#gateways', '#destinations-admin', 
                '#region', '#resorts-admin', '#users-admin', '#not-paid-admin', 
                '#membership-admin', '#available-space-admin', '#destination-history-admin', 
                '#payment-registration', '#admin-report', '#news', '#choose-plan'
            ];

            tableIds.forEach(id => {
                if ($(id).length) {
                    $(id).DataTable(tableConfig);
                }
            });
        });

        // Global Alert Functions
        @if (session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 2000, showConfirmButton: false });
        @endif

        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal', text: '{{ session('error') }}' });
        @endif

        // Global Delete Confirmation
        function confirmDelete(event) {
            event.preventDefault();
            const form = event.target;
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#C5A358",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        }
    </script>
</html>