<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $primaryKey = 'outlet_id';
    protected $fillable = ['outlet_name','address','google_maps_link','phone'];

    public function operationalHours()
    {
        return $this->hasMany(OperationalHour::class, 'outlet_id', 'outlet_id');
    }
}