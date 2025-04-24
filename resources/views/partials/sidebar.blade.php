<div id="sidebar" class="w-64 bg-white h-screen fixed md:sticky top-0 z-20 transition-all duration-300 shadow-lg no-scrollbar flex flex-col hidden md:flex">
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

    <!-- Sidebar Content (visible on desktop) -->
    <div class="sidebar-content px-4 py-2 flex-grow overflow-y-auto space-y-1">
        <!-- Sidebar links remain the same as in your original code -->
        <a href="{{ route('dashboard') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboard' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-house mr-3 text-purple-600"></i>
            Dashboard Utama
        </a>

        @if (Auth::user() && Auth::user()->role === 'admin')
        <div class="text-gray-400 uppercase text-xs font-bold mt-3 mb-2 px-2">Menu (Khusus Admin)</div>
        
        <a href="{{ route('dashboardanak') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboardanak' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-child mr-3 text-purple-600"></i>
            Dashboard Anak
        </a>
        <a href="{{ route('dashboardadmin') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboardadmin' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-chart-pie mr-3 text-purple-500"></i>
            Dashboard User
        </a>
        @endif
        
        <a href="{{ route('user.settings') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'password.change' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-gear mr-3 text-purple-500"></i>
            Pengaturan
        </a>
    </div>
      
    <!-- Tombol Logout -->
    <div class="p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full p-2.5 text-red-400 border border-red-400 rounded-lg flex items-center justify-center transition-all duration-300 ease-in-out hover:bg-gradient-to-r from-red-500 to-red-700 hover:text-white hover:shadow-lg">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>

<!-- Mobile Navbar (new addition) -->
<div class="md:hidden fixed top-0 left-0 right-0 bg-white shadow-md z-10">
    <div class="flex items-center justify-between p-3">
        <!-- Toggle Button (left side) -->
        <button id="menuToggle" class="text-purple-600 p-2 rounded-full hover:bg-purple-50 transition-all duration-300">
    <i id="menuIcon" class="fas fa-bars transition-all duration-300"></i>
</button>

        
        <!-- Logo/Title (center) -->
        <div class="flex items-center justify-center">
            <div class="h-8 w-8 rounded-full bg-gradient-to-r from-purple-500 to-purple-700 flex items-center justify-center text-white mr-2">
                <i class="fas fa-child text-sm"></i>
            </div>
            <h2 class="text-lg font-bold bg-gradient-to-r from-purple-600 to-purple-800 text-transparent bg-clip-text">
                @if (Request::route()->getName() == 'dashboardadmin')
                    Dashboard User
                @else
                    Dashboard Anak
                @endif
            </h2>
        </div>
        
        <!-- Placeholder for right side (to keep title centered) -->
        <div class="w-8"></div>
    </div>
</div>

<!-- Mobile Menu (dropdown from top) -->
<div id="mobileMenu" class="fixed md:hidden top-14 left-0 right-0 bg-white shadow-lg z-20 max-h-0 overflow-hidden transition-all duration-300">
    <div class="p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboard' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-house mr-3 text-purple-600"></i>
            Dashboard Utama
        </a>
        
        @if (Auth::user() && Auth::user()->role === 'admin')
        <div class="text-gray-400 uppercase text-xs font-bold mt-3 mb-2 px-2">Menu (Khusus Admin)</div>
        
        <a href="{{ route('dashboardanak') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboardanak' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-child mr-3 text-purple-600"></i>
            Dashboard Anak
        </a>
        <a href="{{ route('dashboardadmin') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboardadmin' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-chart-pie mr-3 text-purple-500"></i>
            Dashboard User
        </a>
        @endif
        
        <a href="{{ route('user.settings') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'password.change' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-gear mr-3 text-purple-500"></i>
            Pengaturan
        </a>
        
        <!-- Logout Button in Mobile Menu -->
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="w-full p-2.5 text-red-400 border border-red-400 rounded-lg flex items-center justify-center transition-all duration-300 ease-in-out hover:bg-gradient-to-r from-red-500 to-red-700 hover:text-white hover:shadow-lg">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>
<div id="mobileOverlay" class="fixed inset-0 bg-black opacity-50 z-15 hidden md:hidden"></div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const mobileMenu = document.getElementById("mobileMenu");
    const mobileOverlay = document.getElementById("mobileOverlay");
    const toggleBtn = document.getElementById("menuToggle");
    const menuIcon = document.getElementById("menuIcon");

    function toggleMobileMenu() {
        if (mobileMenu && mobileOverlay) {
            if (mobileMenu.classList.contains("max-h-0")) {
                // Open menu
                mobileMenu.classList.remove("max-h-0");
                mobileMenu.classList.add("max-h-screen");
                mobileOverlay.classList.remove("hidden");
            } else {
                // Close menu
                mobileMenu.classList.add("max-h-0");
                mobileMenu.classList.remove("max-h-screen");
                mobileOverlay.classList.add("hidden");
            }
        }

        // Toggle icon if exists
        if (menuIcon) {
            isOpen = !isOpen;
            menuIcon.classList.toggle("fa-bars", !isOpen);
            menuIcon.classList.toggle("fa-times", isOpen);
            menuIcon.classList.add("scale-90");
            setTimeout(() => menuIcon.classList.remove("scale-90"), 150);
        }
    }

    let isOpen = false;

    // Toggle button
    if (toggleBtn) {
        toggleBtn.addEventListener("click", toggleMobileMenu);
    }

    // Overlay click to close
    if (mobileOverlay) {
        mobileOverlay.addEventListener("click", toggleMobileMenu);
    }

    // Resize handler
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 768) {
            if (mobileMenu) {
                mobileMenu.classList.add("max-h-0");
                mobileMenu.classList.remove("max-h-screen");
            }
            if (mobileOverlay) {
                mobileOverlay.classList.add("hidden");
            }
        }
    });
});
    window.addEventListener('load', function () {
        document.getElementById('loader').style.display = 'none';
    });


</script>

