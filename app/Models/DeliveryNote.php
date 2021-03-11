<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'draft_purchase_order_id', 'user_id', 'business_id', 'supplier_user_id', 'supplier_business_id', 'shipment_cost', 'total_cost', 'vat',
        'delivery_address', 'city', 'unit_price', 'quantity', 'otp_mobile_number', 'warranty', 'terms_and_conditions', 'update_user_id', 'status'
    ];

    public function purchase_order()
    {
        return $this->belongsTo(DraftPurchaseOrder::class, 'draft_purchase_order_id', 'id');
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }
}
