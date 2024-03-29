<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['delivery_id', 'rfq_no', 'rfq_item_no',
        'qoute_no', 'draft_purchase_order_id', 'buyer_user_id',
        'buyer_business_id', 'supplier_user_id', 'supplier_business_id',
        'shipment_cost', 'total_cost', 'vat', 'payment_method', 'ship_to_address', 'invoice_type', 'rfq_type','invoice_cash_online'];

    public function purchase_order()
    {
        return $this->belongsTo(DraftPurchaseOrder::class, 'draft_purchase_order_id', 'id');
    }

    public function quote()
    {
        return $this->belongsTo(Qoute::class, 'qoute_no', 'id');
    }

    public function eOrderItem()
    {
        return $this->belongsTo(EOrderItems::class, 'rfq_item_no', 'id');
    }

    public function bankPayment()
    {
        return $this->hasOne(BankPayment::class, 'invoice_id');
    }

    public function deliveryNote(): HasOne
    {
        return $this->hasOne(DeliveryNote::class, 'draft_purchase_order_id','draft_purchase_order_id');
    }
}
