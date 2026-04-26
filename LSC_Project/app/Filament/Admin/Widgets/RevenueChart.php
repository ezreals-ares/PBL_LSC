<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Pendapatan';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 1;
    public ?string $filter = '6_months'; 

    protected function getFilters(): ?array
    {
        return [
            '1_week'   => '1 Minggu Terakhir',
            '1_month'  => '1 Bulan Terakhir',
            '3_months' => '3 Bulan Terakhir',
            '6_months' => '6 Bulan Terakhir',
            '1_year'   => '1 Tahun Terakhir',
            '5_years'  => '5 Tahun Terakhir',
        ];
    }

    // Tampilin growth % di heading
    public function getHeading(): string
    {
        $data = $this->getChartData();
        $values = $data['datasets'][0]['data'] ?? [];

        if (count($values) < 2) return 'Pendapatan';

        $first = $values[0] ?: 0;
        $last  = end($values) ?: 0;

        if ($first == 0) return 'Pendapatan';

        $growth = (($last - $first) / $first) * 100;
        $sign   = $growth >= 0 ? '↑ +' : '↓ ';

        return 'Pendapatan — ' . $sign . number_format($growth, 1) . '%';
    }

    private function getChartData(): array
    {
        $filter = $this->filter ?? '6_months';

        [$startDate, $groupFormat] = match ($filter) {
            '1_week'   => [Carbon::now()->subWeek(),    "TO_CHAR(order_date, 'DD Mon YYYY')"],
            '1_month'  => [Carbon::now()->subMonth(),   "TO_CHAR(order_date, 'DD Mon YYYY')"],
            '3_months' => [Carbon::now()->subMonths(3), "TO_CHAR(order_date, 'Mon YYYY')"],
            '6_months' => [Carbon::now()->subMonths(6), "TO_CHAR(order_date, 'Mon YYYY')"],
            '1_year'   => [Carbon::now()->subYear(),    "TO_CHAR(order_date, 'Mon YYYY')"],
            '5_years'  => [Carbon::now()->subYears(5),  "TO_CHAR(order_date, 'YYYY')"],
            default    => [Carbon::now()->subMonths(6), "TO_CHAR(order_date, 'Mon YYYY')"],
        };

        $orders = \App\Models\Order::whereIn('status', ['diproses', 'selesai'])
            ->where('order_date', '>=', $startDate)
            ->select(
                DB::raw("$groupFormat as date"),
                DB::raw('SUM(total_price) as total')
            )
            ->groupBy('date')
            ->orderByRaw('MIN(order_date) ASC')
            ->get();

        return [
            'datasets' => [[
                'label'           => 'Total Pendapatan (Rp)',
                'data'            => $orders->pluck('total')->map(fn($v) => (float) $v)->toArray(),
                'fill'            => 'start',
                'tension'         => 0.4,
                'borderColor'     => '#185FA5',
                'backgroundColor' => 'rgba(24,95,165,0.08)',
            ]],
            'labels' => $orders->pluck('date')->toArray(),
        ];
    }

    protected function getData(): array
    {
        return $this->getChartData();
    }

    protected function getType(): string
    {
        return 'line';
    }
}