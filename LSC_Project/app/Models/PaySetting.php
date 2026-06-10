<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaySetting extends Model
{
    protected $table = 'pay_settings';

    protected $fillable = [
        'type',
        'is_active',
        'label_name',      // Nama merchant (QRIS) / Nama pemilik rekening (Bank)
        'provider_name',   // Nama provider / nama bank
        'account_number',  // Nomor rekening / kode referensi QRIS
        'account_name',    // Atas nama rekening
        'payment_image',   // Gambar QR code / logo
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ── Scopes ────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    // ── Helpers ───────────────────────────────────────────────────────

    public function isQris(): bool { return $this->type === 'qris'; }
    public function isBank(): bool { return $this->type === 'bank'; }

    // ── Static Helpers ────────────────────────────────────────────────

    public static function getQris(): ?self
    {
        return static::active()->ofType('qris')->first();
    }

    public static function getBank(): ?self
    {
        return static::active()->ofType('bank')->first();
    }

    public static function getActiveMethods(): \Illuminate\Database\Eloquent\Collection
    {
        return static::active()->get();
    }
}
