@extends('layouts.admin')

@section('admin_content')
<div x-data="{ 
    openDetail: false, 
    currBooking: {},
    
    showDetail(data) {
        this.currBooking = data;
        this.openDetail = true;
    },
    confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Reservasi?',
            text: 'Data transaksi ini akan dihapus dan status kamar akan dikembalikan jika belum selesai.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A1A1A',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-booking-' + id).submit();
            }
        })
    },
    confirmCheckOut(id) {
        Swal.fire({
            title: 'Konfirmasi Check-Out?',
            text: 'Status kamar akan otomatis menjadi AVAILABLE kembali.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Selesaikan!',
            cancelButtonText: 'Kembali'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('complete-booking-' + id).submit();
            }
        })
    }
}" 
x-cloak
x-on:view-detail.window="showDetail($event.detail)"
class="antialiased">

    {{-- NOTIFICATION HANDLER --}}
    @if(session('success'))
        <script>
            Swal.fire({ icon: 'success', title: 'Berhasil', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false });
        </script>
    @endif

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-6">
        <div>
            <span class="text-[10px] text-gold font-bold uppercase tracking-[0.4em]">Reception Desk</span>
            <h1 class="font-luxury text-4xl text-dark italic mt-1">Guest Reservations</h1>
            <p class="text-xs text-gray-400 mt-2 font-light">Manage your global hospitality operations and room inventory.</p>
        </div>
        <div class="flex gap-8 bg-white p-6 rounded-[24px] border border-gray-50 shadow-sm">
            <div class="text-right border-r border-gray-100 pr-8">
                <p class="text-[9px] text-gray-400 uppercase tracking-widest mb-1">Total Bookings</p>
                <span class="text-2xl font-luxury text-dark italic">{{ $bookings->count() }}</span>
            </div>
            <div class="text-right">
                <p class="text-[9px] text-gold uppercase tracking-widest mb-1">Active Stays</p>
                <span class="text-2xl font-luxury text-dark italic">{{ $bookings->where('booking_status', 'confirmed')->count() }}</span>
            </div>
        </div>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-[32px] p-8 border border-gray-100 shadow-sm overflow-hidden">
        <table id="resTable" class="w-full">
            <thead>
                <tr class="text-[9px] uppercase tracking-[0.2em] text-gray-400 border-b border-gray-50">
                    <th class="pb-6 font-bold text-left">Folio / Transaction</th>
                    <th class="pb-6 font-bold text-left">Guest & Inventory</th>
                    <th class="pb-6 font-bold text-left">Stay Duration</th>
                    <th class="pb-6 font-bold text-center">Status Control</th>
                    <th class="pb-6 font-bold text-right pr-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($bookings as $bk)
                <tr class="hover:bg-gray-50/50 transition-all group">
                    <td class="py-6">
                        <div class="flex items-center gap-3">
                            <div class="w-1 h-8 bg-gold/20 group-hover:bg-gold transition-all"></div>
                            <div>
                                <span class="text-[11px] font-bold text-dark italic tracking-tighter block uppercase">{{ $bk->transaction_id }}</span>
                                <span class="block text-[8px] text-gray-400 uppercase mt-1">{{ date('d M Y, H:i', strtotime($bk->created_at)) }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-6">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-dark">{{ $bk->customer_name }}</span>
                            <span class="text-[9px] text-gold font-bold uppercase tracking-tighter mt-0.5 flex items-center gap-1">
                                <i class="fas fa-bed text-[8px]"></i> Unit #{{ $bk->room_number }} — {{ $bk->room_type_name }}
                            </span>
                        </div>
                    </td>
                    <td class="py-6">
                        <div class="text-[10px] font-bold text-dark italic flex items-center gap-2">
                            <span>{{ date('d M', strtotime($bk->check_in)) }}</span>
                            <i class="fas fa-long-arrow-alt-right text-gray-300"></i>
                            <span>{{ date('d M Y', strtotime($bk->check_out)) }}</span>
                        </div>
                        <span class="text-[9px] text-gray-400 uppercase font-bold tracking-widest block mt-1">{{ $bk->total_nights }} Nights Experience</span>
                    </td>
                    <td class="py-6 text-center">
                        <div class="flex flex-col gap-1.5 items-center">
                            {{-- Payment Status --}}
                            <span class="px-3 py-1 rounded-full text-[7px] font-bold uppercase tracking-widest 
                                {{ $bk->payment_status == 'paid' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }}">
                                {{ $bk->payment_status }}
                            </span>
                            {{-- Booking Status --}}
                            <span class="text-[8px] font-bold uppercase tracking-[0.1em]
                                {{ $bk->booking_status == 'completed' ? 'text-blue-500' : ($bk->booking_status == 'cancelled' ? 'text-red-400' : 'text-gray-300') }}">
                                {{ $bk->booking_status }}
                            </span>
                        </div>
                    </td>
                    <td class="py-6">
                        <div class="flex justify-end gap-2 pr-2">
                            {{-- View Detail --}}
                            <button type="button" @click="showDetail({{ json_encode($bk) }})" 
                                class="w-9 h-9 flex items-center justify-center rounded-xl bg-gray-50 text-gray-400 hover:bg-dark hover:text-gold transition-all shadow-sm">
                                <i class="fas fa-ellipsis-h text-[10px]"></i>
                            </button>
                            
                            {{-- Delete --}}
                            <form id="delete-booking-{{ $bk->id }}" action="{{ route('reservations.delete', $bk->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" @click="confirmDelete({{ $bk->id }})" 
                                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                    <i class="fas fa-trash-alt text-[10px]"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- SLIDE-OVER DETAIL --}}
    <div x-show="openDetail" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-full"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-full"
        class="fixed inset-0 z-[100] flex items-center justify-end bg-dark/60 backdrop-blur-sm">
        
        <div class="bg-white h-screen w-full max-w-lg p-12 shadow-2xl relative overflow-y-auto" @click.away="openDetail = false">
            {{-- Close --}}
            <button @click="openDetail = false" class="absolute top-8 right-8 text-gray-300 hover:text-dark transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>

            <span class="text-[10px] text-gold font-bold uppercase tracking-[0.4em]">Guest Folio</span>
            <h4 class="font-luxury text-3xl text-dark italic mt-2 mb-10">Booking Summary</h4>

            <div class="space-y-8">
                {{-- Guest --}}
                <div class="border-b border-gray-50 pb-6">
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest mb-3">Principal Guest</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-dark text-gold flex items-center justify-center font-luxury text-xl italic" x-text="currBooking.customer_name ? currBooking.customer_name.charAt(0) : 'G'"></div>
                        <div>
                            <h5 class="text-sm font-bold text-dark" x-text="currBooking.customer_name"></h5>
                            <p class="text-[11px] text-gray-500 mt-0.5" x-text="currBooking.customer_email"></p>
                        </div>
                    </div>
                </div>

                {{-- Schedule --}}
                <div class="border-b border-gray-50 pb-6">
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest mb-3">Inventory Allocation</p>
                    <div class="bg-gray-50 p-6 rounded-[24px] border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-[10px] font-bold text-dark uppercase tracking-tighter" x-text="'Unit #' + currBooking.room_number"></span>
                            <span class="text-[10px] text-gold font-bold uppercase tracking-widest" x-text="currBooking.room_type_name"></span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200/50">
                            <div>
                                <p class="text-[8px] text-gray-400 uppercase tracking-widest mb-1">Arrival</p>
                                <p class="text-xs font-bold text-dark" x-text="currBooking.check_in"></p>
                            </div>
                            <i class="fas fa-arrow-right text-[10px] text-gray-300"></i>
                            <div class="text-right">
                                <p class="text-[8px] text-gray-400 uppercase tracking-widest mb-1">Departure</p>
                                <p class="text-xs font-bold text-dark" x-text="currBooking.check_out"></p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Billing --}}
                <div class="space-y-4 bg-dark/[0.02] p-6 rounded-[24px]">
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest mb-2">Financial Statement</p>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400 font-light italic">Room Charges (Subtotal)</span>
                        <span class="font-bold text-dark" x-text="'IDR ' + Number(currBooking.subtotal).toLocaleString('id-ID')"></span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400 font-light italic">Service & Government Tax</span>
                        <span class="font-bold text-dark" x-text="'IDR ' + Number(currBooking.tax_service).toLocaleString('id-ID')"></span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-dark">Grand Total Amount</span>
                        <span class="text-2xl font-luxury text-gold italic font-bold" x-text="'IDR ' + Number(currBooking.total_amount).toLocaleString('id-ID')"></span>
                    </div>
                </div>

                {{-- Status Control Action --}}
                <div class="pt-4 space-y-4">
                    {{-- Tombol Check-Out (Hanya muncul jika status belum completed/cancelled) --}}
                    <template x-if="currBooking.booking_status !== 'completed' && currBooking.booking_status !== 'cancelled'">
                        <div>
                            <form :id="'complete-booking-' + currBooking.id" :action="'/reservations/' + currBooking.id + '/complete'" method="POST">
                                @csrf @method('PATCH')
                                <button type="button" @click="confirmCheckOut(currBooking.id)" 
                                    class="w-full flex items-center justify-center gap-3 bg-green-600 text-white py-5 rounded-[24px] font-bold uppercase text-[10px] tracking-[0.2em] hover:bg-green-700 transition-all shadow-xl shadow-green-100">
                                    <i class="fas fa-door-open"></i> Confirm Guest Check-Out
                                </button>
                            </form>
                            <p class="text-center text-[8px] text-gray-400 uppercase mt-3 tracking-widest italic">Action will set room status back to available</p>
                        </div>
                    </template>

                    {{-- Label jika sudah selesai --}}
                    <template x-if="currBooking.booking_status === 'completed'">
                        <div class="flex items-center justify-center gap-2 py-5 rounded-[24px] bg-blue-50 border border-blue-100 text-blue-500 font-bold uppercase text-[10px] tracking-widest">
                            <i class="fas fa-check-circle"></i> This stay has been completed
                        </div>
                    </template>

                    {{-- Pay Invoice (Hanya jika belum lunas) --}}
                    <template x-if="currBooking.payment_status !== 'paid' && currBooking.booking_status !== 'cancelled'">
                        <a :href="currBooking.payment_url" target="_blank" class="block w-full text-center bg-dark text-gold py-5 rounded-[24px] font-bold uppercase text-[10px] tracking-[0.2em] hover:bg-gold hover:text-dark transition-all border border-dark">
                            <i class="fas fa-external-link-alt mr-2 text-[8px]"></i> Re-Open Payment Gateway
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- DATATABLES & SCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan jQuery tersedia
        if (typeof $ !== 'undefined') {
            const table = $('#resTable').DataTable({
                responsive: true,
                order: [[0, 'desc']], // Urutkan dari transaksi terbaru (kolom pertama)
                language: { 
                    search: "", 
                    searchPlaceholder: "Search Guest or Trx ID...",
                    paginate: { 
                        previous: "<i class='fas fa-chevron-left text-[10px]'></i>", 
                        next: "<i class='fas fa-chevron-right text-[10px]'></i>" 
                    },
                    emptyTable: "No reservations found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                },
                pageLength: 10,
                dom: '<"flex justify-between items-center mb-6"f>rt<"mt-8 flex justify-between items-center text-[10px] uppercase tracking-widest text-gray-400"ip>',
                drawCallback: function() {
                    // Merapikan styling pagination bawaan datatables setelah draw
                    $('.dataTables_paginate .paginate_button').addClass('px-3 py-1 mx-1 rounded-lg transition-all');
                    $('.dataTables_filter input').addClass('bg-gray-50 border-none rounded-2xl px-6 py-3 text-xs focus:ring-1 focus:ring-gold/30 w-72');
                }
            });

            // Re-adjust responsive column saat tab dibuka atau window resize
            $(window).on('resize', function () {
                table.columns.adjust().responsive.recalc();
            });
        } else {
            console.error("jQuery is not loaded. DataTables requires jQuery.");
        }
    });
</script>

<style>
    /* Styling khusus Datatables agar menyatu dengan tema luxury */
    .dataTables_filter input {
        @apply bg-gray-50 border-none rounded-2xl px-6 py-3 text-xs focus:ring-1 focus:ring-gold/30 w-72 transition-all;
    }
    .dataTables_paginate .paginate_button {
        @apply mx-1 px-3 py-1 rounded-lg border-none bg-transparent text-gray-400 hover:bg-dark hover:text-gold transition-all cursor-pointer;
    }
    .dataTables_paginate .paginate_button.current {
        @apply bg-dark text-gold font-bold !important;
    }
    [x-cloak] { display: none !important; }
</style>
@endsection