<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentItem extends Model
{
    use HasFactory;

    protected $fillable = ['driver_id', 'vehicle_id', 'supplier_business_id', 'rfq_no', 'delivery_id','status'];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class,'deliveries.id','shipment_items.delivery_id');
    }




}
