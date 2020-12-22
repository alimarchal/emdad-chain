<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POInfo extends Model
{
    use HasFactory;

    protected $fillable = ['business_id','user_id','type','volume','no_of_monthly_orders','order_info'];
}
