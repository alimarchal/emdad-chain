<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftPurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'address', 'business_id', 'supplier_user_id', 'supplier_business_id', 'rfq_no', 'rfq_item_no', 'payment_term', 'item_code', 'item_name', 'uom', 'packing', 'brand', 'quantity', 'unit_price', 'warranty', 'contract', 'delivery_city', 'warehouse', 'delivery_status', 'delivery_time', 'sub_total', 'vat', 'shipment', 'po_status', 'po_date', 'remarks', 'status'];
}
