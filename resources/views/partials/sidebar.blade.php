<div id="sidebar" class="w-64 bg-purple-600 h-screen fixed md:sticky top-0 z-20 transition-all duration-300 shadow-lg no-scrollbar flex flex-col hidden md:flex">
    <!-- Header Sidebar -->
    <div class="p-4 flex items-center">
        <div class="h-10 w-10 rounded-full bg-purple-800 flex items-center justify-center text-white mr-3">
            <i class="fas fa-child"></i>
        </div>
        <h2 class="text-xl font-bold text-white">
            @if (Request::route()->getName() == 'dashboardadmin')
                Dashboard User
            @else
                Dashboard Anak
            @endif
        </h2>
    </div>

    <!-- Sidebar Content -->
    <div class="sidebar-content px-4 py-2 flex-grow overflow-y-auto space-y-1">

        <!-- Dashboard Utama -->
        <a href="{{ route('dashboard') }}" class="w-full p-2.5 text-left font-medium 
        {{ Request::route()->getName() == 'dashboard' ? 'bg-white text-purple-800' : 'text-white hover:bg-purple-700' }} 
        rounded-lg flex items-center transition-all">
            <i class="fas fa-house mr-3 {{ Request::route()->getName() == 'dashboard' ? 'text-purple-800' : 'text-white' }}"></i>
            Dashboard Utama
        </a>

        @if (Auth::user() && Auth::user()->role === 'admin')
            <!-- Section Title -->
            <div class="text-purple-200 uppercase text-xs font-bold mt-3 mb-2 px-2">Menu (Khusus Admin)</div>

            <!-- Dashboard Anak -->
            <a href="{{ route('dashboardanak') }}" class="w-full p-2.5 text-left font-medium 
            {{ Request::route()->getName() == 'dashboardanak' ? 'bg-white text-purple-800' : 'text-white hover:bg-purple-700' }} 
            rounded-lg flex items-center transition-all">
                <i class="fas fa-child mr-3 {{ Request::route()->getName() == 'dashboardanak' ? 'text-purple-800' : 'text-white' }}"></i>
                Dashboard Anak
            </a>

            <!-- Dashboard User -->
            <a href="{{ route('dashboardadmin') }}" class="w-full p-2.5 text-left font-medium 
            {{ Request::route()->getName() == 'dashboardadmin' ? 'bg-white text-purple-800' : 'text-white hover:bg-purple-700' }} 
            rounded-lg flex items-center transition-all">
                <i class="fas fa-chart-pie mr-3 {{ Request::route()->getName() == 'dashboardadmin' ? 'text-purple-800' : 'text-white' }}"></i>
                Dashboard User
            </a>
        @endif

        <!-- Pengaturan -->
        <a href="{{ route('user.settings') }}" class="w-full p-2.5 text-left font-medium 
        {{ Request::route()->getName() == 'password.change' ? 'bg-white text-purple-800' : 'text-white hover:bg-purple-700' }} 
        rounded-lg flex items-center transition-all">
            <i class="fas fa-gear mr-3 {{ Request::route()->getName() == 'password.change' ? 'text-purple-800' : 'text-white' }}"></i>
            Pengaturan
        </a>
    </div>

    <!-- Logout button di bawah -->
    <div class="px-4 py-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full border border-purple-300 text-purple-200 hover:bg-purple-700 hover:text-white transition-all font-semibold py-2 rounded-lg flex items-center justify-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </form>
    </div>
</div>


<!-- Mobile Navbar -->
<div class="md:hidden fixed top-0 left-0 right-0 bg-purple-600 shadow-md z-30">
    <div class="flex items-center justify-between p-3">
        <!-- Toggle Button -->
        <button id="menuToggle" class="text-white p-2 rounded-full hover:bg-purple-700 transition-all duration-300">
            <i id="menuIcon" class="fas fa-bars transition-all duration-300"></i>
        </button>

        <!-- Logo/Title -->
        <div class="flex items-center justify-center">
            <div class="h-8 w-8 rounded-full bg-purple-800 flex items-center justify-center text-white mr-2">
                <i class="fas fa-child text-sm"></i>
            </div>
            <h2 class="text-lg font-bold text-white">
                @if (Request::route()->getName() == 'dashboardadmin')
                    Dashboard User
                @else
                    Dashboard Anak
                @endif
            </h2>
        </div>

        <div class="w-8"></div> <!-- Spacer -->
    </div>
</div>

<!-- Mobile Menu (Dropdown) -->
<div id="mobileMenu" class="fixed md:hidden top-14 left-0 right-0 bg-purple-600 shadow-lg z-20 max-h-0 overflow-hidden transition-all duration-300 text-white">
    <div class="p-4 space-y-2">
        <!-- Menu Links -->
        <a href="{{ route('dashboard') }}" class="w-full p-2.5 text-left font-medium 
            {{ Request::route()->getName() == 'dashboard' ? 'bg-white text-purple-800' : 'hover:bg-purple-700' }} 
            rounded-lg flex items-center transition-all">
            <i class="fas fa-house mr-3 {{ Request::route()->getName() == 'dashboard' ? 'text-purple-800' : 'text-white' }}"></i>
            Dashboard Utama
        </a>

        @if (Auth::user() && Auth::user()->role === 'admin')
        <div class="text-purple-200 uppercase text-xs font-bold mt-3 mb-2 px-2">Menu (Khusus Admin)</div>

        <a href="{{ route('dashboardanak') }}" class="w-full p-2.5 text-left font-medium 
            {{ Request::route()->getName() == 'dashboardanak' ? 'bg-white text-purple-800' : 'hover:bg-purple-700' }} 
            rounded-lg flex items-center transition-all">
            <i class="fas fa-child mr-3 {{ Request::route()->getName() == 'dashboardanak' ? 'text-purple-800' : 'text-white' }}"></i>
            Dashboard Anak
        </a>

        <a href="{{ route('dashboardadmin') }}" class="w-full p-2.5 text-left font-medium 
            {{ Request::route()->getName() == 'dashboardadmin' ? 'bg-white text-purple-800' : 'hover:bg-purple-700' }} 
            rounded-lg flex items-center transition-all">
            <i class="fas fa-chart-pie mr-3 {{ Request::route()->getName() == 'dashboardadmin' ? 'text-purple-800' : 'text-white' }}"></i>
            Dashboard User
        </a>
        @endif

        <a href="{{ route('user.settings') }}" class="w-full p-2.5 text-left font-medium 
            {{ Request::route()->getName() == 'password.change' ? 'bg-white text-purple-800' : 'hover:bg-purple-700' }} 
            rounded-lg flex items-center transition-all">
            <i class="fas fa-gear mr-3 {{ Request::route()->getName() == 'password.change' ? 'text-purple-800' : 'text-white' }}"></i>
            Pengaturan
        </a>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="w-full p-2.5 border border-white text-white rounded-lg flex items-center justify-center hover:bg-white hover:text-purple-700 transition-all">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>

<!-- Overlay -->
<div id="mobileOverlay" class="fixed inset-0 bg-black opacity-50 z-10 hidden md:hidden"></div>


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

