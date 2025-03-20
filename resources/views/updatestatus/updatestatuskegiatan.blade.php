<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu Kegiatan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-purple-700">Update Informasi Kegiatan</h1>
                
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

                 <!-- Kegiatan Indoor Section -->
<div class="bg-purple-100 p-3 mb-2 rounded">
    <div class="font-bold text-purple-500">Kegiatan Indoor</div>
</div>

<div class="bg-white p-4 mb-4 rounded">
    <div class="grid grid-cols-3 gap-2">
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Mengaji</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Senam</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Main bebas</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Bahasa inggris</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Belajar sensorik</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Belajar motorik</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Fun looking</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Toilet training</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Ke paud</label>
        </div>
        <div class="flex items-center lainnya-container">
            <input type="checkbox" class="lainnyaCheckbox mr-2 h-4 w-4">
            <label class="lainnyaLabel cursor-text">Lainnya</label>
            <input type="text" class="lainnyaInput hidden border rounded p-1 w-24" placeholder="Isi lainnya...">
        </div>
    </div>
</div>

<!-- Kegiatan Outdoor -->
<div class="bg-purple-100 p-3 mb-2 rounded">
    <div class="font-bold text-purple-500">Kegiatan Outdoor</div>
</div>

<div class="bg-white p-4 mb-4 rounded">
    <div class="grid grid-cols-3 gap-2">
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Berjemur</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Jalan jalan</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Olahraga</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Grounding</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Mandi bola</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Main pasir</label>
        </div>
        <div class="flex items-center">
            <input type="checkbox" class="mr-2 h-4 w-4">
            <label>Main air/busa</label>
        </div>
        <div class="flex items-center lainnya-container">
            <input type="checkbox" class="lainnyaCheckbox mr-2 h-4 w-4">
            <label class="lainnyaLabel cursor-text">Lainnya</label>
            <input type="text" class="lainnyaInput hidden border rounded p-1 w-24" placeholder="Isi lainnya...">
        </div>
    </div>
</div>

<!-- Tombol Submit -->
<div class="flex justify-end space-x-4 mt-4">
    <button type="reset" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-300">
        Reset
    </button>
    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-700 text-white rounded-lg hover:from-purple-600 hover:to-purple-800 transition duration-300">
        <i class="fas fa-save mr-2"></i>Simpan
    </button>
</div>
<script>
    document.querySelector("form").addEventListener("submit", function(e) {
    console.log("Form dikirim!"); // Debugging
});

document.querySelectorAll(".lainnya-container").forEach(container => {
    const checkbox = container.querySelector(".lainnyaCheckbox");
    const label = container.querySelector(".lainnyaLabel");
    const input = container.querySelector(".lainnyaInput");

    checkbox.addEventListener("change", function() {
        if (this.checked) {
            label.classList.add("hidden");
            input.classList.remove("hidden");
            input.focus();
        } else {
            input.classList.add("hidden");
            label.classList.remove("hidden");
            input.value = ""; // Clear input
        }
    });

});

</script>
</body>
</html>
