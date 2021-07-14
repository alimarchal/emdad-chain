<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'gender',
        'name',
        'middle_initial',
        'family_name',
        'ire_no',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'business_id',
        'profile_photo_path',
        'mobile',
        'user_type',
        'nid_num',
        'nid_exp_date',
        'is_active',
        'rtl',
        'status',
    ];
}
