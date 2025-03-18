<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu Makan & Camilan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-purple-700">Update Menu Makan & Camilan</h1>
                <a href="{{ route('dashboardanak') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg px-4 py-2 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <!-- Form -->
            <form action="{{ route('children.updateStatus', $child->id) }}" method="POST" class="space-y-6">
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

                <!-- Makanan Utama -->
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
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
                                    <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_1" value="buah" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_pagi_1" class="ml-2 block text-sm text-gray-700">Buah</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_2" value="biskuit" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_pagi_2" class="ml-2 block text-sm text-gray-700">Biskuit</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_3" value="puding" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_pagi_3" class="ml-2 block text-sm text-gray-700">Puding</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_4" value="yogurt" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_pagi_4" class="ml-2 block text-sm text-gray-700">Yogurt</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_pagi[]" id="camilan_pagi_5" value="keju" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_pagi_5" class="ml-2 block text-sm text-gray-700">Keju</label>
                                </div>
                                <div class="mt-2">
                                    <input type="text" name="makanan_camilan_pagi[]" placeholder="Camilan lainnya" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                </div>
                            </div>
                        </div>

                        <!-- Camilan Siang -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Camilan Siang</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_1" value="buah" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_siang_1" class="ml-2 block text-sm text-gray-700">Buah</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_2" value="biskuit" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_siang_2" class="ml-2 block text-sm text-gray-700">Biskuit</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_3" value="puding" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_siang_3" class="ml-2 block text-sm text-gray-700">Puding</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_4" value="yogurt" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_siang_4" class="ml-2 block text-sm text-gray-700">Yogurt</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_siang[]" id="camilan_siang_5" value="keju" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_siang_5" class="ml-2 block text-sm text-gray-700">Keju</label>
                                </div>
                                <div class="mt-2">
                                    <input type="text" name="makanan_camilan_siang[]" placeholder="Camilan lainnya" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                </div>
                            </div>
                        </div>

                        <!-- Camilan Sore -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Camilan Sore</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_1" value="buah" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_sore_1" class="ml-2 block text-sm text-gray-700">Buah</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_2" value="biskuit" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_sore_2" class="ml-2 block text-sm text-gray-700">Biskuit</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_3" value="puding" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_sore_3" class="ml-2 block text-sm text-gray-700">Puding</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_4" value="yogurt" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_sore_4" class="ml-2 block text-sm text-gray-700">Yogurt</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="makanan_camilan_sore[]" id="camilan_sore_5" value="keju" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                    <label for="camilan_sore_5" class="ml-2 block text-sm text-gray-700">Keju</label>
                                </div>
                                <div class="mt-2">
                                    <input type="text" name="makanan_camilan_sore[]" placeholder="Camilan lainnya" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
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
                                <label for="susu_pagi" class="block text-sm font-medium text-gray-700 mb-1">Susu (ml)</label>
                                <input type="number" name="susu_pagi" id="susu_pagi" min="0" placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="air_putih_pagi" class="block text-sm font-medium text-gray-700 mb-1">Air Putih (ml)</label>
                                <input type="number" name="air_putih_pagi" id="air_putih_pagi" min="0" placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- Minuman Siang -->
                        <div>
                            <div class="mb-4">
                                <label for="susu_siang" class="block text-sm font-medium text-gray-700 mb-1">Susu (ml)</label>
                                <input type="number" name="susu_siang" id="susu_siang" min="0" placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="air_putih_siang" class="block text-sm font-medium text-gray-700 mb-1">Air Putih (ml)</label>
                                <input type="number" name="air_putih_siang" id="air_putih_siang" min="0" placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                        
                        <!-- Minuman Sore -->
                        <div>
                            <div class="mb-4">
                                <label for="susu_sore" class="block text-sm font-medium text-gray-700 mb-1">Susu (ml)</label>
                                <input type="number" name="susu_sore" id="susu_sore" min="0" placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="air_putih_sore" class="block text-sm font-medium text-gray-700 mb-1">Air Putih (ml)</label>
                                <input type="number" name="air_putih_sore" id="air_putih_sore" min="0" placeholder="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Buttons -->
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
    </div>

    <script>
        function toggleCustomMakanan(waktu) {
            const selectElement = document.getElementById(`makan_${waktu}`);
            const customDiv = document.getElementById(`custom_makan_${waktu}_div`);
            
            if (selectElement.value === 'custom') {
                customDiv.classList.remove('hidden');
            } else {
                customDiv.classList.add('hidden');
            }
        }

        // Initialize date picker (assuming you're using a date picker library)
        document.addEventListener('DOMContentLoaded', function() {
            // Fill in with existing data if available (you might want to add this functionality)
            // Example: if there's data from a previous entry, you could populate the form
        });
    </script>
</body>
</html>