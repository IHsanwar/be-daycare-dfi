@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<div class="bg-gray-50 min-h-screen py-8 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto space-y-6">
        {{-- Welcome Header --}}
        <div class="bg-white rounded-xl shadow-soft p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">
                        Selamat Datang, {{ Auth::user()->name }}
                    </h2>
                    <p class="text-gray-500 text-sm">
                        Kelola pengguna dan anak-anak di daycare Anda dengan mudah.
                    </p>
                </div>
                <div class="hidden sm:block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-purple-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
            </div>
        </div>
    {{-- Search and Add User Section --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-between">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari nama anak..." 
                    class="w-full pl-10 pr-4 py-3 rounded-xl border-none bg-white shadow-soft focus:ring-2 focus:ring-purple-300 text-gray-700"
                    value="{{ request('search') }}"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

        <a href="{{ route('register') }}" 
           class="inline-flex items-center justify-center px-6 py-3 bg-purple-500 text-white rounded-xl shadow-soft hover:bg-purple-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 4v16m8-8H4" />
            </svg>
            Tambah User
        </a>
    </div>

    {{-- User List --}}
    <div class="bg-white rounded-xl shadow-soft overflow-hidden">
        <div class="hidden md:block">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                            <button 
                                onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->role }}')"
                                class="text-sm px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors">
                                <i class="fas fa-pen"></i> Edit
                            </button>
                            <button 
                                onclick="alertDelete({{ $user->id }})"
                                class="text-sm px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile Card View --}}
        <div class="md:hidden space-y-4 p-4">
            @foreach($users as $user)
            <div class="bg-white border border-gray-100 rounded-xl p-4 shadow-soft">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h3>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                        {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                <p class="text-gray-500 mb-4">{{ $user->email }}</p>
                <div class="flex space-x-3">
                    <button 
                        onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->role }}')"
                        class="flex-1 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors">
                        Edit
                    </button>
                    <button 
                        onclick="openDeleteModal({{ $user->id }})"
                        class="flex-1 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors">
                        Hapus
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-25 hidden items-center justify-center z-50 p-4">
    <div class="bg-white w-full max-w-md mx-auto rounded-2xl shadow-2xl p-6 relative">
        <button 
            onclick="closeEditModal()" 
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Pengguna</h2>

        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')

            <input type="hidden" id="editUserId" name="id">
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input 
                    type="text" 
                    id="editUsername" 
                    name="name" 
                    class="w-full px-4 py-3 border-none bg-gray-100 rounded-xl focus:ring-2 focus:ring-purple-300"
                >
            </div>

            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select 
                    id="editRole" 
                    name="role" 
                    class="w-full px-4 py-3 border-none bg-gray-100 rounded-xl focus:ring-2 focus:ring-purple-300"
                >
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button 
                type="submit" 
                class="w-full py-3 bg-purple-500 text-white rounded-xl hover:bg-purple-600 transition-colors"
            >
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
</div>

<!-- Include Notiflx -->
<script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>

<script>
    function alertDelete(userId) {
    // Validate user ID
    if (!userId) {
        Notiflix.Notify.failure('ID pengguna tidak valid');
        return;
    }

    Notiflix.Confirm.show(
        'Konfirmasi Hapus',
        'Apakah Anda yakin ingin menghapus user ini?',
        'Ya, Hapus',
        'Batal',
        function okCb() {
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            // Disable interaction during delete process
            Notiflix.Loading.standard('Memproses...');

            fetch(`/users/${userId}/delete`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                // Stop loading
                Notiflix.Loading.remove();

                // Check for error responses
                if (!response.ok) {
                    return response.json().then(errorData => {
                        throw new Error(
                            errorData.message || 
                            `Gagal menghapus user. Status: ${response.status}`
                        );
                    }).catch(() => {
                        throw new Error(`Gagal menghapus user. Status: ${response.status}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                // Success notification
                Notiflix.Notify.success('User berhasil dihapus', {
                    position: 'right-bottom',
                    width: '280px',
                    fontSize: '16px'
                });

                // Reload after a short delay
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            })
            .catch(error => {
                // Error notification
                Notiflix.Notify.failure(error.message || 'Terjadi kesalahan saat menghapus user', {
                    position: 'right-bottom',
                    width: '280px',
                    fontSize: '16px'
                });

                // Log error for debugging
                console.error('Delete Error:', error);
            });
        },
        function cancelCb() {
            // Cancel notification
            Notiflix.Notify.info('Aksi dibatalkan', {
                position: 'right-bottom',
                width: '280px',
                fontSize: '16px'
            });
        }
    );
}


</script>
<script>
// Same JavaScript logic as before, with slight UI improvements
function openEditModal(id, name, role) {
    document.getElementById('editForm').action = `/users/${id}`;
    document.getElementById('editUserId').value = id;
    document.getElementById('editUsername').value = name;
    document.getElementById('editRole').value = role;
    
    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

</script>
@endsection