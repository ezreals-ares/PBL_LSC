<?php

namespace App\Filament\Admin\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_id')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('payment_date')
                    ->label('Tanggal Pembayaran')
                    ->date()
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Jumlah Pembayaran')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge() 
                        ->color(fn (string $state): string => match ($state) {
                            'verified' => 'success',
                            'unverified' => 'warning',
                            default => 'gray',
                        })
                    ->searchable(),
                ImageColumn::make('payment_proof')
                    ->label('Bukti Pembayaran')
                    ->disk('public'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
