<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $primaryKey = 'order_detail_id';
    protected $fillable = ['order_id','service_id','quantity','subtotal'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }
}