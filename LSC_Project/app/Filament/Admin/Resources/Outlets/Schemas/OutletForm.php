<?php

namespace App\Filament\Admin\Resources\Outlets\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OutletForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('outlet_name')
                    ->required(),
                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('google_maps_link'),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
            ]);
    }
}
