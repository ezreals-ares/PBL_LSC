<?php
namespace App\Filament\Admin\Resources\Users\Tables;

use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('role')->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make()
                    ->modalHeading(fn ($record) => 'Detail User: ' . $record->name)
                    ->modalWidth('4xl')
                    ->infolist([

                        Section::make('Statistik')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                TextEntry::make('total_orders')
                                    ->label('Total Order')
                                    ->state(fn ($record) => $record->orders()->count() . ' Kali')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('total_spent')
                                    ->label('Total Pengeluaran')
                                    ->state(fn ($record) =>
                                        'Rp ' . number_format(
                                            $record->orders()->sum('total_price'), 0, ',', '.'
                                        )
                                    )
                                    ->badge()
                                    ->color('warning'),
                            ])
                            ->columns(2),

                        Section::make('Riwayat Order')
                            ->icon('heroicon-o-clipboard-document-list')
                            ->schema([
                                RepeatableEntry::make('orders')
                                    ->label('')
                                    ->schema([

                                        // Info order utama
                                        TextEntry::make('order_number')
                                            ->label('No. Order')
                                            ->badge()
                                            ->color('gray'),

                                        TextEntry::make('status')
                                            ->label('Status')
                                            ->badge()
                                            ->color(fn ($state) => match($state) {
                                                'pending'    => 'warning',
                                                'processing' => 'info',
                                                'completed'  => 'success',
                                                'cancelled'  => 'danger',
                                                default      => 'gray',
                                            }),

                                        TextEntry::make('created_at')
                                            ->label('Tanggal Order')
                                            ->dateTime('d M Y H:i'),

                                        TextEntry::make('total_price')
                                            ->label('Total Harga')
                                            ->money('IDR'),

                                        RepeatableEntry::make('orderDetails')
                                            ->label('Item Dipesan')
                                            ->schema([
                                                TextEntry::make('service.name')
                                                    ->label('Layanan'),

                                                TextEntry::make('quantity')
                                                    ->label('Qty')
                                                    ->badge()
                                                    ->color('info'),

                                                TextEntry::make('subtotal')
                                                    ->label('Subtotal')
                                                    ->money('IDR'),
                                            ])
                                            ->columns(3),
                                    ])
                                    ->columns(4),
                            ]),
                    ]),

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