<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ire extends Model
{
    use HasFactory;

    protected $fillable = ['ire_no', 'name', 'email', 'password','gender','bank','iban','nid_num','referred_no','type','mobile_number','status','rtl' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function sellerCommission()
    {
        return $this->belongsTo(IreCommission::class)->withDefault();
    }
}
