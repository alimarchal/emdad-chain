<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryComment extends Model
{
    use HasFactory;

    protected $fillable = ['delivery_id','user_id','comment_content','comment_type','rating',];
}
