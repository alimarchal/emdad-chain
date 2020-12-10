<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessFinanceDetail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'landline', 'mobile', 'bank_name', 'iban','designation', 'business_id'];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
