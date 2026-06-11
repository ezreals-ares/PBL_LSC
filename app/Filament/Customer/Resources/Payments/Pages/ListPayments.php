<?php

namespace App\Filament\Customer\Resources\Payments\Pages;

use App\Filament\Customer\Resources\Payments\PaymentsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
