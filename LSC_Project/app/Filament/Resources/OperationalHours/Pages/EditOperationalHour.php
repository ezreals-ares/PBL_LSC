<?php

namespace App\Filament\Resources\OperationalHours\Pages;

use App\Filament\Resources\OperationalHours\OperationalHourResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOperationalHour extends EditRecord
{
    protected static string $resource = OperationalHourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
