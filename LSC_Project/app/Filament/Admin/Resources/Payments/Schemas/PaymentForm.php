<?php

namespace App\Filament\Admin\Resources\Payments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('order_id')
                ->relationship('order', 'order_id')
                ->searchable()->preload()->required(),

            TextInput::make('amount')
                ->numeric()->required()->prefix('Rp'),

            DatePicker::make('payment_date')->required(),

            Select::make('payment_method')
                ->options([
                    'e-wallet' => 'E-Wallet',
                    'bank-transfer' => 'Bank Transfer',
                ])
                ->default('e-wallet')->required(),
                
            FileUpload::make('payment_proof')
                ->image()
                ->disk('public')
                ->fetchFileInformation(false)
                ->directory('payment_proof'),

            Select::make('status')
                ->options([
                    'verified' => 'Verified',
                    'unverified' => 'Unverified',
                ])
                ->default('unverified')
                ->required()
                // Hanya admin yang bisa ubah status
                ->disabled(fn () => ! auth()->user()?->role === 'admin'),
        ]);
    }
}
