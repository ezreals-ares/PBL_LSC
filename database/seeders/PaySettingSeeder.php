<?php

namespace Database\Seeders;

use App\Models\PaySetting;
use Illuminate\Database\Seeder;

class PaySettingSeeder extends Seeder
{
    public function run(): void
    {
        PaySetting::updateOrCreate(
            ['type' => 'qris'],
            [
                'is_active'    => true,
                'label_name'   => 'Lose ShoesCare',
                'provider_name'=> 'QRIS',
                'account_number'=> null,
                'account_name' => null,
                'payment_image'=> null,
                'notes'        => 'Scan QR code menggunakan aplikasi dompet digital (GoPay, OVO, DANA, ShopeePay, dll.)',
            ]
        );

        PaySetting::updateOrCreate(
            ['type' => 'bank'],
            [
                'is_active'     => true,
                'label_name'    => 'Lose ShoesCare',
                'provider_name' => 'BCA',
                'account_number'=> '1234567890',
                'account_name'  => 'Lose ShoesCare',
                'payment_image' => null,
                'notes'         => 'Harap cantumkan nomor pesanan sebagai berita transfer.',
            ]
        );
    }
}
