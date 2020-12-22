<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['business_id','name','short_name','logo','description'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

}
