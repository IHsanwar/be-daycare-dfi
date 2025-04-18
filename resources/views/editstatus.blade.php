@extends('layouts.app')

@section('title', 'Update Status')

@section('content')
    <div class="flex flex-col md:flex-row min-h-screen relative">             
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
                <div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-md animate-fade-in-up delay-300">
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
                 <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4 animate-fade-in-up delay-300">
                <!-- Dashboard link that opens the meal update modal -->
                <a onclick="openIframeModal('{{ $child->id }}', 'Makan, Minum & Camilan - {{ $child->nama }}','makan')" class="group menu-item block bg-gradient-to-br from-purple-500 to-purple-700 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:bg-gradient-to-r hover:from-purple-600 hover:to-purple-800 hover:-translate-y-2 hover:scale-105 hover:shadow-xl">
                    <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-utensils text-lg"></i>
                    </div>
                    <div class="font-medium text-sm group-hover:animate-pulse">Makan, Minum & Camilan</div>
                </a>

                    <a onclick="openIframeModal('{{ $child->id }}', 'Informasi Buang Air  - {{ $child->nama }}','buangair')" class="group menu-item block bg-gradient-to-br from-blue-400 to-blue-600 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-blue-500 hover:to-blue-700 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
                        <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-toilet text-lg"></i>
                        </div>
                        <div class="font-medium text-sm group-hover:animate-pulse">Buang Air Kecil & Buang Air Besar</div>
                    </a>

                        <a onclick="openIframeModal('{{ $child->id }}', 'Informasi Kegiatan Indoor & Outdoor - {{ $child->nama }}','kegiatan')" class="group menu-item block bg-gradient-to-br from-purple-500 to-purple-700 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-purple-600 hover:to-purple-800 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
                        <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-home text-lg"></i>
                        </div>
                        <div class="font-medium text-sm group-hover:animate-pulse">Kegiatan Indoor & Outdoor</div>
                    </a>

                    <a onclick="openIframeModal('{{ $child->id }}', 'Informasi Kesehatan  - {{ $child->nama }}','kesehatan')" class="group menu-item block bg-gradient-to-br from-blue-400 to-blue-600 text-white p-4 rounded-xl shadow-md flex items-center gap-3 cursor-pointer transition-all duration-300 ease-out hover:from-blue-500 hover:to-blue-700 hover:shadow-xl hover:scale-105 hover:-translate-y-2">
                        <div class="h-10 w-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bed text-lg"></i>
                        </div>
                        <div class="font-medium text-sm group-hover:animate-pulse">Kesehatan</div>
                    </a>

                <!-- Recent Activity Section - Added to fill the gap -->
                
            </div>
        </div>
    </div>
                <!-- Modal for iframe content -->
                <div id="infoIframeModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 p-4">
                <div class="relative w-full max-w-4xl bg-white rounded-xl shadow-2xl overflow-hidden">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-4 bg-purple-100 border-b border-gray-300">
                        <h3 id="childNameIframe" class="text-xl font-bold text-purple-700">Menu</h3>
                        <button onclick="closeIframeModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <!-- Modal Loading Indicator -->
                    <div id="iframeLoader" class="flex items-center justify-center p-12">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-purple-700"></div>
                    </div>
                    
                    <!-- Modal Iframe Content -->
                    <div class="h-[80vh]">
                        <iframe id="childInfoIframe" class="w-full h-full" frameborder="0"></iframe>
                    </div>
                </div>
            </div>

    </div>
<!-- Close modal function -->

    
    <script>
    
function openIframeModal(id, nama, page) {
    const modal = document.getElementById("infoIframeModal");
    const childNameElement = document.getElementById("childNameIframe");
    const loaderElement = document.getElementById("iframeLoader");
    const iframeElement = document.getElementById("childInfoIframe");

    if (!modal || !childNameElement || !loaderElement || !iframeElement) {
        console.error("Missing modal elements.");
        return;
    }

    // Set modal title
    childNameElement.textContent = nama;

    // Show modal and loading animation
    modal.classList.remove("hidden");
    loaderElement.classList.remove("hidden");

    // URL mapping
    let urlMap = {
        "makan": `/children/${id}/edit-status/makan-cemilan`,
        "buangair": `/children/${id}/edit-status/buang-air`,
        "kegiatan": `/children/${id}/edit-status/kegiatan`,
        "kesehatan": `/children/${id}/edit-status/kesehatan`,
    };

    if (!urlMap[page]) {
        console.error("Invalid page type.");
        return;
    }

    // Set iframe src and handle load event
    iframeElement.src = urlMap[page];
    iframeElement.onload = function() {
        loaderElement.classList.add("hidden"); // Hide loading indicator after iframe loads
    };
}

function closeIframeModal() {
    const modal = document.getElementById("infoIframeModal");
    const iframeElement = document.getElementById("childInfoIframe");
    const loaderElement = document.getElementById("iframeLoader");

    if (!modal || !iframeElement || !loaderElement) {
        console.error("Missing modal elements.");
        return;
    }

    // Hide modal
    modal.classList.add("hidden");

    // Clear iframe src to prevent old content flickering
    iframeElement.src = "";
}

     
    </script>

    @endsection