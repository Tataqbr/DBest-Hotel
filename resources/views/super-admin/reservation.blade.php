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
            text: 'Data transaksi ini akan dihapus permanen dari sistem.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A1A1A',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-booking-' + id).submit();
            }
        })
    }
}" 
x-cloak
x-on:view-detail.window="showDetail($event.detail)"
x-on:delete-booking.window="confirmDelete($event.detail)">

    {{-- HEADER --}}
    <div class="flex justify-between items-end mb-10">
        <div>
            <span class="text-[10px] text-gold font-bold uppercase tracking-[0.4em]">Reception</span>
            <h1 class="font-luxury text-4xl text-dark italic mt-1">Guest Reservations</h1>
        </div>
        <div class="text-right">
            <p class="text-[10px] text-gray-400 uppercase tracking-widest">Total Trx</p>
            <span class="text-2xl font-luxury text-dark italic">{{ $bookings->count() }}</span>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-[32px] p-8 border border-gray-100 shadow-sm overflow-hidden">
        <table id="resTable" class="w-full">
            <thead>
                <tr class="text-[9px] uppercase tracking-[0.2em] text-gray-400 border-b border-gray-50">
                    <th class="pb-6 font-bold text-left">Trx ID / Date</th>
                    <th class="pb-6 font-bold text-left">Guest & Room</th>
                    <th class="pb-6 font-bold text-left">Check In - Out</th>
                    <th class="pb-6 font-bold text-center">Status</th>
                    <th class="pb-6 font-bold text-right pr-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($bookings as $bk)
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="py-6">
                        <span class="text-[11px] font-bold text-dark italic tracking-tighter">{{ $bk->transaction_id }}</span>
                        <span class="block text-[8px] text-gray-400 uppercase mt-1">{{ date('d M Y, H:i', strtotime($bk->created_at)) }}</span>
                    </td>
                    <td class="py-6">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-dark">{{ $bk->customer_name }}</span>
                            <span class="text-[9px] text-gold font-bold uppercase tracking-tighter mt-0.5">
                                Unit #{{ $bk->room_number }} ({{ $bk->room_type_name }})
                            </span>
                        </div>
                    </td>
                    <td class="py-6">
                        <div class="text-[10px] font-bold text-dark italic">
                            {{ date('d M', strtotime($bk->check_in)) }} - {{ date('d M Y', strtotime($bk->check_out)) }}
                        </div>
                        <span class="text-[9px] text-gray-400 uppercase font-bold tracking-widest">{{ $bk->total_nights }} Nights</span>
                    </td>
                    <td class="py-6 text-center">
                        <div class="flex flex-col gap-1 items-center">
                            <span class="px-3 py-1 rounded-full text-[7px] font-bold uppercase tracking-widest 
                                {{ $bk->payment_status == 'paid' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }}">
                                {{ $bk->payment_status }}
                            </span>
                            <span class="text-[8px] font-bold uppercase text-gray-300">{{ $bk->booking_status }}</span>
                        </div>
                    </td>
                    <td class="py-6">
                        <div class="flex justify-end gap-2 pr-2">
                            <button type="button" onclick="triggerView('{{ json_encode($bk) }}')" 
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 text-gray-400 hover:bg-dark hover:text-gold transition-all">
                                <i class="fas fa-eye text-[10px]"></i>
                            </button>
                            
                            <form id="delete-booking-{{ $bk->id }}" action="{{ route('reservations.delete', $bk->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" onclick="triggerDelete({{ $bk->id }})" 
                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all">
                                    <i class="fas fa-trash text-[10px]"></i>
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
    <div x-show="openDetail" class="fixed inset-0 z-[100] flex items-center justify-end bg-dark/60 backdrop-blur-sm" x-transition>
        <div class="bg-white h-screen w-full max-w-lg p-12 shadow-2xl relative overflow-y-auto" @click.away="openDetail = false">
            <button @click="openDetail = false" class="absolute top-8 right-8 text-gray-300 hover:text-dark">
                <i class="fas fa-times text-xl"></i>
            </button>

            <span class="text-[10px] text-gold font-bold uppercase tracking-[0.4em]">Detail Folio</span>
            <h4 class="font-luxury text-3xl text-dark italic mt-2 mb-10">Booking Summary</h4>

            <div class="space-y-8">
                <div class="border-b border-gray-100 pb-6">
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest mb-3">Guest Information</p>
                    <h5 class="text-sm font-bold text-dark" x-text="currBooking.customer_name"></h5>
                    <p class="text-xs text-gray-500 mt-1" x-text="currBooking.customer_email"></p>
                    <p class="text-xs text-gray-500" x-text="currBooking.customer_phone"></p>
                </div>

                <div class="border-b border-gray-100 pb-6">
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest mb-3">Unit & Schedule</p>
                    <div class="bg-gray-50 p-4 rounded-2xl">
                        <p class="text-[10px] font-bold text-dark uppercase tracking-tighter" x-text="'Room: Unit #' + currBooking.room_number + ' (' + currBooking.room_type_name + ')'"></p>
                        <p class="text-[10px] text-gold font-bold mt-2" x-text="currBooking.check_in + ' — ' + currBooking.check_out"></p>
                    </div>
                </div>

                <div class="space-y-4">
                    <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest">Pricing Details</p>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Subtotal</span>
                        <span class="font-bold text-dark" x-text="'IDR ' + Number(currBooking.subtotal).toLocaleString('id-ID')"></span>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-400">Tax & Service</span>
                        <span class="font-bold text-dark" x-text="'IDR ' + Number(currBooking.tax_service).toLocaleString('id-ID')"></span>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-dark">
                        <span class="text-[10px] font-bold uppercase tracking-widest">Total Amount</span>
                        <span class="text-xl font-luxury text-gold italic font-bold" x-text="'IDR ' + Number(currBooking.total_amount).toLocaleString('id-ID')"></span>
                    </div>
                </div>

                <div class="pt-10">
                    <div class="flex items-center gap-4 p-5 rounded-[24px] border border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center">
                            <i class="fas fa-wallet text-xs text-gray-400"></i>
                        </div>
                        <div>
                            <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest">Payment Gateway: <span class="text-dark" x-text="currBooking.gateway_name"></span></p>
                            <p class="text-[10px] font-bold italic text-dark uppercase" x-text="'Status: ' + currBooking.payment_status"></p>
                        </div>
                    </div>
                </div>
                
                <template x-if="currBooking.payment_url && currBooking.payment_status !== 'paid'">
                    <a :href="currBooking.payment_url" target="_blank" class="block w-full text-center bg-dark text-gold py-5 rounded-[24px] font-bold uppercase text-[10px] tracking-widest hover:bg-gold hover:text-dark transition-all">
                        Pay Invoice
                    </a>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
    function triggerView(data) {
        window.dispatchEvent(new CustomEvent('view-detail', { detail: JSON.parse(data) }));
    }
    function triggerDelete(id) {
        window.dispatchEvent(new CustomEvent('delete-booking', { detail: id }));
    }

    $(document).ready(function() {
        $('#resTable').DataTable({
            responsive: true,
            language: { 
                search: "", 
                searchPlaceholder: "Search Trx ID or Guest...",
                paginate: { previous: "<i class='fas fa-chevron-left'></i>", next: "<i class='fas fa-chevron-right'></i>" }
            },
            pageLength: 10,
            dom: 'frtip'
        });
    });
</script>
@endsection