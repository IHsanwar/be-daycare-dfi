<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu Informasi Buang Air</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        darkBg: '#111827',
                        darkCard: '#1F2937',
                        accentPurple: '#A855F7',
                        accentHover: '#9333EA',
                        accentLight: '#C084FC'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-image: linear-gradient(to bottom right, #1E293B, #111827);
            min-height: 100vh;
        }
        .glow-effect {
            box-shadow: 0 0 15px rgba(168, 85, 247, 0.3);
        }
        .card-hover:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
    </style>
    
</head>
<body class="bg-white dark:dark-bg">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6 dark:bg-black dark:rounded-xl dark:shadow-lg p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-purple-700">Update Informasi Buang Air</h1>
                
            </div>

            <!-- Form -->
            <form action="{{ url('/children/' . $child->id . '/update-status/buang-air') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_pendamping" class="block text-sm font-medium text-gray-700 mb-1">Nama Pendamping</label>
                        <input type="text" name="nama_pendamping" id="nama_pendamping" value="{{ old('nama_pendamping', $child->nama_pendamping ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="text" name="tanggal" id="tanggal" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    </div>
                </div>

                <!-- Buang Air -->
                <h3 class="text-lg font-semibold text-purple-700 mt-4">Buang Air</h3>
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="block font-medium text-purple-900">BAK Pagi:</label>
                        <input type="number" name="bak_pagi" min="0" placeholder="Jumlah"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                    <div>
                        <label class="block font-medium text-purple-900">BAK Siang:</label>
                        <input type="number" name="bak_siang" min="0" placeholder="Jumlah"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                    <div>
                        <label class="block font-medium text-purple-900">BAK Sore:</label>
                        <input type="number" name="bak_sore" min="0" placeholder="Jumlah"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="block font-medium text-purple-900">BAB Pagi:</label>
                        <input type="number" name="bab_pagi" min="0" placeholder="Jumlah"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                    <div>
                        <label class="block font-medium text-purple-900">BAB Siang:</label>
                        <input type="number" name="bab_siang" min="0" placeholder="Jumlah"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                    <div>
                        <label class="block font-medium text-purple-900">BAB Sore:</label>
                        <input type="number" name="bab_sore" min="0" placeholder="Jumlah"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-4">
                    <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300">
                        Reset
                    </button>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-700 text-white rounded-lg hover:from-purple-600 hover:to-purple-800 transition duration-300">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
    </div>
<script>
    document.querySelector("form").addEventListener("submit", function(e) {
    console.log("Form dikirim!"); // Debugging
});
// Animation keyframes
document.styleSheets[0].insertRule(`
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `, 0);

        // Toggle custom food input fields
        function toggleCustomMakanan(time) {
            const selectElement = document.getElementById(`makan_${time}`);
            const customDiv = document.getElementById(`custom_makan_${time}_div`);
            
            if (selectElement.value === 'custom') {
                customDiv.classList.remove('hidden');
            } else {
                customDiv.classList.add('hidden');
            }
        }

        // Initialize select elements
        document.addEventListener('DOMContentLoaded', function() {
            ['pagi', 'siang', 'sore'].forEach(time => {
                document.getElementById(`makan_${time}`).addEventListener('change', function() {
                    toggleCustomMakanan(time);
                });
            });
        });
</script>
</body>
</html>
