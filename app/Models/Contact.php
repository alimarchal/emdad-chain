<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Contact extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected static $logAttributes = ['status'];
    protected $fillable = ['name','email','phone','subject','message','language','status'];

}
