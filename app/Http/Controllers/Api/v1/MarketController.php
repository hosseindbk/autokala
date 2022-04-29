<?php

namespace App\Http\Controllers\Api\v1;


use App\Car_offer;
use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class MarketController extends Controller
{
    public function sell(){
        $brandnames = Offer::leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->leftJoin('states', 'states.id', '=', 'offers.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'offers.city_id')
            ->leftJoin('users', 'users.id', '=', 'offers.user_id')
            ->select('brands.title_fa as brand' ,'offers.total as numberofsell' , 'offers.slug' , 'offers.image1 as image' , 'offers.title_offer as title' , 'states.title as state' , 'cities.title as city' , 'offers.price as wholesaleprice' , 'offers.single_price as retailprice',

            DB::raw( '(CASE
            WHEN users.type_id = "1" THEN "فروشگاه"
            WHEN users.type_id = "3" THEN "شخصی"
            WHEN users.type_id = "4" THEN "شخصی"
            END) AS type'))
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('sell')
            ->where('offers.brand_id' , '<>' , null)
            ->filter()
            ->paginate(16);

        $response = [
            'selloffer'=>$brandnames,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }


    public function buy(){
        $brandnames = Offer::leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->leftJoin('states', 'states.id', '=', 'offers.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'offers.city_id')
            ->leftJoin('users', 'users.id', '=', 'offers.user_id')
            ->select('brands.title_fa as brand' ,'offers.total as numberofsell', 'offers.slug' , 'offers.image1 as image' , 'offers.title_offer as title' , 'states.title as state' , 'cities.title as city' , 'offers.price as wholesaleprice' , 'offers.single_price as retailprice',

            DB::raw( '(CASE
            WHEN users.type_id = "1" THEN "فروشگاه"
            WHEN users.type_id = "3" THEN "شخصی"
            WHEN users.type_id = "4" THEN "شخصی"
            END) AS type'))            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('buy')
            ->filter()
            ->where('offers.brand_id' , '<>' , null)
            ->paginate(16);

        $response = [
            'buyoffer'=>$brandnames,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function bmpmarket(){

        $carsells = Car_offer::
        leftjoin('offers', 'offers.id'  , '=' , 'car_offers.offer_id')
            ->leftJoin('car_brands'     , 'car_brands.id'       , '=' , 'car_offers.car_brand_id')
            ->leftJoin('car_models'     , 'car_models.id'       , '=' , 'car_offers.car_model_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title')
            ->where('offers.user_id' , Auth::user()->id)
            ->where('car_offers.offer_id' , request('offer_id'))
            ->get();

        $status     = true;
        $message    = 'success';
        $response   = $carsells;

        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
    }

}
