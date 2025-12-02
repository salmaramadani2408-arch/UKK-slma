<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // User Kaban
        User::create([
            'name' => 'Kepala Badan',
            'email' => 'kaban@gmail.com', 
            'password' => Hash::make('kaban123'),
            'role' => 'kaban',
        ]);
    }
}