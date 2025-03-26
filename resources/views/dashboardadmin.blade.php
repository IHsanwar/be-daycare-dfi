@extends('layouts.app') {{-- Sesuaikan dengan layout utama jika ada --}}

@section('title', 'Dashboard Admin') {{-- ✅ Tambahin Judul Halaman --}}

@section('content')
<div class="flex">

    <div class="flex-1 container mx-auto p-6">
        {{-- Header Selamat Datang --}}
        <div class="mb-5">
            <h2 class="text-2xl font-semibold text-gray-800">Selamat Datang, {{ Auth::user()->name }}</h2>
            <p class="text-gray-600 mb-4">Kelola pengguna dan anak-anak di daycare Anda di sini.</p>
        </div>

        {{-- Input Pencarian dan Tombol Tambah User --}}
        <div class="flex justify-between items-center mb-4">
            <form method="GET" action="{{ route('users.index') }}" class="flex">
                <input type="text" name="search" 
                    placeholder="Cari nama anak..." 
                    class="p-2 border border-gray-300 rounded w-full md:w-64 text-gray-700 focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                    value="{{ request('search') }}">
                <button type="submit" class="ml-2 bg-purple-500 text-white px-4 py-2 rounded-lg">Cari</button>
            </form>

            <a href="{{ route('register') }}" 
                class="bg-purple-500 text-white px-4 py-2 rounded-lg flex items-center transition-all hover:bg-purple-600 shadow-md">
                <i class="fas fa-user-plus mr-2"></i> Tambah User
            </a>
        </div>

        {{-- Tabel Data Pengguna --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="p-3 text-left">Username</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Role</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user) {{-- Looping data dari controller --}}
                    <tr class="border-t">
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 text-white text-sm rounded-lg 
                                        {{ $user->role == 'admin' ? 'bg-pink-500' : 'bg-blue-500' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            {{-- Tombol Edit (Pakai modal) --}}
                            <button onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" 
                            class="px-3 py-1 bg-blue-500 text-white rounded">
                              Edit
                            </button>

                            {{-- Tombol Hapus (Pakai modal) --}}
                            <button onclick="openDeleteModal({{ $user->id }})" 
                                    class="px-3 py-1 bg-red-500 text-white rounded">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" class="fixed inset-0 hidden bg-black bg-opacity-50 items-center justify-center z-50 p-4">
    <div class="bg-white p-5 w-11/12 max-w-lg shadow-lg rounded-lg text-left relative">
        <button class="absolute top-2 right-3 text-xl cursor-pointer bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center" 
                onclick="closeEditModal()">×</button>
        <h2 class="text-lg font-bold mb-3">Edit Data Pengguna</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" id="editUserId">
            
            <label for="username" class="block mb-2">Username:</label>
            <input type="text" id="editUsername" name="username" class="w-full p-2 border rounded mb-3">
        
            <label for="email" class="block mb-2">Email:</label>
            <input type="email" id="editEmail" name="email" class="w-full p-2 border rounded mb-3">
        
            <label for="role" class="block mb-2">Role:</label>
            <select id="editRole" name="role" class="w-full p-2 border rounded mb-3">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div id="deleteModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white p-5 w-11/12 max-w-lg shadow-lg rounded-lg text-left relative">
        <button class="absolute top-2 right-3 text-xl cursor-pointer bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center" 
                onclick="closeDeleteModal()">×</button>
        <h2 class="text-lg font-bold mb-3">Konfirmasi Penghapusan</h2>
        <p class="text-gray-800 mb-4">Apakah Anda yakin ingin menghapus data ini?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, username, email, role) {
        document.getElementById('editUserId').value = id;
        document.getElementById('editUsername').value = username;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;
        
        // Tampilkan modal
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        // Sembunyikan modal
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }

    function openDeleteModal(id) {
        document.getElementById("deleteModal").classList.remove("hidden");
        document.getElementById("deleteModal").classList.add("flex");

        document.getElementById("deleteForm").action = "/users/" + id;
    }

    function closeDeleteModal() {
        document.getElementById("deleteModal").classList.add("hidden");
    }
</script>
@endsection
