<?php

namespace App\Filament\Admin\Resources\Reviews\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->label('Pengguna')
                    ->required()
                    ->numeric(),
                TextInput::make('order_id')
                    ->label('Pesanan')
                    ->required()
                    ->numeric(),
                TextInput::make('rating')
                    ->label('Rating')
                    ->required()
                    ->numeric(),
                FileUpload::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->fetchFileInformation(false)
                    ->image()
                    ->directory('review-images'),
                Textarea::make('comment')
                    ->label('Komentar')
                    ->columnSpanFull(),
                
            ]);
    }
}
