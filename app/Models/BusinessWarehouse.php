<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessWarehouse extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'designation', 'name', 'warehouse_email', 'landline',
        'mobile', 'country', 'city', 'longitude', 'latitude', 'warehouse_type', 'cold_storage',
        'gate_type', 'fork_lift', 'total_warehouse_manpower', 'number_of_delivery_vehicles',
        'number_of_drivers', 'vehicle_category', 'vehicle_type', 'working_time',];

    public function business()
    {
        return $this->belongsTo(Business::class)->withDefault();
    }

    public function logistic_detail()
    {
        return $this->hasOne(BusinessWarehouse::class);
    }

}
