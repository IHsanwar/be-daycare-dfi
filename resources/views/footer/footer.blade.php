

@yield('footer')
@php
    $currentRoute = request()->route()->getName();
@endphp
<footer class="mt-auto bg-white py-4 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                © 2025 DayCare Portal. All rights reserved.
            </p>
        </div>
    </footer>