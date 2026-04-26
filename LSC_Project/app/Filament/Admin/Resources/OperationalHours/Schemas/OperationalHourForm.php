<?php

namespace App\Filament\Admin\Resources\OperationalHours\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class OperationalHourForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('outlet_id')
                    ->required()
                    ->numeric(),
                TextInput::make('day')
                    ->required(),
                TimePicker::make('open_time')
                    ->required(),
                TimePicker::make('close_time')
                    ->required(),
            ]);
    }
}
