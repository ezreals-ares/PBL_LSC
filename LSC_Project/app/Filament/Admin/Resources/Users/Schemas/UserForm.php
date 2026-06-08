<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email(),
                DateTimePicker::make('email_verified_at')
                    ->label('Email Terverifikasi Pada'),
                TextInput::make('password')
                    ->label('Kata Sandi')
                    ->password()
                    ->required(),
                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->required(),
                Select::make('role')
                    ->label('Peran')
                    ->required()
                    ->default('customer')
                    ->options([
                        'customer' => 'Pelanggan',
                        'admin' => 'Admin',
                    ]),
                Textarea::make('address')
                    ->label('Alamat')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
