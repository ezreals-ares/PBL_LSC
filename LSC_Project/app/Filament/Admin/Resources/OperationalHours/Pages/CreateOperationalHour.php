<?php

namespace App\Filament\Admin\Resources\OperationalHours\Pages;

use App\Filament\Admin\Resources\OperationalHours\OperationalHourResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOperationalHour extends CreateRecord
{
    protected static string $resource = OperationalHourResource::class;
}
