<?php

namespace App\Filament\Customer\Resources\OrderDetails\Pages;

use App\Filament\Customer\Resources\OrderDetails\OrderDetailsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderDetails extends CreateRecord
{
    protected static string $resource = OrderDetailsResource::class;
}
