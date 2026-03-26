<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Management Console - d'best Hotel Bandung</title>
    
    <link rel="shortcut icon" href="{{ asset('assets/logo-dbest.png') }}" type="image/x-icon">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'hotel-gold': '#B8924A',
                        'hotel-dark': '#0F0F0F',
                    }
                }
            }
        }
    </script>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0F0F0F;
            position: relative;
            overflow: hidden;
        }

        .bg-overlay {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=2000');
            background-size: cover;
            background-position: center;
            filter: grayscale(100%) brightness(15%);
            z-index: -1;
            transform: scale(1.1);
        }

        .login-card {
            width: 100%;
            max-width: 460px;
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 4.5rem 3.5rem;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            color: white;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            transition: all 0.4s ease;
            border-radius: 0;
        }

        .form-input:focus {
            outline: none;
            border-bottom-color: #B8924A;
            background: rgba(255, 255, 255, 0.01);
        }

        .btn-authorize {
            width: 100%;
            padding: 1.25rem;
            background: #B8924A;
            color: #0F0F0F;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4em;
            font-size: 0.65rem;
            transition: all 0.5s ease;
            margin-top: 3.5rem;
        }

        .btn-authorize:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .toggle-btn {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.3);
        }

        /* Custom Swal for consistent branding */
        .custom-swal-popup { background: #121212 !important; border: 1px solid rgba(184, 146, 74, 0.5) !important; color: white !important; border-radius: 0 !important; }
        .custom-swal-button { background: #B8924A !important; color: #121212 !important; border-radius: 0 !important; font-size: 0.7rem !important; letter-spacing: 0.2em !important; font-weight: bold !important; }
    </style>
</head>

<body>
    <div class="bg-overlay"></div>

    <div class="login-card shadow-2xl">
        <form action="{{ route('proccess-login-admin') }}" method="POST">
            @csrf
            
            <div class="text-center mb-16">
                <p class="text-hotel-gold text-[8px] uppercase tracking-[0.7em] mb-4 font-bold">Secure Access</p>
                <h1 class="font-serif text-white text-4xl italic tracking-wider">d'best Hotel</h1>
                <p class="text-white/20 text-[9px] uppercase tracking-[0.5em] mt-3 font-light">Internal Management</p>
                <div class="w-10 h-[1px] bg-hotel-gold/40 mx-auto mt-8"></div>
            </div>

            <div class="space-y-12">
                {{-- Username Field --}}
                <div class="relative group">
                    <label class="text-[8px] uppercase tracking-[0.4em] text-white/30 font-bold mb-1 block group-focus-within:text-hotel-gold transition-colors">Admin ID</label>
                    <input 
                        type="text" 
                        name="username" 
                        required 
                        class="form-input"
                        placeholder="USERNAME"
                        value="{{ old('username') }}"
                        autocomplete="off"
                    >
                    @error('username')
                        <span class="text-[9px] text-red-500 uppercase mt-2 block tracking-widest">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div class="relative group">
                    <label class="text-[8px] uppercase tracking-[0.4em] text-white/30 font-bold mb-1 block group-focus-within:text-hotel-gold transition-colors">Access Key</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            class="form-input"
                            placeholder="••••••••••••"
                        >
                        <button type="button" id="togglePassword" class="toggle-btn hover:text-hotel-gold transition-colors">
                            <i class="far fa-eye text-[10px]" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-[9px] text-red-500 uppercase mt-2 block tracking-widest">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn-authorize">
                Authorize Session
            </button>

            <div class="mt-14 text-center">
                <p class="text-[8px] text-white/80 uppercase tracking-[0.5em] font-light">
                    &copy; {{ date('Y') }} d'best Hotel Group &bull; System v2.4
                </p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Toggle password logic
        const toggleBtn = document.getElementById('togglePassword');
        const passField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        toggleBtn.addEventListener('click', () => {
            const type = passField.type === 'password' ? 'text' : 'password';
            passField.type = type;
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });

        // SweetAlert Handler
        document.addEventListener("DOMContentLoaded", function() {
            const config = {
                confirmButtonText: 'PROCEED',
                customClass: { popup: 'custom-swal-popup', confirmButton: 'custom-swal-button' }
            };

            @if (session('success'))
                Swal.fire({ ...config, icon: 'success', title: 'AUTHORIZED', text: '{{ session('success') }}' });
            @endif

            @if (session('error'))
                Swal.fire({ ...config, icon: 'error', title: 'DENIED', text: '{{ session('error') }}' });
            @endif
        });
    </script>
</body>
</html>