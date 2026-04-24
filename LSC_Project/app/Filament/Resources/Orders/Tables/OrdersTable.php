<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_id')->label('ID')->toggleable(isToggledHiddenByDefault: true)->sortable(),
                TextColumn::make('user.name')->label('Customer')->searchable(),
                TextColumn::make('shoe_type')->label('Jenis Sepatu')->searchable(), // Udah gue benerin jadi shoe_type ya
                TextColumn::make('order_date')->label('Tanggal Order')->date('d M Y')->sortable(),
                TextColumn::make('pickup_method')->label('Metode'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending'    => 'warning',
                        'diproses'   => 'info',
                        'selesai'    => 'success',
                        'dibatalkan' => 'danger',
                        default      => 'gray',
                    }),
                TextColumn::make('total_price')->label('Total')->money('IDR')->sortable(),
            ])
            ->recordActions([
                
            ]);
    }
}