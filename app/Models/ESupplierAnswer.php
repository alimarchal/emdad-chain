<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ESupplierAnswer extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(EBuyerSurvey::class);
    }
}
