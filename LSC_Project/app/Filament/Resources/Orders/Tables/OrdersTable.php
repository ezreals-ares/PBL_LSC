<?php
namespace App\Filament\Resources\Orders\Schemas;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

class OrderTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_id')->label('ID')->sortable(),
                TextColumn::make('user.name')->label('Customer')->searchable(),
                TextColumn::make('jenis_sepatu')->label('Jenis Sepatu')->searchable(),
                TextColumn::make('order_date')->label('Tanggal Order')->date('d M Y')->sortable(),
                TextColumn::make('pickup_method')->label('Metode'),
                TextColumn::make('status')->badge()->color(fn($state) => match($state) {
                    'pending'    => 'warning',
                    'diproses'   => 'info',
                    'selesai'    => 'success',
                    'dibatalkan' => 'danger',
                }),
                TextColumn::make('total_price')->label('Total')->money('IDR')->sortable(),
            ])
            ->actions([
                Action::make('riwayat_user')
                    ->label('Riwayat Order User')
                    ->icon('heroicon-o-clock')
                    ->modalHeading(fn($record) => 'Riwayat Order: ' . $record->user->name)
                    ->modalContent(fn($record) => view('filament.modals.user-order-history', [
                        'user'   => $record->user,
                        'orders' => $record->user->orders()->with('orderDetails.service')->latest('order_date')->get(),
                    ]))
                    ->modalSubmitAction(false),
            ]);
    }
}