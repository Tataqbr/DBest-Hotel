@extends('layouts.admin')

@section('admin_content')

    {{-- HEADER SECTION --}}
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="font-luxury text-3xl text-dark italic">Executive Dashboard</h1>
            <p class="text-[11px] uppercase tracking-[0.3em] text-gray-400 mt-1">Operational Overview & Analytics</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-right hidden md:block border-r border-gray-100 pr-4 mr-1">
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">System Status</p>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <p class="text-[9px] font-bold text-dark uppercase tracking-tighter">Gateway Synchronized</p>
                </div>
            </div>
            <div class="text-right hidden md:block">
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Current Time</p>
                <p class="text-xs font-bold text-dark">{{ date('D, d M Y | H:i') }} WIB</p>
            </div>
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        @php
            $stats = [
                ['label' => 'Total Revenue', 'value' => 'IDR ' . number_format($totalRevenue ?? 0, 0, ',', '.'), 'color' => 'text-dark', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['label' => 'Total Bookings', 'value' => $totalBookings ?? 0, 'color' => 'text-dark', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['label' => 'Room Occupancy', 'value' => ($occupancyRate ?? 0) . '%', 'color' => 'text-dark', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                ['label' => 'Dining Orders', 'value' => '24', 'color' => 'text-dark', 'icon' => 'M12 2v20m0-20c-2.5 0-4 2-4 5v3m4-8c2.5 0 4 2 4 5v3m-8 0h8M6 20h2a2 2 0 002-2V8m4 10a2 2 0 002 2h2m-6-10V4'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all group">
            <div class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 group-hover:bg-dark group-hover:text-gold transition-colors duration-500 mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"></path></svg>
            </div>
            <p class="text-[9px] uppercase tracking-widest text-gray-400 font-bold">{{ $stat['label'] }}</p>
            <h3 class="text-xl font-bold text-dark mt-1">{{ $stat['value'] }}</h3>
        </div>
        @endforeach
    </div>


                {{-- ==== TABEL GATEWAYS ==== --}}
<div class="bg-white border shadow-md p-6">
    <div class="flex items-center justify-between w-full border-b-2 pb-6 mb-5">
        <h2 class="text-xl font-semibold">Payment Gateways</h2>
    </div>
    <div class="overflow-x-auto">
        <table id="gateways" class="min-w-full text-left text-sm">
            <thead class="text-white bg-dark">
                <tr>
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Code</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataGateways as $dg)
                    <tr>
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">{{ $dg->name }}</td>
                        <td class="py-3 px-4">{{ $dg->code }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded text-xs font-medium 
                                {{ $dg->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($dg->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 flex items-center gap-3">
                            <button onclick="openEditModal({{ $dg->id }}, '{{ $dg->name }}', '{{ $dg->code }}', '{{ $dg->status }}')" 
                                    class="p-2 bg-blue-600 text-white font-medium text-sm hover:bg-blue-700 rounded">
                                Edit
                            </button>
                            
                            <form action="{{ route('gateway-toggle-status', $dg->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-2 {{ $dg->status === 'active' ? 'bg-orange-600 hover:bg-orange-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-medium text-sm rounded">
                                    {{ $dg->status === 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                            
                            <form action="{{ route('delete-gateway', $dg->id) }}" method="POST"
                                        onsubmit="return confirmDelete(event)">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="p-2 bg-red-800 text-white font-medium">Delete</button>
                                    </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center pb-3 border-b">
                <h3 class="text-xl font-medium">Edit Payment Gateway</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    ✕
                </button>
            </div>
            
            <form id="editForm" method="POST">
                @csrf
                @method('POST')
                
                <div class="mt-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Name</label>
                        <input type="text" id="edit_name" name="name" 
                               class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Code</label>
                        <input type="text" id="edit_code" name="code" 
                               class="w-full p-2 border rounded" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Status</label>
                        <select id="edit_status" name="status" class="w-full p-2 border rounded" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()" 
                            class="px-4 py-2 border rounded hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update Gateway
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
     

    <script>
let currentEditId = null;

function openEditModal(id, name, code, status) {
    currentEditId = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_code').value = code;
    document.getElementById('edit_status').value = status;
    document.getElementById('editForm').action = `edit-payment-gateway/${id}`;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
    currentEditId = null;
}

// Close modal when clicking outside
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target.id === 'editModal') {
        closeEditModal();
    }
});
</script>
    </main>

    {{-- ==================== JAVASCRIPT ==================== --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Simple Modal Functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Image Modal
    function showImageModal(src, caption) {
        document.getElementById('modalImage').src = src;
        document.getElementById('modalCaption').textContent = caption;
        openModal('imageModal');
    }

    // Create User Modal
    function openCreateUserModal(requestId, userEmail) {
        console.log('Opening modal for request ID:', requestId, 'Email:', userEmail);
        
        // Set hidden input dengan request ID
        document.getElementById('userRequestId').value = requestId;
        
        // Generate username dari email
        const username = userEmail.split('@')[0];
        document.getElementById('userUsername').value = username;
        
        // Set form action dengan route yang benar
        document.getElementById('createUserForm').action = `/create-user/${requestId}`;
        
        // Generate initial password
        generatePassword();
        
        // Buka modal
        openModal('createUserModal');
    }


    // SweetAlert for Delete Confirmation
    function confirmDeleteUserRequest(requestId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            background: '#fff',
            color: '#333'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                document.getElementById(`delete-user-request-${requestId}`).submit();
            }
        });
    }


    // Close modals when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[id$="Modal"]').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal(this.id);
                }
            });
        });

        // Auto-generate password on page load for user modal
        generatePassword();
    });

    
    // Prevent modal close when clicking inside modal content
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.bg-white').forEach(modalContent => {
            modalContent.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    });
    </script>

@endsection