<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technical_unit extends Model
{
    public function scopeTechnicalsearch($query , $keywords)
    {
        $category = request('category_id');
        if ($category == 'all' || $category == null)
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
        if (isset($productgroup_id) && array_values($productgroup_id)[0] != null) {
            $technical_id = Car_technical_group::whereKala_group_id($productgroup_id)->pluck('technical_id');
            if (trim($technical_id) != '[]') {
                $query->whereIn('id',$technical_id);
            }else{
                $query->whereId(null);
            }
        }

        $state_id = request('state_id');
        if (isset($state_id) &&  $state_id != null) {
            $query->whereState_id($state_id);
        }

        $city_id = request('city_id');
        if (isset($city_id) &&  array_values($city_id)[0] != null) {
            $query->whereIn('city_id' , $city_id);
        }

        $carbrands = request('car_brand_id');
        if (isset($carbrands) && $carbrands != null) {
            $product_id = Car_product::whereCar_brand_id($carbrands)->pluck('product_id');
            if (trim($product_id) != '[]') {
                $query->whereIn('id',$product_id);
            }
        }

        $car_model_id  = request('car_model_id');
        if(isset($car_model_id)  && array_values($car_model_id)[0] != null){
            $product_id  = Car_product::whereIn('Car_model_id',$car_model_id)->pluck('product_id')->toArray();
            if (array_values($product_id)[0] != null) {
                $query->whereIn('id',$product_id);
            }
        }

        $brand_id    = request('brand_id');
        if(isset($brand_id)  && array_values($brand_id)[0] != null){
            $product_id  = Product_brand_variety::whereBrand_id($brand_id)->pluck('product_id');
            if (trim($product_id) != '[]') {
                $query->whereIn('id' , $product_id);
            }
        }
    }

    public  function comment(){

        return $this->morphMany(comment::class, 'commentable');
    }
}
