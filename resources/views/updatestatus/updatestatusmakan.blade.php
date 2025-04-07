<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu Makan & Camilan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
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
            background-color: #f3f4f6;
            min-height: 100vh;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="text-gray-800 p-4 md:p-8">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
         <!-- Header -->
         <div class="bg-purple-700 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Update Menu Makan & Camilan</h1>                
        </div>

        <!-- Form -->
        <div class="p-6">
        <form action="{{ url('/children/' . $child->id . '/update-status/makan-cemilan') }}" method="POST" class="space-y-6">

        @csrf
        @method('PUT')
            <input type="hidden" name="child_id" value="{{ $child->id }}">
                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_pendamping" class="block text-sm font-medium text-gray-700 mb-1">Nama Pendamping</label>
                        <input type="text" name="nama_pendamping" id="nama_pendamping" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    </div>
                </div>

                <!-- Makanan Utama -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-purple-700 mb-4">Makanan Utama</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <!-- Makan Pagi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Makan Pagi</label>
                            <select name="makan_pagi" id="makan_pagi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" onchange="toggleCustomMakanan('pagi')">
                                <option value="">Pilih makanan</option>
                                <option value="nasi putih">Nasi Putih</option>
                                <option value="bubur">Bubur</option>
                                <option value="roti">Roti</option>
                                <option value="sereal">Sereal</option>
                                <option value="custom">Lainnya</option>
                            </select>
                            <div id="custom_makan_pagi_div" class="hidden mt-2">
                                <input type="text" name="makan_pagi_custom" id="makan_pagi_custom" placeholder="Masukkan makanan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- Makan Siang -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Makan Siang</label>
                            <select name="makan_siang" id="makan_siang" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" onchange="toggleCustomMakanan('siang')">
                                <option value="">Pilih makanan</option>
                                <option value="nasi putih">Nasi Putih</option>
                                <option value="bubur">Bubur</option>
                                <option value="roti">Roti</option>
                                <option value="mie">Mie</option>
                                <option value="custom">Lainnya</option>
                            </select>
                            <div id="custom_makan_siang_div" class="hidden mt-2">
                                <input type="text" name="makan_siang_custom" id="makan_siang_custom" placeholder="Masukkan makanan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- Makan Sore -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Makan Sore</label>
                            <select name="makan_sore" id="makan_sore" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" onchange="toggleCustomMakanan('sore')">
                                <option value="">Pilih makanan</option>
                                <option value="nasi putih">Nasi Putih</option>
                                <option value="bubur">Bubur</option>
                                <option value="roti">Roti</option>
                                <option value="mie">Mie</option>
                                <option value="custom">Lainnya</option>
                            </select>
                            <div id="custom_makan_sore_div" class="hidden mt-2">
                                <input type="text" name="makan_sore_custom" id="makan_sore_custom" placeholder="Masukkan makanan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Camilan -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <h2 class="text-lg font-semibold text-purple-700 mb-4">Camilan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Camilan Pagi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Camilan Pagi</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_buah" value="buah" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_pagi_buah" class="ml-2 block text-sm text-gray-700">Buah</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_biskuit" value="biskuit" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_pagi_biskuit" class="ml-2 block text-sm text-gray-700">Biskuit</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_puding" value="puding" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_pagi_puding" class="ml-2 block text-sm text-gray-700">Puding</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_yogurt" value="yogurt" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_pagi_yogurt" class="ml-2 block text-sm text-gray-700">Yogurt</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_keju" value="keju" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_pagi_keju" class="ml-2 block text-sm text-gray-700">Keju</label>
                                </div>
                                
                                <div class="mt-2">
                                    <input type="text" name="makanan_camilan_pagi_custom" placeholder="Camilan lainnya" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                </div>
                            </div>
                        </div>

                        <!-- Camilan Siang -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Camilan Siang</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_buah" value="buah" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_siang_buah" class="ml-2 block text-sm text-gray-700">Buah</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_biskuit" value="biskuit" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_siang_biskuit" class="ml-2 block text-sm text-gray-700">Biskuit</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_puding" value="puding" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_siang_puding" class="ml-2 block text-sm text-gray-700">Puding</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_yogurt" value="yogurt" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_siang_yogurt" class="ml-2 block text-sm text-gray-700">Yogurt</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_keju" value="keju" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_siang_keju" class="ml-2 block text-sm text-gray-700">Keju</label>
                                </div>
                                
                                <div class="mt-2">
                                    <input type="text" name="makanan_camilan_siang_custom" placeholder="Camilan lainnya" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                </div>
                            </div>
                        </div>

                        <!-- Camilan Sore -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Camilan Sore</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_buah" value="buah" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_sore_buah" class="ml-2 block text-sm text-gray-700">Buah</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_biskuit" value="biskuit" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_sore_biskuit" class="ml-2 block text-sm text-gray-700">Biskuit</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_puding" value="puding" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_sore_puding" class="ml-2 block text-sm text-gray-700">Puding</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_yogurt" value="yogurt" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_sore_yogurt" class="ml-2 block text-sm text-gray-700">Yogurt</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_keju" value="keju" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_sore_keju" class="ml-2 block text-sm text-gray-700">Keju</label>
                                </div>
                                
                                <div class="mt-2">
                                    <input type="text" name="makanan_camilan_sore_custom" placeholder="Camilan lainnya" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Minuman -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <h2 class="text-lg font-semibold text-purple-700 mb-4">Minuman</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Minuman Pagi -->
                        <div>
                            <div class="mb-4">
                                <label for="susu_pagi" class="block text-sm font-medium text-gray-700 mb-1">Susu Pagi (ml)</label>
                                <input type="number" name="susu_pagi" id="susu_pagi" min="0" placeholder="0" value="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="air_putih_pagi" class="block text-sm font-medium text-gray-700 mb-1">Air Putih Pagi (ml)</label>
                                <input type="number" name="air_putih_pagi" id="air_putih_pagi" min="0" placeholder="0" value="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- Minuman Siang -->
                        <div>
                            <div class="mb-4">
                                <label for="susu_siang" class="block text-sm font-medium text-gray-700 mb-1">Susu Siang (ml)</label>
                                <input type="number" name="susu_siang" id="susu_siang" min="0" placeholder="0" value="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="air_putih_siang" class="block text-sm font-medium text-gray-700 mb-1">Air Putih Siang (ml)</label>
                                <input type="number" name="air_putih_siang" id="air_putih_siang" min="0" placeholder="0" value="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- Minuman Sore -->
                        <div>
                            <div class="mb-4">
                                <label for="susu_sore" class="block text-sm font-medium text-gray-700 mb-1">Susu Sore (ml)</label>
                                <input type="number" name="susu_sore" id="susu_sore" min="0" placeholder="0" value="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="air_putih_sore" class="block text-sm font-medium text-gray-700 mb-1">Air Putih Sore (ml)</label>
                                <input type="number" name="air_putih_sore" id="air_putih_sore" min="0" placeholder="0" value="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" id="resetButton" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300">
                        Reset
                    </button>
                    <button type="submit" id="submitButton" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-700 text-white rounded-lg hover:from-purple-600 hover:to-purple-800 transition duration-300">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>


function toggleCustomMakanan(time) {
    const selectElement = document.getElementById(`makan_${time}`);
    const customDiv = document.getElementById(`custom_makan_${time}_div`);

    if (selectElement.value === 'custom') {
        customDiv.classList.remove('hidden');
    } else {
        customDiv.classList.add('hidden');
    }
}

    </script>
</body>
</html>