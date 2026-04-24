<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ─── ADMIN ───────────────────────────────────────────────────────────
        User::create([
            'name'     => 'Admin Utama',
            'email'    => 'admin@cucisepatu.com',
            'password' => Hash::make('password'),
            'phone'    => '081234567890',
            'address'  => 'Jl. Sudirman No. 1, Bandung',
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Supervisor Operasional',
            'email'    => 'supervisor@cucisepatu.com',
            'password' => Hash::make('password'),
            'phone'    => '081234567891',
            'address'  => 'Jl. Asia Afrika No. 10, Bandung',
            'role'     => 'admin',
        ]);

        // ─── CUSTOMER ────────────────────────────────────────────────────────
        $customers = [
            [
                'name'    => 'Budi Santoso',
                'email'   => 'budi@gmail.com',
                'phone'   => '082111111111',
                'address' => 'Jl. Dago No. 25, Bandung',
            ],
            [
                'name'    => 'Sari Dewi',
                'email'   => 'sari@gmail.com',
                'phone'   => '082222222222',
                'address' => 'Jl. Cihampelas No. 88, Bandung',
            ],
            [
                'name'    => 'Rizky Pratama',
                'email'   => 'rizky@gmail.com',
                'phone'   => '082333333333',
                'address' => 'Jl. Setiabudi No. 12, Bandung',
            ],
            [
                'name'    => 'Nadia Putri',
                'email'   => 'nadia@gmail.com',
                'phone'   => '082444444444',
                'address' => 'Jl. Pasteur No. 44, Bandung',
            ],
            [
                'name'    => 'Andi Kurniawan',
                'email'   => 'andi@gmail.com',
                'phone'   => '082555555555',
                'address' => 'Jl. Gatot Subroto No. 7, Bandung',
            ],
            [
                'name'    => 'Mega Lestari',
                'email'   => 'mega@gmail.com',
                'phone'   => '082666666666',
                'address' => 'Jl. Buah Batu No. 33, Bandung',
            ],
            [
                'name'    => 'Fajar Hidayat',
                'email'   => 'fajar@gmail.com',
                'phone'   => '082777777777',
                'address' => 'Jl. Kiaracondong No. 5, Bandung',
            ],
            [
                'name'    => 'Tania Rahayu',
                'email'   => 'tania@gmail.com',
                'phone'   => '082888888888',
                'address' => 'Jl. Riau No. 21, Bandung',
            ],
        ];

        foreach ($customers as $customer) {
            User::create([
                'name'     => $customer['name'],
                'email'    => $customer['email'],
                'password' => Hash::make('password'),
                'phone'    => $customer['phone'],
                'address'  => $customer['address'],
                'role'     => 'customer',
            ]);
        }
    }
}