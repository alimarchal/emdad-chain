<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_type','user_type','charges','registeration','category','quotations','emdad_tools','super_admin_count',
        'users','truck','driver','rfq_per_day','quotations_per_rfq','payment_type','training','discount_code','status'];

}
