@extends('layouts.app')

@section('title', 'Dashboard Anak')

@section('content')
<body class="font-inter bg-gray-50 text-gray-800 overflow-x-hidden">
    <div class="flex flex-col md:flex-row min-h-screen relative">
        <!-- Mobile Menu Button -->
        <div class="md:hidden fixed top-4 right-4 z-30">
            <button id="menuToggle" class="bg-white text-purple-600 p-2 rounded-full shadow-lg hover:shadow-xl transition-all duration-300">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        
        
        <!-- Main Content -->
        <div class="flex-1 md:ml-2">
            <!-- Header -->
            <div class="bg-white p-3 shadow-sm sticky top-0 z-10">
                <div class="flex items-center">
                    <div class="text-purple-600 mr-3">
                        <i class="fas fa-edit"></i>
                    </div>
                    <span class="font-bold text-gray-800">Update Status Anak</span>
                </div>
            </div>
            
            <!-- Child Info Card -->
            <div class="p-4">
                <div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex flex-col md:flex-row md:justify-between gap-4">
                        <!-- Child and companion info -->
                        <div class="flex flex-col space-y-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gradient-to-r from-purple-500 to-purple-700 rounded-full flex items-center justify-center text-white shadow-md mr-3">
                                    <i class="fas fa-child text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Nama Anak</div>
                                    <div class="font-semibold">{{ $child->nama }}</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white shadow-md mr-3">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Nama Pendamping</div>
                                    <div class="font-semibold">{{ $child->getOriginal('nama_pendamping') }}</div>
                                    <div class="font-semibold">{{ $child->getOriginal('keterangan') }}</div>
                                </div>
                            </div>

                        </div>
                         <!-- Date -->
                        <div class="flex items-center">
                            <div class="h-12 w-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600 mr-3 pulse-effect">
                                <i class="far fa-calendar-alt text-lg"></i>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Tanggal</div>
                                <div class="bg-purple-50 text-purple-800 px-3 py-1.5 rounded-lg font-semibold">{{ $child->tanggal ? (\Carbon\Carbon::parse($child->tanggal)->format('d-m-Y')) : '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Menu Grid -->
                 <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">
                <!-- Dashboard link that opens the meal update modal -->
                <a onclick="openIframeModal('{{ $child->id }}', 'Menu Makan & Camilan - {{ $child->nama }}','makan')" class="group menu-item block bg-gradient-to-br from-purple-500 to-purple-700 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:bg-gradient-to-r hover:from-purple-600 hover:to-purple-800 hover:-translate-y-2 hover:scale-105 hover:shadow-xl">
                    <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-utensils text-lg"></i>
                    </div>
                    <div class="font-medium text-sm group-hover:animate-pulse">Menu Makan, Minum & Camilan</div>
                </a>

                    <a onclick="openIframeModal('{{ $child->id }}', 'Informasi Buang air dan kesehatan - {{ $child->nama }}','kesehatan')" class="group menu-item block bg-gradient-to-br from-blue-400 to-blue-600 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-blue-500 hover:to-blue-700 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
                        <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-toilet text-lg"></i>
                        </div>
                        <div class="font-medium text-sm group-hover:animate-pulse">Buang Air Kecil & Besar</div>
                    </a>

                    <a href="update_anak_airputih_susu.html" class="group menu-item block bg-gradient-to-br from-purple-500 to-purple-700 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-purple-600 hover:to-purple-800 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
                        <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-glass-water"></i>
                        </div>
                        <div class="font-medium text-sm group-hover:animate-pulse">Air Putih & Susu</div>
                    </a>

                    <a <a onclick="openIframeModal('{{ $child->id }}', 'Informasi Buang air dan kesehatan - {{ $child->nama }}','kegiatan')" class="group menu-item block bg-gradient-to-br from-purple-500 to-purple-700 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-purple-600 hover:to-purple-800 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
                        <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-home text-lg"></i>
                        </div>
                        <div class="font-medium text-sm group-hover:animate-pulse">Kegiatan Indoor & Outdoor</div>
                    </a>

                    <a href="update_anak_obat.html" class="group menu-item block bg-gradient-to-br from-purple-500 to-purple-700 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-purple-600 hover:to-purple-800 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
                        <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-pills text-lg"></i>
                        </div>
                        <div class="font-medium text-sm group-hover:animate-pulse">Obat</div>
                    </a>

                    <a onclick="openIframeModal('{{ $child->id }}', 'Informasi Buang air dan kesehatan - {{ $child->nama }}','tidur')" class="group menu-item block bg-gradient-to-br from-blue-400 to-blue-600 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-blue-500 hover:to-blue-700 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
                        <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bed text-lg"></i>
                        </div>
                        <div class="font-medium text-sm group-hover:animate-pulse">Tidur</div>
                    </a>

                    <a href="update_anak_kondisikesehatan.html" class="group menu-item block bg-gradient-to-br from-indigo-500 to-indigo-700 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-indigo-600 hover:to-indigo-800 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
                        <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-heartbeat text-lg"></i>
                        </div>
                        <div class="font-medium text-sm group-hover:animate-pulse">Kondisi Kesehatan</div>
                    </a>

                    <a href="update_anak_keterangan.html" class="group menu-item block bg-gradient-to-br from-indigo-400 to-indigo-600 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-indigo-500 hover:to-indigo-700 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
                        <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clipboard-list text-lg"></i>
                        </div>
                        <div class="font-medium text-sm group-hover:animate-pulse">Keterangan</div>
                    </a>
                </div>



                <!-- Recent Activity Section - Added to fill the gap -->
                <div class="mt-4">
                    <h3 class="font-semibold text-gray-700 mb-2">Aktivitas Terbaru</h3>
                    <div class="bg-white rounded-xl shadow-sm p-4">
                        <div class="space-y-3">
                            <div class="flex items-start border-b border-gray-100 pb-3">
                                <div class="h-8 w-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-check text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium">Makan Pagi</div>
                                    <div class="text-xs text-gray-500">Hari ini, 08:30</div>
                                </div>
                                <div class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full">Selesai</div>
                            </div>
                            
                            <div class="flex items-start border-b border-gray-100 pb-3">
                                <div class="h-8 w-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-bed text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium">Tidur Siang</div>
                                    <div class="text-xs text-gray-500">Hari ini, 13:00 - 14:15</div>
                                </div>
                                <div class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded-full">75 menit</div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="h-8 w-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-baby-bottle text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm font-medium">Minum Susu</div>
                                    <div class="text-xs text-gray-500">Hari ini, 14:30</div>
                                </div>
                                <div class="text-xs px-2 py-1 bg-purple-100 text-purple-700 rounded-full">120ml</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for iframe content -->
<div id="infoIframeModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4">
    <div class="relative w-full max-w-4xl bg-white rounded-xl shadow-2xl">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h3 id="childNameIframe" class="text-xl font-bold text-purple-700">Menu Makan, Minum & Camilan</h3>
            <button onclick="closeIframeModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Modal loading indicator -->
        <div id="iframeLoader" class="flex items-center justify-center p-12" style="display: none;">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-700"></div>
        </div>
        
        <!-- Modal iframe content -->
        <div class="iframe-container" style="height: 80vh;">
            <iframe id="childInfoIframe" class="w-full h-full" frameborder="0"></iframe>
        </div>
    </div>
</div>

<!-- Close modal function -->
<script>
    function closeIframeModal() {
        const modal = document.getElementById("infoIframeModal");
        if (modal) {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
            
            // Reset iframe source when closing to stop any processes
            const iframe = document.getElementById("childInfoIframe");
            if (iframe) {
                iframe.src = "";
            }
        }
    }
</script>
    
      
    </body>
    </html>
    <script>
        function openIframeModal(id, nama, page) {
    // Pastikan elemen modal ada
    const modal = document.getElementById("infoIframeModal");
    if (!modal) {
        console.error("Modal element not found. Make sure to add the modal HTML to your page.");
        return;
    }

    // Setel nama anak di judul modal jika elemen ada
    const childNameElement = document.getElementById("childNameIframe");
    if (childNameElement) {
        childNameElement.textContent = nama;
    }

    // Tampilkan indikator loading jika ada
    const loaderElement = document.getElementById("iframeLoader");
    if (loaderElement) {
        loaderElement.style.display = "flex";
    }

    // Tentukan URL berdasarkan `page`
    let url = "";
    if (page === "makan") {
        url = `/children/${id}/edit-status/makan-cemilan`;
    } else if (page === "kesehatan") {
        url = `/children/${id}/edit-status/kesehatan`;
    } else if (page === "kegiatan") {
        url = `/children/${id}/edit-status/kegiatan`;
    } else if (page === "keterangan") {
        url = `/children/${id}/edit-status/keterangan`;
    } else if (page === "tidur") {
        url = `/children/${id}/edit-status/tidur`;
    } else {
        console.error("Invalid page type.");
        return;
    }

    // Setel sumber iframe jika ada   
    const iframe = document.getElementById("childInfoIframe");
    if (iframe) {
        iframe.src = url;
        
        // Sembunyikan loading indicator ketika iframe selesai dimuat
        iframe.onload = function() {
            if (loaderElement) {
                loaderElement.style.display = "none";
            }
        };
    }

    // Tampilkan modal
    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

     
    </script>

    @endsection