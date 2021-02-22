<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qoute extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'qoute_no', 'dpo', 'supplier_business_id', 'supplier_user_id', 'qoute_status_updated', 'qoute_updated_user_id',  'qoute_updated_user_id', 'e_order_items_id', 'e_order_id', 'business_id', 'warehouse_id', 'business_id_buyer', 'quote_quantity', 'quote_price_per_quantity', 'sample_information', 'sample_unit', 'sample_security_charges', 'sample_charges_per_unit', 'shipping_time_in_days', 'note_for_customer', 'status', 'qoute_status'];

    public function orderItem()
    {
        return $this->belongsTo(EOrderItems::class, 'e_order_items_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function RFQ()
    {
        return $this->belongsTo(EOrders::class, 'e_order_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany(QouteMessage::class);
    }
}
