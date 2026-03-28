@extends('layouts.guest')

@section('content')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<style>
    * { border-radius: 0 !important; }
    .font-serif { font-family: 'Playfair Display', serif; }
    
    /* Form Input Aesthetics */
    input, select, textarea { 
        border: 1px solid #e5e7eb !important; 
        padding: 1.2rem !important; 
        font-size: 0.75rem !important; 
        text-transform: uppercase; 
        letter-spacing: 0.15em;
        width: 100%;
        background: #fff;
    }
    input:focus, select:focus { border-color: #000 !important; outline: none !important; ring: 0 !important; }
    label { font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.2em; color: #9ca3af; margin-bottom: 8px; display: block; }

    /* Custom Gateway Selection */
    .gateway-option input:checked + .gateway-box { border-color: #000; background-color: #f9fafb; color: #000; }
    .gateway-box { border: 1px solid #f3f4f6; transition: all 0.4s ease; color: #9ca3af; }

    /* Hero Gradient for Navbar Protection */
    .nav-protection {
        background: linear-gradient(to bottom, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0) 100%);
    }
</style>

<div class="min-h-screen bg-white">
    
    <div class="relative h-[45vh] w-full bg-black overflow-hidden">
        <img src="{{ asset('assets/room_types/' . $roomType->image_thumbnail) }}" 
             class="w-full h-full object-cover opacity-40 grayscale" 
             alt="Booking Header">
        
        <div class="absolute inset-0 z-10 nav-protection h-40"></div>
        
        <div class="absolute bottom-16 left-0 w-full z-20">
            <div class="container mx-auto px-8 lg:px-16">
                <nav class="flex text-[9px] uppercase tracking-[0.5em] text-white/50 mb-4">
                    <a href="/" class="hover:text-white transition-colors">Home</a>
                    <span class="mx-4">/</span>
                    <span class="text-white">Reservation Details</span>
                </nav>
                <h1 class="font-serif text-5xl md:text-7xl text-white uppercase tracking-tighter leading-none">
                    Complete <br> Reservation
                </h1>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-8 lg:px-16 py-24">
        <form id="bookingForm" class="grid grid-cols-1 lg:grid-cols-12 gap-24">
            @csrf
            <input type="hidden" name="room_type_id" value="{{ $roomType->id }}">

            <div class="lg:col-span-7 space-y-20">
                <section>
                    <div class="flex items-center gap-4 mb-12">
                        <span class="text-[10px] font-bold text-gray-300 tracking-[0.5em] uppercase italic">Section 01</span>
                        <h3 class="text-xs font-bold uppercase tracking-[0.4em] text-black">Guest Credentials</h3>
                    </div>
                    <div class="space-y-8">
                        <div>
                            <label>Full Name</label>
                            <input type="text" name="customer_name" placeholder="E.G. ALEXANDER PIERCE" required>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label>Email Address</label>
                                <input type="email" name="customer_email" placeholder="ALEX@ARCHITECT.COM" required>
                            </div>
                            <div>
                                <label>Phone Number</label>
                                <input type="tel" name="customer_phone" placeholder="+62 812 XXXX" required>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="flex items-center gap-4 mb-12">
                        <span class="text-[10px] font-bold text-gray-300 tracking-[0.5em] uppercase italic">Section 02</span>
                        <h3 class="text-xs font-bold uppercase tracking-[0.4em] text-black">Stay Configuration</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label>Arrival Date</label>
                            <input type="date" name="check_in" id="check_in" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div>
                            <label>Departure Date</label>
                            <input type="date" name="check_out" id="check_out" required>
                        </div>
                    </div>
                    <div>
                        <label>Room Allocation</label>
                        <select name="room_id" required>
                            <option value="">-- SELECT PREFERRED UNIT --</option>
                            @foreach($availableRooms as $room)
                                <option value="{{ $room->id }}">Room {{ $room->room_number }} (Level {{ $room->floor }})</option>
                            @endforeach
                        </select>
                    </div>
                </section>

                <section>
                    <div class="flex items-center gap-4 mb-12">
                        <span class="text-[10px] font-bold text-gray-300 tracking-[0.5em] uppercase italic">Section 03</span>
                        <h3 class="text-xs font-bold uppercase tracking-[0.4em] text-black">Payment Method</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-10 text-center border border-black bg-gray-50">
                            <span class="text-[10px] font-bold uppercase tracking-[0.3em]">System Default (Auto-Detect)</span>
                        </div>
                        <p class="text-[9px] text-gray-400 flex items-center italic tracking-widest leading-relaxed">
                            *Payment gateway will be automatically selected based on system availability.
                        </p>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-5">
                <div class="sticky top-32 bg-white border border-gray-100 p-12 shadow-[0_50px_100px_-20px_rgba(0,0,0,0.15)]">
                    <h3 class="text-[10px] font-bold uppercase tracking-[0.5em] mb-12 text-center border-b border-gray-50 pb-6">Invoice Summary</h3>
                    
                    <div class="space-y-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-widest text-black">{{ $roomType->name }}</p>
                                <p class="text-[9px] text-gray-400 uppercase mt-1 tracking-tighter">Rate: IDR {{ number_format($roomType->base_price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="space-y-4 pt-8 border-t border-gray-50 text-[10px] uppercase tracking-widest font-medium">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Duration</span>
                                <span class="text-black font-bold" id="js_nights">0 Nights</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Subtotal</span>
                                <span class="text-black font-bold" id="js_subtotal">IDR 0</span>
                            </div>
                            <div class="flex justify-between italic">
                                <span class="text-gray-400">Tax & Service (11%)</span>
                                <span class="text-black font-bold" id="js_tax">IDR 0</span>
                            </div>
                            
                            <div class="flex justify-between items-center pt-10 border-t border-black mt-8">
                                <span class="text-[12px] font-bold uppercase tracking-[0.4em] text-black">Total</span>
                                <span class="text-3xl font-bold text-black tracking-tighter" id="js_total">IDR 0</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" class="w-full bg-black text-white py-7 mt-16 text-[11px] font-bold uppercase tracking-[0.6em] hover:bg-gray-800 transition-all duration-500 shadow-2xl">
                        Secure Checkout
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    // --- 1. INISIALISASI ELEMEN ---
    const checkIn = document.getElementById('check_in');
    const checkOut = document.getElementById('check_out');
    const uiNights = document.getElementById('js_nights');
    const uiSubtotal = document.getElementById('js_subtotal');
    const uiTax = document.getElementById('js_tax');
    const uiTotal = document.getElementById('js_total');
    const bookingForm = document.getElementById('bookingForm');
    const submitBtn = document.getElementById('submitBtn');
    
    // Ambil harga dasar dari server-side Blade
    const basePrice = {{ $roomType->base_price }};

    // --- 2. LOGIKA KALKULASI HARGA ---
    function updateInvoice() {
        if (checkIn.value && checkOut.value) {
            const start = new Date(checkIn.value);
            const end = new Date(checkOut.value);
            
            // Validasi: Check-out tidak boleh sebelum/sama dengan Check-in
            if (end <= start) {
                uiNights.innerText = "Invalid Dates";
                uiTotal.innerText = "IDR 0";
                return;
            }

            const diffTime = end - start;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays > 0) {
                const subtotal = diffDays * basePrice;
                const tax = subtotal * 0.11; // Pajak 11%
                const total = subtotal + tax;

                // Format ke Rupiah (id-ID)
                uiNights.innerText = diffDays + " Night(s)";
                uiSubtotal.innerText = "IDR " + subtotal.toLocaleString('id-ID');
                uiTax.innerText = "IDR " + tax.toLocaleString('id-ID');
                uiTotal.innerText = "IDR " + total.toLocaleString('id-ID');
            }
        }
    }

    // Event listener untuk perubahan tanggal
    checkIn.addEventListener('change', updateInvoice);
    checkOut.addEventListener('change', updateInvoice);

    // --- 3. LOGIKA SUBMIT (MULTI-GATEWAY HANDLING) ---
    bookingForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // UI Feedback: Loading state
        submitBtn.innerHTML = '<span class="animate-pulse">PROCESSING RESERVATION...</span>';
        submitBtn.disabled = true;

        const formData = new FormData(bookingForm);
        const successUrl = (id) => `/booking/success/${id}`;

        try {
            const response = await fetch("{{ route('booking.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            // Jika validasi gagal atau server error
            if (!result.success) {
                alert(result.message || "Something went wrong. Please check your data.");
                resetSubmitButton();
                return;
            }

            // --- PERCABANGAN GATEWAY ---

            // A. HANDLING MIDTRANS (Snap Popup)
            if (result.type === 'midtrans') {
                if (typeof window.snap === 'undefined') {
                    alert("Midtrans library not loaded. Please refresh.");
                    resetSubmitButton();
                    return;
                }

                window.snap.pay(result.snap_token, {
                    onSuccess: function(res) { 
                        window.location.href = successUrl(result.transaction_id); 
                    },
                    onPending: function(res) { 
                        window.location.href = successUrl(result.transaction_id); 
                    },
                    onError: function(res) { 
                        alert("Payment encountered an error. Please try again."); 
                        resetSubmitButton();
                    },
                    onClose: function() {
                        alert("You closed the payment popup without finishing.");
                        resetSubmitButton();
                    }
                });
            } 
            
            // B. HANDLING XENDIT (Direct Redirect to Invoice)
            else if (result.type === 'xendit') {
                if (result.invoice_url) {
                    window.location.href = result.invoice_url;
                } else {
                    alert("Xendit Invoice URL not found.");
                    resetSubmitButton();
                }
            } 

            // C. MANUAL / BANK TRANSFER / FREE
            else {
                window.location.href = successUrl(result.transaction_id);
            }

        } catch (error) {
            console.error("Technical Error:", error);
            alert("Connection error. Please ensure you are online.");
            resetSubmitButton();
        }
    });

    // Fungsi untuk mengembalikan tombol ke keadaan semula
    function resetSubmitButton() {
        submitBtn.disabled = false;
        submitBtn.innerHTML = "SECURE CHECKOUT";
    }
</script>
@endsection