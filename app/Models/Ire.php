<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Ire extends Model
{
    use HasFactory;

    protected $fillable = ['ire_no', 'name', 'email', 'password', 'email_verified_at','gender','bank','iban','nid_num','nid_image','referred_no','type','mobile_number','status','rtl' ];

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

    public function ireCommission()
    {
        return $this->belongsTo(IreCommission::class)->withDefault();
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank', 'id')->withDefault();
    }
}
