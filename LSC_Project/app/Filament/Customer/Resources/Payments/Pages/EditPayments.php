<?php

namespace App\Filament\Customer\Resources\Payments\Pages;

use App\Filament\Customer\Resources\Payments\PaymentsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPayments extends EditRecord
{
    protected static string $resource = PaymentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
