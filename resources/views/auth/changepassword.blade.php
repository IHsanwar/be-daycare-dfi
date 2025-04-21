@extends('layouts.app')
@section('title', 'Change Password')
@section('content')

<div class="flex flex-col items-center justify-center py-8 bg-white bg-cover bg-center h-screen">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800">Ubah Password</h2>
        <p class="text-center text-gray-500 mb-6">Masukkan password baru Anda</p>

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

        <form method="POST" action="{{ route('user.changePassword.post') }}" class="space-y-6">
    @csrf
    <div class="relative">
        <input type="password" id="current_password" name="current_password" 
               class="peer w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 placeholder-transparent transition-all duration-300" 
               placeholder="Password Lama" required>
        <label for="current_password" 
               class="absolute left-4 -top-2.5 px-1 text-sm text-gray-600 bg-white transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-purple-600">
            Password Lama
        </label>
    </div>

    <div class="relative">
    <input type="password" id="current_password" name="current_password" 
           class="peer w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 placeholder-transparent transition-all duration-300" 
           placeholder="Password Lama" required>
    <label for="current_password" 
           class="absolute left-4 -top-2.5 px-1 text-sm text-gray-600 bg-white transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-purple-600">
        Password Lama
    </label>
</div>


    <div class="relative">
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
               class="peer w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 placeholder-transparent transition-all duration-300" 
               placeholder="Konfirmasi Password Baru" required>
        <label for="new_password_confirmation" 
               class="absolute left-4 -top-2.5 px-1 text-sm text-gray-600 bg-white transition-all duration-300 peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3.5 peer-focus:-top-2.5 peer-focus:text-sm peer-focus:text-purple-600">
            Konfirmasi Password Baru
        </label>
    </div>

    <button type="submit" 
            class="w-full px-4 py-3 bg-gradient-to-r from-purple-500 to-purple-700 text-white rounded-lg hover:from-purple-600 hover:to-purple-800 focus:ring-2 focus:ring-purple-300 focus:outline-none transform hover:scale-[1.02] active:scale-[0.98] transition duration-300 shadow-md">
        Ubah Password
    </button>
</form>
    </div>
</div>

@endsection