<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya order berstatus 'selesai' yang boleh direview
        // Load beserta relasi user agar bisa ambil user_id
        $selesaiOrders = Order::where('status', 'selesai')->with('user')->get();

        $ulasan = [
            [
                'rating'  => 5,
                'comment' => 'Hasilnya luar biasa! Sepatu Nike Air Force saya kembali putih bersih seperti baru beli. Proses pengerjaan cepat dan rapih. Sangat puas dan pasti akan balik lagi!',
            ],
            [
                'rating'  => 5,
                'comment' => 'Pelayanan ramah, hasil bersih banget. Vans saya yang tadinya kusam sekarang kinclong lagi. Recommended banget buat yang punya koleksi sepatu!',
            ],
            [
                'rating'  => 4,
                'comment' => 'Kerjaannya bagus, tepat waktu sesuai estimasi. Sedikit saja kurang di bagian sol, tapi overall memuaskan. Harga juga worth it.',
            ],
            [
                'rating'  => 5,
                'comment' => 'Suede New Balance saya yang hampir hopeless sekarang kembali mulus. Tim SneakerCare benar-benar tahu cara handle material suede. Top!',
            ],
            [
                'rating'  => 4,
                'comment' => 'Proses pickup mudah, tidak perlu repot-repot datang ke toko. Hasil cuci bagus. Akan coba layanan repaint berikutnya.',
            ],
            [
                'rating'  => 5,
                'comment' => 'Jordan 1 saya sudah rapi banget setelah di-deep clean dan repaint. Warnanya kembali vibrant. Harga sebanding dengan hasil yang didapat!',
            ],
            [
                'rating'  => 3,
                'comment' => 'Hasil lumayan bagus tapi waktu pengerjaan molor 1 hari dari estimasi. Harap bisa lebih tepat waktu ke depannya.',
            ],
            [
                'rating'  => 5,
                'comment' => 'Timberland boot suede saya yang sudah kotor parah sekarang seperti baru! Proses pembersihan sangat teliti, tidak ada noda tersisa.',
            ],
            [
                'rating'  => 4,
                'comment' => 'Pelayanan profesional. Dr Martens saya bersih dan warna repaint sesuai yang diinginkan. Terima kasih SneakerCare!',
            ],
        ];

        foreach ($selesaiOrders as $index => $order) {
            // Tidak semua order direview (realistis: ~80% review rate)
            // Skip setiap order ke-5
            if (($index + 1) % 5 === 0) continue;

            $ulasanData = $ulasan[$index % count($ulasan)];

            Review::create([
                'user_id'  => $order->user_id,   // ambil dari relasi order → user
                'order_id' => $order->order_id,
                'rating'   => $ulasanData['rating'],
                'comment'  => $ulasanData['comment'],
                'photo'    => null,
            ]);
        }
    }
}