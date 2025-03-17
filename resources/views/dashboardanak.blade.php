{{-- views/dashboard/anak/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard Anak')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-5 gap-3">
        <div>
            <h2 class="text-xl font-semibold">Selamat Datang, {{ Auth::user()->name }}</h2>
            <p class="text-gray-600">Kelola data anak-anak di daycare Anda di sini.</p>
        </div>
        <input type="text" 
               placeholder="Cari nama anak..." 
               class="p-2 border border-gray-300 rounded w-full md:w-64 border-purple-300 text-purple-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
               value="{{ request('search') }}">
    </div>
    
    <!-- Table view (hidden on mobile, visible on md screens and up) -->
    <div class="hidden md:block overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Nama Anak</th>
                    <th class="p-3 text-left">Nama Orang tua</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($children as $child)
                <tr class="border-b border-gray-100">
                    <td class="p-3">{{ $child->nama }}</td>
                    <td class="p-3">{{ $child->user->name ?? '-' }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($child->tanggal)->format('d-m-Y') }}</td>
                    <td class="p-3">
                        @php
                            $today = \Carbon\Carbon::now()->format('Y-m-d');
                            $childHistory = $child->histories()
                                ->whereDate('tanggal', $today)
                                ->latest()
                                ->first();

                            $isComplete = $childHistory && 
                                !empty($childHistory->makan_pagi) && !empty($childHistory->makan_siang) && !empty($childHistory->makan_sore) &&
                                !empty($childHistory->susu_pagi) && !empty($childHistory->susu_siang) && !empty($childHistory->susu_sore) &&
                                !empty($childHistory->air_putih_pagi) && !empty($childHistory->air_putih_siang) && !empty($childHistory->air_putih_sore) &&
                                !empty($childHistory->bak_pagi) && !empty($childHistory->bak_siang) && !empty($childHistory->bak_sore) &&
                                !empty($childHistory->bab_pagi) && !empty($childHistory->bab_siang) && !empty($childHistory->bab_sore) &&
                                !empty($childHistory->tidur_pagi) && !empty($childHistory->tidur_siang) && !empty($childHistory->tidur_sore) &&
                                !empty($childHistory->kondisi);

                            if ($isComplete) {
                                $kegiatanOutdoor = json_decode($childHistory->kegiatan_outdoor, true);
                                $kegiatanIndoor = json_decode($childHistory->kegiatan_indoor, true);
                                $makananCamilanPagi = json_decode($childHistory->makanan_camilan_pagi, true);
                                $makananCamilanSiang = json_decode($childHistory->makanan_camilan_siang, true);
                                $makananCamilanSore = json_decode($childHistory->makanan_camilan_sore, true);
                                
                                $isComplete = $isComplete && 
                                    is_array($kegiatanOutdoor) && count($kegiatanOutdoor) > 0 &&
                                    is_array($kegiatanIndoor) && count($kegiatanIndoor) > 0 &&
                                    is_array($makananCamilanPagi) && count($makananCamilanPagi) > 0 &&
                                    is_array($makananCamilanSiang) && count($makananCamilanSiang) > 0 &&
                                    is_array($makananCamilanSore) && count($makananCamilanSore) > 0 &&
                                    !empty($childHistory->obat_pagi) &&
                                    !empty($childHistory->obat_siang) &&
                                    !empty($childHistory->obat_sore);
                            }
                        @endphp
                        
                        @if ($isComplete)
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Lengkap</span>
                        @else
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Belum Lengkap</span>
                        @endif
                    </td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('children.editStatus', $child->id) }}" class="px-3 py-1.5 bg-purple-600 text-white text-xs rounded hover:bg-purple-700">
                            <i class="fas fa-edit"></i> Update
                        </a>
                        <button class="px-3 py-1.5 bg-purple-500 text-white text-xs rounded hover:bg-purple-600" onclick="openModal({{ $child->id }}, '{{ $child->nama }}')">
                            <i class="fas fa-info-circle"></i> Info
                        </button>
                        <button class="px-3 py-1.5 bg-purple-400 text-white text-xs rounded hover:bg-purple-500" 
                                onclick="openEditModal({{ $child->id }}, '{{ $child->nama }}', {{ $child->user_id ?? 'null' }})">
                            <i class="fas fa-sync"></i> Edit
                        </button>
                        <button class="px-3 py-1.5 bg-red-500 text-white text-xs rounded hover:bg-red-600" 
                                onclick="openDeleteModal({{ $child->id }}, '{{ $child->nama }}')">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Card view (visible on mobile, hidden on md screens and up) -->
    <div class="md:hidden space-y-4">
        @foreach ($children as $child)
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-medium text-lg">{{ $child->nama }}</h3>
                @php
                    $today = \Carbon\Carbon::now()->format('Y-m-d');
                    $childHistory = $child->histories()
                        ->whereDate('tanggal', $today)
                        ->latest()
                        ->first();

                    $isComplete = $childHistory && 
                        !empty($childHistory->makan_pagi) && !empty($childHistory->makan_siang) && !empty($childHistory->makan_sore) &&
                        !empty($childHistory->susu_pagi) && !empty($childHistory->susu_siang) && !empty($childHistory->susu_sore) &&
                        !empty($childHistory->air_putih_pagi) && !empty($childHistory->air_putih_siang) && !empty($childHistory->air_putih_sore) &&
                        !empty($childHistory->bak_pagi) && !empty($childHistory->bak_siang) && !empty($childHistory->bak_sore) &&
                        !empty($childHistory->bab_pagi) && !empty($childHistory->bab_siang) && !empty($childHistory->bab_sore) &&
                        !empty($childHistory->tidur_pagi) && !empty($childHistory->tidur_siang) && !empty($childHistory->tidur_sore) &&
                        !empty($childHistory->kondisi);

                    if ($isComplete) {
                        $kegiatanOutdoor = json_decode($childHistory->kegiatan_outdoor, true);
                        $kegiatanIndoor = json_decode($childHistory->kegiatan_indoor, true);
                        $makananCamilanPagi = json_decode($childHistory->makanan_camilan_pagi, true);
                        $makananCamilanSiang = json_decode($childHistory->makanan_camilan_siang, true);
                        $makananCamilanSore = json_decode($childHistory->makanan_camilan_sore, true);
                        
                        $isComplete = $isComplete && 
                            is_array($kegiatanOutdoor) && count($kegiatanOutdoor) > 0 &&
                            is_array($kegiatanIndoor) && count($kegiatanIndoor) > 0 &&
                            is_array($makananCamilanPagi) && count($makananCamilanPagi) > 0 &&
                            is_array($makananCamilanSiang) && count($makananCamilanSiang) > 0 &&
                            is_array($makananCamilanSore) && count($makananCamilanSore) > 0 &&
                            !empty($childHistory->obat_pagi) &&
                            !empty($childHistory->obat_siang) &&
                            !empty($childHistory->obat_sore);
                    }
                @endphp
                
                @if ($isComplete)
                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Lengkap</span>
                @else
                    <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Belum Lengkap</span>
                @endif
            </div>
            
            <div class="space-y-2 mb-4">
                <div class="flex items-start">
                    <span class="text-gray-500 w-32">Orang Tua:</span>
                    <span>{{ $child->user->name ?? '-' }}</span>
                </div>
                <div class="flex items-start">
                    <span class="text-gray-500 w-32">Tanggal:</span>
                    <span>{{ \Carbon\Carbon::parse($child->tanggal)->format('d-m-Y') }}</span>
                </div>
            </div>
            
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('children.editStatus', $child->id) }}" class="px-3 py-1.5 bg-purple-600 text-white text-xs rounded hover:bg-purple-700 flex-1">
                    <i class="fas fa-edit"></i> Update
                </a>
                <button class="px-3 py-1.5 bg-purple-500 text-white text-xs rounded hover:bg-purple-600 flex-1" 
                        onclick="openModal({{ $child->id }}, '{{ $child->nama }}')">
                    <i class="fas fa-info-circle"></i> Info
                </button>
                <button class="px-3 py-1.5 bg-purple-400 text-white text-xs rounded hover:bg-purple-500 flex-1" 
                        onclick="openEditModal({{ $child->id }}, '{{ $child->nama }}', {{ $child->user_id ?? 'null' }})">
                    <i class="fas fa-sync"></i> Edit
                </button>
                <button class="px-3 py-1.5 bg-red-500 text-white text-xs rounded hover:bg-red-600 flex-1"
        onclick="openDeleteModal({{ $child->id }}, '{{ $child->name }}', '{{ route('children.destroy', $child->id) }}')">
    <i class="fas fa-trash"></i> Hapus
</button>

            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal Info -->
    <div id="infoModal" class="fixed inset-0 hidden bg-black bg-opacity-50 items-center justify-center z-50 p-4">
        <div class="bg-white p-5 w-11/12 max-w-lg shadow-lg rounded-lg text-left relative max-h-90vh overflow-y-auto">
            <button class="absolute top-2 right-3 text-xl cursor-pointer bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-opacity-50 transition duration-550 ease-in-out" onclick="closeModal()">×</button>
            <div class="text-lg font-bold mb-2.5 text-black">Informasi Tentang <span id="childNameInfo"></span></div>
            <div id="childInfoContent" class="space-y-2">
                <!-- This will be populated with AJAX/JavaScript -->
                <div class="flex justify-center">
                    <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-purple-500"></div>
                </div>
                <p class="text-center text-gray-500">Memuat informasi...</p>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 hidden bg-black bg-opacity-50 items-center justify-center z-50 p-4">
        <div class="bg-white p-5 w-11/12 max-w-lg shadow-lg rounded-lg text-left relative max-h-90vh overflow-y-auto">
            <button class="absolute top-2 right-3 text-xl cursor-pointer bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center" onclick="closeEditModal()">×</button>
            <h2 class="text-lg font-bold mb-3">Edit Data Anak</h2>
            <form id="editForm" class="relative pb-16" method="POST" action="{{ route('children.update', $child->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block mb-2">Nama Anak:</label>
                    <input type="text" id="edit_nama" name="nama" class="w-full p-2 border rounded mb-3" required>
                </div>
                <div class="mb-4">
                <label class="block mb-2">Nama Orang Tua:</label>
                <select id="edit_user_id" name="user_id" class="w-full p-2 border rounded mb-3" required>
                    <option value="">Pilih orang tua...</option>
                    @foreach($users as $user)
                        @if($user->role === 'user')
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>


                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js">
        function openModal() {
            document.getElementById("infoModal").classList.remove("hidden");
            document.getElementById("infoModal").classList.add("flex");
        }

        function closeModal() {
            document.getElementById("infoModal").classList.add("hidden");
        }

        function openEditModal(id, nama, user_id) {
            document.getElementById("editModal").classList.remove("hidden");
            document.getElementById("editModal").classList.add("flex");

            // Set input values
            document.getElementById("edit_nama").value = nama;
            document.getElementById("edit_user_id").value = user_id;

            // Update form action dynamically
            let form = document.getElementById("editForm");
            form.action = "/children/" + id;
        }



        function closeEditModal() {
            document.getElementById("editModal").classList.add("hidden");
        }

        function openDeleteModal(id, name, url) {
    Notiflix.Confirm.show(
        'Konfirmasi Hapus',
        `Apakah Anda yakin ingin menghapus <strong>${name}</strong>?`,
        'Ya, Hapus',
        'Batal',
        function okCb() {
            // Kirim AJAX DELETE
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({ '_method': 'DELETE' })
            })
            .then(response => {
                if (response.redirected) {
                    Notiflix.Notify.failure('Sesi telah habis! Mengarahkan ke login...');
                    window.location.href = response.url;
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Notiflix.Notify.success('Data berhasil dihapus!');
                    location.reload();
                } else {
                    Notiflix.Notify.failure(data.message || 'Gagal menghapus data.');
                }
            })
            .catch(error => {
                Notiflix.Notify.failure('Terjadi kesalahan!');
                console.error('Error:', error);
            });
        },
        function cancelCb() {
            Notiflix.Notify.info('Penghapusan dibatalkan.');
        }
    );
}


        function closeDeleteModal() {
            let modal = document.getElementById("deleteModal");
            modal.classList.remove("flex");
            modal.classList.add("hidden");
        }

        function toggleSidebar() {
            let sidebar = document.getElementById("sidebar");
            let overlay = document.getElementById("sidebarOverlay");
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }

        function closeSidebar() {
            let sidebar = document.getElementById("sidebar");
            let overlay = document.getElementById("sidebarOverlay");
            sidebar.classList.add("-translate-x-full");
            overlay.classList.add("hidden");
        }

        document.getElementById("menuToggle").addEventListener("click", toggleSidebar);

        document.querySelectorAll(".hapus-btn").forEach(button => {
            button.addEventListener("click", openDeleteModal);
        });

        document.querySelectorAll("#deleteModal, #infoModal, #editModal").forEach(modal => {
            modal.addEventListener("click", function (event) {
                if (event.target === modal) {
                    modal.classList.add("hidden");
                }
            });
        });

        document.getElementById("editForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let form = this;
    let formData = new FormData(form);

fetch(form.action, {
    method: 'POST',
    body: formData,
    headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        'X-Requested-With': 'XMLHttpRequest'
    }
})
.then(response => {
    if (response.redirected) {
        // Handle session expiration with Notiflix
        if (typeof Notiflix === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/notiflix@3.2.5/dist/notiflix-aio-3.2.5.min.js';
            script.onload = function() {
                setupNotiflixAndRedirect(response.url);
            };
            document.head.appendChild(script);
        } else {
            setupNotiflixAndRedirect(response.url);
        }
        return Promise.reject('Data berhasil disimpan');
    }
    return response.json(); // Make sure to return this for the next then
})
.then(data => {
    // Success handling with Notiflix instead of alert
    if (typeof Notiflix !== 'undefined') {
        Notiflix.Notify.init({
            fontFamily: 'inherit',
            position: 'center-top',
            success: {
                background: '#6d28d9',
                textColor: '#ffffff',
            }
        });
        Notiflix.Notify.success('Data berhasil diperbarui!');
    } else {
        alert("Data berhasil diperbarui!");
    }
    closeEditModal();
    location.reload();
})
.catch(error => {
    console.log('Error:', error);
    if (error !== 'Redirected due to session expiration') {
        // Show error notification
        if (typeof Notiflix !== 'undefined') {
            Notiflix.Notify.failure('Terjadi kesalahan. Silakan coba lagi.');
        } else {
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    }
});

// Function to configure Notiflix and handle redirection
function setupNotiflixAndRedirect(redirectUrl) {
    Notiflix.Notify.init({
        fontFamily: 'inherit',
        position: 'center-top',
        backOverlay: true,
        backOverlayColor: 'rgba(0,0,0,0.5)',
        success: {
            background: '#6d28d9',
            textColor: '#ffffff',
            childClassName: 'notiflix-notify-success',
            notiflixIconColor: '#ffffff',
        }
    });
    
    Notiflix.Notify.success('Session expired! Redirecting to login...');
    
    setTimeout(() => {
        window.location.href = redirectUrl;
    }, 2000);
}
    
});

    </script>
    @endsection
