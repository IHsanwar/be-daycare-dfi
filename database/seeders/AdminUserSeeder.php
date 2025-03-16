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
            'name' => 'Migurdia',
            'email' => 'migurdia@gmail.com',
            'password' => Hash::make('migurdia123'),
            'role' => 'admin',
        ]);
    }
}
