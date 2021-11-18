<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Utils;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'waiting_time', 'destination_coordinates', 'otp_mobile_number', 'status', 'delivery_note_id', 'draft_purchase_order_id', 'invoice_id', 'business_id', 'supplier_user_id', 'supplier_business_id', 'otp', 'warehouse_coordinates', 'shipment_cost', 'total_cost', 'vat', 'item_code', 'item_name', 'brand', 'quantity', 'unit_price', 'rfq_no', 'rfq_item_no', 'qoute_no', 'payment_term', 'shipment_status', 'delivery_address', 'driver_opt', 'review_status', 'driver_rating', 'buyer_rating', 'supplier_rating', 'emdad_rating', 'rfq_type'];

    /* For rating functions */
    public function eOrderItems()
    {
        return $this->belongsTo(EOrderItems::class, 'rfq_item_no','id');
    }

    /* For rating functions */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    /* Added for API */
    public function buyerBusiness()
    {
        return $this->belongsTo(Business::class, 'business_id','id');
    }

    /* For rating functions */
    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_user_id','id');
    }

    /* Added for API */
    public function supplierBusiness()
    {
        return $this->belongsTo(Business::class, 'supplier_business_id','id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id','id');
    }
}
