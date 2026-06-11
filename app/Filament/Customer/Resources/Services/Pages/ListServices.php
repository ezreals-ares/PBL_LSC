<?php

namespace App\Filament\Customer\Resources\Services\Pages;

use App\Filament\Customer\Resources\Services\ServicesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
