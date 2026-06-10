<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    protected $table = 'exports';

    protected $guarded = [];

    protected $casts = [
        'completed_at' => 'datetime',
    ];
  
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}