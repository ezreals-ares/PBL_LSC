<?php

namespace App\Filament\Admin\Resources\Outlets\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class OutletForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Outlet')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('address')
                            ->required(),
                    ]),

                Section::make('Jam Operasional')
                    ->schema([
                        Repeater::make('operationalHours')
                            ->relationship('operationalHours')
                            ->schema([
                                Select::make('day')
                                    ->label('Hari')
                                    ->options([
                                        'Monday' => 'Senin',
                                        'Tuesday' => 'Selasa',
                                        'Wednesday' => 'Rabu',
                                        'Thursday' => 'Kamis',
                                        'Friday' => 'Jumat',
                                        'Saturday' => 'Sabtu',
                                        'Sunday' => 'Minggu',
                                    ])
                                    ->required()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems(),

                                TimePicker::make('open_time')
                                    ->label('Buka')
                                    ->native(false)
                                    ->displayFormat('H:i')
                                    ->required(),

                                TimePicker::make('close_time')
                                    ->label('Tutup')
                                    ->native(false)
                                    ->displayFormat('H:i')
                                    ->required(),
                            ])
                            ->columns(3)
                            ->defaultItems(7)
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false),
                    ]),
            ]);
    }
}