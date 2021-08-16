<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagingSolution extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'logistics_businesse_id', 'box_quantity_pieces', 'weight_piece', 'forklift', 'length', 'width', 'height', 'printing', 'printing_design', 'commodity_type', 'commodity_information', 'msds', 'msds_information', 'latitude', 'longitude', 'address', 'per_day','month','quarter','half_year','one_year',];

}
