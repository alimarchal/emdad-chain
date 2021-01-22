<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EOrders extends Model
{
    use HasFactory;

    protected $fillable  = ['business_id', 'user_id', 'status'];

    public function order_items()
    {
        return $this->hasMany(EOrderItems::class);
    }
}
