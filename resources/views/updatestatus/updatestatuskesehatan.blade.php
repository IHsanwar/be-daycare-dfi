<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu Informasi Kesehatan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-purple-700">Update Informasi Kesehatan</h1>
                
            </div>

            <!-- Form -->
            <form action="{{ url('/children/' . $child->id . '/update-status/kesehatan') }}" method="POST" class="space-y-6">
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

                <!-- Tidur Section -->
             <h3 class="text-lg font-semibold text-purple-700 mt-4">Tidur</h3>
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="block font-medium text-purple-900">Pagi:</label>
                        <input type="number" name="tidur_pagi" min="0" placeholder="Jumlah"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                    <div>
                        <label class="block font-medium text-purple-900">Siang:</label>
                        <input type="number" name="tidur_siang" min="0" placeholder="Jumlah"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                    <div>
                        <label class="block font-medium text-purple-900">Malam:</label>
                        <input type="number" name="tidur_malam" min="0" placeholder="Jumlah"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                </div>
         
                <!-- Obat -->
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label for="obat_pagi" class="block font-medium text-purple-900">Obat Pagi:</label>
                        <input type="time" id="obat_pagi" name="obat_pagi"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                    <div>
                        <label for="obat_siang" class="block font-medium text-purple-900">Obat Siang:</label>
                        <input type="time" id="obat_siang" name="obat_siang"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                    <div>
                        <label for="obat_sore" class="block font-medium text-purple-900">Obat Sore:</label>
                        <input type="time" id="obat_sore" name="obat_sore"
                            class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                    </div>
                </div>

                <!-- Kondisi Anak -->
                <div>
                    <label for="kondisi" class="block font-medium text-purple-900">Kondisi Anak:</label>
                    <select id="kondisi" name="kondisi" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-purple-400">
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="sehat">Sehat</option>
                        <option value="sakit">Sakit</option>
                    </select>           
                </div>

                <!---section keterangan-->
                <div class="mt-4">
                        <label for="keterangan" class="block text-purple-700 font-medium mb-2">Keterangan</label>
                        <input type="textarea" id="keterangan" name="keterangan" class="w-full p-2 border rounded-md h-24 resize-none" placeholder="Tulis keterangan di sini..."></textarea>
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
</body>
</html>