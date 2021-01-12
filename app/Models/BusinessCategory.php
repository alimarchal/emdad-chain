<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BusinessCategory extends Model
{
    use HasFactory, LogsActivity;
    protected static $logAttributes = ['*'];

    protected $fillable = ['business_id','category_number'];
}
