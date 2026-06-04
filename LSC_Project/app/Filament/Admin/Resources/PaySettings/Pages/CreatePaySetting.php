<?php

namespace App\Filament\Admin\Resources\PaySettings\Pages;

use App\Filament\Admin\Resources\PaySettings\PaySettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePaySetting extends CreateRecord
{
    protected static string $resource = PaySettingResource::class;
}
