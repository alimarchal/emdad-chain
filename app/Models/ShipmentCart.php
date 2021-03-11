<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id', 'vehicle_type', 'supplier_business_id', 'delivery_id',
    ];

    public function delivery()
    {
       return $this->belongsTo(Delivery::class, 'delivery_id', 'id');
    }

    public function driver()
    {
       return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function vehicle()
    {
       return $this->belongsTo(Vehicle::class, 'vehicle_type', 'id');
    }
}
