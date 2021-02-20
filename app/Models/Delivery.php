<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'invoice_id', 'business_id', 'item_code', 'item_name', 'uom', 'packing', 'brand', 'quantity', 'unit_price', 'rfq_no', 'rfq_item_no', 'qoute_no', 'payment_term', 'shipment_status', 'delivery_address'];
}
