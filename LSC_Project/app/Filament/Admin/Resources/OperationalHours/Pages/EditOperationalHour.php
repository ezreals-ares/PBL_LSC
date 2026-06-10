<?php

namespace App\Filament\Admin\Resources\OperationalHours\Pages;

use App\Filament\Admin\Resources\OperationalHours\OperationalHourResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOperationalHour extends EditRecord
{
    protected static string $resource = OperationalHourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
}
