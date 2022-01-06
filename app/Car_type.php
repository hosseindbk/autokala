<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car_type extends Model
{
    protected $fillable = ['name' , 'label'];
    public function carproducts(){
        return $this->belongsToMany(Car_product::class);
    }
}
