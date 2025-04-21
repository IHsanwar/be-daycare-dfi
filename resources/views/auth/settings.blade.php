@extends('layouts.app')
@section('title', 'User profile and Settings')
@section('content')

<div class="w-full max -w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800">Pengaturan Akun</h2>
        <p class="text-gray-500 mb-6">Ubah dan tinjau informasi akun Anda</p>

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
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            @php
            $role = auth()->user()->role;
            $borderColor = $role === 'admin' ? 'border-purple-500' : ($role === 'user' ? 'border-blue-500' : 'border-gray-500');
            $textColor = $role === 'admin' ? 'text-purple-500' : ($role === 'user' ? 'text-blue-500' : 'text-gray-500');
                        @endphp

            <div class="flex items-center gap-4">
                <img src="https://www.citypng.com/public/uploads/preview/profile-user-round-white-icon-symbol-png-701751695033499brrbuebohc.png" 
                    width="80px" 
                    class="rounded-full border-4 {{ $borderColor }} shadow-md" 
                    alt="Profile Picture">

                <div>
                    <!-- User Name -->
                    <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>

                    <!-- User Email -->
                    <p class="text-gray-500">{{ auth()->user()->email }}</p>

                    <!-- User Role -->
                    <p class="{{ $textColor }}">{{ ucfirst($role) }}</p>
                </div>
            </div>

        </div>

        <!-- Form -->
        <form class="grid md:grid-cols-2 gap-6 mb-6" method="POST" action="{{ route('user.updateProfile.post') }}">
    @csrf

    <div> 
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" placeholder="Enter your email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none" name="email" value="{{ old('email', auth()->user()->email) }}">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password saat ini</label>
        <input type="password" placeholder="Current password" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none" name="current_password">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
        <input type="password" placeholder="New password" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none" name="new_password">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
        <input type="password" placeholder="Confirm new password" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none" name="new_password_confirmation">
    </div>

    <div>
        <button type="submit" class="p-7 bg-purple-500 text-white py-2 rounded-lg hover:bg-purple-600 transition duration-200">
            Update Profile
        </button>
    </div>
</form>

@include('footer.footer')
    </div>
    {{-- FOOTER --}}
    

@endsection