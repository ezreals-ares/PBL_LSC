<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel ini menyimpan pengaturan metode pembayaran yang ditampilkan
     * kepada pelanggan saat mengunggah bukti pembayaran.
     * Mendukung dua jenis: QRIS (dengan gambar QR) dan Bank Transfer
     * (dengan nama penerima, nama bank, dan nomor rekening).
     */
    public function up(): void
    {
        Schema::create('pay_settings', function (Blueprint $table) {
            $table->id();

            // Jenis metode pembayaran: 'qris' atau 'bank'
            $table->enum('type', ['qris', 'bank'])->unique();

            // Aktif / non-aktif metode pembayaran ini
            $table->boolean('is_active')->default(true);

            // ── Field khusus QRIS ──────────────────────────────────
            // Path gambar QR code yang disimpan di storage
            $table->string('qris_image')->nullable();

            // Nama merchant / keterangan QRIS
            $table->string('qris_merchant_name')->nullable();

            // ── Field khusus Bank Transfer ─────────────────────────
            // Nama lengkap pemilik rekening (penerima)
            $table->string('bank_account_name')->nullable();

            // Nama bank (contoh: BCA, BRI, Mandiri, BNI, dll.)
            $table->string('bank_name')->nullable();

            // Nomor rekening bank
            $table->string('bank_account_number')->nullable();

            // Catatan tambahan yang ditampilkan ke pelanggan (opsional)
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_settings');
    }
};
