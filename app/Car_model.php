<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car_model extends Model
{
    protected $fillable = ['id' , 'title_fa'];

    public function carproducts(){
        return $this->belongsToMany(Car_product::class);
    }
}
