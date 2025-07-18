@extends('layouts.base')
<body class="text-gray-800 p-4 md:p-8">
  <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">

    <!-- Header di dalam card -->

            <!-- Form -->
          <div class="p-6">
            <form action="{{ url('/children/' . $child->id . '/update-status/kegiatan') }}" method="POST" class="space-y-6">
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
                        <input type="date" name="tanggal" id="tanggal" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                    </div>
                </div>
                
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
    <h2 class="text-lg font-semibold text-purple-700 mb-4">Kegiatan Indoor</h2>
    
    <!-- Kegiatan Indoor -->
    <div class="bg-white p-4 mb-4 rounded">
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="mengaji" name="kegiatan_indoor[]" value="Mengaji" class="h-4 w-4">
                <label for="mengaji">Mengaji</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="senam" name="kegiatan_indoor[]" value="Senam" class="h-4 w-4">
                <label for="senam">Senam</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="main_bebas" name="kegiatan_indoor[]" value="Main bebas" class="h-4 w-4">
                <label for="main_bebas">Main Bebas</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="bahasa_inggris" name="kegiatan_indoor[]" value="Bahasa inggris" class="h-4 w-4">
                <label for="bahasa_inggris">Bahasa Inggris</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="belajar_sensorik" name="kegiatan_indoor[]" value="Belajar sensorik" class="h-4 w-4">
                <label for="belajar_sensorik">Belajar Sensorik</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="belajar_motorik" name="kegiatan_indoor[]" value="Belajar motorik" class="h-4 w-4">
                <label for="belajar_motorik">Belajar Motorik</label>
            </div>
                <div class="flex items-center lainnya-container">
                    <input type="checkbox" id="lainnya_indoor" class="lainnyaCheckbox mr-2 h-4 w-4">
                    <label for="lainnya_indoor" class="lainnyaLabel cursor-text">Lainnya</label>
                    <input type="text" id="kegiatan_indoor" name="kegiatan_indoor[]" class="lainnyaInput border rounded p-1 w-24" placeholder="Isi lainnya...">
                </div>
            </div>
        </div>
    </div>
    
    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
    <h2 class="text-lg font-semibold text-purple-700 mb-4">Kegiatan Outdoor</h2>

    <!-- Kegiatan Outdoor -->
    <div class="bg-white p-4 mb-4 rounded">
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="berjemur" name="kegiatan_outdoor[]" value="Berjemur" class="h-4 w-4">
                <label for="berjemur">Berjemur</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="jalan_jalan" name="kegiatan_outdoor[]" value="Jalan jalan" class="h-4 w-4">
                <label for="jalan_jalan">Jalan Jalan</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="olahraga" name="kegiatan_outdoor[]" value="Olahraga" class="h-4 w-4">
                <label for="olahraga">Olahraga</label>
            </div>
                <div class="flex items-center lainnya-container">
                    <input type="checkbox" id="lainnya_outdoor" class="lainnyaCheckbox mr-2 h-4 w-4">
                    <label for="lainnya_outdoor" class="lainnyaLabel cursor-text">Lainnya</label>
                    <input type="text" id="kegiatan_outdoor" name="kegiatan_outdoor[]" class="lainnyaInput border rounded p-1 w-24"
                    placeholder="Isi lainnya...">
                </div>
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
</div>

</form>
<script>
    document.querySelector("form").addEventListener("submit", function(e) {
    console.log("Form dikirim!"); // Debugging
});

document.addEventListener('DOMContentLoaded', function () {
    function setupLainnyaCheckboxes() {
        document.querySelectorAll(".lainnya-container").forEach(container => {
            const checkbox = container.querySelector(".lainnyaCheckbox");
            const label = container.querySelector(".lainnyaLabel");
            const input = container.querySelector(".lainnyaInput");

            // Sembunyikan input jika checkbox tidak dicentang
            input.classList.toggle("hidden", !checkbox.checked);
            label.classList.toggle("hidden", checkbox.checked);

            checkbox.addEventListener("change", function () {
                input.classList.toggle("hidden", !this.checked);
                label.classList.toggle("hidden", this.checked);
                if (this.checked) {
                    input.focus();
                } else {
                    input.value = ""; // Hanya reset input jika checkbox dinonaktifkan
                }
            });

            input.addEventListener("input", function () {
                if (this.value.trim()) {
                    checkbox.value = this.value.trim(); // Pastikan tidak kosong
                }
            });
        });
    }

    setupLainnyaCheckboxes();
});


  // Initial setup
  setupLainnyaCheckboxes();

  // Function to add a new "lainnya" option dynamically
  window.addNewLainnyaOption = function(containerId, checkboxName) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    // Create a new lainnya container
    const newLainnyaContainer = document.createElement('div');
    newLainnyaContainer.className = 'flex items-center lainnya-container';
    
    // Generate unique IDs based on timestamp
    const uniqueId = 'lainnya_' + Date.now();
    
    // Create HTML structure
    newLainnyaContainer.innerHTML = `
      <input type="checkbox" id="${uniqueId}" name="${checkboxName}" class="lainnyaCheckbox mr-2 h-4 w-4">
      <label for="${uniqueId}" class="lainnyaLabel cursor-text">Lainnya</label>
      <input type="text" name="${checkboxName}" class="lainnyaInput border rounded p-1 w-24" placeholder="Isi lainnya...">
    `;
    
    // Append to the container
    container.appendChild(newLainnyaContainer);
    
    // Re-run setup to configure the new element
    setupLainnyaCheckboxes();
  };
</script>
</body>
</html>
