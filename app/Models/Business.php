<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function warehouse()
    {
        return $this->hasMany(BusinessWarehouse::class);
    }

    public function business_finance_details()
    {
        return $this->hasMany(BusinessFinanceDetail::class);
    }

}
