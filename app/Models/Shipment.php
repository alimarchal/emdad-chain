<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id', 'supplier_business_id', 'buyer_business_id','status'
    ];

    public function shipmentItems()
    {
        return $this->hasMany(ShipmentItem::class);
    }
}
