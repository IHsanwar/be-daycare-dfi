@extends('layouts.app')
@section('title', 'Dashboard Utama')
@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Top Navigation Bar -->
    <div class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-blue-600">DayCare</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        <i class="fas fa-user-circle mr-2"></i>{{ Auth::user()->name }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @session('success')
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4 rounded-r-md" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ $value }}</p>
                    </div>
                </div>
            </div>
        @endsession

        <!-- Welcome Card -->
        <div class="bg-white rounded-xl shadow-sm mb-6 overflow-hidden">
            <div class="md:flex">
                <div class="p-6 md:flex-1">
                    <div class="flex items-center mb-2">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                            <i class="fas fa-hand-sparkles"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang</h2>
                    </div>
                    <p class="text-gray-600 mb-4">
                        <span class="font-medium">{{ Auth::user()->name }}</span>, anda login sebagai 
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ Auth::user()->role }}
                        </span>
                    </p>
                    <p class="text-sm text-gray-500">Kelola dan pantau perkembangan anak-anak di daycare Anda dengan mudah melalui dashboard ini.</p>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-12 gap-6">
            <!-- Main Content Area -->
            <div class="md:col-span-8 space-y-6">
                <!-- Child Information Panel -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center mb-6">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                            <i class="fas fa-child"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Informasi Anak</h2>
                    </div>

                    @if($selectedChild)
                        <div class="space-y-6">
                            <div class="flex items-center pb-4 border-b border-gray-100">
                                <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-4">
                                    <i class="fas fa-user-circle text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $selectedChild->nama }}</h3>
                                    <p class="text-sm text-gray-500">ID: {{ $selectedChild->id }}</p>
                                </div>
                                <!-- Date -->
                             <div class="">
                                    <p class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::now()->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-3 gap-4">
                                <!-- Food Card -->
                                <div class="bg-white rounded-lg p-4 border border-gray-100 hover:shadow-md transition-shadow">
                                    <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-2">
                                            <i class="fas fa-utensils"></i>
                                        </div>
                                        Makan
                                    </h3>
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Pagi</span>
                                            <span class="text-sm {{ $selectedChild->makan_pagi ? 'text-green-600' : 'text-gray-400' }}">
                                                {{ $selectedChild->makan_pagi ?? 'Belum' }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Siang</span>
                                            <span class="text-sm {{ $selectedChild->makan_siang ? 'text-green-600' : 'text-gray-400' }}">
                                                {{ $selectedChild->makan_siang ?? 'Belum' }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Sore</span>
                                            <span class="text-sm {{ $selectedChild->makan_sore ? 'text-green-600' : 'text-gray-400' }}">
                                                {{ $selectedChild->makan_sore ?? 'Belum' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Sleep Card -->
                                <div class="bg-white rounded-lg p-4 border border-gray-100 hover:shadow-md transition-shadow">
                                    <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-2">
                                            <i class="fas fa-bed"></i>
                                        </div>
                                        Tidur
                                    </h3>
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Tidur Pagi</span>
                                            <span class="text-sm {{ $selectedChild->tidur_mulai ? 'text-blue-600' : 'text-gray-400' }}">
                                                {{ $selectedChild->tidur_pagi. ' kali'  ?? 'Belum' }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Tidur Siang</span>
                                            <span class="text-sm {{ $selectedChild->tidur_selesai ? 'text-blue-600' : 'text-gray-400' }}">
                                                {{ $selectedChild->tidur_siang.' kali' ?? 'Belum' }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Tidur Sore</span>
                                            <span class="text-sm {{ $selectedChild->tidur_selesai ? 'text-blue-600' : 'text-gray-400' }}">
                                            {{ $selectedChild->tidur_sore.' kali' ?? 'Belum' }}
                                            </span>
                                            
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Total tidur hari ini</span>
                                            <span class="text-sm {{ $selectedChild->tidur_malam ? 'text-blue-600' : 'text-gray-400' }}">
                                            {{ ($selectedChild->tidur_sore ?? 0) + ($selectedChild->tidur_siang ?? 0) + ($selectedChild->tidur_pagi ?? 0) }} kali
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Activities Card -->
                                @php
    $todayHistory = $selectedChild->histories()->whereDate('tanggal', today())->first();
@endphp

                                <div class="bg-white rounded-lg p-4 border border-gray-100 hover:shadow-md transition-shadow">
                                    <h3 class="font-medium text-gray-800 mb-3 flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mr-2">
                                            <i class="fas fa-running"></i>
                                        </div>
                                        Aktivitas Hari Ini
                                    </h3>

                                    @if ($todayHistory)
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-gray-600">Kegiatan Outdoor</span>
                                                <span class="text-sm {{ $todayHistory->kegiatan_outdoor ? 'text-purple-600' : 'text-gray-400' }}">
                                                    {{ $todayHistory->kegiatan_outdoor ? implode(', ', json_decode($todayHistory->kegiatan_outdoor, true)) : 'Belum' }}
                                                </span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm text-gray-600">Kegiatan Indoor</span>
                                                <span class="text-sm {{ $todayHistory->kegiatan_indoor ? 'text-purple-600' : 'text-gray-400' }}">
                                                    {{ $todayHistory->kegiatan_indoor ? implode(', ', json_decode($todayHistory->kegiatan_indoor, true)) : 'Belum' }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-sm text-gray-500">Belum ada data aktivitas hari ini.</div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-12 bg-gray-50 rounded-lg">
                            <div class="h-16 w-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 mb-3">
                                <i class="fas fa-child text-2xl"></i>
                            </div>
                            <p class="text-gray-500">Tidak ada anak yang dipilih.</p>
                            <p class="text-sm text-gray-400">Pilih anak dari panel di samping untuk melihat informasi.</p>
                        </div>
                    @endif
                </div>

                <!-- History Section -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                                <i class="fas fa-history"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Riwayat Anak</h2>
                        </div>
                        <span class="text-xs font-medium text-gray-500">5 Terakhir</span>
                    </div>
                    
                    @if($selectedChild && isset($history) && count($history) > 0)
                        <div class="space-y-4">
                            @foreach($history as $item)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-2">
                                            <i class="fas fa-calendar-day"></i>
                                        </div>
                                        <h4 class="text-md font-medium text-gray-800">{{ $item->tanggal }}</h4>
                                    </div>
                                    <div class="ml-10">
                                        <div class="grid grid-cols-2 gap-2 mt-2">
                                            <div>
                                                <p class="text-xs text-gray-500">Makan:</p>
                                                <p class="text-sm text-gray-700">
                                                    {{ $item->makan_pagi ? 'Pagi ✓' : '' }}
                                                    {{ $item->makan_siang ? 'Siang ✓' : '' }}
                                                    {{ $item->makan_sore ? 'Sore ✓' : '' }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500">Tidur:</p>
                                                <p class="text-sm text-gray-700">
                                                    {{ $item->tidur_pagi }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-8 bg-gray-50 rounded-lg">
                            <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 mb-3">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <p class="text-gray-500">Tidak ada riwayat tersedia.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="md:col-span-4">
                <div class="bg-white rounded-xl shadow-sm p-6 sticky top-8">
                    <div class="flex items-center mb-6">
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Anak Anda</h2>
                    </div>
                    
                    @if($children->count() > 0)
                        <div class="space-y-2">
                            @foreach($children as $child)
                                <a href="{{ route('dashboard', ['child_id' => $child->id]) }}" 
                                   class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 
                                   {{ $selectedChild && $selectedChild->id == $child->id 
                                      ? 'bg-blue-100 text-blue-700' 
                                      : 'hover:bg-gray-100 text-gray-700' }}">
                                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 mr-3
                                        {{ $selectedChild && $selectedChild->id == $child->id ? 'bg-blue-200 text-blue-600' : '' }}">
                                        {{ substr($child->nama, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-medium">{{ $child->nama }}</p>
                                        <p class="text-xs text-gray-500">ID: {{ $child->id }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-8 bg-gray-50 rounded-lg">
                            <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 mb-3">
                                <i class="fas fa-user-slash"></i>
                            </div>
                            <p class="text-gray-500">No children in the list.</p>
                        </div>
                    @endif
                    
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h3 class="text-sm font-medium text-gray-500 mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-2 gap-2"><!--
                            <a href="#" class="flex items-center justify-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors duration-200">
                                <i class="fas fa-plus-circle text-blue-500 mr-2"></i>
                                <span class="text-sm text-gray-700">Add Child</span>
                            </a> -->

                            @if (!empty($selectedChild) && !empty($selectedChild->id))
                                <a href="{{ route('children.history', ['id' => $selectedChild->id, 'type' => 'null']) }}"
                                class="flex items-center justify-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                                    <span class="text-sm text-gray-700">Reports</span>
                                </a>
                            @else
                                <div class="italic text-sm text-gray-500 p-3">
                                    Tidak ada ID yang dipilih
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-white py-4 mt-6 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">© 2025 DayCare Portal. All rights reserved.</p>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleHistory(id) {
    const historyElement = document.getElementById(`history-${id}`);
    const toggleIcon = document.getElementById(`toggle-icon-${id}`);
    
    if (historyElement.classList.contains('show')) {
        historyElement.classList.remove('show');
        toggleIcon.classList.remove('fa-chevron-up');
        toggleIcon.classList.add('fa-chevron-down');
    } else {
        historyElement.classList.add('show');
        toggleIcon.classList.remove('fa-chevron-down');
        toggleIcon.classList.add('fa-chevron-up');
    }
}
</script>
@endsection