<?php

namespace App\Filament\Admin\Resources\OperationalHours;

use App\Filament\Admin\Resources\OperationalHours\Pages\CreateOperationalHour;
use App\Filament\Admin\Resources\OperationalHours\Pages\EditOperationalHour;
use App\Filament\Admin\Resources\OperationalHours\Pages\ListOperationalHours;
use App\Filament\Admin\Resources\OperationalHours\Schemas\OperationalHourForm;
use App\Filament\Admin\Resources\OperationalHours\Tables\OperationalHoursTable;
use App\Models\OperationalHour;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OperationalHourResource extends Resource
{
    protected static ?string $model = OperationalHour::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    public static function form(Schema $schema): Schema
    {
        return OperationalHourForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OperationalHoursTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOperationalHours::route('/'),
            'create' => CreateOperationalHour::route('/create'),
            'edit' => EditOperationalHour::route('/{record}/edit'),
        ];
    }
}
