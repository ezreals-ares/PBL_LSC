<?php

namespace App\Filament\Admin\Resources\Outlets\Pages;

use App\Filament\Admin\Resources\Outlets\OutletResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOutlet extends EditRecord
{
    protected static string $resource = OutletResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
