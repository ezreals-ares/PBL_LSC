<?php

namespace App\Filament\Customer\Resources\Reviews\Pages;

use App\Filament\Customer\Resources\Reviews\ReviewsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReviews extends EditRecord
{
    protected static string $resource = ReviewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
