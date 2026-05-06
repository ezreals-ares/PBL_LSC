<?php

namespace App\Filament\Admin\Resources\Orders\Tables;

use App\Filament\Admin\Exports\OrderExporter;
use Filament\Actions\ExportAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

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
                TextColumn::make('jenis_sepatu')
                    ->label('Merek Sepatu')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('material_sepatu')
                    ->label('Material')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('catatan')
                    ->label('Catatan')
                    ->limit(40)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('order_date')
                    ->label('Tanggal Order')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('pickup_method')
                    ->label('Metode'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'diproses' => 'info',
                        'selesai' => 'success',
                        'dibatalkan' => 'danger',
                        default => 'gray',
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

                
                SelectFilter::make('service_id')
                    ->label('Kategori Layanan')
                    ->relationship('orderDetails.service', 'service_name')
                    ->searchable()
                    ->preload()
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
                    ->exporter(OrderExporter::class)
                    ->label('Export CSV')
                    ->color('primary'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),

            ])
            ->toolbarActions([
                bulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
