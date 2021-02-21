<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingDelivery extends Model
{
    use HasFactory;

    protected $fillable = ['delivery_id', 'timestamp', 'coordinates', 'vehicle_id', 'driver_id'];
}
