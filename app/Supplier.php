<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    public function scopeState($query){
        if(auth::check() && auth::user()->state_id != null && auth::user()->state_status != 1) {
            $query->where('suppliers.state_id', auth::user()->state_id);
        }else{
            $query->where('suppliers.state_id', '8');
        }
    }

    public function scopeFilter($query)
    {

        $keywords   = request('suppliersearch');
        $category   = request('category_id');

        if(isset($keywords) && $keywords != null)
        {
            if ($category == 'all' || $category == null)
            {
                $query->where('suppliers.title'   , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('suppliers.manager' , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('suppliers.phone'   , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('suppliers.mobile'  , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('suppliers.address' , 'LIKE' , '%' .$keywords. '%');
            }
            else
                {
                    $query->where($category, 'LIKE', '%' . $keywords . '%')->where('suppliers.status' , 4);
                }
        }

        $productgroup_id    = request('productgroup_id');
        if(isset($productgroup_id)  && array_values($productgroup_id)[0] != null) {
            $supplier_id = Supplier_product_group::whereIn('kala_group_id', $productgroup_id)->pluck('supplier_id');
            $query->whereIn('suppliers.id', $supplier_id);
        }

        $state_id = request('state_id');
        if (isset($state_id) && $state_id != null) {
            $query->where('suppliers.state_id',$state_id);
        }

        $city_id = request('city_id');
        if (isset($city_id) &&  $city_id != null) {
            $query->where('suppliers.city_id' , $city_id);
        }

        $whole_seller = request('whole_seller');
        if (isset($whole_seller) && $whole_seller == 1) {
            $query->where('suppliers.whole_seller',1);
        }

        $retail_seller = request('retail_seller');
        if (isset($retail_seller) && $retail_seller == 1) {
            $query->where('suppliers.retail_seller',1);
        }

        $manufacturer = request('manufacturer');
        if (isset($manufacturer) && $manufacturer == 1) {
            $query->where('suppliers.manufacturer',1);
        }

        $importer = request('importer');
        if (isset($importer) && $importer == 1) {
            $query->where('suppliers.importer',1);
        }

        $carbrands = request('car_brand_id');
        if (isset($carbrands) && $carbrands != null) {
            $supplier_id = Supplier_product_group::whereCar_brand_id($carbrands)->pluck('supplier_id');
            $query->whereIn('suppliers.id',$supplier_id);
        }

        $carmodels = request('car_model_id');
        if (isset($carmodels) && array_values($carmodels)[0] != null) {
            $supplier_id = Supplier_product_group::whereIn('car_model_id',$carmodels)->pluck('supplier_id');
            $query->whereIn('suppliers.id',$supplier_id);

        }
        return $query;
    }

    public function scopeSort($query)
    {

        $user_rate = request('user_rate');
        if (isset($user_rate) &&  $user_rate == 1) {
            $query->orderby('avgrate' , 'DESC');
        }

        $autokala_rate = request('autokala_rate');
        if (isset($autokala_rate) &&  $autokala_rate == 1) {
            $query->orderby('autokala' , 'DESC');
        }

        $lat = request('lat');
        $lng = request('lng');
        if ($lat != null && $lng != null) {
            $query->orderByRaw("(POW((lat-$lat),2) + POW((lng-$lng),2))");
        }

    }

    public  function comment(){

        return $this->morphMany(comment::class, 'commentable');
    }
}
