<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    // Actual DB primary key column name
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id', 'order_date', 'pickup_method', 'status',
        'estimated_finish', 'total_price',
        'jenis_sepatu', 'material_sepatu', 'catatan',
    ];

    // ─── Relationships ─────────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'order_id', 'order_id');
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class, 'order_id', 'order_id');
    }
}