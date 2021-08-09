<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedRequisition extends Model
{
    use HasFactory;

    public $fillable = ['e_order_id', 'user_id'];
}
