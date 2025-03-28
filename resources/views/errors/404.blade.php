<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --purple-50: #f5f3ff;
            --purple-100: #ede9fe;
            --purple-200: #ddd6fe;
            --purple-300: #c4b5fd;
            --purple-400: #a78bfa;
            --purple-500: #8b5cf6;
            --purple-600: #7c3aed;
            --purple-700: #6d28d9;
            --purple-800: #5b21b6;
            --purple-900: #4c1d95;
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen bg-purple-50">
    <div class="text-center">
    <img src="{{ asset('images/page404.svg') }}" alt="" style="height: 400px;">
        <p class="text-2xl font-semibold text-purple-600 mt-4">Oops! Page not found.</p>
        <p class="text-gray-500 mt-2 mb-7">The page you are looking for doesn’t exist or has been moved.</p>
        <a href="{{ route('dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-4 py-4 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Go back to home
                </a>
    </div>
</body>
</html>
