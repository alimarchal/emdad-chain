<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id','business_type','business_id','package_id','user_id','invoice_id','manual_payment_id','categories','subscription_start_date','subscription_end_date','last_promocode',
        'promocode_given_count','promocode_used_count','status'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
