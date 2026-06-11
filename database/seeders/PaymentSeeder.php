<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Order yang sudah selesai → payment verified
        $selesaiOrders = Order::where('status', 'selesai')->get();
        foreach ($selesaiOrders as $order) {
            Payment::create([
                'order_id'       => $order->order_id,
                'payment_date'   => Carbon::parse($order->order_date)->addDay(),
                'amount'         => $order->total_price,
                'payment_method' => collect(['e-wallet', 'bank-transfer'])->random(),
                'status'         => 'verified',
                'payment_proof'  => null,
            ]);
        }

        // Order yang sedang diproses → sudah bayar tapi belum diverifikasi
        $diprosesOrders = Order::where('status', 'diproses')->get();
        foreach ($diprosesOrders as $order) {
            Payment::create([
                'order_id'       => $order->order_id,
                'payment_date'   => Carbon::parse($order->order_date)->addHours(rand(2, 12)),
                'amount'         => $order->total_price,
                'payment_method' => collect(['e-wallet', 'bank-transfer'])->random(),
                'status'         => 'unverified',
                'payment_proof'  => null,
            ]);
        }

        // Order pending → sebagian sudah upload bukti bayar, sebagian belum
        $pendingOrders = Order::where('status', 'pending')->get();
        foreach ($pendingOrders as $index => $order) {
            // Selang-seling: genap sudah upload, ganjil belum
            if ($index % 2 === 0) {
                Payment::create([
                    'order_id'       => $order->order_id,
                    'payment_date'   => Carbon::parse($order->order_date)->addHours(1),
                    'amount'         => $order->total_price,
                    'payment_method' => 'bank-transfer',
                    'status'         => 'unverified',
                    'payment_proof'  => null,
                ]);
            }
            // Yang lain belum melakukan pembayaran (tidak dibuat record)
        }
    }
}