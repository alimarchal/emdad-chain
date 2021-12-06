<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageManualPayment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'business_id', 'business_type', 'package_id','bank_name', 'amount_received', 'account_number', 'amount_date', 'receipt', 'upgrade', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id','id');
    }
}
