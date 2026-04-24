<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrdersWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest('order_date')->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('order_id')->label('ID Order'),
                Tables\Columns\TextColumn::make('user.name')->label('Customer'),
                Tables\Columns\TextColumn::make('shoe_type')->label('Sepatu'),
                Tables\Columns\TextColumn::make('status')
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