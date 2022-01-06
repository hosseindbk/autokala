<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_group extends Model
{
    public function productgroup(){
        return $this->belongsToMany(Product_group::class);
    }
}
