<?php

namespace App\Filament\Customer\Resources\OrderDetails\Pages;

use App\Filament\Customer\Resources\OrderDetails\OrderDetailsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrderDetails extends ListRecords
{
    protected static string $resource = OrderDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
