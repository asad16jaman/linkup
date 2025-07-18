<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class)->select(['id','name']);
    }

    public function image(){
        return $this->hasOne(ProductImage::class)->latest();
    }
    
}
