<?php
namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    TextInput::make('name')->required(),
                    TextInput::make('phone')->tel()->required(),
                    TextInput::make('address')->required(),
                ])
                ->required(),

            TextInput::make('jenis_sepatu')
                ->label('Jenis Sepatu')
                ->placeholder('Contoh: Nike Air Max, Adidas Ultraboost, dll')
                ->required(),

            DatePicker::make('order_date')->required(),

            Select::make('pickup_method')
                ->options(['pickup' => 'Pickup', 'antar langsung' => 'Antar Langsung'])
                ->default('pickup')
                ->required(),

            Select::make('status')
                ->options([
                    'pending'    => 'Pending',
                    'diproses'   => 'Diproses',
                    'selesai'    => 'Selesai',
                    'dibatalkan' => 'Dibatalkan',
                ])
                ->default('pending')
                ->required(),

            DatePicker::make('estimated_finish'),

            TextInput::make('total_price')
                ->required()->numeric()->default(0)->readOnly()->prefix('Rp'),

            Repeater::make('order_details')
                ->relationship('orderDetails')
                ->schema([
                    Select::make('service_id')
                        ->relationship('service', 'service_name')
                        ->searchable()->preload()->required()->live()
                        ->afterStateUpdated(function ($state, $set) {
                            $service = \App\Models\Service::find($state);
                            if ($service) {
                                $set('subtotal', $service->price);
                            }
                        }),
                    TextInput::make('quantity')
                        ->numeric()->default(1)->required()->live()
                        ->afterStateUpdated(function ($state, $set, $get) {
                            $service = \App\Models\Service::find($get('service_id'));
                            if ($service) {
                                $set('subtotal', $service->price * $state);
                            }
                        }),
                    TextInput::make('subtotal')
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