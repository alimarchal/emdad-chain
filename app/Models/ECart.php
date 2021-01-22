<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ECart extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code', 'item_name', 'user_id', 'business_id', 'description', 'unit_of_measurement', 'size', 'quantity', 'brand', 'last_price', 'delivery_period', 'remarks', 'file_path', 'required_sample', 'payment_mode','status'
    ];
}
