<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QouteMessage extends Model
{
    use HasFactory;

    protected $fillable = ['qoute_id', 'user_id', 'message','usertype'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
