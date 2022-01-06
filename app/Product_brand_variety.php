<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_brand_variety extends Model
{
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
