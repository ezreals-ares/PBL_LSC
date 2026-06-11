<?php

namespace Database\Seeders;

use App\Models\Outlet;
use App\Models\OperationalHour;
use Illuminate\Database\Seeder;

class OperationalHourSeeder extends Seeder
{
    public function run(): void
    {
        $outlets = Outlet::all();

        // Jam operasional: Senin-Jumat 08:00-20:00, Sabtu 08:00-18:00, Minggu tutup
        $schedule = [
            ['day' => 'Senin',  'open_time' => '08:00', 'close_time' => '20:00'],
            ['day' => 'Selasa', 'open_time' => '08:00', 'close_time' => '20:00'],
            ['day' => 'Rabu',   'open_time' => '08:00', 'close_time' => '20:00'],
            ['day' => 'Kamis',  'open_time' => '08:00', 'close_time' => '20:00'],
            ['day' => 'Jumat',  'open_time' => '08:00', 'close_time' => '20:00'],
            ['day' => 'Sabtu',  'open_time' => '08:00', 'close_time' => '18:00'],
            ['day' => 'Minggu', 'open_time' => '09:00', 'close_time' => '16:00'],
        ];

        foreach ($outlets as $outlet) {
            foreach ($schedule as $jam) {
                OperationalHour::create([
                    'outlet_id'  => $outlet->outlet_id,
                    'day'        => $jam['day'],
                    'open_time'  => $jam['open_time'],
                    'close_time' => $jam['close_time'],
                ]);
            }
        }
    }
}