<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryComment extends Model
{
    use HasFactory;

    protected $appends = ['delivery_note_id'];
    protected $fillable = ['delivery_id', 'user_id', 'business_id', 'comment_content', 'comment_type', 'rating',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDeliveryNoteIdAttribute()
    {
        $delivery_note_id = Delivery::find($this->delivery_id)->delivery_note_id;
        return $delivery_note_id;
    }
}
