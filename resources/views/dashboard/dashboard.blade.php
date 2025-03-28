@extends('layouts.app')
@section('title', 'Dashboard Utama')
@section('content')

<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="bg-white rounded-xl shadow-soft p-6">
            <div class="flex items-center justify-between">
                <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Selamat Datang,<span class="font-bold"> {{ Auth::user()->name }} </span> anda login sebagai {{ Auth::user()->role }}</h2>
                <p class="text-gray-500 text-sm">Kelola data anak-anak di daycare Anda di sini.</p>
                </div>
                <div class="hidden sm:block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-purple-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>            
                </div>
            </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @session('success')
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4" role="alert">
                <p class="text-green-700">{{ $value }}</p>
            </div>
        @endsession

        <div class="grid md:grid-cols-12 gap-6">
            <div class="md:col-span-8 space-y-6">
                <div class="bg-white rounded-xl shadow-soft p-6">
                    <div class="flex items-center space-x-6">
                        <div class="flex-grow">
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">Hi, {{ auth()->user()->name }} anda login sebagai {{ auth()->user()->role }}</h1>
                            <p class="text-gray-500">Pantau keseharian anak anda disini.</p>
                        </div>
                        <div>
                            <img src="{{ asset('images/daycare.png') }}" alt="Upinipin" class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-soft p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-child text-blue-500 mr-3"></i>
                        <h2 class="text-xl font-semibold text-gray-800">Children Information</h2>
                    </div>

                    @if($selectedChild)
                        <div class="space-y-4">
                            <div class="grid md:grid-cols-3 gap-4">
                                <!-- Information Cards - Example for Makan -->
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                                    <h3 class="font-medium text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-utensils mr-2 text-blue-500"></i>Makan
                                    </h3>
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-600">
                                            <i class="fas fa-sun text-yellow-500 mr-2"></i>
                                            Pagi: {{ $selectedChild->makan_pagi ?? 'Belum' }}
                                        </p>
                                        <!-- Similar styling for other meal times -->
                                    </div>
                                </div>
                                <!-- More information cards with similar styling -->
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 text-center">Tidak ada anak yang dipilih.</p>
                    @endif
                </div>

                <!-- History Section -->
                <div class="bg-white rounded-xl shadow-soft p-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-history text-blue-500 mr-3"></i>
                        <h2 class="text-xl font-semibold text-gray-800">Riwayat Anak (5 Terakhir)</h2>
                    </div>
                    <!-- Similar structure to previous history section, but with Tailwind styling -->
                </div>
            </div>

            <div class="md:col-span-4">
                <div class="bg-white rounded-xl shadow-soft p-6 sticky top-8">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-child text-blue-500 mr-3"></i>
                        <h2 class="text-xl font-semibold text-gray-800">Anak Anda</h2>
                    </div>
                    @if($children->count() > 0)
                        <div class="space-y-2">
                            @foreach($children as $child)
                                <a href="{{ route('dashboard', ['child_id' => $child->id]) }}" 
                                   class="block px-4 py-3 rounded-lg transition-colors duration-300 
                                   {{ $selectedChild && $selectedChild->id == $child->id 
                                      ? 'bg-blue-50 text-blue-700' 
                                      : 'hover:bg-gray-100 text-gray-700' }}">
                                    <i class="fas fa-user mr-2"></i>{{ $child->nama }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center">No children in the list.</p>
                    @endif
                </div>
            </div>
        </div>
    </main>

   

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