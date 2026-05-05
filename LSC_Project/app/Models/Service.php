<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $primaryKey = 'service_id';
    protected $fillable = ['service_name','description','price','estimated_days','gambar'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'service_id', 'service_id');
    }
}