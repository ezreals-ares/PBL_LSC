<?php

namespace App\Filament\Customer\Resources\Payments\Pages;

use App\Filament\Customer\Resources\Payments\PaymentsResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePayments extends CreateRecord
{
    protected static string $resource = PaymentsResource::class;
}
