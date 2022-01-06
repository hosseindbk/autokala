<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeSearch($query , $keywords)
    {
        $category = request('category_id');
        if ($category == 'all')
        {
            $query->where('title_fa' , 'LIKE' , '%' .$keywords. '%')
                ->orwhere('title_bazar_fa' , 'LIKE' , '%' .$keywords. '%')
                ->orwhere('title_fani_fa' , 'LIKE' , '%' .$keywords. '%')
                ->orwhere('title_fani_en' , 'LIKE' , '%' .$keywords. '%')
                ->orwhere('code_fani_company' , 'LIKE' , '%' .$keywords. '%');
        }else {
            $query->where($category, 'LIKE', '%' . $keywords . '%');
        }
        return $query;
    }

    public function scopeFilter($query){

        $productgroup_id    = request('productgroup_id');
        if(isset($productgroup_id)  && $productgroup_id != ''){
            $query->whereIn('kala_group_id' , $productgroup_id);
        }

        $carbrands = request('car_brand_id');
        if (isset($carbrands) && trim($carbrands) != '') {
            $product_id = Car_product::whereCar_brand_id($carbrands)->pluck('product_id');
            if (trim($product_id) != '[]') {
                $query->whereIn('id',$product_id);
            }else{
                $query->whereId(null);
            }
        }

        $car_model_id    = request('car_model_id');
        if(isset($car_model_id)  && $car_model_id != ''){
            $product_id  = Car_product::whereIn('Car_model_id',$car_model_id)->pluck('product_id');
            if (trim($product_id) != '[]') {
                $query->whereIn('id',$product_id);
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

    public function productgroup(){

        return $this->belongsToMany(Product_group::class);
    }
    public function productbrandvarieties(){
        return $this->belongsToMany(Product_brand_variety::class);
    }

    public  function comment(){

        return $this->morphMany(comment::class, 'commentable');
    }

}
