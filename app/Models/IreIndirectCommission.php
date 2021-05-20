<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IreIndirectCommission extends Model
{
    use HasFactory;

    protected $fillable = ['ire_id', 'ire_no', 'referencee_ire_no', 'amount'];

    public function ire()
    {
        return $this->belongsTo(Ire::class, 'ire_no','ire_no');
    }

    public function ireReferencee()
    {
        return $this->belongsTo(Ire::class, 'referencee_ire_no','ire_no');
    }
}
