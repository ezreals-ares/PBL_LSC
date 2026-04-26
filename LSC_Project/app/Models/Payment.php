<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';
    protected $fillable = ['order_id','payment_date','amount','payment_method','status','payment_proof'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}