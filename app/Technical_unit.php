<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Technical_unit extends Model
{

    public function scopeState($query)
    {

        if (auth::check() && auth::user()->state_id != null && auth::user()->state_status != 1) {

            $query->where('technical_units.state_id', auth::user()->state_id);

        }elseif(!auth::check()){

            $query->where('technical_units.State_id', '8');
        }
    }

    public function scopeFilter($query)
    {

        $keywords   = request('technicalsearch');
        $category   = request('category_id');

        if (isset($keywords) &&  $keywords != null)
        {
            if ($category == 'all' || $category == null)
            {
                $query->where('technical_units.title'   , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('technical_units.manager' , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('technical_units.phone'   , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('technical_units.mobile'  , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('technical_units.address' , 'LIKE' , '%' .$keywords. '%');
            }
            else
            {
                $query->where($category, 'LIKE', '%' . $keywords . '%')->where('technical_units.status' , 4);
            }
        }

        $productgroup_id    = request('productgroup_id');
        if(isset($productgroup_id)  && array_values($productgroup_id)[0] != null) {
            $technical_id = Car_technical_group::whereIn('kala_group_id', $productgroup_id)->pluck('technical_id');
            $query->whereIn('technical_units.id', $technical_id);
        }

        $state_id = request('state_id');

        if (isset($state_id) &&  $state_id != null && auth::check() && auth::user()->state_status == 1 ) {
            session(['state_id' => $state_id]);
            dd($state_id);
            $query->where('technical_units.state_id', $state_id);
        }elseif (auth::check() && auth::user()->state_status == 1 && Session::get('state_id') != null){
            $query->where('technical_units.state_id', Session::get('state_id'));
        }
        elseif(isset($state_id)){
            alert()->warning('جهت اطلاع بیشتر با پشتیبانی تماس حاصل فرمایید', 'عدم دسترسی تغییر استان')->autoclose(5000);
        }

        $city_id = request('city_id');
        if (isset($city_id)) {
            $query->where('technical_units.city_id' , $city_id);
        }

        $carbrands = request('car_brand_id');
        if (isset($carbrands) && $carbrands != null) {
            $product_id = Car_product::whereCar_brand_id($carbrands)->pluck('product_id');
            $query->whereIn('technical_units.id',$product_id);
        }

        $car_model_id  = request('car_model_id');
        if(isset($car_model_id)  && array_values($car_model_id)[0] != null){
            $product_id  = Car_product::whereIn('Car_model_id',$car_model_id)->pluck('product_id')->toArray();
            $query->whereIn('technical_units.id',$product_id);
        }

        $brand_id    = request('brand_id');
        if(isset($brand_id)  && array_values($brand_id)[0] != null){
            $product_id  = Product_brand_variety::whereBrand_id($brand_id)->pluck('product_id');
            $query->whereIn('technical_units.id' , $product_id);
        }
    }

    public function scopeApi($query)
    {

        $keywords   = request('technicalsearch');
        $category   = request('category_id');

        if (isset($keywords) &&  $keywords != null)
        {
            if ($category == 'all' || $category == null)
            {
                $query->where('technical_units.title'   , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('technical_units.manager' , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('technical_units.phone'   , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('technical_units.mobile'  , 'LIKE' , '%' .$keywords. '%')
                    ->orwhere('technical_units.address' , 'LIKE' , '%' .$keywords. '%');
            }
            else
            {
                $query->where($category, 'LIKE', '%' . $keywords . '%')->where('technical_units.status' , 4);
            }
        }

        $productgroup_id    = request('productgroup_id');
        if(isset($productgroup_id)  && array_values($productgroup_id)[0] != null) {
            $technical_id = Car_technical_group::whereIn('kala_group_id', $productgroup_id)->pluck('technical_id');
            $query->whereIn('technical_units.id', $technical_id);
        }

        $state_id = request('state_id');
        if (isset($state_id) &&  $state_id != null && Auth::guard('api')->check() && Auth::guard('api')->user()->state_status == 1 ) {
            session(['state_id' => $state_id]);
            $query->where('technical_units.state_id', $state_id);
        }elseif (auth::check() && auth::user()->state_status == 1 && Session::get('state_id') != null){
            $query->where('technical_units.state_id', Session::get('state_id'));
        }
        elseif(isset($state_id)){
            alert()->warning('جهت اطلاع بیشتر با پشتیبانی تماس حاصل فرمایید', 'عدم دسترسی تغییر استان')->autoclose(5000);
        }

        $city_id = request('city_id');
        if (isset($city_id)) {
            $query->where('technical_units.city_id' , $city_id);
        }

        $carbrands = request('car_brand_id');
        if (isset($carbrands) && $carbrands != null) {
            $product_id = Car_product::whereCar_brand_id($carbrands)->pluck('product_id');
            $query->whereIn('technical_units.id',$product_id);
        }

        $car_model_id  = request('car_model_id');
        if(isset($car_model_id)  && array_values($car_model_id)[0] != null){
            $product_id  = Car_product::whereIn('Car_model_id',$car_model_id)->pluck('product_id')->toArray();
            $query->whereIn('technical_units.id',$product_id);
        }

        $brand_id    = request('brand_id');
        if(isset($brand_id)  && array_values($brand_id)[0] != null){
            $product_id  = Product_brand_variety::whereBrand_id($brand_id)->pluck('product_id');
            $query->whereIn('technical_units.id' , $product_id);
        }
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
