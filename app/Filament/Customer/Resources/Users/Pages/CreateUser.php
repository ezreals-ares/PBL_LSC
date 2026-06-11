<?php

namespace App\Filament\Customer\Resources\Users\Pages;

use App\Filament\Customer\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
