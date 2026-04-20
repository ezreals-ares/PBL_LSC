<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun Admin
        User::create([
            'name' => 'Nawaf Azril Annaufal',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Password default: password
            'phone' => '081234567890',
            'address' => 'Malang, Jawa Timur',
            'role' => 'admin',
        ]);

        // Membuat akun Customer
        User::create([
            'name' => 'Customer Default',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '089876543210',
            'address' => 'Jl. Customer No. 123',
            'role' => 'customer',
        ]);
    }
}
