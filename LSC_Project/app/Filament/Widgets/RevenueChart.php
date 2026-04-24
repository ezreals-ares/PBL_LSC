<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueChart extends ChartWidget
{
    protected ?string $heading = 'Pendapatan';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 1;

    protected function getFilters(): ?array
    {
        return [
            '1_week' => '1 Minggu Terakhir',
            '1_month' => '1 Bulan Terakhir',
            '3_months' => '3 Bulan Terakhir',
            '6_months' => '6 Bulan Terakhir',
            '1_year' => '1 Tahun Terakhir',
            '5_years' => '5 Tahun Terakhir',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $startDate = match ($activeFilter) {
            '1_week' => Carbon::now()->subWeek(),
            '1_month' => Carbon::now()->subMonth(),
            '3_months' => Carbon::now()->subMonths(3),
            '6_months' => Carbon::now()->subMonths(6),
            '1_year' => Carbon::now()->subYear(),
            '5_years' => Carbon::now()->subYears(5),
            default => Carbon::now()->subMonths(6),
        };

        $payments = Payment::where('status', 'verified')
            ->where('payment_date', '>=', $startDate)
            ->select(
                $activeFilter === '1_week' 
                    ? DB::raw("TO_CHAR(payment_date, 'DD Mon') as date") 
                    : DB::raw("TO_CHAR(payment_date, 'Mon YYYY') as date"),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('date')
            ->orderByRaw('MIN(payment_date) ASC')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Pendapatan (Rp)',
                    'data' => $payments->pluck('total')->toArray(),
                    'fill' => 'start',
                    'tension' => 0.4,
                ],
            ],
            'labels' => $payments->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}