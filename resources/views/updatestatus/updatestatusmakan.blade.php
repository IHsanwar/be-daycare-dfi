<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu Makan & Camilan</title>
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
<body class="dark:bg-darkBg text-white p-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header with animation -->
        <div class="flex items-center justify-between mb-6 opacity-0 animate-fade-in" style="animation: fadeIn 0.8s forwards;">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-500 to-purple-300 bg-clip-text text-transparent">Update Menu Makan & Camilan</h1>
        </div>

        <!-- Form -->
        <form action="#" method="POST" class="space-y-6">
            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="opacity-0 animate-fade-in" style="animation: fadeIn 0.8s 0.2s forwards;">
                    <label for="nama_pendamping" class="block text-sm font-medium text-gray-300 mb-1">Nama Pendamping</label>
                    <input type="text" name="nama_pendamping" id="nama_pendamping" value="Fanny" class="w-full px-4 py-3 bg-darkCard border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400 transition-all">
                </div>
                <div class="opacity-0 animate-fade-in" style="animation: fadeIn 0.8s 0.3s forwards;">
                    <label for="tanggal" class="block text-sm font-medium text-gray-300 mb-1">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" value="06-04-2025" class="w-full px-4 py-3 bg-darkCard border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400 transition-all">
                </div>
            </div>

            <!-- Makanan Utama -->
            <div class="border border-gray-700 rounded-xl p-6 bg-darkCard glow-effect card-hover transition-all opacity-0 animate-fade-in" style="animation: fadeIn 0.8s 0.4s forwards;">
                <h2 class="text-xl font-semibold text-accentLight mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M3 3a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 13.846 4.632 15 6 15H14a1 1 0 000-2H6l.8-.8 1.4-5.6h7.8a1 1 0 00.968-.747l1-4A1 1 0 0016 1H3.782a1 1 0 00-.894.553L3 3z"/>
                    </svg>
                    Makanan Utama
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Makan Pagi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Makan Pagi</label>
                        <select name="makan_pagi" id="makan_pagi" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white appearance-none cursor-pointer transition-all hover:bg-gray-700">
                            <option value="">Pilih makanan</option>
                            <option value="nasi putih">Nasi Putih</option>
                            <option value="bubur">Bubur</option>
                            <option value="roti">Roti</option>
                            <option value="sereal">Sereal</option>
                            <option value="custom">Lainnya</option>
                        </select>
                        <div id="custom_makan_pagi_div" class="hidden mt-2">
                            <input type="text" name="makan_pagi_custom" id="makan_pagi_custom" placeholder="Masukkan makanan" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400 transition-all">
                        </div>
                    </div>
                    
                    <!-- Makan Siang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Makan Siang</label>
                        <select name="makan_siang" id="makan_siang" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white appearance-none cursor-pointer transition-all hover:bg-gray-700">
                            <option value="">Pilih makanan</option>
                            <option value="nasi putih">Nasi Putih</option>
                            <option value="bubur">Bubur</option>
                            <option value="roti">Roti</option>
                            <option value="mie">Mie</option>
                            <option value="custom">Lainnya</option>
                        </select>
                        <div id="custom_makan_siang_div" class="hidden mt-2">
                            <input type="text" name="makan_siang_custom" id="makan_siang_custom" placeholder="Masukkan makanan" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400 transition-all">
                        </div>
                    </div>
                    
                    <!-- Makan Sore -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Makan Sore</label>
                        <select name="makan_sore" id="makan_sore" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white appearance-none cursor-pointer transition-all hover:bg-gray-700">
                            <option value="">Pilih makanan</option>
                            <option value="nasi putih">Nasi Putih</option>
                            <option value="bubur">Bubur</option>
                            <option value="roti">Roti</option>
                            <option value="mie">Mie</option>
                            <option value="custom">Lainnya</option>
                        </select>
                        <div id="custom_makan_sore_div" class="hidden mt-2">
                            <input type="text" name="makan_sore_custom" id="makan_sore_custom" placeholder="Masukkan makanan" class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400 transition-all">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Camilan -->
            <div class="border border-gray-700 rounded-xl p-6 bg-darkCard glow-effect card-hover transition-all opacity-0 animate-fade-in" style="animation: fadeIn 0.8s 0.5s forwards;">
                <h2 class="text-xl font-semibold text-accentLight mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    Camilan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Camilan Pagi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Camilan Pagi</label>
                        <div class="space-y-3 bg-gray-800 rounded-lg p-4 border border-gray-700">
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_buah" value="buah" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_pagi_buah" class="ml-3 block text-sm text-gray-300">Buah</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_biskuit" value="biskuit" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_pagi_biskuit" class="ml-3 block text-sm text-gray-300">Biskuit</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_puding" value="puding" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_pagi_puding" class="ml-3 block text-sm text-gray-300">Puding</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_yogurt" value="yogurt" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_pagi_yogurt" class="ml-3 block text-sm text-gray-300">Yogurt</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_keju" value="keju" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_pagi_keju" class="ml-3 block text-sm text-gray-300">Keju</label>
                            </div>
                            <div class="mt-3">
                                <input type="text" name="makanan_camilan_pagi[]" placeholder="Camilan lainnya" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400">
                            </div>
                        </div>
                    </div>

                    <!-- Camilan Siang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Camilan Siang</label>
                        <div class="space-y-3 bg-gray-800 rounded-lg p-4 border border-gray-700">
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_buah" value="buah" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_siang_buah" class="ml-3 block text-sm text-gray-300">Buah</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_biskuit" value="biskuit" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_siang_biskuit" class="ml-3 block text-sm text-gray-300">Biskuit</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_puding" value="puding" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_siang_puding" class="ml-3 block text-sm text-gray-300">Puding</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_yogurt" value="yogurt" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_siang_yogurt" class="ml-3 block text-sm text-gray-300">Yogurt</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_keju" value="keju" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_siang_keju" class="ml-3 block text-sm text-gray-300">Keju</label>
                            </div>
                            <div class="mt-3">
                                <input type="text" name="makanan_camilan_siang[]" placeholder="Camilan lainnya" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400">
                            </div>
                        </div>
                    </div>

                    <!-- Camilan Sore -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Camilan Sore</label>
                        <div class="space-y-3 bg-gray-800 rounded-lg p-4 border border-gray-700">
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_buah" value="buah" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_sore_buah" class="ml-3 block text-sm text-gray-300">Buah</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_biskuit" value="biskuit" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_sore_biskuit" class="ml-3 block text-sm text-gray-300">Biskuit</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_puding" value="puding" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_sore_puding" class="ml-3 block text-sm text-gray-300">Puding</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_yogurt" value="yogurt" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_sore_yogurt" class="ml-3 block text-sm text-gray-300">Yogurt</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_keju" value="keju" class="h-5 w-5 text-accentPurple focus:ring-accentPurple border-gray-600 rounded">
                                <label for="camilan_sore_keju" class="ml-3 block text-sm text-gray-300">Keju</label>
                            </div>
                            <div class="mt-3">
                                <input type="text" name="makanan_camilan_sore[]" placeholder="Camilan lainnya" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Minuman -->
            <div class="border border-gray-700 rounded-xl p-6 bg-darkCard glow-effect card-hover transition-all opacity-0 animate-fade-in" style="animation: fadeIn 0.8s 0.6s forwards;">
                <h2 class="text-xl font-semibold text-accentLight mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
                    </svg>
                    Minuman
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                        <div class="mb-4">
                            <label for="susu_pagi" class="block text-sm font-medium text-gray-300 mb-1">Susu Pagi (ml)</label>
                            <input type="number" name="susu_pagi" id="susu_pagi" min="0" placeholder="0" value="0" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400">
                        </div>
                        <div>
                            <label for="air_putih_pagi" class="block text-sm font-medium text-gray-300 mb-1">Air Putih Pagi (ml)</label>
                            <input type="number" name="air_putih_pagi" id="air_putih_pagi" min="0" placeholder="0" value="0" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400">
                        </div>
                    </div>
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                        <div class="mb-4">
                            <label for="susu_siang" class="block text-sm font-medium text-gray-300 mb-1">Susu Siang (ml)</label>
                            <input type="number" name="susu_siang" id="susu_siang" min="0" placeholder="0" value="0" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400">
                        </div>
                        <div>
                            <label for="air_putih_siang" class="block text-sm font-medium text-gray-300 mb-1">Air Putih Siang (ml)</label>
                            <input type="number" name="air_putih_siang" id="air_putih_siang" min="0" placeholder="0" value="0" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400">
                        </div>
                    </div>
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                        <div class="mb-4">
                            <label for="susu_sore" class="block text-sm font-medium text-gray-300 mb-1">Susu Sore (ml)</label>
                            <input type="number" name="susu_sore" id="susu_sore" min="0" placeholder="0" value="0" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400">
                        </div>
                        <div>
                            <label for="air_putih_sore" class="block text-sm font-medium text-gray-300 mb-1">Air Putih Sore (ml)</label>
                            <input type="number" name="air_putih_sore" id="air_putih_sore" min="0" placeholder="0" value="0" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-accentPurple focus:border-transparent text-white placeholder-gray-400">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                    <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300">
                        Reset
                    </button>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-700 text-white rounded-lg hover:from-purple-600 hover:to-purple-800 transition duration-300">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
        </form>
    </div>

    <script>
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