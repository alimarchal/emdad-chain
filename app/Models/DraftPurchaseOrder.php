<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftPurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'approval_details', 'qoute_no', 'address', 'business_id', 'supplier_user_id', 'supplier_business_id', 'rfq_no', 'rfq_item_no', 'payment_term', 'item_code', 'item_name', 'uom', 'packing', 'brand', 'quantity', 'unit_price', 'warranty', 'contract', 'delivery_city', 'warehouse', 'delivery_status', 'delivery_time', 'sub_total', 'vat', 'shipment', 'po_status', 'po_date', 'remarks', 'status'];

    public function buyer_business()
    {
        return $this->belongsTo(Business::class, 'business_id', 'id');
    }

    public function supplier_business()
    {
        return $this->belongsTo(Business::class, 'supplier_business_id', 'id');
    }

    public function delivery_note()
    {
        return $this->hasOne(DeliveryNote::class);
    }
}
