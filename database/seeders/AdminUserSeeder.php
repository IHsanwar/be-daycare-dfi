<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Cipher',
            'email' => 'cipher@gmail.com',
            'password' => Hash::make('cipher'),
            'role' => 'admin',
        ]);
    }
}
