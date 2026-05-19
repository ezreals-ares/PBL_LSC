<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class TodayStatsOverview extends BaseWidget
{

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $statusDihitung = ['diproses', 'selesai'];
        
        $pendapatanHariIni = Order::whereIn('status', $statusDihitung)
                                ->whereDate('order_date', Carbon::today())
                                ->sum('total_price');

        $pesananHariIni = Order::whereDate('order_date', Carbon::today())->count();

        return [
            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($pendapatanHariIni, 0, ',', '.'))
                ->description('Diupdate otomatis hari ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Pesanan Masuk Hari Ini', $pesananHariIni)
                ->description('Pelanggan yang order hari ini')
                ->descriptionIcon('heroicon-m-bell-alert')
                ->color('primary'),
        ];
    }
}