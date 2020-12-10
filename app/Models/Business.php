<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'business_name', 'num_of_warehouse', 'category_number', 'business_type', 'chamber_reg_number', 'chamber_reg_path', 'vat_reg_certificate_number', 'vat_reg_certificate_path', 'country', 'city', 'address', 'website', 'business_email', 'phone', 'mobile', 'longitude', 'latitude', 'supplier_client', 'status'];

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

    public function purchase_request_forms()
    {
        return $this->hasMany(PurchaseRequestForm::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quatation::class);
    }

}
