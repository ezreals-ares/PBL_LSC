<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use App\Models\Service;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('user_id')
                ->label('Pelanggan')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    TextInput::make('name')->label('Nama')->required(),
                    TextInput::make('phone')->label('Nomor Telepon')->tel()->required(),
                    TextInput::make('address')->label('Alamat')->required(),
                ])
                ->required(),

            TextInput::make('jenis_sepatu')
                ->label('Jenis Sepatu')
                ->placeholder('Contoh: Nike Air Max, Adidas Ultraboost, dll')
                ->required(),

            DatePicker::make('order_date')
                ->label('Tanggal Pesanan')
                ->required(),

            Select::make('pickup_method')
                ->label('Metode Pengiriman')
                ->options(['pickup' => 'Pickup', 'antar langsung' => 'Antar Langsung'])
                ->default('pickup')
                ->required(),

            Select::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Menunggu',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                    'dibatalkan' => 'Dibatalkan',
                ])
                ->default('pending')
                ->required(),

            DatePicker::make('estimated_finish')
                ->label('Estimasi Selesai'),

            TextInput::make('total_price')
                ->label('Total Harga')
                ->required()->numeric()->default(0)->readOnly()->prefix('Rp'),

            Repeater::make('order_details')
                ->label('Detail Pesanan')
                ->relationship('orderDetails')
                ->schema([
                    Select::make('service_id')
                        ->label('Layanan')
                        ->relationship('service', 'service_name')
                        ->searchable()->preload()->required()->live()
                        ->afterStateUpdated(function ($state, $set) {
                            $service = Service::find($state);
                            if ($service) {
                                $set('subtotal', $service->price);
                            }
                        }),
                    TextInput::make('quantity')
                        ->label('Jumlah')
                        ->numeric()->default(1)->required()->live()
                        ->afterStateUpdated(function ($state, $set, $get) {
                            $service = Service::find($get('service_id'));
                            if ($service) {
                                $set('subtotal', $service->price * $state);
                            }
                        }),
                    TextInput::make('subtotal')
                        ->label('Subtotal')
                        ->numeric()->required()->readOnly()->prefix('Rp'),
                ])
                ->columns(3)->live()
                ->afterStateUpdated(function ($state, $set) {
                    $total = collect($state)->reduce(function ($carry, $item) {
                        return $carry + (($item['subtotal'] ?? 0));
                    }, 0);
                    $set('total_price', $total);
                }),
        ]);
    }
}