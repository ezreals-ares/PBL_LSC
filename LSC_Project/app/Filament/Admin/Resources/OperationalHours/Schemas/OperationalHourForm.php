<?php

namespace App\Filament\Admin\Resources\OperationalHours\Schemas;

use Filament\Forms\Components\Select;
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

                Select::make('day')
                    ->label('Hari')
                    ->options([
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                        'Sabtu' => 'Sabtu',
                        'Minggu' => 'Minggu',
                    ])
                    ->required(),

                TimePicker::make('open_time')
                    ->label('Jam Buka')
                    ->native(false)
                    ->displayFormat('H:i')
                    ->required(),

                TimePicker::make('close_time')
                    ->label('Jam Tutup')
                    ->native(false)
                    ->displayFormat('H:i')
                    ->required(),
            ]);
    }
}
