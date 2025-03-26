<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Anak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>
<body>
<body class="bg-white min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg">
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="bg-blue-500 text-white text-center py-4">
                <h2 class="text-2xl font-semibold">Edit User</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Password"
                                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        <small class="text-gray-500">Biarkan kosong jika Anda tidak ingin mengubah password</small>
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700 font-medium mb-1">Role</label>
                        <select id="role" name="role" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="grid gap-2">
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Update</button>
                        <a href="{{ route('dashboardadmin') }}" class="w-full text-center bg-gray-500 text-white py-2 rounded-lg hover:bg-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
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