<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECart extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name_check','item_code', 'item_name', 'user_id', 'warehouse_id', 'business_id', 'description', 'unit_of_measurement', 'size', 'quantity', 'brand', 'last_price', 'delivery_period', 'remarks', 'file_path', 'required_sample', 'payment_mode', 'rfq_type','status'
    ];
}
