<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $orderDate = $this->faker->dateTimeBetween('-5 years', 'now');
        
        return [
            'user_id'          => User::where('role', 'customer')->inRandomOrder()->first()->user_id,
            'order_date'       => $orderDate,
            'jenis_sepatu'     => $this->faker->randomElement([
                'Nike Air Force 1', 'Adidas Stan Smith', 'Vans Old Skool',
                'Converse Chuck Taylor', 'New Balance 574', 'Jordan 1 Retro',
                'Puma Suede Classic', 'Nike Air Max 90', 'Reebok Classic',
                'Timberland 6-Inch', 'Dr. Martens 1460', 'Nike Dunk Low',
                'Asics Gel-Kayano', 'Skechers D\'Lites', 'Crocs Classic',
            ]),
            'pickup_method'    => $this->faker->randomElement(['antar langsung', 'pickup']),
            'status'           => $this->faker->randomElement(['pending', 'diproses', 'selesai']),
            'estimated_finish' => Carbon::instance($orderDate)->addDays(rand(2, 7)),
            'total_price'      => 0, // dihitung setelah details dibuat
        ];
    }
}