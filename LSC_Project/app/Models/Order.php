<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'user_id','order_date','pickup_method','status',
        'estimated_finish','total_price','jenis_sepatu'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'order_id');
    }
    public function review()
    {
        return $this->hasOne(Review::class, 'order_id', 'order_id');
    }
}