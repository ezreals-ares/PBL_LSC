<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'service_id';
    protected $fillable = ['service_name', 'description', 'price', 'estimated_days', 'gambar'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'service_id', 'service_id');
    }
}