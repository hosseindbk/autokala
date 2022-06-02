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

        $keywords = request('offersellsearch');
        if (isset($keywords) && $keywords != null) {
            $query->where('title_offer' , 'LIKE' , '%' .$keywords. '%');
        }

        $keywords = request('offerbuysearch');
        if (isset($keywords) && $keywords != null) {
            $query->where('title_offer' , 'LIKE' , '%' .$keywords. '%');
        }

        $type = request('type');

        if (isset($type) && $type == 'all') {
            $user_id = User::pluck('id');
            $query->whereIn('offers.user_id' ,$user_id);

        }elseif(isset($type) && $type == 1){

            $user_id = User::whereType_id('1')->pluck('id');
            $query->whereIn('offers.user_id' ,$user_id);

        }elseif(isset($type) && $type > 1){
            $user_id = User::where('type_id' ,'>' ,1)->pluck('id');
            $query->whereIn('offers.user_id' ,$user_id);
        }

        $state_id = request('state_id');
        if (isset($state_id) && $state_id != null) {
            $query->where('offers.state_id' , $state_id);
        }

        $city_id = request('city_id');
        if (isset($city_id) &&  array_values($city_id)[0] != null) {
            $query->whereIn('offers.city_id' , $city_id);
        }

        $productgroup_id    = request('productgroup_id');
        if(isset($productgroup_id)  && array_values($productgroup_id)[0] != null){
            $query->whereIn('product_group' , $productgroup_id);
        }

        $carbrands = request('car_brand_id');
        if (isset($carbrands) && $carbrands != null) {
            $offer_id = Car_offer::whereCar_brand_id($carbrands)->pluck('offer_id');
            $query->whereIn('offers.id',$offer_id);
        }

        $car_model_id    = request('car_model_id');
        if(isset($car_model_id)  &&  array_values($car_model_id)[0] != null){
            $offer_id  = Car_offer::whereIn('car_model_id',$car_model_id)->pluck('offer_id');
            $query->whereIn('offers.id',$offer_id);
        }

        $brand_id    = request('brand_id');
        if(isset($brand_id)  && array_values($brand_id)[0] != null){
            $query->whereIn('offers.brand_id' , $brand_id);
        }

    }
    public function scopeSort($query){

        $newest = request('newest');
        if (isset($newest) && $newest == 1) {
            $query->orderBy('offers.id' , 'DESC');
        }

        $click = request('click');
        if (isset($click) && $click == 1) {
            $query->orderBy('offers.click' , 'DESC');
        }

        $brandvarity = request('brandvarity');
        if (isset($brandvarity) && $brandvarity == 1) {
            $query->orderBy('offers.countvarity' , 'DESC');
        }

        $lat = request('lat');
        $lng = request('lng');
        if ($lat != null && $lng) {
            $query->orderByRaw("(POW((lat-$lat),2) + POW((lng-$lng),2))");
        }

    }
    public  function comment(){

        return $this->morphMany(comment::class, 'commentable');
    }
}
