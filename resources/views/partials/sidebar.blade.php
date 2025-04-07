<!-- Sidebar -->

<style>
        /* Styling untuk toggle switch */
        .toggle-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            width: 50px;
            height: 25px;
            background-color: #888;
            border-radius: 50px;
            position: relative;
            transition: background 0.3s;
        }
        
        .toggle-circle {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 21px;
            height: 21px;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.3s;
        }

        /* Mode gelap */
        .dark .toggle-container {
            background-color: #4f46e5;
        }

        .dark .toggle-circle {
            transform: translateX(25px);
        }

        .dark body {
            background-color: #1a202c;
            color: white;
        }
    </style>



<div id="sidebar" class="w-full md:w-64 bg-white h-screen fixed md:sticky top-0 z-20 -translate-x-full md:translate-x-0 shadow-lg no-scrollbar flex flex-col dark:bg-gray-900">
    
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
    <div class="sidebar-content px-4 py-2 flex-grow overflow-y-auto space-y-1 ">
        
    <a href="{{ route('dashboard') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboard' ? 'bg-purple-100 text-purple-800' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-house mr-3 text-purple-600 dark:text-indigo-600"></i>
            Dashboard Utama
        </a>

        <!-- Judul Menu -->
        <div class="text-gray-400 uppercase text-xs font-bold mt-3 mb-2 px-2 dark:text-slate-400 ">Menu</div>
        
        <!-- Dashboard User -->
         <!-- Dashboard Anak -->
        <a href="{{ route('dashboardanak') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboardanak' ? 'bg-purple-100 text-purple-800 dark:bg-transparent dark:outline' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-child mr-3 text-purple-600"></i>
            Dashboard Anak
        </a>
        <a href="{{ route('dashboardadmin') }}" class="w-full p-2.5 text-left font-medium {{ Request::route()->getName() == 'dashboardadmin' ? 'bg-purple-100 text-purple-800 dark:bg-transparent dark:outline' : 'text-gray-600 hover:bg-purple-50' }} rounded-lg flex items-center transition-all">
            <i class="fas fa-chart-pie mr-3 text-purple-500"></i>
            Dashboard User (Khusus Admin)
        </a>
    </div>

    
    <div class="p-4 flex gap-2 items-center hidden">
        <label class="toggle-container ml-4 justify-center " id="dark-toggle"> 
          <div class="toggle-circle"></div>
        </label>
      Mode Gelap
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

<script>
    
// Toggle for dark mode
const toggle = document.getElementById('dark-toggle');
toggle.addEventListener('click', () => {
  document.documentElement.classList.toggle('dark');
  
  // Save preference to localStorage
  if (document.documentElement.classList.contains('dark')) {
    localStorage.setItem('darkMode', 'dark');
  } else {
    localStorage.setItem('darkMode', 'light');
  }
});
</script>