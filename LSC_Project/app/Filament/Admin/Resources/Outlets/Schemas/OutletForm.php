<?php

namespace App\Filament\Admin\Resources\Outlets\Schemas;

use Filament\Schemas\Components\Section;  // ← changed
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OutletForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            
                    ->schema([
                        TextInput::make('outlet_name')
                            ->label('Nama Outlet')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->required(),
                        TextInput::make('google_maps_link')
                            ->label('Link Google Maps')
                            ->placeholder('https://goo.gl/maps/...'),
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->required(),
                    ])
                    ->columns(2);
            
    }
}