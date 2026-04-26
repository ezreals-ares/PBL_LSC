<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'service_name'   => 'Reguler Clean',
                'description'    => 'Pembersihan standar untuk sepatu sehari-hari. Cocok untuk sneakers berbahan kanvas dan mesh. Meliputi pembersihan upper, midsole, dan outsole.',
                'price'          => 35000,
                'estimated_days' => 2,
            ],
            [
                'service_name'   => 'Deep Clean',
                'description'    => 'Pembersihan mendalam untuk sepatu dengan kotoran membandel. Menggunakan bahan khusus yang aman untuk berbagai material sepatu termasuk kulit dan suede.',
                'price'          => 65000,
                'estimated_days' => 3,
            ],
            [
                'service_name'   => 'Full White',
                'description'    => 'Layanan khusus untuk sepatu putih agar kembali cerah bersih seperti baru. Menggunakan formula whitening premium yang aman untuk bahan sepatu.',
                'price'          => 75000,
                'estimated_days' => 3,
            ],
            [
                'service_name'   => 'Suede & Nubuck Care',
                'description'    => 'Perawatan khusus untuk sepatu berbahan suede dan nubuck yang memerlukan penanganan ekstra hati-hati. Menggunakan brush dan cleaner khusus suede.',
                'price'          => 85000,
                'estimated_days' => 4,
            ],
            [
                'service_name'   => 'Unyellowing',
                'description'    => 'Menghilangkan kekuningan pada sol sepatu (yellowing) akibat oksidasi. Proses menggunakan bahan kimia khusus dan paparan sinar UV.',
                'price'          => 55000,
                'estimated_days' => 2,
            ],
            [
                'service_name'   => 'Repaint & Recolor',
                'description'    => 'Pengecatan ulang untuk sepatu yang warnanya sudah pudar atau tergores. Menggunakan cat khusus sepatu yang fleksibel dan tahan lama.',
                'price'          => 120000,
                'estimated_days' => 5,
            ],
            [
                'service_name'   => 'Sole Restoration',
                'description'    => 'Restorasi dan perbaikan sol sepatu yang sudah menguning parah atau retak. Termasuk proses lem ulang dan finishing.',
                'price'          => 95000,
                'estimated_days' => 4,
            ],
            [
                'service_name'   => 'Express Clean',
                'description'    => 'Layanan pembersihan cepat selesai dalam 1 hari. Cocok untuk kebutuhan mendesak. Tersedia untuk sepatu dengan kotoran ringan hingga sedang.',
                'price'          => 50000,
                'estimated_days' => 1,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}