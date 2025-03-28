<!-- Sidebar -->
<div id="sidebar" class="w-full md:w-64 bg-white h-screen fixed md:sticky top-0 z-20 -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out shadow-lg no-scrollbar flex flex-col">
    
    <!-- Header Sidebar -->
    <div class="p-4 flex items-center">
        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-purple-500 to-purple-700 flex items-center justify-center text-white mr-3">
            <i class="fas fa-child"></i>
        </div>
        <h2 class="text-xl font-bold bg-gradient-to-r from-purple-600 to-purple-800 text-transparent bg-clip-text">
            @if (Request::route()->getName() == 'dashboardadmin')
                Dashboard User
            @else
                Dashboard Anak
            @endif
        </h2>
    </div>

    <!-- Konten Menu Sidebar -->
    <div class="sidebar-content px-4 py-2 flex-grow overflow-y-auto space-y-1">
        
    <a href="{{ route('dashboard') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboard' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-house mr-3 text-purple-600"></i>
            Dashboard Utama
        </a>

        <!-- Judul Menu -->
        <div class="text-gray-400 uppercase text-xs font-bold mt-3 mb-2 px-2">Menu</div>
        
        <!-- Dashboard User -->
         <!-- Dashboard Anak -->
        <a href="{{ route('dashboardanak') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboardanak' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-child mr-3 text-purple-600"></i>
            Dashboard Anak
        </a>
        <a href="{{ route('dashboardadmin') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboardadmin' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-chart-pie mr-3 text-purple-500"></i>
            Dashboard User (Khusus Admin)
        </a>
    </div>

    <!-- Tombol Logout -->
    <div class="p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full p-2.5 text-white bg-gradient-to-r from-red-500 to-red-700 rounded-lg flex items-center justify-center transition-all hover:shadow-lg">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>
