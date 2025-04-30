@extends('layouts.base')

<body class="text-gray-800 p-4 md:p-8">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
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
                        <div id="checkbox-container" class="space-y-2">
                            
                            <button onclick="addCheckbox()" class="mt-3 px-2 py-1 bg-purple-600 text-white rounded">Tambah Pilihan</button>

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
const initialChoices = ["Buah", "Biskuit", "Puding", "Yogurt", "Keju"];

function createCheckbox(value) {
  const id = `camilan_pagi_${value.toLowerCase()}`;
  const label = document.createElement("label");
  label.className = "flex items-center";

  const checkbox = document.createElement("input");
  checkbox.type = "checkbox";
  checkbox.name = "makanan_camilan_pagi[]";
  checkbox.value = value.toLowerCase();
  checkbox.id = id;
  checkbox.className = "h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded";

  const text = document.createElement("span");
  text.textContent = value;
  text.className = "ml-2 block text-sm text-gray-700";

  const editBtn = document.createElement("button");
  editBtn.type = "button";
  editBtn.innerHTML = "✏️";
  editBtn.className = "ml-2 text-sm";
  editBtn.onclick = () => editLabel(text, checkbox);

  label.appendChild(checkbox);
  label.appendChild(text);
  label.appendChild(editBtn);

  return label;
}

function editLabel(labelSpan, checkboxInput) {
  const currentValue = labelSpan.textContent;
  const input = document.createElement("input");
  input.type = "text";
  input.value = currentValue;
  input.className = "ml-2 text-sm border rounded px-1";

  const saveBtn = document.createElement("button");
  saveBtn.textContent = "✔️";
  saveBtn.className = "ml-1 text-sm";
  saveBtn.onclick = () => {
    const newValue = input.value.trim();
    if (newValue) {
      labelSpan.textContent = newValue;
      checkboxInput.value = newValue.toLowerCase();
      checkboxInput.id = `camilan_pagi_${newValue.toLowerCase()}`;
      labelSpan.style.display = "";
      saveBtn.remove();
      input.remove();
    }
  };

  labelSpan.parentElement.appendChild(input);
  labelSpan.parentElement.appendChild(saveBtn);
  labelSpan.style.display = "none";
  input.focus();
}

function addCheckbox() {
  const container = document.getElementById("checkbox-container");
  const newLabel = prompt("Masukkan nama pilihan baru:");
  if (newLabel) {
    container.appendChild(createCheckbox(newLabel));
  }
}

// Inisialisasi
const container = document.getElementById("checkbox-container");
initialChoices.forEach(choice => container.appendChild(createCheckbox(choice)));
    </script>
</body>
</html>