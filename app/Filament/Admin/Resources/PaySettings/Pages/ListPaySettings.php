<?php

namespace App\Filament\Admin\Resources\PaySettings\Pages;

use App\Filament\Admin\Resources\PaySettings\PaySettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPaySettings extends ListRecords
{
    protected static string $resource = PaySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Metode Pembayaran'),
        ];
    }
}
