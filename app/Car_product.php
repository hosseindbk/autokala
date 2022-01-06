<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car_product extends Model
{
    protected $fillable = ['car_model_id' , 'car_type_id' , 'product_id'];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function carmodels()
    {
        return $this->belongsToMany(Car_model::class);
    }
    public function cartypes()
    {
        return $this->belongsToMany(Car_type::class);
    }
}
