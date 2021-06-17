<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUpdateCertificate extends Model
{
    use HasFactory;

    protected $fillable = [ 'business_id', 'vat_reg_certificate_path', 'chamber_reg_path', 'business_photo_url', 'legal_officer_status'];

    public function business()
    {
        return $this->hasOne(Business::class,'id','business_id');
    }
}
