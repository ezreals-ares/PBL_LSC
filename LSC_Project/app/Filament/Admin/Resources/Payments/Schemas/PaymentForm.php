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
                ->label('Pesanan')
                ->relationship('order', 'order_id')
                ->searchable()->preload()->required(),

            TextInput::make('amount')
                ->label('Jumlah Pembayaran')
                ->numeric()->required()->prefix('Rp'),

            DatePicker::make('payment_date')
                ->label('Tanggal Pembayaran')
                ->required(),

            Select::make('payment_method')
                ->label('Metode Pembayaran')
                ->options([
                    'e-wallet' => 'E-Wallet',
                    'bank-transfer' => 'Transfer Bank',
                ])
                ->default('e-wallet')->required(),
                
            FileUpload::make('payment_proof')
                ->label('Bukti Pembayaran')
                ->image()
                ->disk('public')
                ->fetchFileInformation(false)
                ->directory('payment_proof'),

            Select::make('status')
                ->label('Status')
                ->options([
                    'verified' => 'Terverifikasi',
                    'unverified' => 'Belum Terverifikasi',
                ])
                ->default('unverified')
                ->required()
                // Hanya admin yang bisa ubah status
                ->disabled(fn () => ! auth()->user()?->role === 'admin'),
        ]);
    }
}
