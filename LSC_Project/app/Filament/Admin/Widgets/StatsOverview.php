<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalPesanan      = Order::count();
        $pesananAktif      = Order::whereIn('status', ['pending', 'diproses'])->count();
        $pelangganBaru     = User::where('role', 'customer')
                                ->where('created_at', '>=', Carbon::now()->startOfMonth())
                                ->count();
        $statusDihitung = ['diproses', 'selesai'];
        $totalPendapatan = Order::whereIn('status', $statusDihitung)->sum('total_price');

        // Trend pesanan: bandingkan bulan ini vs bulan lalu
        $pesananBulanIni   = Order::whereMonth('order_date', Carbon::now()->month)->count();
        $pesananBulanLalu  = Order::whereMonth('order_date', Carbon::now()->subMonth()->month)->count();
        $trendPesanan      = $pesananBulanLalu > 0
            ? round((($pesananBulanIni - $pesananBulanLalu) / $pesananBulanLalu) * 100, 1)
            : 0;

        return [
            Stat::make('Total Pesanan', $totalPesanan)
                ->description('Semua pesanan masuk')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart(
                    Order::selectRaw('COUNT(*) as count')
                        ->where('order_date', '>=', Carbon::now()->subDays(7))
                        ->groupBy('order_date')
                        ->orderBy('order_date')
                        ->pluck('count')
                        ->toArray() ?: [0]
                ),

            Stat::make('Pesanan Aktif', $pesananAktif)
                ->description('Pending & sedang diproses')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('warning'),

            Stat::make('Pelanggan Baru', $pelangganBaru)
                ->description('Bulan ' . Carbon::now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('success'),

            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalPendapatan, 0, ',', '.'))
                ->description('Dari order')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),
        ];
    }
}