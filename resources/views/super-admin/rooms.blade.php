@extends('layouts.admin')

@section('admin_content')
<div x-data="{ 
    openType: false, 
    openRoom: false, 
    editType: false, 
    editRoom: false, 
    currType: { amenities: [] }, 
    currRoom: {},
    imagePreview: null,
    
    addAmenity() {
        if (!this.currType.amenities) this.currType.amenities = [];
        this.currType.amenities.push('');
    },
    removeAmenity(index) {
        this.currType.amenities.splice(index, 1);
    },
    initType(data = null) {
        if(data) {
            this.currType = {...data};
            this.currType.amenities = data.amenities ? data.amenities.split(', ') : [];
            this.imagePreview = '{{ asset("assets/room_types") }}/' + data.image_thumbnail;
            this.editType = true;
        } else {
            this.currType = { name: '', base_price: '', capacity: '', description: '', amenities: ['WiFi', 'AC', 'TV'] };
            this.imagePreview = null;
            this.editType = false;
        }
        this.openType = true;
    },
    previewFile(event) {
        const file = event.target.files[0];
        if (file) { this.imagePreview = URL.createObjectURL(file); }
    },
    confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Delete this unit from inventory?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A1A1A',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) { document.getElementById('delete-form-' + id).submit(); }
        })
    }
}" 
id="admin-root"
x-cloak
x-on:edit-room-event.window="currRoom = $event.detail; editRoom = true; openRoom = true"
x-on:delete-room-event.window="confirmDelete($event.detail)">

    {{-- HEADER --}}
    <div class="flex justify-between items-end mb-10">
        <div>
            <span class="text-[10px] text-gold font-bold uppercase tracking-[0.4em]">Inventory</span>
            <h1 class="font-luxury text-4xl text-dark italic mt-1">Master Rooms</h1>
        </div>
        <div class="flex gap-4">
            <button type="button" @click="initType()" class="border-b border-dark pb-1 text-[10px] font-bold uppercase tracking-widest hover:text-gold hover:border-gold transition-all">
                Manage Categories
            </button>
            <button type="button" @click="editRoom = false; currRoom = {}; openRoom = true" class="bg-dark text-gold px-8 py-3 rounded-2xl text-[10px] font-bold uppercase tracking-widest shadow-2xl hover:bg-gold hover:text-dark transition-all">
                + Add Unit
            </button>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-[32px] p-8 border border-gray-100 shadow-sm overflow-hidden">
        <table id="roomsTable" class="w-full">
            <thead>
                <tr class="text-[9px] uppercase tracking-[0.2em] text-gray-400 border-b border-gray-50">
                    <th class="pb-6 font-bold text-left">Room Details</th>
                    <th class="pb-6 font-bold text-left">Category & Pricing</th>
                    <th class="pb-6 font-bold text-center">Status</th>
                    <th class="pb-6 font-bold text-right pr-4">Settings</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($rooms as $rm)
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 overflow-hidden rounded-xl bg-gray-100 border border-gray-50">
                                <img src="{{ asset('assets/room_types/' . $rm->image_thumbnail) }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <span class="text-xs font-bold text-dark italic">Unit #{{ $rm->room_number }}</span>
                                <span class="block text-[9px] text-gray-400 uppercase tracking-widest mt-0.5">Floor {{ $rm->floor }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="py-6">
                        <p class="text-[10px] font-bold text-dark uppercase">{{ $rm->type_name }}</p>
                        <p class="text-xs text-gold font-bold italic mt-0.5">IDR {{ number_format($rm->base_price, 0, ',', '.') }}</p>
                    </td>
                    <td class="py-6 text-center">
                        <span class="px-3 py-1 rounded-full text-[8px] font-bold uppercase tracking-widest {{ strtolower($rm->status) == 'available' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                            {{ $rm->status }}
                        </span>
                    </td>
                    <td class="py-6">
                        <div class="flex justify-end gap-2 pr-2">
                            <button type="button" onclick="triggerEditRoom({{ json_encode($rm) }})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 text-gray-400 hover:bg-dark hover:text-gold transition-all">
                                <i class="fas fa-edit text-[10px]"></i>
                            </button>
                            <form id="delete-form-{{ $rm->id }}" action="{{ route('rooms.delete', $rm->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" onclick="triggerDeleteRoom({{ $rm->id }})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all">
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

    {{-- MODAL ROOM TYPE (CATEGORY) --}}
    <div x-show="openType" class="fixed inset-0 z-[100] flex items-center justify-center bg-dark/80 backdrop-blur-sm p-4" x-transition>
        <div class="bg-white rounded-[40px] w-full max-w-4xl p-10 overflow-y-auto max-h-[90vh] relative" @click.away="openType = false">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h4 class="font-luxury text-3xl text-dark italic">Category Atelier</h4>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest">Define room types & luxury level</p>
                </div>
                <div class="flex gap-2 bg-gray-50 p-1 rounded-xl mr-8">
                    @foreach($roomTypes as $tp)
                        <button type="button" @click="initType({{ json_encode($tp) }})" 
                            class="px-4 py-2 rounded-lg text-[9px] font-bold uppercase transition-all"
                            :class="currType.id == {{ $tp->id }} ? 'bg-white shadow-sm text-dark' : 'text-gray-400 hover:text-dark'">
                            {{ $tp->name }}
                        </button>
                    @endforeach
                    <button type="button" @click="initType()" class="px-4 py-2 text-[9px] font-bold text-gold uppercase">+ New</button>
                </div>
            </div>

            <form :action="editType ? '/room-types/update/' + currType.id : '{{ route('types.store') }}'" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-10">
                @csrf
                <template x-if="editType"><input type="hidden" name="_method" value="POST"></template>
                
                <div class="space-y-5">
                    <div class="aspect-video bg-gray-50 rounded-3xl border-2 border-dashed border-gray-100 relative flex items-center justify-center overflow-hidden">
                        <template x-if="imagePreview"><img :src="imagePreview" class="w-full h-full object-cover"></template>
                        <template x-if="!imagePreview"><div class="text-center"><i class="fas fa-image text-gray-200 text-3xl mb-2"></i></div></template>
                        <input type="file" name="image_thumbnail" @change="previewFile" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="name" x-model="currType.name" class="w-full bg-gray-50 rounded-xl p-4 text-xs shadow-inner border-none" placeholder="Category Name" required>
                        <input type="number" name="base_price" x-model="currType.base_price" class="w-full bg-gray-50 rounded-xl p-4 text-xs shadow-inner border-none" placeholder="Price (IDR)" required>
                    </div>
                    <textarea name="description" x-model="currType.description" class="w-full bg-gray-50 rounded-xl p-4 text-xs h-28 shadow-inner border-none" placeholder="Description..."></textarea>
                </div>

                <div class="space-y-5">
                    <input type="number" name="capacity" x-model="currType.capacity" class="w-full bg-gray-50 rounded-xl p-4 text-xs shadow-inner border-none" placeholder="Max Capacity (Guests)" required>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center"><label class="text-[9px] font-bold text-gray-400 uppercase">Amenities</label>
                        <button type="button" @click="addAmenity()" class="text-[9px] font-bold text-gold uppercase">+ Add</button></div>
                        <div class="space-y-2 max-h-40 overflow-y-auto pr-2">
                            <template x-for="(amenity, index) in currType.amenities" :key="index">
                                <div class="flex gap-2">
                                    <input type="text" x-model="currType.amenities[index]" class="flex-1 bg-gray-50 rounded-lg px-3 py-2 text-[11px] border-none shadow-inner">
                                    <button type="button" @click="removeAmenity(index)" class="text-red-300 hover:text-red-500"><i class="fas fa-times"></i></button>
                                </div>
                            </template>
                        </div>
                        <input type="hidden" name="amenities" :value="currType.amenities ? currType.amenities.filter(a => a.trim() !== '').join(', ') : ''">
                    </div>
                    <button type="submit" class="w-full bg-dark text-gold py-4 rounded-2xl font-bold uppercase text-[10px] tracking-widest hover:bg-gold hover:text-dark transition-all">
                        <span x-text="editType ? 'Update Category' : 'Create Category'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL UNIT --}}
    <div x-show="openRoom" class="fixed inset-0 z-[100] flex items-center justify-center bg-dark/80 backdrop-blur-sm p-4" x-transition>
        <div class="bg-white rounded-[40px] w-full max-w-sm p-10 shadow-2xl relative" @click.away="openRoom = false">
            <h4 class="font-luxury text-2xl text-dark italic mb-8" x-text="editRoom ? 'Refine Unit' : 'New Unit'"></h4>
            <form :action="editRoom ? '/rooms/update/' + currRoom.id : '{{ route('rooms.store') }}'" method="POST" class="space-y-4">
                @csrf 
                <template x-if="editRoom"><input type="hidden" name="_method" value="POST"></template>
                <input type="text" name="room_number" x-model="currRoom.room_number" class="w-full bg-gray-50 rounded-xl p-4 text-xs border-none shadow-inner" placeholder="Room Number (e.g. 101)" required>
                <input type="number" name="floor" x-model="currRoom.floor" class="w-full bg-gray-50 rounded-xl p-4 text-xs border-none shadow-inner" placeholder="Floor" required>
                <select name="room_type_id" x-model="currRoom.room_type_id" class="w-full bg-gray-50 rounded-xl p-4 text-xs border-none shadow-inner" required>
                    <option value="">Select Category</option>
                    @foreach($roomTypes as $t) <option value="{{ $t->id }}">{{ $t->name }}</option> @endforeach
                </select>
                <button type="submit" class="w-full bg-dark text-gold py-4 rounded-2xl font-bold uppercase text-[10px] tracking-widest mt-4 hover:bg-gold hover:text-dark transition-all">
                    Push to Inventory
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // GLOBAL HELPERS
    function triggerEditRoom(data) {
        window.dispatchEvent(new CustomEvent('edit-room-event', { detail: data }));
    }

    function triggerDeleteRoom(id) {
        window.dispatchEvent(new CustomEvent('delete-room-event', { detail: id }));
    }

    $(document).ready(function() {
        $('#roomsTable').DataTable({
            responsive: true,
            language: { 
                search: "", 
                searchPlaceholder: "Search units...",
                paginate: { previous: "<i class='fas fa-chevron-left'></i>", next: "<i class='fas fa-chevron-right'></i>" }
            },
            pageLength: 8,
            dom: 'frtip'
        });
    });
</script>

<style>
    .dataTables_wrapper .dataTables_filter { margin-bottom: 2rem; }
    .dataTables_wrapper .dataTables_filter input {
        background: #fff; border: 1px solid #eee; border-radius: 12px; padding: 0.6rem 1rem; font-size: 11px; width: 250px; outline: none;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current { 
        background: #1A1A1A !important; color: #D4AF37 !important; border-radius: 8px; border: none !important; font-size: 10px; font-weight: bold; 
    }
</style>
@endsection