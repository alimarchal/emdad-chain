<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerRating extends Model
{
    use HasFactory;

    protected $fillable = ['buyer_user_id','buyer_business_id','rating_business_id','buyer_rating_type','buyer_recommend','rating',];
}
