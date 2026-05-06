<?php

namespace App\Filament\Customer\Resources\OrderDetails;

use App\Filament\Customer\Resources\OrderDetails\Pages\CreateOrderDetails;
use App\Filament\Customer\Resources\OrderDetails\Pages\EditOrderDetails;
use App\Filament\Customer\Resources\OrderDetails\Pages\ListOrderDetails;
use App\Filament\Customer\Resources\OrderDetails\Schemas\OrderDetailsForm;
use App\Filament\Customer\Resources\OrderDetails\Tables\OrderDetailsTable;
use App\Models\OrderDetail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrderDetailsResource extends Resource
{
    protected static ?string $model = OrderDetail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return OrderDetailsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderDetailsTable::configure($table);
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
            'index' => ListOrderDetails::route('/'),
            'create' => CreateOrderDetails::route('/create'),
            'edit' => EditOrderDetails::route('/{record}/edit'),
        ];
    }
}
