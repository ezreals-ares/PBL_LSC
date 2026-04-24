<?php

namespace App\Filament\Widgets;

use App\Models\OrderDetail;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PopularServicesChart extends ChartWidget
{
    protected ?string $heading = 'Layanan Paling Diminati';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $services = OrderDetail::select('services.service_name', DB::raw('SUM(order_details.quantity) as total_qty'))
            ->join('services', 'order_details.service_id', '=', 'services.service_id')
            ->groupBy('services.service_id', 'services.service_name')
            ->orderByDesc('total_qty')
            ->limit(4)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Dipesan',
                    'data' => $services->pluck('total_qty')->toArray(),
                    'backgroundColor' => ['#0F172A', '#334155', '#64748B', '#94A3B8'],
                ],
            ],
            'labels' => $services->pluck('service_name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'scales' => [
                'x' => [
                    'display' => false,
                ],
                'y' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }
}