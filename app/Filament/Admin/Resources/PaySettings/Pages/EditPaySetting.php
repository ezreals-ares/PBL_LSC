<?php

namespace App\Filament\Admin\Resources\PaySettings\Pages;

use App\Filament\Admin\Resources\PaySettings\PaySettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPaySetting extends EditRecord
{
    protected static string $resource = PaySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
