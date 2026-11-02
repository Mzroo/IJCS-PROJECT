<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Owner
        User::create([
            'name' => 'Owner IJCS',
            'email' => 'owner@ijcs.com',
            'password' => Hash::make('password123'),
            'role' => 'owner',
            'is_active' => true,
        ]);

        // 2. Akun Admin / Kasir
        User::create([
            'name' => 'Admin Kasir',
            'email' => 'admin@ijcs.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // 3. Akun Teknisi
        User::create([
            'name' => 'Teknisi Utama',
            'email' => 'teknisi@ijcs.com',
            'password' => Hash::make('password123'),
            'role' => 'teknisi',
            'is_active' => true,
        ]);
    }
}