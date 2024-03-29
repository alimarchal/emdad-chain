<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EOrders extends Model
{
    use HasFactory;

    protected $fillable  = ['business_id', 'user_id', 'rfq_type', 'discard', 'status'];

    public function OrderItems()
    {
        return $this->hasMany(EOrderItems::class,'e_order_id');
    }

    public function userName()
    {
        return $this->hasMany(User::class,'id','user_id');
    }

    public function quotes()
    {
        return $this->hasMany(Qoute::class,'e_order_id');
    }
}
