<?php

namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class MarketController extends Controller
{
    public function sell(){
        $brandnames = DB::table('offers')
            ->leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->leftJoin('states', 'states.id', '=', 'offers.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'offers.city_id')
            ->select('brands.title_fa as brand' , 'offers.slug' , 'offers.image1 as image' , 'offers.title_offer as title' , 'states.title as state' , 'cities.title as city')
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('sell')
            ->where('offers.brand_id' , '<>' , null)
            ->paginate(16);

        $response = [
            'selloffer'=>$brandnames,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }
    public function buy(){
        $brandnames = DB::table('offers')
            ->leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->leftJoin('states', 'states.id', '=', 'offers.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'offers.city_id')
            ->select('brands.title_fa as brand' , 'offers.slug' , 'offers.image1 as image' , 'offers.title_offer as title' , 'states.title as state' , 'cities.title as city')
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('buy')
            ->where('offers.brand_id' , '<>' , null)
            ->paginate(16);

        $response = [
            'buyoffer'=>$brandnames,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

}
