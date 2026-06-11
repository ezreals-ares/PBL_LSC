<?php

namespace App\Filament\Admin\Resources\PaySettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaySettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'qris' ? 'QRIS' : 'Transfer Bank')
                    ->color(fn ($state) => $state === 'qris' ? 'info' : 'success'),

                TextColumn::make('label_name')
                    ->label('Nama')
                    ->placeholder('—'),

                TextColumn::make('provider_name')
                    ->label('Provider / Bank')
                    ->placeholder('—'),

                TextColumn::make('account_number')
                    ->label('No. Rekening')
                    ->placeholder('—')
                    ->copyable()
                    ->copyMessage('Nomor disalin!'),

                ImageColumn::make('payment_image')
                    ->label('Gambar')
                    ->disk('public')
                    ->height(50)
                    ->placeholder('—'),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('type');
    }
}
