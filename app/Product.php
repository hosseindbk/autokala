<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function scopeFilter($query)
    {
        $category = request('category_id');
        $keywords = request('productsearch');

        if (isset($keywords) && $keywords != null)
        {
            if ($category == 'all' || $category == null)
                {
                    $query->where('title_fa'            , 'LIKE' , '%' .$keywords. '%')
                        ->orwhere('title_bazar_fa'      , 'LIKE' , '%' .$keywords. '%')
                        ->orwhere('title_fani_fa'       , 'LIKE' , '%' .$keywords. '%')
                        ->orwhere('title_fani_en'       , 'LIKE' , '%' .$keywords. '%')
                        ->orwhere('code_fani_company'   , 'LIKE' , '%' .$keywords. '%');
                }
            else
                {
                    $query->where($category, 'LIKE', '%' . $keywords . '%');
                }
        }
        $unicode = request('unicode');
        if (isset($unicode) && $unicode != null) {
            $query->where('unicode', 'LIKE', '%' . $unicode . '%');
        }

        $productgroup_id    = request('productgroup_id');
        if(isset($productgroup_id)  && array_values($productgroup_id)[0] != null){
            $query->whereIn('kala_group_id' , $productgroup_id);
        }

        $carbrands = request('car_brand_id');
        if (isset($carbrands) && $carbrands != null) {
            $product_id = Car_product::whereCar_brand_id($carbrands)->pluck('product_id');
            $query->whereIn('id',$product_id);
        }

        $car_model_id    = request('car_model_id');
        if(isset($car_model_id)  &&  array_values($car_model_id)[0] != null){
            $product_id  = Car_product::whereIn('Car_model_id',$car_model_id)->pluck('product_id');
            $query->whereIn('id',$product_id);
        }

        $brand_id    = request('brand_id');
        if(isset($brand_id)  && array_values($brand_id)[0] != null){
            $product_id  = Product_brand_variety::whereBrand_id($brand_id)->pluck('product_id');
                $query->whereIn('id' , $product_id);
        }
    }
    public function scopeSort($query)
    {
        $newest = request('newest');
        if (isset($newest) && $newest == 1) {
            $query->orderBy('id' , 'DESC');
        }

        $click = request('click');
        if (isset($click) && $click == 1) {
            $query->orderBy('click' , 'DESC');
        }

        $brandvarity = request('brandvarity');
        if (isset($brandvarity) && $brandvarity == 1) {
            $query->orderBy('countvarity' , 'DESC');
        }
    }
    public function scopeUnicode($query)
    {
        $unicode = request('unicode');
        if (isset($unicode) && $unicode != null) {
            $query->where('unicode', 'LIKE', '%' . $unicode . '%');
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
