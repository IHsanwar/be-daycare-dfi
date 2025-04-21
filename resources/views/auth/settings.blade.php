@extends('layouts.app')
@section('title', 'User profile and Settings')
@section('content')
<div class="flex flex-col items-center justify-center py-8 bg-white bg-cover bg-center h-screen">
    <div class="w-full max -w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800">Pengaturan Akun</h2>
        <p class="text-center text-gray-500 mb-6">Ubah informasi akun Anda</p>

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

        <!-- open change password page-->
        <a href="{{ route('user.changePassword') }}" class="text-blue-500 hover:underline mb-4">Ubah Password</a>