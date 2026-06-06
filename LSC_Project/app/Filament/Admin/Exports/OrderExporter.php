<?php

namespace App\Filament\Admin\Exports;

use App\Models\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('order_id')->label('ID Pesanan'),
            ExportColumn::make('user_id')->label('ID Pengguna'),
            ExportColumn::make('order_date')->label('Tanggal Pesanan'),
            ExportColumn::make('pickup_method')->label('Metode Pengiriman'),
            ExportColumn::make('status')->label('Status'),
            ExportColumn::make('estimated_finish')->label('Estimasi Selesai'),
            ExportColumn::make('total_price')->label('Total Harga'),
            ExportColumn::make('jenis_sepatu')->label('Jenis Sepatu'),
            ExportColumn::make('created_at')->label('Dibuat Pada'),
            ExportColumn::make('updated_at')->label('Diperbarui Pada'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Export pesanan selesai. ' . Number::format($export->successful_rows) . ' baris berhasil diekspor.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' baris gagal diekspor.';
        }

        return $body;
    }
}
