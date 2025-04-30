
@extends('layouts.base')
</div>

<body class="font-inter bg-gray-50 text-gray-800 overflow-x-hidden transition-colors duration-300">
    <div class="flex flex-col md:flex-row min-h-screen relative">
        <!-- Mobile Menu Button -->
        @include('partials.sidebar')
        
        <div class="flex-1 p-4 md:p-5 pt-16 md:pt-5">
            @yield('content')
        </div>       
    </div>

    <script>

</script>
</body>
</html>
