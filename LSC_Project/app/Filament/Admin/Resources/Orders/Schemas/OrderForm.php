<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use App\Models\Service;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

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
                ->label('Merek Sepatu')
                ->placeholder('Contoh: Nike, Adidas, Vans...')
                ->maxLength(100),

            Select::make('material_sepatu')
                ->label('Material Sepatu')
                ->options([
                    'Kanvas'         => 'Kanvas',
                    'Kulit'          => 'Kulit (Leather)',
                    'Kulit Sintetis' => 'Kulit Sintetis',
                    'Suede'          => 'Suede',
                    'Nubuck'         => 'Nubuck',
                    'Mesh / Rajut'   => 'Mesh / Rajut',
                    'Karet'          => 'Karet',
                    'Lainnya'        => 'Lainnya',
                ])
                ->searchable()
                ->placeholder('-- Pilih Material --'),

            Textarea::make('catatan')
                ->label('Catatan Tambahan')
                ->placeholder('Catatan kondisi sepatu atau permintaan khusus...')
                ->rows(3)
                ->maxLength(500)
                ->columnSpanFull(),

            DatePicker::make('order_date')->required(),
            DatePicker::make('estimated_finish'),

            Select::make('pickup_method')
                ->options(['pickup' => 'Pickup', 'antar langsung' => 'Antar Langsung'])
                ->default('pickup')
                ->required(),

            Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                    'dibatalkan' => 'Dibatalkan',
                ])
                ->default('pending')
                ->required(),

            Repeater::make('order_details')
                ->relationship('orderDetails')
                ->schema([
                    Select::make('service_id')
                        ->relationship('service', 'service_name')
                        ->searchable()->preload()->required()->live()
                        ->afterStateUpdated(function ($state, $set) {
                            $service = Service::find($state);
                            if ($service) {
                                $set('subtotal', $service->price);
                            }
                        }),
                    TextInput::make('quantity')
                        ->numeric()->default(1)->required()->live()
                        ->afterStateUpdated(function ($state, $set, $get) {
                            $service = Service::find($get('service_id'));
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

            TextInput::make('total_price')
                ->required()->numeric()->default(0)->readOnly()->prefix('Rp'),

            
        ]);
    }
}
