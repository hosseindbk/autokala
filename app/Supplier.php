<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    public function scopeSuppliersearch($query , $keywords)
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
            $query->where($category, 'LIKE', '%' . $keywords . '%')->whereStatus(4);
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
        $productgroup_id    = request('productgroup_id');
        if(isset($productgroup_id)  && array_values($productgroup_id)[0] != null) {
            $supplier_id = Supplier_product_group::whereIn('kala_group_id', $productgroup_id)->pluck('supplier_id');
            $query->whereIn('id', $supplier_id);
        }

        $state_id = request('state_id');
        if (isset($state_id) && $state_id != null) {
            $query->whereState_id($state_id);
        }

        $city_id = request('city_id');
        if (isset($city_id) &&  array_values($city_id)[0] != null) {
            $query->whereIn('city_id' , $city_id);
        }

        $whole_seller = request('whole_seller');
        if (isset($whole_seller) && $whole_seller == 1) {
            $query->whereWhole_seller(1);
        }

        $retail_seller = request('retail_seller');
        if (isset($retail_seller) && $retail_seller == 1) {
            $query->whereRetail_seller(1);
        }

        $manufacturer = request('manufacturer');
        if (isset($manufacturer) && $manufacturer == 1) {
            $query->whereManufacturer(1);
        }

        $importer = request('importer');
        if (isset($importer) && $importer == 1) {
            $query->whereImporter(1);
        }

        $carbrands = request('car_brand_id');
        if (isset($carbrands) && $carbrands != null) {
            $supplier_id = Supplier_product_group::whereCar_brand_id($carbrands)->pluck('supplier_id');
            $query->whereIn('id',$supplier_id);
        }

        $carmodels = request('car_model_id');
        if (isset($carmodels) && array_values($carmodels)[0] != null) {
            $supplier_id = Supplier_product_group::whereIn('car_model_id',$carmodels)->pluck('supplier_id');
            $query->whereIn('id',$supplier_id);

        }
        return $query;
    }

    public  function comment(){

        return $this->morphMany(comment::class, 'commentable');
    }
}
