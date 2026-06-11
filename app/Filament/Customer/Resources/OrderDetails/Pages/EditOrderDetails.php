<?php

namespace App\Filament\Customer\Resources\OrderDetails\Pages;

use App\Filament\Customer\Resources\OrderDetails\OrderDetailsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrderDetails extends EditRecord
{
    protected static string $resource = OrderDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
