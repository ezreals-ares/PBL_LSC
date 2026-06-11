<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    // Actual DB primary key
    protected $primaryKey = 'payment_id';

    // Actual DB columns: payment_id, order_id, payment_date, amount,
    //                    payment_method (enum: e-wallet|bank-transfer),
    //                    status (enum: unverified|verified),
    //                    payment_proof, timestamps
    protected $fillable = [
        'order_id',
        'payment_date',
        'amount',
        'payment_method',
        'status',
        'payment_proof',
    ];

    // ─── Relationships ─────────────────────────────────────────────────────────

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}