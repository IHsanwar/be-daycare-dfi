<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Anak</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e16c014aae.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif']
                    },
                    colors: {
                        'purple': {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(124, 58, 237, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(124, 58, 237, 0); }
            100% { box-shadow: 0 0 0 0 rgba(124, 58, 237, 0); }
        }
        
        .menu-item {
            animation: fadeIn 0.3s ease-out forwards;
            opacity: 0;
        }
        
        .menu-item:nth-child(1) { animation-delay: 0.05s; }
        .menu-item:nth-child(2) { animation-delay: 0.1s; }
        .menu-item:nth-child(3) { animation-delay: 0.15s; }
        .menu-item:nth-child(4) { animation-delay: 0.2s; }
        .menu-item:nth-child(5) { animation-delay: 0.25s; }
        .menu-item:nth-child(6) { animation-delay: 0.3s; }
        .menu-item:nth-child(7) { animation-delay: 0.35s; }
        .menu-item:nth-child(8) { animation-delay: 0.4s; }
        
        .hover-scale {
            transition: transform 0.2s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.03);
        }
        
        .pulse-effect {
            animation: pulse 2s infinite;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="font-inter bg-gray-50 text-gray-800 overflow-x-hidden">
    <div class="flex flex-col md:flex-row min-h-screen relative">
        <!-- Mobile Menu Button -->
        <div class="md:hidden fixed top-4 right-4 z-30">
            <button id="menuToggle" class="bg-white text-purple-600 p-2 rounded-full shadow-lg hover:shadow-xl transition-all duration-300">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <div id="sidebar" class="w-full md:w-64 bg-white h-screen fixed md:sticky top-0 z-20 -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out shadow-lg no-scrollbar flex flex-col">
            <div class="p-4 flex items-center">
                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-purple-500 to-purple-700 flex items-center justify-center text-white mr-3">
                    <i class="fas fa-child"></i>
                </div>
                <h2 class="text-xl font-bold bg-gradient-to-r from-purple-600 to-purple-800 text-transparent bg-clip-text">Dashboard Anak</h2>
            </div>
            
            <div class="sidebar-content px-4 py-2 flex-grow overflow-y-auto">
                <button class="w-full mb-3 p-2.5 text-left font-medium bg-purple-100 text-purple-800 rounded-lg flex items-center transition-all hover:bg-purple-200">
                    <i class="fas fa-tachometer-alt mr-3 text-purple-600"></i>
                    Dashboard Anak
                </button>
                
                <div class="text-gray-400 uppercase text-xs font-bold mt-3 mb-2 px-2">Menu</div>
                
                <div class="space-y-1">
                    <button onclick="window.location.href='/dashboard_anak.html'"
                    class="w-full p-2.5 text-left font-medium text-gray-600 rounded-lg flex items-center transition-all hover:bg-purple-50">
                    <i class="fas fa-circle-arrow-left mr-3 text-purple-500"></i>
                    Kembali
                </button>
                
                <button onclick="window.location.href='/dashboard_user.html'" 
                class="w-full p-2.5 text-left font-medium text-gray-600 rounded-lg flex items-center transition-all hover:bg-purple-50">
                <i class="fas fa-user mr-3 text-purple-500"></i>
                Dashboard User
                  </button>
            
                </div>
            </div>
            
            <div class="bottom-0 left-0 right-0 p-4">
                <button class="w-full p-2.5 text-white bg-gradient-to-r from-red-500 to-red-700 rounded-lg flex items-center justify-center transition-all hover:shadow-lg">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </button>
            </div>
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
<a onclick="openIframeModal('{{ $child->id }}', 'Menu Makan & Camilan - {{ $child->nama }}')" class="group menu-item block bg-gradient-to-br from-purple-500 to-purple-700 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:bg-gradient-to-r hover:from-purple-600 hover:to-purple-800 hover:-translate-y-2 hover:scale-105 hover:shadow-xl">
    <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
        <i class="fas fa-utensils text-lg"></i>
    </div>
    <div class="font-medium text-sm group-hover:animate-pulse">Menu Makan & Camilan</div>
</a>

                    <a href="update_anak_buangair.html" class="group menu-item block bg-gradient-to-br from-blue-400 to-blue-600 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-blue-500 hover:to-blue-700 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
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

                    <a href="update_anak_indooroutdoor.html" class="group menu-item block bg-gradient-to-br from-purple-500 to-purple-700 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-purple-600 hover:to-purple-800 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
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

                    <a href="update_anak_tidur.html" class="group menu-item block bg-gradient-to-br from-blue-400 to-blue-600 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-blue-500 hover:to-blue-700 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
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
            <h3 id="childNameIframe" class="text-xl font-bold text-purple-700">Menu Makan & Camilan</h3>
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
        // JavaScript function to open iframe modal
        function openIframeModal(id, nama) {
    const modal = document.getElementById("infoIframeModal");
    if (!modal) {
        console.error("Modal element not found.");
        return;
    }

    const childNameElement = document.getElementById("childNameIframe");
    if (childNameElement) {
        childNameElement.textContent = nama;
    }

    const loaderElement = document.getElementById("iframeLoader");
    if (loaderElement) {
        loaderElement.style.display = "flex";
    }

    const iframe = document.getElementById("childInfoIframe");
    if (iframe) {
        const url = `/children/${id}/edit-status/makan-cemilan?cache=${new Date().getTime()}`;
        console.log("Iframe URL:", url); // Debugging

        iframe.src = url;

        iframe.onload = function () {
            if (loaderElement) {
                loaderElement.style.display = "none";
            }
        };
    }

    modal.classList.remove("hidden");
    modal.classList.add("flex");
}

     
    </script>
</body>
</html>