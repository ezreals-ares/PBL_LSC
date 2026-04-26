<?php

namespace App\Filament\Admin\Resources\Services\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('service_name')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                TextInput::make('estimated_days')
                    ->required()
                    ->numeric(),
                FileUpload::make('gambar')
                    ->image()
                    ->disk('public')
                    ->fetchFileInformation(false)
                    ->directory('service_photos'),
                Textarea::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
