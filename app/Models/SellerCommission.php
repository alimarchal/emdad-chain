<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerCommission extends Model
{
    use HasFactory;

    protected $fillable = ['seller_no', 'user_id', 'payment_status'];

    public function sellerReference()
    {
        return $this->belongsTo(Seller::class, 'user_id','id');
    }

}
