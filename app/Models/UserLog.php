<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id' , 'login_at' ,'status'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
