<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IreCommission extends Model
{
    use HasFactory;

    protected $fillable = ['ire_no', 'user_id', 'type', 'status', 'payment', 'payment_status'];

    public function ireReference()
    {
        return $this->belongsTo(Ire::class, 'user_id','id');
    }

    public function ireNoReferencee()
    {
        return $this->belongsTo(Ire::class, 'ire_no','ire_no');
    }

    public function nonIreReference()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

}
