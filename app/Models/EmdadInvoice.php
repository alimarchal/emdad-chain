<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmdadInvoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'charges', 'send_status', 'status'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }
}
