<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_business_id', 'warehouse_id', 'type', 'licence_plate_No', 'availability_status', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function businessWarehouse()
    {
        return $this->belongsTo(BusinessWarehouse::class);
    }
}
