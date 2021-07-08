<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'featured','menu','image'
    ];

    protected $cast = [
        'parent_id' => 'integer',
        'featured' => 'integer',
        'menu' => 'boolean'
    ];

    //mutator will save the slug field automatically whenever we save or create a category in our application.
    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    //The first relation will be to get the parent category of a category
    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}


