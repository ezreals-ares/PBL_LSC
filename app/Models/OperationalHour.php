<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OperationalHour extends Model
{
    protected $primaryKey = 'operational_id';
    protected $fillable = ['outlet_id','day','open_time','close_time'];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'outlet_id');
    }
}