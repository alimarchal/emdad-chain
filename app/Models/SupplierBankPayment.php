<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierBankPayment extends Model
{
    use HasFactory;

    protected $fillable = [ 'bank_payment_id', 'bank_name','rfq_no', 'amount_received', 'account_number', 'amount_date', 'file_path', 'supplier_business_id', 'supplier_user_id', 'status', 'rfq_type'];

    public function bankPayment()
    {
        return $this->belongsTo(BankPayment::class,'bank_payment_id', 'id');
    }
}
