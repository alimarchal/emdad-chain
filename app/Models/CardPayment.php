<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardPayment extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'user_id','status','amount','invoice_id','invoice_transaction_id'];
}
