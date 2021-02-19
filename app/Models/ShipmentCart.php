<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id', 'vehicle_type', 'business_id', 'delivery_id',
    ];
}
