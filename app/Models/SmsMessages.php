<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsMessages extends Model
{
    use HasFactory;

    protected $fillable = ['category','arabic_message','english_message',];
}
