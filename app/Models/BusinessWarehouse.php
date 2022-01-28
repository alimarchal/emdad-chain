<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BusinessWarehouse extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'business_id', 'designation', 'warehouse_name', 'name', 'warehouse_email', 'landline',
        'mobile','mobile_verified','mobile_verification_code', 'country', 'address', 'city', 'longitude', 'latitude', 'warehouse_type', 'cold_storage',
        'gate_type', 'fork_lift', 'total_warehouse_manpower', 'number_of_delivery_vehicles',
        'number_of_drivers', 'vehicle_category', 'vehicle_type', 'working_time',];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class)->withDefault();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function logistic_detail(): HasOne
    {
        return $this->hasOne(BusinessWarehouse::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

}
