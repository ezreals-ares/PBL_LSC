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
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                Select::make('role')
                    ->required()
                    ->default('customer')
                    ->options([
                        'customer' => 'Customer',
                        'admin' => 'Admin',
                    ]),
                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
