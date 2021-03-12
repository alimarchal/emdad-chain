<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['delivery_id', 'rfq_no', 'rfq_item_no',
        'qoute_no', 'draft_purchase_order_id', 'buyer_user_id',
        'buyer_business_id', 'supplier_user_id', 'supplier_business_id',
        'shipment_cost', 'total_cost', 'vat', 'payment_method', 'ship_to_address', 'invoice_type'];

    public function purchase_order()
    {
        return $this->belongsTo(DraftPurchaseOrder::class, 'draft_purchase_order_id', 'id');
    }
}
