<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequestForm extends Model
{
    use HasFactory;

    protected $fillable = ['item_code', 'item_name', 'user_id', 'business_id'
        , 'description', 'unit_of_measurement', 'size', 'quantity', 'brand', 'last_price', 'delivery_period'
        , 'remarks','file_path'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quatation::class);
    }
}
