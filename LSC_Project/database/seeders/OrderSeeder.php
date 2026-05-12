<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', 'customer')->pluck('id');
        $services  = Service::all();

        if ($customers->isEmpty() || $services->isEmpty()) {
            $this->command->warn('Tidak ada customer atau service. Skip.');
            return;
        }

        $this->command->info('Membuat 1000 orders...');
        $bar = $this->command->getOutput()->createProgressBar(1000);

        for ($i = 0; $i < 1000; $i++) {
            $orderDate = fake()->dateTimeBetween('-5 years', 'now');
            $status    = fake()->randomElement(['pending', 'diproses', 'selesai']);

            // Estimasi finish: kalau selesai di masa lalu, kalau pending/diproses di masa depan
            $estimatedFinish = $status === 'selesai'
                ? fake()->dateTimeBetween($orderDate, 'now')
                : fake()->dateTimeBetween('now', '+7 days');

            $order = Order::create([
                'user_id'          => $customers->random(),
                'order_date'       => $orderDate,
                'jenis_sepatu'     => fake()->randomElement([
                    'Nike Air Force 1', 'Adidas Stan Smith', 'Vans Old Skool',
                    'Converse Chuck Taylor', 'New Balance 574', 'Jordan 1 Retro',
                    'Puma Suede Classic', 'Nike Air Max 90', 'Reebok Classic',
                    'Timberland 6-Inch', 'Dr. Martens 1460', 'Nike Dunk Low',
                    'Asics Gel-Kayano', 'Skechers D\'Lites', 'Crocs Classic',
                ]),
                'material_sepatu'  => fake()->randomElement([
                    'Kanvas', 'Kulit', 'Kulit Sintetis', 'Suede',
                    'Nubuck', 'Mesh / Rajut', 'Karet',
                ]),
                'pickup_method'    => fake()->randomElement(['antar langsung', 'pickup']),
                'status'           => $status,
                'estimated_finish' => $estimatedFinish,
                'total_price'      => 0,
            ]);

            // Tiap order punya 1-3 detail service
            $selectedServices = $services->random(rand(1, 3));
            $totalPrice = 0;

            foreach ($selectedServices as $service) {
                $qty      = rand(1, 2);
                $subtotal = $service->price * $qty;
                $totalPrice += $subtotal;

                OrderDetail::create([
                    'order_id'   => $order->order_id,
                    'service_id' => $service->service_id,
                    'quantity'   => $qty,
                    'subtotal'   => $subtotal,
                ]);
            }

            // Update total price
            $order->update(['total_price' => $totalPrice]);

            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine();
        $this->command->info('Selesai! 1000 orders berhasil dibuat.');
    }
}