<!DOCTYPE html>
<html lang="id" class="transition-theme duration-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Anak')</title> <!-- ✅ Judul bisa berubah otomatis -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Path_Harmony.webp') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e16c014aae.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        tailwind.config = {
      darkMode: 'class', // or 'media' for system preference
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
            gray: {
              50: '#f9fafb',
              100: '#f3f4f6',
              200: '#e5e7eb',
              300: '#d1d5db',
              400: '#9ca3af',
              500: '#6b7280',
              600: '#4b5563',
              700: '#374151',
              800: '#1f2937',
              900: '#111827'
            }
            white: '#f8f8ff',
          }
        }
      }
    }
    </script>

    <style>
      .animate-fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease forwards;
        }
        
        .delay-300 {
            animation-delay: 300ms;
        }
        
        .delay-500 {
            animation-delay: 500ms;
        }
        
        .delay-700 {
            animation-delay: 700ms;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

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
        * {
      transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
      transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
      transition-duration: 300ms;
    }
    
    /* Prevent transitions on page load */
    .no-transition * {
      transition: none !important;
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
        /* Improved text contrast for dark mode */
.dark .text-primary {
  color: hsl(265, 80%, 80%); /* Brighter purple */
}

/* Better hover states for interactive elements */
.dark .interactive:hover {
  background-color: rgba(255, 255, 255, 0.1);
  transform: translateY(-1px);
}

/* Consistent button styling system */
.dark .btn-primary {
  background-color: hsl(265, 80%, 60%);
}

.dark .btn-secondary {
  background-color: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.dark .btn-danger {
  background-color: hsl(0, 70%, 50%);
}

/* Improved form elements */
.dark .input-field {
  background-color: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.dark .input-field:focus {
  border-color: hsl(265, 80%, 60%);
  box-shadow: 0 0 0 2px rgba(123, 97, 255, 0.2);
}
        html {
  transition: background-color 0.3s ease, color 0.3s ease;
}
    </style>
    @yield('styles')
</head>

<body class="font-inter bg-gray-50 text-gray-800 overflow-x-hidden transition-colors duration-300">
    <div class="flex flex-col md:flex-row min-h-screen relative">
        <!-- Mobile Menu Button -->
        <div class="md:hidden absolute top-4 right-4 z-30">
            <button id="menuToggle" class="bg-white text-purple-600 p-2 rounded-full shadow-lg hover:shadow-xl transition-all duration-300">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <!-- Sidebar Overlay -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden md:hidden" onclick="closeSidebar()"></div>

        @include('partials.sidebar')

        <div class="flex-1 p-4 md:p-5 pt-16 md:pt-5">
            @yield('content')
        </div>       
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("sidebarOverlay");
        const toggleBtn = document.getElementById("menuToggle");

        function openSidebar() {
            sidebar.classList.remove("-translate-x-full");
            sidebar.classList.add("translate-x-0");
            overlay.classList.remove("hidden");
        }

        function closeSidebar() {
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("translate-x-0");
            overlay.classList.add("hidden");
        }

        // Tombol hamburger
        toggleBtn.addEventListener("click", function () {
            if (sidebar.classList.contains("-translate-x-full")) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });

        // Biar overlay bisa nutup sidebar juga
        window.closeSidebar = closeSidebar;
    });
</script>
</body>
</html>
