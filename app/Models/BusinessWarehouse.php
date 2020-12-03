<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessWarehouse extends Model
{
    use HasFactory;

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function logistic_detail()
    {
        return $this->hasOne(BusinessWarehouse::class);
    }

}
