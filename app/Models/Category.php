<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 'name', 'description', 'unit_of_measurement', 'image', 'is_active','name_ar'
    ];


    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
//
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function childs() {
        return $this->hasMany(Category::class,'parent_id') ;
    }

    ####################

}
