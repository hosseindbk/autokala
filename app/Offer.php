<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function scopeOffersearchsell($query , $keywords)
    {
        $query->where('title_offer' , 'LIKE' , '%' .$keywords. '%');
//            ->orwhere('description' , 'LIKE' , '%' .$keywords. '%');

        return $query;
    }
    public function scopeOffersearchbuy($query , $keywords)
    {
        $query->where('title_offer' , 'LIKE' , '%' .$keywords. '%');
//            ->orwhere('description' , 'LIKE' , '%' .$keywords. '%');

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

    public function scopeFilter($query){

        $type = request('type');

        if (isset($type) && $type == 'all') {
            $user_id = User::pluck('id');
            $query->whereIn('User_id' ,$user_id);
        }elseif(isset($type) && $type == '4'){
            $user_id = User::whereType_id('4')->pluck('id');
            $query->whereIn('User_id' ,$user_id);
        }elseif(isset($type) && $type == '13'){
            $user_id = User::whereIn('Type_id' , ['3' , '1'])->pluck('id');
            $query->whereIn('User_id' ,$user_id);
        }

        $state_id = request('state_id');
        if (isset($state_id) && $state_id != '') {
            $query->whereState_id($state_id);
        }

        $city_id = request('city_id');
        if (isset($city_id) && $city_id != '') {
            $query->whereIn('city_id' , $city_id);
        }

        $range = request('range');
        if (isset($range) && $range != '') {
            $query->where('Single_price' ,'<=', $range);
        }

        $productgroup_id    = request('productgroup_id');
        if(isset($productgroup_id)  && $productgroup_id != ''){
            $query->whereIn('product_group' , $productgroup_id);
        }

        $carbrands = request('car_brand_id');
        if (isset($carbrands) && trim($carbrands) != '') {
            $offer_id = Car_offer::whereCar_brand_id($carbrands)->pluck('offer_id');
            if (trim($offer_id) != '[]') {
                $query->whereIn('id',$offer_id);
            }else{
                $query->whereId(null);
            }
        }

        $car_model_id    = request('car_model_id');
        if(isset($car_model_id)  && $car_model_id != ''){
            $offer_id  = Car_offer::whereIn('Car_model_id',$car_model_id)->pluck('offer_id');
            if (trim($offer_id) != '[]') {
                $query->whereIn('id',$offer_id);
            }else{
                $query->whereId(null);
            }
        }

        $brand_id    = request('brand_id');
        if(isset($brand_id)  && $brand_id != ''){
            $query->whereIn('brand_id' , $brand_id);
        }

    }
    public  function comment(){

        return $this->morphMany(comment::class, 'commentable');
    }
}
