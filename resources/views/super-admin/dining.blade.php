@extends('layouts.admin')

@section('admin_content')
<div x-data="{ 
    openModal: false, 
    editMode: false,
    currMenu: {},
    imagePreview: null,

    initMenu(data = null) {
        if(data) {
            this.currMenu = {...data};
            this.imagePreview = '{{ asset('assets/dining') }}/' + data.image_path;
            this.editMode = true;
        } else {
            this.currMenu = { category: '', name: '', description: '', price: '', is_available: 1 };
            this.imagePreview = null;
            this.editMode = false;
        }
        this.openModal = true;
    },

    confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Menu?',
            text: 'Data ini akan dihapus permanen dari koleksi kuliner Loka Bliss.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A1A1A',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    },

    previewFile(event) {
        const file = event.target.files[0];
        if (file) { this.imagePreview = URL.createObjectURL(file); }
    }
}" x-cloak>

    {{-- 1. NOTIFICATION AREA --}}
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl">
            <p class="text-[10px] font-bold text-red-600 uppercase tracking-widest">Gagal Menyimpan:</p>
            <p class="text-xs text-red-500 mt-1">{{ $errors->first() }}</p>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-2xl">
            <p class="text-[10px] font-bold text-green-600 uppercase tracking-widest">Success</p>
            <p class="text-xs text-green-500 mt-1">{{ session('success') }}</p>
        </div>
    @endif

    {{-- 2. HEADER --}}
    <div class="flex justify-between items-end mb-10">
        <div>
            <span class="text-[10px] text-gold font-bold uppercase tracking-[0.4em]">Culinary Inventory</span>
            <h1 class="font-luxury text-4xl text-dark italic mt-1">Dining Master</h1>
        </div>
        <button @click="initMenu()" class="bg-dark text-gold px-8 py-3 rounded-2xl text-[10px] font-bold uppercase tracking-widest shadow-2xl hover:bg-gold hover:text-dark transition-all">
            + Add New Dish
        </button>
    </div>

    {{-- 3. DATA TABLE --}}
    <div class="bg-white rounded-[32px] p-8 border border-gray-100 shadow-sm overflow-hidden">
        <table id="diningTable" class="w-full">
            <thead>
                <tr class="text-[9px] uppercase tracking-[0.2em] text-gray-400 border-b border-gray-50">
                    <th class="pb-6 font-bold text-left">Menu Details</th>
                    <th class="pb-6 font-bold text-left">Category & Price</th>
                    <th class="pb-6 font-bold text-center">Status</th>
                    <th class="pb-6 font-bold text-right pr-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($menus as $menu)
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 overflow-hidden rounded-xl bg-gray-100 border border-gray-50">
                                <img src="{{ asset('assets/dining/' . $menu->image_path) }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <span class="text-xs font-bold text-dark italic">{{ $menu->name }}</span>
                                <p class="text-[9px] text-gray-400 line-clamp-1 w-48 mt-0.5">{{ $menu->description }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-6">
                        <span class="text-[10px] font-bold text-dark uppercase tracking-tighter">{{ $menu->category }}</span>
                        <p class="text-xs text-gold font-bold italic mt-0.5">IDR {{ number_format($menu->price, 0, ',', '.') }}</p>
                    </td>
                    <td class="py-6 text-center">
                        <span class="px-3 py-1 rounded-full text-[8px] font-bold uppercase tracking-widest {{ $menu->is_available ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                            {{ $menu->is_available ? 'Available' : 'Sold Out' }}
                        </span>
                    </td>
                    <td class="py-6">
                        <div class="flex justify-end gap-2 pr-2">
                            {{-- Tombol Edit --}}
                            <button type="button" @click="initMenu({{ json_encode($menu) }})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 text-gray-400 hover:bg-dark hover:text-gold transition-all">
                                <i class="fas fa-edit text-[10px]"></i>
                            </button>
                            
                            {{-- Form Delete dengan Swal --}}
                            <form id="delete-form-{{ $menu->id }}" action="{{ route('dining.delete', $menu->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" @click="confirmDelete({{ $menu->id }})" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all">
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

    {{-- 4. MODAL FORM (ADD & EDIT) --}}
    <div x-show="openModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center bg-dark/80 backdrop-blur-sm p-4" 
         x-transition>
        
        <div class="bg-white rounded-[40px] w-full max-w-4xl p-10 overflow-y-auto max-h-[90vh] relative" @click.away="openModal = false">
            {{-- Close Button --}}
            <button @click="openModal = false" class="absolute top-8 right-8 text-gray-300 hover:text-dark">
                <i class="fas fa-times text-xl"></i>
            </button>

            <div class="mb-8">
                <h4 class="font-luxury text-3xl text-dark italic" x-text="editMode ? 'Refine Culinary' : 'New Creation'"></h4>
                <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Manage dish information and visuals</p>
            </div>

            {{-- FORM --}}
            <form :action="editMode ? '/admin/dining/update/' + currMenu.id : '{{ route('dining.store') }}'" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="grid grid-cols-1 md:grid-cols-2 gap-10">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                {{-- Left Side: Image Upload --}}
                <div class="space-y-6">
                    <div class="relative aspect-video bg-gray-50 rounded-[32px] border-2 border-dashed border-gray-100 flex items-center justify-center overflow-hidden group">
                        <template x-if="imagePreview">
                            <img :src="imagePreview" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!imagePreview">
                            <div class="text-center">
                                <i class="fas fa-image text-gray-200 text-3xl mb-2"></i>
                                <p class="text-[9px] text-gray-300 font-bold uppercase tracking-widest">Upload Photo</p>
                            </div>
                        </template>
                        <input type="file" name="image" @change="previewFile" class="absolute inset-0 opacity-0 cursor-pointer" :required="!editMode">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[9px] font-bold text-gray-400 uppercase tracking-widest ml-2">Category</label>
                            <input type="text" name="category" x-model="currMenu.category" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-xs shadow-inner focus:ring-1 focus:ring-gold" placeholder="e.g. Appetizer" required>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-bold text-gray-400 uppercase tracking-widest ml-2">Status</label>
                            <select name="is_available" x-model="currMenu.is_available" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-xs shadow-inner appearance-none">
                                <option value="1">Available</option>
                                <option value="0">Sold Out</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Right Side: Fields --}}
                <div class="space-y-6">
                    <div class="space-y-1">
                        <label class="text-[9px] font-bold text-gray-400 uppercase tracking-widest ml-2">Dish Name</label>
                        <input type="text" name="name" x-model="currMenu.name" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-xs shadow-inner focus:ring-1 focus:ring-gold" required>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[9px] font-bold text-gray-400 uppercase tracking-widest ml-2">Price (IDR)</label>
                        <input type="number" name="price" x-model="currMenu.price" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-xs shadow-inner focus:ring-1 focus:ring-gold" required>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[9px] font-bold text-gray-400 uppercase tracking-widest ml-2">Description</label>
                        <textarea name="description" x-model="currMenu.description" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-xs h-32 shadow-inner focus:ring-1 focus:ring-gold" placeholder="Briefly describe the taste..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-dark text-gold py-5 rounded-[24px] font-bold uppercase text-[10px] tracking-widest hover:bg-gold hover:text-dark transition-all mt-4">
                        <span x-text="editMode ? 'Update Dish' : 'Save To Menu'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 5. SCRIPTS --}}
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#diningTable').DataTable({
            responsive: true,
            language: { 
                search: "", 
                searchPlaceholder: "Cari menu...",
                paginate: { previous: "<i class='fas fa-chevron-left'></i>", next: "<i class='fas fa-chevron-right'></i>" }
            },
            pageLength: 8,
            dom: 'frtip'
        });
    });
</script>

<style>
    /* Styling khusus DataTables agar serasi */
    .dataTables_wrapper .dataTables_filter { margin-bottom: 2rem; }
    .dataTables_wrapper .dataTables_filter input {
        background: #fff; border: 1px solid #eee; border-radius: 12px; padding: 0.6rem 1.2rem; font-size: 11px; width: 280px; outline: none;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current { 
        background: #1A1A1A !important; color: #D4AF37 !important; border-radius: 8px; border: none !important; font-size: 10px; font-weight: bold; 
    }
    .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
</style>
@endsection