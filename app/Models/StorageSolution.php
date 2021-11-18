<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageSolution extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','logistics_businesse_id','box_quantity_pieces','weight_piece','temprature_ctrl','temprature_ctrl_max','temprature_ctrl_min','length','width','height','per_day','per_week','month','quarter','half_year','one_year','commodity_type','commodity_information','msds','msds_information','latitude','longitude','address',];

    public function logisticsBusiness()
    {
        return $this->belongsTo(LogisticsBusiness::class,'logistics_businesse_id');
    }
}
