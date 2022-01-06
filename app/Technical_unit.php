<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Technical_unit extends Model
{
    public function scopeTechnicalsearch($query , $keywords)
    {
        $category = request('category_id');
        if ($category == 'all')
        {
            $query->where('title' , 'LIKE' , '%' .$keywords. '%')
                ->orwhere('manager' , 'LIKE' , '%' .$keywords. '%')
                ->orwhere('phone' , 'LIKE' , '%' .$keywords. '%')
                ->orwhere('mobile' , 'LIKE' , '%' .$keywords. '%')
                ->orwhere('address' , 'LIKE' , '%' .$keywords. '%');
        }else {
            $query->where($category, 'LIKE', '%' . $keywords . '%');
        }
        return $query;
    }

    public function scopeState($query){
        $state_id = request('state_id');
        if (isset($state_id) && $state_id == ''){
            $state_id = State::pluck('id');
            $query->whereIn('State_id' , $state_id);
        }elseif(isset($state_id) && $state_id != '') {
            $query->whereIn('State_id' , $state_id);
        }
    }

    public function scopeFilter($query)
    {

        $productgroup_id = request('productgroup_id');
        if (isset($productgroup_id) && $productgroup_id != '') {
            $technical_id = Car_technical_group::whereKala_group_id($productgroup_id)->pluck('technical_id');
            if (trim($technical_id) != '[]') {
                $query->whereIn('id',$technical_id);
            }else{
                $query->whereId(null);
            }
        }

        $state_id = request('state_id');
        if (isset($state_id) && $state_id != '') {
            $query->whereState_id($state_id);
        }

        $city_id = request('city_id');
        if (isset($city_id) && $city_id != '') {
            $query->whereIn('city_id' , $city_id);
        }

        $carbrands = request('car_brand_id');
        if (isset($carbrands) && trim($carbrands) != '') {
            $technical_id = Car_technical_group::whereCar_brand_id($carbrands)->pluck('technical_id');
            if (trim($technical_id) != '[]') {
                $query->whereIn('id',$technical_id);
            }else{
                $query->whereId(null);
            }
        }

        $carmodels = request('car_model_id');
        if (isset($carmodels) && $carmodels != '') {
            $technical_id = Car_technical_group::whereIn('car_model_id',$carmodels)->pluck('technical_id');
            if (trim($technical_id) != '[]') {
                $query->whereIn('id',$technical_id);
            }else{
                $query->whereId(null);
            }
        }

        $brand_id    = request('brand_id');
        if(isset($brand_id)  && $brand_id != ''){
            $product_id  = Product_brand_variety::whereBrand_id($brand_id)->pluck('product_id');
            if (trim($product_id) != '[]') {
                $query->whereIn('id' , $product_id);
            }else{
                $query->whereId(null);
            }
        }
    }

    public  function comment(){

        return $this->morphMany(comment::class, 'commentable');
    }
}
