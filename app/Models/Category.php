<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'image', 'unit_of_measurement', 'image', 'is_active'
    ];


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
//
//    public function children()
//    {
//        return $this->hasMany(Category::class, 'parent_id');
//    }


    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


}
