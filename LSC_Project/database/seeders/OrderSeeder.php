<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::where('role', 'customer')->get();
        $services  = Service::all()->keyBy('service_id');

        // Data order yang realistis
        $ordersData = [
            // ── Budi Santoso ──────────────────────────────────────────────
            [
                'customer_email'  => 'budi@gmail.com',
                'order_date'      => Carbon::now()->subDays(30),
                'jenis_sepatu'    => 'Nike Air Force 1 Low',
                'pickup_method'   => 'antar langsung',
                'status'          => 'selesai',
                'estimated_finish'=> Carbon::now()->subDays(27),
                'details' => [
                    ['service_name' => 'Deep Clean',  'quantity' => 1],
                    ['service_name' => 'Unyellowing', 'quantity' => 1],
                ],
            ],
            [
                'customer_email'  => 'budi@gmail.com',
                'order_date'      => Carbon::now()->subDays(10),
                'jenis_sepatu'    => 'Adidas Stan Smith',
                'pickup_method'   => 'pickup',
                'status'          => 'diproses',
                'estimated_finish'=> Carbon::now()->addDays(1),
                'details' => [
                    ['service_name' => 'Full White', 'quantity' => 1],
                ],
            ],

            // ── Sari Dewi ─────────────────────────────────────────────────
            [
                'customer_email'  => 'sari@gmail.com',
                'order_date'      => Carbon::now()->subDays(20),
                'jenis_sepatu'    => 'Vans Old Skool',
                'pickup_method'   => 'antar langsung',
                'status'          => 'selesai',
                'estimated_finish'=> Carbon::now()->subDays(18),
                'details' => [
                    ['service_name' => 'Reguler Clean', 'quantity' => 2],
                ],
            ],
            [
                'customer_email'  => 'sari@gmail.com',
                'order_date'      => Carbon::now()->subDays(5),
                'jenis_sepatu'    => 'Converse Chuck Taylor',
                'pickup_method'   => 'pickup',
                'status'          => 'pending',
                'estimated_finish'=> Carbon::now()->addDays(2),
                'details' => [
                    ['service_name' => 'Full White',     'quantity' => 1],
                    ['service_name' => 'Unyellowing',    'quantity' => 1],
                ],
            ],

            // ── Rizky Pratama ─────────────────────────────────────────────
            [
                'customer_email'  => 'rizky@gmail.com',
                'order_date'      => Carbon::now()->subDays(45),
                'jenis_sepatu'    => 'New Balance 574',
                'pickup_method'   => 'pickup',
                'status'          => 'selesai',
                'estimated_finish'=> Carbon::now()->subDays(42),
                'details' => [
                    ['service_name' => 'Suede & Nubuck Care', 'quantity' => 1],
                ],
            ],
            [
                'customer_email'  => 'rizky@gmail.com',
                'order_date'      => Carbon::now()->subDays(15),
                'jenis_sepatu'    => 'Jordan 1 Retro High',
                'pickup_method'   => 'antar langsung',
                'status'          => 'selesai',
                'estimated_finish'=> Carbon::now()->subDays(11),
                'details' => [
                    ['service_name' => 'Deep Clean',   'quantity' => 1],
                    ['service_name' => 'Repaint & Recolor', 'quantity' => 1],
                ],
            ],
            [
                'customer_email'  => 'rizky@gmail.com',
                'order_date'      => Carbon::now()->subDays(2),
                'jenis_sepatu'    => 'Puma Suede Classic',
                'pickup_method'   => 'pickup',
                'status'          => 'pending',
                'estimated_finish'=> Carbon::now()->addDays(4),
                'details' => [
                    ['service_name' => 'Suede & Nubuck Care', 'quantity' => 1],
                ],
            ],

            // ── Nadia Putri ───────────────────────────────────────────────
            [
                'customer_email'  => 'nadia@gmail.com',
                'order_date'      => Carbon::now()->subDays(7),
                'jenis_sepatu'    => 'Nike Air Max 90',
                'pickup_method'   => 'antar langsung',
                'status'          => 'diproses',
                'estimated_finish'=> Carbon::now()->addDays(1),
                'details' => [
                    ['service_name' => 'Express Clean', 'quantity' => 1],
                ],
            ],
            [
                'customer_email'  => 'nadia@gmail.com',
                'order_date'      => Carbon::now()->subDays(60),
                'jenis_sepatu'    => 'Skechers D\'Lites',
                'pickup_method'   => 'pickup',
                'status'          => 'selesai',
                'estimated_finish'=> Carbon::now()->subDays(57),
                'details' => [
                    ['service_name' => 'Reguler Clean', 'quantity' => 1],
                    ['service_name' => 'Unyellowing',   'quantity' => 1],
                ],
            ],

            // ── Andi Kurniawan ────────────────────────────────────────────
            [
                'customer_email'  => 'andi@gmail.com',
                'order_date'      => Carbon::now()->subDays(3),
                'jenis_sepatu'    => 'Reebok Classic Leather',
                'pickup_method'   => 'antar langsung',
                'status'          => 'pending',
                'estimated_finish'=> Carbon::now()->addDays(3),
                'details' => [
                    ['service_name' => 'Deep Clean',      'quantity' => 1],
                    ['service_name' => 'Sole Restoration', 'quantity' => 1],
                ],
            ],

            // ── Mega Lestari ──────────────────────────────────────────────
            [
                'customer_email'  => 'mega@gmail.com',
                'order_date'      => Carbon::now()->subDays(25),
                'jenis_sepatu'    => 'Timberland 6-Inch Boot',
                'pickup_method'   => 'pickup',
                'status'          => 'selesai',
                'estimated_finish'=> Carbon::now()->subDays(20),
                'details' => [
                    ['service_name' => 'Suede & Nubuck Care', 'quantity' => 1],
                    ['service_name' => 'Repaint & Recolor',   'quantity' => 1],
                ],
            ],
            [
                'customer_email'  => 'mega@gmail.com',
                'order_date'      => Carbon::now()->subDays(1),
                'jenis_sepatu'    => 'Crocs Classic Clog',
                'pickup_method'   => 'antar langsung',
                'status'          => 'pending',
                'estimated_finish'=> Carbon::now()->addDays(2),
                'details' => [
                    ['service_name' => 'Express Clean', 'quantity' => 2],
                ],
            ],

            // ── Fajar Hidayat ─────────────────────────────────────────────
            [
                'customer_email'  => 'fajar@gmail.com',
                'order_date'      => Carbon::now()->subDays(12),
                'jenis_sepatu'    => 'Asics Gel-Kayano',
                'pickup_method'   => 'pickup',
                'status'          => 'diproses',
                'estimated_finish'=> Carbon::now()->addDays(2),
                'details' => [
                    ['service_name' => 'Reguler Clean', 'quantity' => 1],
                ],
            ],

            // ── Tania Rahayu ──────────────────────────────────────────────
            [
                'customer_email'  => 'tania@gmail.com',
                'order_date'      => Carbon::now()->subDays(35),
                'jenis_sepatu'    => 'Dr. Martens 1460',
                'pickup_method'   => 'antar langsung',
                'status'          => 'selesai',
                'estimated_finish'=> Carbon::now()->subDays(31),
                'details' => [
                    ['service_name' => 'Deep Clean',      'quantity' => 1],
                    ['service_name' => 'Repaint & Recolor', 'quantity' => 1],
                ],
            ],
            [
                'customer_email'  => 'tania@gmail.com',
                'order_date'      => Carbon::now()->subDays(4),
                'jenis_sepatu'    => 'Nike Dunk Low',
                'pickup_method'   => 'pickup',
                'status'          => 'pending',
                'estimated_finish'=> Carbon::now()->addDays(3),
                'details' => [
                    ['service_name' => 'Full White',  'quantity' => 1],
                    ['service_name' => 'Unyellowing', 'quantity' => 1],
                ],
            ],
        ];

        // Map service_name ke service object
        $servicesByName = Service::all()->keyBy('service_name');

        foreach ($ordersData as $orderData) {
            $customer = User::where('email', $orderData['customer_email'])->first();
            if (!$customer) continue;

            // Hitung total_price dari details
            $totalPrice = 0;
            foreach ($orderData['details'] as $detail) {
                $service = $servicesByName[$detail['service_name']] ?? null;
                if ($service) {
                    $totalPrice += $service->price * $detail['quantity'];
                }
            }

            // Buat order
            $order = Order::create([
                'user_id'          => $customer->id,
                'order_date'       => $orderData['order_date'],
                'jenis_sepatu'     => $orderData['jenis_sepatu'],
                'pickup_method'    => $orderData['pickup_method'],
                'status'           => $orderData['status'],
                'estimated_finish' => $orderData['estimated_finish'],
                'total_price'      => $totalPrice,
            ]);

            // Buat order details
            foreach ($orderData['details'] as $detail) {
                $service = $servicesByName[$detail['service_name']] ?? null;
                if (!$service) continue;

                OrderDetail::create([
                    'order_id'   => $order->order_id,
                    'service_id' => $service->service_id,
                    'quantity'   => $detail['quantity'],
                    'subtotal'   => $service->price * $detail['quantity'],
                ]);
            }
        }
    }
}