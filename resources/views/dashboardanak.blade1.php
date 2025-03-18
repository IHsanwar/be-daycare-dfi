<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Modal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
        <template x-data="{ open: null }">
            <div class="bg-white shadow rounded-lg p-4 flex flex-col items-center">
                <span class="text-xl font-semibold">Menu Makan</span>
                <button @click="open = 'menuMakan'" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Buka</button>
            </div>
            <div class="bg-white shadow rounded-lg p-4 flex flex-col items-center">
                <span class="text-xl font-semibold">Buang Air</span>
                <button @click="open = 'buangAir'" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Buka</button>
            </div>
            
            <!-- Modal Menu Makan -->
            <div x-show="open === 'menuMakan'" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center" x-cloak>
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                    <h2 class="text-lg font-semibold">Menu Makan & Camilan</h2>
                    <p class="mt-2">Masukkan data terkait menu makan</p>
                    <button @click="open = null" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">Tutup</button>
                </div>
            </div>
            
            <!-- Modal Buang Air -->
            <div x-show="open === 'buangAir'" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center" x-cloak>
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                    <h2 class="text-lg font-semibold">Buang Air</h2>
                    <p class="mt-2">Masukkan data terkait buang air</p>
                    <button @click="open = null" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">Tutup</button>
                </div>
            </div>
        </template>
    </div>
</body>
</html>
