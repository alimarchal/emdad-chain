<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EOrderItems extends Model
{
    use HasFactory;

    protected $fillable =  [
        'company_name_check','item_code', 'item_name', 'user_id', 'warehouse_id', 'business_id', 'description', 'unit_of_measurement', 'size', 'quantity', 'brand', 'last_price', 'delivery_period', 'remarks', 'file_path', 'required_sample', 'payment_mode', 'order_id', 'discard', 'status', 'bypass', 'quotation_time', 'rfq_type'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function orders()
    {
        return $this->belongsTo(EOrders::class,'e_order_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function qoutes()
    {
        return $this->hasMany(Qoute::class,'e_order_items_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'item_code');
    }

    public function warehouse()
    {
        return $this->hasOne(BusinessWarehouse::class,'id', 'warehouse_id');
    }
}
