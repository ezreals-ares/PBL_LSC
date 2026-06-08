<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 5;
    protected static ?string $heading = 'Pesanan Terbaru';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest('order_date')->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('order_id')->label('ID Pesanan'),
                Tables\Columns\TextColumn::make('user.name')->label('Pelanggan'),
                Tables\Columns\TextColumn::make('jenis_sepatu')->label('Sepatu'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending'    => 'Menunggu',
                        'diproses'   => 'Diproses',
                        'selesai'    => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                        default      => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'    => 'warning',
                        'diproses'   => 'info',
                        'selesai'    => 'success',
                        'dibatalkan' => 'danger',
                        default      => 'gray',
                    }),
                Tables\Columns\TextColumn::make('total_price')->label('Total')->money('IDR'),
            ])
            ->paginated(false);
    }
}