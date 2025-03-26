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
                        $childHistory = $child->histories()->whereDate('tanggal', $today)->latest()->first();
                        
                        $requiredFields = [
                            'makan_pagi', 'makan_siang', 'makan_sore',
                            'susu_pagi', 'susu_siang', 'susu_sore',
                            'air_putih_pagi', 'air_putih_siang', 'air_putih_sore',
                            'bak_pagi', 'bak_siang', 'bak_sore',
                            'bab_pagi', 'bab_siang', 'bab_sore',
                            'tidur_pagi', 'tidur_siang', 'tidur_sore',
                            'kondisi', 'obat_pagi', 'obat_siang', 'obat_sore'
                        ];
                        
                        $jsonFields = ['kegiatan_outdoor', 'kegiatan_indoor', 'makanan_camilan_pagi', 'makanan_camilan_siang', 'makanan_camilan_sore'];
                        
                        $isComplete = $childHistory && collect($requiredFields)->every(fn($field) => !empty($childHistory->$field))
                            && collect($jsonFields)->every(fn($field) => !empty(json_decode($childHistory->$field, true)));
                    @endphp

                    <span class="px-2 py-1 rounded text-xs {{ $isComplete ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ $isComplete ? 'Lengkap' : 'Belum Lengkap' }}
                        
                    </span>

                </td>
                    </td>

                    <td class="p-3 flex gap-2">
                    <a href="{{ route('children.editStatus', ['id' => $child->id, 'type' => 'null']) }}"  class="px-3 py-1.5 bg-purple-600 text-white text-xs rounded hover:bg-purple-700">
                    <i class="fas fa-edit"></i> Update
    </a>
                <button type="button" class="px-3 py-1.5 bg-purple-500 text-white text-xs rounded hover:bg-purple-600 info-button" 
                onclick="openInfoModal({{ $child->id }})" 
                data-id="{{ $child->id }}" data-nama="{{ $child->nama }}">
                <i class="fas fa-info-circle"></i> Info
            </button>

    <button type="button" class="px-3 py-1.5 bg-purple-400 text-white text-xs rounded hover:bg-purple-500" 
            onclick="window.openEditModal({{ $child->id }}, '{{ $child->nama }}', {{ $child->user_id ?? 'null' }})">
        <i class="fas fa-sync"></i> Edit
    </button>
    <button type="button" class="px-3 py-1.5 bg-red-500 text-white text-xs rounded hover:bg-red-600" 
            onclick="window.openDeleteModal({{ $child->id }}, '{{ $child->nama }}')">
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
                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Bengkap</span>
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
        <a href="{{ route('children.editStatus', $child->id) }}" 
        class="px-3 py-1.5 bg-purple-600 text-white text-xs rounded hover:bg-purple-700 flex-1">
            <i class="fas fa-edit"></i> Update
        </a>

        <button class="px-3 py-1.5 bg-purple-500 text-white text-xs rounded hover:bg-purple-600 flex-1 info-btn" 
                data-id="{{ $child->id }}" data-nama="{{ $child->nama }}">
            <i class="fas fa-info-circle"></i> Info
        </button>

        <button class="px-3 py-1.5 bg-purple-400 text-white text-xs rounded hover:bg-purple-500 flex-1 edit-btn" 
                data-id="{{ $child->id }}" data-nama="{{ $child->nama }}" data-user_id="{{ $child->user_id ?? 'null' }}">
            <i class="fas fa-sync"></i> Edit
        </button>

        <button class="px-3 py-1.5 bg-red-500 text-white text-xs rounded hover:bg-red-600 flex-1 delete-btn" 
                data-id="{{ $child->id }}" data-name="{{ $child->nama }}" 
                data-url="{{ route('children.destroy', $child->id) }}">
            <i class="fas fa-trash"></i> Hapus
        </button>

                </div>
            </div>
            @endforeach
        </div>

        
                        <!-- Modal for displaying dashboardanak/info/{id} -->
<div id="infoIframeModal" class="fixed inset-0 hidden bg-black bg-opacity-50 z-50 items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-4xl h-5/6 flex flex-col relative">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">Informasi Anak: <span id="childNameIframe"></span></h3>
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body (iframe container) -->
        <div class="flex-grow p-1 overflow-hidden">
            <div class="w-full h-full relative">
                <!-- Loading indicator -->
                <div id="iframeLoader" class="absolute inset-0 flex items-center justify-center bg-white">
                    <div class="flex flex-col items-center">
                        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-purple-500"></div>
                        <p class="mt-4 text-gray-600">Memuat informasi...</p>
                    </div>
                </div>
                
                <!-- iframe to load the external page -->
                <iframe id="childInfoIframe" class="w-full h-full" frameborder="0"></iframe>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="p-4 border-t">
            <button type="button" onclick="closeIframeModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md">
                Tutup
            </button>
        </div>
    </div>
</div>



        <!-- Modal Edit -->
        <div id="editModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white p-5 w-11/12 max-w-lg shadow-lg rounded-lg text-left relative max-h-[80vh] overflow-y-auto">
        <button class="absolute top-2 right-3 text-xl cursor-pointer bg-red-500 text-white w-8 h-8 rounded-full flex items-center justify-center" onclick="closeEditModal()">×</button>
        <h2 class="text-lg font-bold mb-3">Edit Data Anak</h2>
        <form id="editForm" class="flex flex-col gap-4" method="POST" action="{{ route('children.update', $child->id) }}">
            @csrf
            @method('PUT')
            <div>
                <label class="block mb-2">Nama Anak:</label>
                <input type="text" id="edit_nama" name="nama" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block mb-2">Nama Orang Tua:</label>
                <select id="edit_user_id" name="user_id" class="w-full p-2 border rounded" required>
                    <option value="">Pilih orang tua...</option>
                    @foreach($users as $user)
                        @if($user->role === 'user')
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <!-- Simpan tombol ke kanan -->
            <div class="flex justify-end mt-4">
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

        

        <!-- Modal for information -->
<div id="infoModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
    <div class="bg-white rounded-lg shadow-2xl w-auto max-w-3xl max-h-[90vh] flex flex-col transform transition-transform duration-200 scale-95">
        <!-- Header Modal -->
        <div class="flex justify-between items-center p-5 border-b border-gray-200">
            <h2 class="text-lg font-bold text-purple-700">Informasi Tentang Anak</h2>
            <button onclick="closeModal()" class="text-gray-500 hover:text-red-500 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Body Modal -->
        <div id="modalContent" class="p-5 overflow-auto max-h-[65vh]">
            <!-- Modal content will be loaded here -->
            <div class="flex items-center justify-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-700"></div>
            </div>
        </div>

        <!-- Footer Modal -->
        <div class="p-5 border-t border-gray-200 flex justify-end gap-3">
            <button type="button" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition duration-300">
                Download Data
            </button>
            <button onclick="closeModal()" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

        <script>
            
document.addEventListener("DOMContentLoaded", function () {
    // First, make these functions globally available
    window.openModal = function(id, nama) {
        document.getElementById("infoModal").classList.remove("hidden");
        document.getElementById("infoModal").classList.add("flex");
        document.getElementById("childNameInfo").textContent = nama;
        
        // Get child info via AJAX
        fetchChildInfo(id);
    };

    window.closeModal = function() {
        document.getElementById("infoModal").classList.add("hidden");
        document.getElementById("infoModal").classList.remove("flex");
    };

    window.openEditModal = function(id, nama, user_id) {
        document.getElementById("editModal").classList.remove("hidden");
        document.getElementById("editModal").classList.add("flex");
        
        document.getElementById("edit_nama").value = nama;
        
        // Handle null user_id
        if (user_id !== null && user_id !== 'null') {
            document.getElementById("edit_user_id").value = user_id;
        } else {
            document.getElementById("edit_user_id").value = "";
        }
        
        document.getElementById("editForm").action = `/children/${id}`;
    };

    window.closeEditModal = function() {
        document.getElementById("editModal").classList.add("hidden");
        document.getElementById("editModal").classList.remove("flex");
    };

    window.openDeleteModal = function(id, name) {
        // Use standard confirm dialog if Notiflix is not loaded
        if (typeof Notiflix === 'undefined') {
            if (confirm(`Apakah Anda yakin ingin menghapus ${name}?`)) {
                deleteChild(id);
            }
        } else {
            Notiflix.Confirm.show(
                'Konfirmasi Hapus',
                `Apakah Anda yakin ingin menghapus <strong>${name}</strong>?`,
                'Ya, Hapus',
                'Batal',
                function okCb() {
                    deleteChild(id);
                },
                function cancelCb() {
                    alert('Penghapusan dibatalkan.');
                }
            );
        }
    };function deleteChild(id) {
    // Get CSRF token
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Check if Notiflix exists
    if (typeof Notiflix !== 'undefined') {
        // Use Notiflix for confirmation
        Notiflix.Confirm.show(
            'Konfirmasi',
            'Apakah Anda yakin ingin menghapus data ini?',
            'Ya',
            'Tidak',
            function() {
                performDelete(id, token);
            }
        );
    } else {
        // Fallback to regular confirm
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            performDelete(id, token);
        }
    }
}

function performDelete(id, token) {
    // Create form data
    const formData = new FormData();
    formData.append('_method', 'DELETE');
    formData.append('_token', token);
    
    // Make fetch request
    fetch(`/children/${id}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': token
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (typeof Notiflix !== 'undefined') {
                Notiflix.Notify.success('Data berhasil dihapus!');
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                alert('Data berhasil dihapus!');
                location.reload();
            }
        } else {
            if (typeof Notiflix !== 'undefined') {
                Notiflix.Notify.failure(data.message || 'Gagal menghapus data.');
            } else {
                alert(data.message || 'Gagal menghapus data.');
            }
        }
    })
    .catch(error => {
        if (typeof Notiflix !== 'undefined') {
            Notiflix.Notify.failure('Terjadi kesalahan!');
        } else {
            alert('Terjadi kesalahan!');
        }
        console.error('Error:', error);
    });
}
    
    function fetchChildInfo(id) {
        // Show loading indicator
        document.getElementById("childInfoContent").innerHTML = `
            <div class="flex justify-center">
                <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-purple-500"></div>
            </div>
            <p class="text-center text-gray-500">Memuat informasi...</p>
        `;
        
        // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Fetch child data
        fetch(`/children/${id}/info`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Populate modal with data
                document.getElementById("childInfoContent").innerHTML = renderChildInfo(data.child);
            } else {
                document.getElementById("childInfoContent").innerHTML = `
                    <p class="text-center text-red-500">Gagal memuat informasi.</p>
                `;
            }
        })
        .catch(error => {
            document.getElementById("childInfoContent").innerHTML = `
                <p class="text-center text-red-500">Terjadi kesalahan saat memuat data.</p>
            `;
            console.error('Error:', error);
        });
    }
    
    function renderChildInfo(child) {
        // Create HTML to display child info
        return `
            <div class="space-y-3">
                <div class="flex items-start">
                    <span class="text-gray-500 w-32">Nama:</span>
                    <span class="font-medium">${child.nama}</span>
                </div>
                <div class="flex items-start">
                    <span class="text-gray-500 w-32">Orang Tua:</span>
                    <span>${child.user ? child.user.name : '-'}</span>
                </div>
                <div class="flex items-start">
                    <span class="text-gray-500 w-32">Tanggal:</span>
                    <span>${formatDate(child.tanggal)}</span>
                </div>
                <!-- Add more child info as needed -->
            </div>
        `;
    }
    
    function formatDate(dateString) {
        const date = new Date(dateString);
        return `${date.getDate().toString().padStart(2, '0')}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getFullYear()}`;
    }

    // Set up form submission
    const editForm = document.getElementById("editForm");
    if (editForm) {
        editForm.addEventListener("submit", function (event) {
            event.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Data berhasil diperbarui!');
                    window.closeEditModal();
                    location.reload();
                } else {
                    alert('Gagal memperbarui data.');
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan. Silakan coba lagi.');
                console.error('Error:', error);
            });
        });
    }

    // Add event listeners for mobile buttons
    document.querySelectorAll('.info-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            window.openModal(id, nama);
        });
    });

    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const userId = this.getAttribute('data-user_id');
            window.openEditModal(id, nama, userId);
        });
    });

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name') || this.getAttribute('data-nama');
            window.openDeleteModal(id, name);
        });
    });

    // Initialize any toggle functionality
    const menuToggle = document.getElementById("menuToggle");
    if (menuToggle) {
        menuToggle.addEventListener("click", function() {
            let sidebar = document.getElementById("sidebar");
            let overlay = document.getElementById("sidebarOverlay");
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        });
    }
});
function openIframeModal(id, nama) {
    // Make sure the modal element exists
    const modal = document.getElementById("infoIframeModal");
    if (!modal) {
        console.error("Modal element not found. Make sure to add the modal HTML to your page.");
        return;
    }
    
    // Set the child name in the modal title if the element exists
    const childNameElement = document.getElementById("childNameIframe");
    if (childNameElement) {
        childNameElement.textContent = nama;
    }
    
    // Show the loading indicator if it exists
    const loaderElement = document.getElementById("iframeLoader");
    if (loaderElement) {
        loaderElement.style.display = "flex";
    }
    
    // Set the iframe source if it exists   
    const iframe = document.getElementById("childInfoIframe");
    if (iframe) {
        iframe.src = `/children/{id}/edit-status/makan-cemilan`;
        
        // Hide the loading indicator when the iframe is loaded
        iframe.onload = function() {
            if (loaderElement) {
                loaderElement.style.display = "none";
            }
        };
    }
    
    // Show the modal
    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

function closeIframeModal() {
    // Hide the modal
    const modal = document.getElementById("infoIframeModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");
    
    // Clear the iframe source to stop any ongoing processes
    document.getElementById("childInfoIframe").src = "";
}

// Add event listeners for your existing buttons
document.addEventListener("DOMContentLoaded", function() {
    // For table view buttons
    document.querySelectorAll('button[onclick*="openModal("]').forEach(button => {
        button.onclick = function() {
            const onclickAttr = this.getAttribute('onclick');
            const matches = onclickAttr.match(/openModal\(\s*(\d+)\s*,\s*['"]([^'"]+)['"]\s*\)/);
            
            if (matches && matches.length >= 3) {
                const id = matches[1];
                const nama = matches[2];
                openIframeModal(id, nama);
                return false; // Prevent the original onclick from firing
            }
        };
    });
    
    // For mobile view buttons
    document.querySelectorAll('.info-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            openIframeModal(id, nama);
        });
    });
});function openInfoModal(childId) {
    fetch(`/dashboardanak/info/${childId}`)
        .then(response => response.text())
        .then(data => {
            const modal = document.getElementById("infoModal");
            const modalContent = document.getElementById("modalContent");

            // Ensure modal is centered and visible
            modal.classList.remove("hidden");
            modal.classList.add("fixed", "inset-0", "z-50", "flex", "items-center", "justify-center", "bg-black", "bg-opacity-50");
            
            modalContent.innerHTML = data; // Load dynamic content
            
            // Add scale and opacity transition
            const modalWrapper = modal.querySelector("div");
            modalWrapper.classList.remove("scale-95", "opacity-0");
            modalWrapper.classList.add("scale-100", "opacity-100");
        })
        .catch(error => console.error("Error fetching modal content:", error));
}

function closeModal() {
    const modal = document.getElementById("infoModal");
    const modalWrapper = modal.querySelector("div");

    // Add fade-out effect
    modalWrapper.classList.remove("scale-100", "opacity-100");
    modalWrapper.classList.add("scale-95", "opacity-0");

    // Hide modal after transition
    setTimeout(() => {
        modal.classList.add("hidden");
        modal.classList.remove("fixed", "inset-0", "z-50", "flex", "items-center", "justify-center", "bg-black", "bg-opacity-50");
    }, 300); // Match this to your CSS transition duration
}
// <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>
        </script>
        @endsection
