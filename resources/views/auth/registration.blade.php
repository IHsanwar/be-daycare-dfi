<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Daycare</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-100">
    <div class="flex w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Brand Side -->
        <div class="hidden lg:flex w-1/2 bg-cover bg-center" style="background-image: url('https://images.pexels.com/photos/3661351/pexels-photo-3661351.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');">
            <div class="flex items-center justify-center h-full bg-black bg-opacity-50">
                <h1 class="text-white text-3xl font-bold text-center p-6 rounded-lg bg-white bg-opacity-20 backdrop-blur-lg">Selamat Datang di Website Daycare!</h1>
            </div>
        </div>
        
        <!-- Register Side -->
        <div class="w-full lg:w-1/2 flex flex-col p-8">
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('images/daycare.png') }}" alt="" class="h-24 w-24 mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Buat Akun Baru</h2>
                <p class="text-gray-500">Isi form di bawah untuk mendaftar</p>
            </div>
            
            <!-- Error Message -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 border border-red-400 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('register.post') }}" class="space-y-3">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role" required
                            class="mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm @error('role') border-red-500 @enderror">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                               class="mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm @error('password') border-red-500 @enderror">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-4 flex items-center text-gray-600">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="mt-1 w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                        <button type="button" id="togglePasswordConfirmation" class="absolute inset-y-0 right-4 flex items-center text-gray-600">
                            <i class="fas fa-eye" id="toggleIconConfirmation"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-700 text-white rounded-lg hover:from-purple-600 hover:to-purple-800 transition duration-300">Register</button>
                
                <p class="text-center text-sm text-gray-500">Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a></p>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIcon.classList.toggle('fa-eye');
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>