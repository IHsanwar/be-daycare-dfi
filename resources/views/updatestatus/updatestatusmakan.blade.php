<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Makan Cemilan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e16c014aae.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    'inter': ['Inter', 'sans-serif']
                },
                colors: {
                    'purple': {
                        50: '#f5f3ff',
                        100: '#ede9fe',
                        200: '#ddd6fe',
                        300: '#c4b5fd',
                        400: '#a78bfa',
                        500: '#8b5cf6',
                        600: '#7c3aed',
                        700: '#6d28d9',
                        800: '#5b21b6',
                        900: '#4c1d95'
                    }
                }
            }
        }
    }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        #sidebar {
            display: flex;
            flex-direction: column;
        }
        .sidebar-content {
            flex-grow: 1;
            overflow-y: auto;
        }
    </style>
</head>
<body class="font-inter bg-gray-50 text-gray-800 overflow-x-hidden">
    <div class="flex min-h-screen relative">
        <!-- Mobile Menu Button -->
        <div class="md:hidden fixed top-4 right-4 z-30">
            <button id="menuToggle" class="bg-white text-purple-600 p-2 rounded-full shadow-lg hover:shadow-xl transition-all duration-300">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <div id="sidebar" class="w-full md:w-64 bg-white h-screen fixed md:sticky top-0 z-20 -translate-x-full md:translate-x-0 transition-all duration-300 ease-in-out shadow-lg no-scrollbar flex flex-col">
            <div class="p-4 flex items-center">
                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-purple-500 to-purple-700 flex items-center justify-center text-white mr-3">
                    <i class="fas fa-child"></i>
                </div>
                <h2 class="text-xl font-bold bg-gradient-to-r from-purple-600 to-purple-800 text-transparent bg-clip-text">Dashboard Anak</h2>
            </div>
            
            <div class="sidebar-content px-4 py-2 flex-grow overflow-y-auto">
                <button class="w-full mb-3 p-2.5 text-left font-medium bg-purple-100 text-purple-800 rounded-lg flex items-center transition-all hover:bg-purple-200">
                    <i class="fas fa-tachometer-alt mr-3 text-purple-600"></i>
                    Dashboard Anak
                </button>
                
                <div class="text-gray-400 uppercase text-xs font-bold mt-3 mb-2 px-2">Menu</div>
                
                <div class="space-y-1">
                    <button onclick="window.location.href='/update_anak.html'"
                    class="w-full p-2.5 text-left font-medium text-gray-600 rounded-lg flex items-center transition-all hover:bg-purple-50">
                    <i class="fas fa-circle-arrow-left mr-3 text-purple-500"></i>
                    Kembali
                </button>
                
                <button onclick="window.location.href='/dashboard_anak.html'" 
                class="w-full p-2.5 text-left font-medium text-gray-600 rounded-lg flex items-center transition-all hover:bg-purple-50">
                <i class="fas fa-user mr-3 text-purple-500"></i>
                Dashboard Anak
                  </button>
            
                </div>
            </div>
            
            <div class="bottom-0 left-0 right-0 p-4">
                <button class="w-full p-2.5 text-white bg-gradient-to-r from-red-500 to-red-700 rounded-lg flex items-center justify-center transition-all hover:shadow-lg">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Logout
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <div class="bg-white p-3 shadow-sm sticky top-0 z-10">
                <div class="flex items-center">
                    <div class="text-purple-600 mr-3">
                        <i class="fas fa-utensils text-lg"></i>
                    </div>
                    <span class="font-bold text-gray-800">Menu Makan & Cemilan</span>
                </div>
            </div>
            
            <!-- Child Info -->
            <div class="p-4">
                <div class="bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="flex flex-col md:flex-row md:justify-between gap-4">
                        <!-- Child and companion info -->
                        <div class="flex flex-col space-y-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gradient-to-r from-purple-500 to-purple-700 rounded-full flex items-center justify-center text-white shadow-md mr-3">
                                    <i class="fas fa-child text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Nama Anak</div>
                                    <div class="font-semibold">{{$child->nama}}</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white shadow-md mr-3">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-xs text-gray-500">Nama Pendamping</div>
                                    <div class="font-semibold">Erisia Chelly</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Date -->
                         
                        <div class="flex items-center">
                            <div class="h-12 w-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600 mr-3 pulse-effect">
                                <i class="far fa-calendar-alt text-lg"></i>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Tanggal</div>
                                <div class="bg-purple-50 text-purple-800 px-3 py-1.5 rounded-lg font-semibold">12-02-2025</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Porsi Makan -->
                @csrf
                @method('PUT')
                <div class="section-header flex items-center mt-4">
                    <span class="mr-2 text-2xl">🍽</span>
                    <span class="font-bold text-purple-700">Porsi Makan</span>
                </div>
                <div class="info-card p-6 bg-white shadow-lg rounded-lg mt-4">
                    <p class="font-semibold mb-3 text-black-600">Pagi</p>
                    <div class="flex space-x-6">
                        <label class="flex items-center">
                            <input type="radio" name="pagi" value="1" class="mr-2 text-purple-600 focus:ring-purple-500"> 1 Porsi
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="pagi" value="1/2" class="mr-2 text-purple-600 focus:ring-purple-500"> 1/2 Porsi
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="pagi" value="1/3" class="mr-2 text-purple-600 focus:ring-purple-500"> 1/3 Porsi
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="pagi" value="1/4" class="mr-2 text-purple-600 focus:ring-purple-500"> 1/4 Porsi
                        </label>
                    </div>
                </div>
                
                <div class="info-card p-6 bg-white shadow-lg rounded-lg mt-4">
                    <p class="font-semibold mb-3 text-black-600">Siang</p>
                    <div class="flex space-x-6">
                        <label class="flex items-center">
                            <input type="radio" name="siang" value="1" class="mr-2 text-purple-600 focus:ring-purple-500"> 1 Porsi
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="siang" value="1/2" class="mr-2 text-purple-600 focus:ring-purple-500"> 1/2 Porsi
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="siang" value="1/3" class="mr-2 text-purple-600 focus:ring-purple-500"> 1/3 Porsi
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="siang" value="1/4" class="mr-2 text-purple-600 focus:ring-purple-500"> 1/4 Porsi
                        </label>
                    </div>
                </div>
                
                <div class="info-card p-6 bg-white shadow-lg rounded-lg mt-4">
                    <p class="font-semibold mb-3 text-black-600">Sore</p>
                    <div class="flex space-x-6">
                        <label class="flex items-center">
                            <input type="radio" name="sore" value="1" class="mr-2 text-purple-600 focus:ring-purple-500"> 1 Porsi
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="sore" value="1/2" class="mr-2 text-purple-600 focus:ring-purple-500"> 1/2 Porsi
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="sore" value="1/3" class="mr-2 text-purple-600 focus:ring-purple-500"> 1/3 Porsi
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="sore" value="1/4" class="mr-2 text-purple-600 focus:ring-purple-500"> 1/4 Porsi
                        </label>
                    </div>
                </div>

                <!-- Menu Makan & Camilan -->
                <div class="section-header flex items-center mt-8">
    <span class="mr-2 text-2xl">🍽</span>
    <span class="font-bold text-purple-700">Menu Makan & Camilan</span>
</div>
<div class="info-card p-6 bg-white shadow-lg rounded-lg mt-4">
    <div class="grid gap-6">
        @foreach(['Pagi', 'Siang', 'Sore'] as $meal)
        <div>
            <p class="font-semibold mb-3 text-black-600">
                <i class="fas fa-{{ $meal == 'Pagi' ? 'sun text-warning' : ($meal == 'Siang' ? 'cloud-sun text-primary' : 'moon text-info') }} me-2"></i>
                {{ $meal }}
            </p>
            <div class="mb-4">
                @foreach(['1', '1/2', '1/3', '1/4'] as $value)
                <div class="form-check form-check-inline mb-2 mr-4">
                    <input class="form-check-input" type="radio" name="makan_{{ strtolower($meal) }}" 
                           id="makan_{{ strtolower($meal) }}_{{ str_replace('/', '_', $value) }}" 
                           value="{{ $value }}" 
                           {{ $child->{"makan_" . strtolower($meal)} == $value ? 'checked' : '' }}>
                    <label class="form-check-label" for="makan_{{ strtolower($meal) }}_{{ str_replace('/', '_', $value) }}">{{ $value }}</label>
                </div>
                @endforeach
                <div class="form-check form-check-inline">
                    <input class="form-check-input lainnya-checkbox" type="radio" 
                           name="makan_{{ strtolower($meal) }}" 
                           id="makan_{{ strtolower($meal) }}_lainnya" 
                           value="custom" 
                           {{ $child->{"makan_" . strtolower($meal)} && !in_array($child->{"makan_" . strtolower($meal)}, ['1', '1/2', '1/3', '1/4']) ? 'checked' : '' }}>
                    <label class="form-check-label" for="makan_{{ strtolower($meal) }}_lainnya">Lainnya</label>
                    <input type="text" class="border border-purple-300 p-2 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 ml-2 w-32" 
                           id="makan_{{ strtolower($meal) }}_custom" 
                           name="makan_{{ strtolower($meal) }}_custom" 
                           value="{{ $child->{"makan_" . strtolower($meal)} && !in_array($child->{"makan_" . strtolower($meal)}, ['1', '1/2', '1/3', '1/4']) ? $child->{"makan_" . strtolower($meal)} : '' }}" 
                           style="{{ $child->{"makan_" . strtolower($meal)} && !in_array($child->{"makan_" . strtolower($meal)}, ['1', '1/2', '1/3', '1/4']) ? 'display: inline-block;' : 'display: none;' }}">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" placeholder="Menu 1" name="menu_{{ strtolower($meal) }}_1" 
                       value="{{ $child->{'menu_' . strtolower($meal) . '_1'} ?? '' }}"
                       class="border border-purple-300 p-3 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                <input type="text" placeholder="Menu 2" name="menu_{{ strtolower($meal) }}_2"
                       value="{{ $child->{'menu_' . strtolower($meal) . '_2'} ?? '' }}"
                       class="border border-purple-300 p-3 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show/hide custom input fields when "Lainnya" is selected
    const lainyaCheckboxes = document.querySelectorAll('.lainnya-checkbox');
    lainyaCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const mealType = this.id.split('_')[1];
            const customInput = document.getElementById(`makan_${mealType}_custom`);
            if (this.checked) {
                customInput.style.display = 'inline-block';
                customInput.focus();
            } else {
                customInput.style.display = 'none';
            }
        });
    });
    
    // Also listen to other radio buttons to hide custom input when they're selected
    const mealRadios = document.querySelectorAll('input[type="radio"][name^="makan_"]');
    mealRadios.forEach(radio => {
        if (!radio.classList.contains('lainnya-checkbox')) {
            radio.addEventListener('change', function() {
                const mealType = this.name.replace('makan_', '');
                const customInput = document.getElementById(`makan_${mealType}_custom`);
                customInput.style.display = 'none';
            });
        }
    });
});
</script>
</body>
</html>