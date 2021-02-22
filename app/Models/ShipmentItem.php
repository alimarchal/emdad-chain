<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id', 'vehicle_type', 'supplier_business_id', 'delivery_id',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}
