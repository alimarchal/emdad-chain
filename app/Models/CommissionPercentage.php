<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionPercentage extends Model
{
    use HasFactory;

    protected $fillable = [ 'commission_type','package_type','amount_type','amount','ire_type',];
}
