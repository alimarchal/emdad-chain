<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankPayment extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id','delivery_id','draft_purchase_order_id','quote_no','bank_name','amount_received','amount_date','account_number','supplier_business_id','supplier_user_id','buyer_business_id','buyer_user_id','file_path','status'];

//    public function getRouteKeyName()
//    {
//        return 'bank_name';
//    }
}
