<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProformaInvoice extends Model
{
    use HasFactory;

    protected $fillable = ['draft_purchase_order_id','user_id', 'approval_details', 'qoute_no', 'address', 'business_id', 'supplier_user_id', 'supplier_business_id', 'shipment_cost', 'total_cost', 'vat', 'rfq_no', 'rfq_item_no', 'payment_term', 'item_code', 'item_name', 'uom', 'packing', 'brand', 'quantity', 'unit_price', 'warranty', 'contract', 'delivery_city', 'warehouse_id', 'delivery_status', 'delivery_time', 'sub_total', 'vat', 'po_status', 'po_date', 'remarks', 'status'];

    public function purchase_order()
    {
        return $this->belongsTo(DraftPurchaseOrder::class, 'draft_purchase_order_id', 'id');
    }
}
