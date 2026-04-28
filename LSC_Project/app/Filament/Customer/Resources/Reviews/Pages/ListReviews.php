<?php

namespace App\Filament\Customer\Resources\Reviews\Pages;

use App\Filament\Customer\Resources\Reviews\ReviewsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReviews extends ListRecords
{
    protected static string $resource = ReviewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
