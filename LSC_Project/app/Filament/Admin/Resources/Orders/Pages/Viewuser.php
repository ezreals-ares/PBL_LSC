<?php

namespace App\Filament\Admin\Resources\Users\Pages;

use App\Filament\Admin\Resources\Users\UserResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Customer'),
                        TextEntry::make('email')
                            ->label('Email'),
                        TextEntry::make('phone')
                            ->label('No. HP'),
                        TextEntry::make('address')
                            ->label('Alamat')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Section::make('Ringkasan Order')
                    ->schema([
                        TextEntry::make('total_orders')
                            ->label('Total Order')
                            ->state(fn ($record): string => $record->orders()->count() . ' order')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('total_spent')
                            ->label('Total Belanja')
                            ->state(fn ($record): string => 'Rp ' . number_format($record->orders()->sum('total_price'), 0, ',', '.'))
                            ->badge()
                            ->color('success'),
                    ])
                    ->columns(2),

                Section::make('Detail Order')
                    ->schema([
                        RepeatableEntry::make('orders')
                            ->label('')
                            ->schema([
                                TextEntry::make('order_id')
                                    ->label('ID Order')
                                    ->badge(),
                                TextEntry::make('order_date')
                                    ->label('Tanggal Order')
                                    ->date('d M Y'),
                                TextEntry::make('jenis_sepatu')
                                    ->label('Jenis Sepatu'),
                                TextEntry::make('pickup_method')
                                    ->label('Metode'),
                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'diproses' => 'info',
                                        'selesai' => 'success',
                                        'dibatalkan' => 'danger',
                                        default => 'gray',
                                    }),
                                TextEntry::make('total_price')
                                    ->label('Total')
                                    ->money('IDR'),

                                RepeatableEntry::make('orderDetails')
                                    ->label('Layanan')
                                    ->schema([
                                        TextEntry::make('service.service_name')
                                            ->label('Layanan'),
                                        TextEntry::make('quantity')
                                            ->label('Qty')
                                            ->badge(),
                                        TextEntry::make('subtotal')
                                            ->label('Subtotal')
                                            ->money('IDR'),
                                    ])
                                    ->columns(3)
                                    ->columnSpanFull(),
                            ])
                            ->columns(3),
                    ]),
            ]);
    }
}