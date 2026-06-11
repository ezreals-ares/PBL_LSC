<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    public function run(): void
    {
        $outlets = [
            [
                'outlet_name'      => 'SneakerCare Dago',
                'address'          => 'Jl. Ir. H. Juanda No. 45, Dago, Coblong, Bandung',
                'google_maps_link' => 'https://maps.google.com/?q=SneakerCare+Dago+Bandung',
                'phone'            => '022-1234567',
            ],
        ];

        foreach ($outlets as $outlet) {
            Outlet::create($outlet);
        }
    }
}