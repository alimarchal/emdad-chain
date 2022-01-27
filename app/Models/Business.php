<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Codebyray\ReviewRateable\Contracts\ReviewRateable;
use Codebyray\ReviewRateable\Traits\ReviewRateable as ReviewRateableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Business extends Model implements ReviewRateable
{
    use HasFactory;
    use ReviewRateableTrait;

    protected $fillable = ['user_id', 'business_name', 'business_photo_url', 'num_of_warehouse', 'category_number', 'business_type', 'chamber_reg_number', 'chamber_reg_path', 'vat_reg_certificate_number', 'vat_reg_certificate_path', 'country', 'city', 'address', 'website', 'business_email', 'phone', 'mobile', 'longitude', 'latitude', 'legal_status', 'finance_status', 'sc_supervisor_status', 'supplier_client', 'status', 'iban', 'bank_name'];

    protected $appends = ['business_photo_url_full'];

    public function getBusinessPhotoUrlFullAttribute()
    {
        return url(\Storage::url($this->business_photo_url));
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(BusinessCategory::class)->withDefault();
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function poinfo()
    {
        return $this->hasMany(POInfo::class);
    }

    public function businessPackage(): HasOne
    {
        return $this->hasOne(BusinessPackage::class, 'business_id','id');
    }

}
