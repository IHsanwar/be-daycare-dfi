<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://kit.fontawesome.com/e16c014aae.js" crossorigin="anonymous"></script>
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
        <img src="{{ asset('images/undraw_completed.svg') }}" alt="" style="height: 400px;" class="mx-auto">
        <p class="text-2xl font-semibold text-purple-600 mt-4">Update profil sukses!</p>
        <p class="text-gray-500 mt-2">data berhasil diupdate</p>

        <!-- Tombol Kembali -->
        <div class="mt-6 flex justify-center space-x-4">
            <a href="{{ route('user.settings') }}">
            <button class="flex items-center gap-2 px-5 py-2 bg-purple-600 text-white rounded-lg hover:bg-transparent border border-purple-600 hover:text-purple-600 transition duration-300 shadow">
            <i class="fa-solid fa-house"></i>
            Kembali
        </button>
            </a>
        </div>
    </div>
</body>
</html>
