<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogisticsBusiness extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','business_name','business_photo_url','chamber_reg_number','chamber_reg_path','vat_reg_certificate_number','vat_reg_certificate_path','country','city','address','website','business_email','phone','mobile','bank_name','iban','longitude','latitude','legal_status','status',];

    public function packaging_solutions()
    {
        return $this->hasMany(PackagingSolution::class,'logistics_businesse_id');
    }

    public function storage_solutions()
    {
        return $this->hasMany(StorageSolution::class,'logistics_businesse_id');
    }

}
