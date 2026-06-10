<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Rename kolom pay_settings agar lebih generik
     * sehingga mendukung CRUD yang bersih di Filament
     * tanpa perlu form kondisional.
     *
     *  qris_merchant_name  → label_name      (nama merchant / pemilik rekening)
     *  bank_name           → provider_name   (nama bank / provider QRIS)
     *  bank_account_number → account_number  (nomor rekening / kode referensi)
     *  qris_image          → payment_image   (gambar QR / logo bank)
     */
    public function up(): void
    {
        Schema::table('pay_settings', function (Blueprint $table) {
            $table->renameColumn('qris_merchant_name',  'label_name');
            $table->renameColumn('bank_name',           'provider_name');
            $table->renameColumn('bank_account_number', 'account_number');
            $table->renameColumn('qris_image',          'payment_image');
            $table->renameColumn('bank_account_name',   'account_name');
        });
    }

    public function down(): void
    {
        Schema::table('pay_settings', function (Blueprint $table) {
            $table->renameColumn('label_name',     'qris_merchant_name');
            $table->renameColumn('provider_name',  'bank_name');
            $table->renameColumn('account_number', 'bank_account_number');
            $table->renameColumn('payment_image',  'qris_image');
            $table->renameColumn('account_name',   'bank_account_name');
        });
    }
};
