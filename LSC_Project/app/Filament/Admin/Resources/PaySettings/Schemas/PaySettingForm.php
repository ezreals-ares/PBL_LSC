<?php

namespace App\Filament\Admin\Resources\PaySettings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaySettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informasi Metode Pembayaran')
                ->columns(2)
                ->schema([

                    Select::make('type')
                        ->label('Jenis Metode')
                        ->options([
                            'qris' => 'QRIS',
                            'bank' => 'Transfer Bank',
                        ])
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->native(false)
                        ->helperText('Setiap jenis hanya boleh ada satu record.'),

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->helperText('Nonaktifkan untuk menyembunyikan dari pelanggan.')
                        ->default(true),

                    TextInput::make('label_name')
                        ->label('Nama')
                        ->placeholder('Nama merchant / nama pemilik rekening')
                        ->helperText('Untuk QRIS: nama merchant. Untuk Bank: nama pemilik rekening.')
                        ->maxLength(100),

                    TextInput::make('provider_name')
                        ->label('Provider / Nama Bank')
                        ->placeholder('contoh: BCA, BRI, Mandiri, QRIS')
                        ->helperText('Untuk Bank: nama bank. Untuk QRIS: bisa dikosongkan atau diisi "QRIS".')
                        ->maxLength(50),

                    TextInput::make('account_number')
                        ->label('Nomor Rekening / Kode Referensi')
                        ->placeholder('contoh: 1234567890')
                        ->helperText('Untuk Bank: nomor rekening. Untuk QRIS: bisa dikosongkan.')
                        ->maxLength(30),

                    TextInput::make('account_name')
                        ->label('Atas Nama')
                        ->placeholder('contoh: Lose ShoesCare')
                        ->helperText('Untuk Bank: nama pemilik rekening. Untuk QRIS: bisa dikosongkan.')
                        ->maxLength(100),

                    Textarea::make('notes')
                        ->label('Catatan / Instruksi')
                        ->placeholder('Instruksi yang ditampilkan ke pelanggan...')
                        ->rows(3)
                        ->columnSpanFull(),

                    FileUpload::make('payment_image')
                        ->label('Gambar QR Code / Logo')
                        ->image()
                        ->disk('public')
                        ->directory('pay-settings')
                        ->imagePreviewHeight('200')
                        ->helperText('Untuk QRIS: upload gambar QR Code. Untuk Bank: opsional.')
                        ->maxSize(2048)
                        ->columnSpanFull(),

                ]),
        ]);
    }
}
