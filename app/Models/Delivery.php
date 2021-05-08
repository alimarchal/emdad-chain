<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'waiting_time', 'destination_coordinates', 'otp_mobile_number', 'status', 'delivery_note_id', 'draft_purchase_order_id', 'invoice_id', 'business_id', 'supplier_user_id', 'supplier_business_id', 'otp', 'warehouse_coordinates', 'shipment_cost', 'total_cost', 'vat', 'item_code', 'item_name', 'brand', 'quantity', 'unit_price', 'rfq_no', 'rfq_item_no', 'qoute_no', 'payment_term', 'shipment_status', 'delivery_address', 'driver_opt', 'review_status'];
}
