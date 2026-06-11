<?php

namespace App\Filament\Admin\Resources\PaySettings;

use App\Filament\Admin\Resources\PaySettings\Pages\CreatePaySetting;
use App\Filament\Admin\Resources\PaySettings\Pages\EditPaySetting;
use App\Filament\Admin\Resources\PaySettings\Pages\ListPaySettings;
use App\Filament\Admin\Resources\PaySettings\Schemas\PaySettingForm;
use App\Filament\Admin\Resources\PaySettings\Tables\PaySettingsTable;
use App\Models\PaySetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PaySettingResource extends Resource
{
    protected static ?string $model = PaySetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected static ?string $navigationLabel = 'Pengaturan Pembayaran';

    protected static ?string $modelLabel = 'Metode Pembayaran';

    protected static ?string $pluralModelLabel = 'Pengaturan Pembayaran';

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'type';

    public static function form(Schema $schema): Schema
    {
        return PaySettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaySettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPaySettings::route('/'),
            'create' => CreatePaySetting::route('/create'),
            'edit'   => EditPaySetting::route('/{record}/edit'),
        ];
    }
}
