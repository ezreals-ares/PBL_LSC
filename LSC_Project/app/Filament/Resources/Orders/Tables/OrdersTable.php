<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Forms\Components\DatePicker;
use Filament\Infolists\Components\Tabs;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\ProductExporter;
use Filament\Actions\ExportAction;
use Filament\Tables\Table;


class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_id')
                    ->label('ID')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),
                TextColumn::make('shoe_type')
                    ->label('Jenis Sepatu')
                    ->searchable(),
                TextColumn::make('order_date')
                    ->label('Tanggal Order')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('pickup_method')
                    ->label('Metode'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending'    => 'warning',
                        'diproses'   => 'info',
                        'selesai'    => 'success',
                        'dibatalkan' => 'danger',
                        default      => 'gray',
                    }),
                TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('order_date')
                    ->form([
                        DatePicker::make('created_from')->label('Dari Tanggal'),
                        DatePicker::make('created_until')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('order_date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('order_date', '<=', $date),
                            );
                    })
                    ->columnSpan(1),
                SelectFilter::make('pickup_method')
                    ->label('Metode Pengiriman')
                    ->options([
                        'pickup' => 'Pickup',
                        'antar langsung' => 'Antar Langsung',
                    ])
                    ->columnSpan(1),
            ])
            ->filtersFormColumns(3)
            ->headerActions([
                ExportAction::make()
                    ->label('Export CSV')
                    ->color('primary'),
            ])
            ->recordActions([
                
            ]);
    }
}