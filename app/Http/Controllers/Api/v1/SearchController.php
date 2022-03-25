<?php

namespace App\Http\Controllers\Api\v1;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Product;
use App\Supplier;
use App\Technical_unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SearchController extends Controller
{
    public function product(){
        $keywords      = request('productsearch');
        $products      = Product::select('unicode' , 'slug' , 'image' , 'title_fa as title')
            ->search($keywords)
            ->whereStatus(4)
            ->latest()
            ->paginate(10);

        $response = [
            'products'=>$products,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }

    public function unicode(){
        $keywords      = request('unicodesearch');
        $products      = Product::select('unicode' , 'slug' , 'image' , 'title_fa as title')
            ->where('unicode', 'LIKE', '%' . $keywords . '%')
            ->whereStatus(4)
            ->latest()
            ->paginate(10);

        $response = [
            'products'=>$products,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }

    public function technical(){

        $keywords               = request('technicalsearch');
        $technicals             = Technical_unit::select('title' , 'slug' , 'address' , 'manager' , 'image')
            ->technicalsearch($keywords)
            ->whereStatus(4)
            ->latest()
            ->paginate(10);
        $response = ['technical_unit' => $technicals];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }

    public function supplier(){
        $keywords        = request('suppliersearch');
        $suppliers       = Supplier::select('title' , 'slug' , 'address' , 'manager' , 'image')
            ->suppliersearch($keywords)
            ->whereStatus(4)
            ->latest()
            ->paginate(10);

        $response = ['supplier' => $suppliers];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function brand(){
        $keywords           = request('brandsearch');

        $brands             = Brand::brandsearch($keywords)->whereStatus(4)->latest()->paginate(12);

    }

    public function offersell()
    {
        $keywords = request('offersellsearch');

        $brandnames = Offer::
            leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
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
            ->offersearchsell($keywords)
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('sell')
            ->where('offers.brand_id' , '<>' , null)
            ->paginate(16);

        $response = [
            'selloffer'=>$brandnames,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }

    public function offerbuy()
    {
        $keywords = request('offerbuysearch');

        $brandnames = Offer::
            leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
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
            END) AS type'))
            ->offersearchbuy($keywords)
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('buy')
            ->where('offers.brand_id' , '<>' , null)
            ->paginate(16);

        $response = [
            'buyoffer'=>$brandnames,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }

    public function sellfilter(){
        $brandnames = Offer::
            leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
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
            ->filter()
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('sell')
            ->where('offers.brand_id' , '<>' , null)
            ->paginate(16);

        $response = [
            'selloffer'=>$brandnames,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function buyfilter(){
        $brandnames = Offer::
        leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
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
                END) AS type'))
            ->filter()
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('buy')
            ->where('offers.brand_id' , '<>' , null)
            ->paginate(16);

        $response = [
            'buyoffer'=>$brandnames,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function technicalfilter(){

        $technicals      = Technical_unit::select('title' , 'slug' , 'address' , 'manager' , 'image')
            ->filter()
            ->whereStatus(4)
            ->latest()
            ->paginate(10);

        $response = ['technical_unit' => $technicals];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function supplierfilter(){
        $suppliers       = Supplier::select('title' , 'slug' , 'address' , 'manager' , 'image')
            ->filter()
            ->whereStatus(4)
            ->latest()
            ->paginate(10);
        $response = ['supplier' => $suppliers];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }

    public function productfilter(){
        $products       = Product::select('unicode' , 'slug' , 'image' , 'title_fa as title')
            ->filter()
            ->whereStatus(4)
            ->latest()
            ->paginate(10);

        $response = [
            'products'=>$products,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

}
