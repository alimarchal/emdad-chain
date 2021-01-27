<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qoute extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'e_order_items_id', 'quote_quantity', 'quote_price_per_quantity', 'sample_information', 'sample_unit', 'sample_security_charges', 'sample_charges_per_unit', 'shipping_time_in_days', 'note_for_customer', 'status', 'qoute_status'];

    public function orderItem()
    {
        return $this->belongsTo(EOrderItems::class,'e_order_items_id','id');
    }
}
