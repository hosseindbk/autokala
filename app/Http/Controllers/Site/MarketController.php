<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Car_offer;
use App\Car_product;
use App\Car_type;
use App\City;
use App\comment;
use App\Http\Controllers\Controller;
use App\Media;
use App\Menu;
use App\Offer;
use App\Product;
use App\Product_brand_variety;
use App\Product_group;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{

    public function sell(){
        $menus                  = Menu::whereStatus(4)->get();
        $sell                   = 1;
        $buy                    = 0;
        $countState             = null;
        $users                  = User::select('id' , 'type_id')->get();
        $selloffers             = Offer::whereStatus(4)->whereBuyorsell('sell')->latest()->paginate('16');
        $max_price              = Offer::whereStatus(4)->max('single_price');
        $min_price              = Offer::whereStatus(4)->min('single_price');
        $carproducts            = Car_product::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $products               = Product::whereStatus(4)->get();
        $brand_varietis         = Product_brand_variety::all();
        $states                 = State::all();
        $cities                 = City::all();
        $brands                 = Brand::whereStatus(4)->get();
        $caroffers              = Car_offer::all();
        $filter                 = 0;

        $brandnames = DB::table('offers')
            ->leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('offers.brand_id as brand_offer_id' , 'offers.id as offer_id' , 'product_brand_varieties.brand_id as brand_variety_id' , 'product_brand_varieties.product_id' ,'brands.title_fa')
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('sell')
            ->where('offers.brand_id' , '<>' , null)
            ->get();

        return view('Site.market')
            ->with(compact('brandnames'))
            ->with(compact('products'))
            ->with(compact('brand_varietis'))
            ->with(compact('users'))
            ->with(compact('countState'))
            ->with(compact('sell'))
            ->with(compact('buy'))
            ->with(compact('productgroups'))
            ->with(compact('max_price'))
            ->with(compact('min_price'))
            ->with(compact('caroffers'))
            ->with(compact('selloffers'))
            ->with(compact('cities'))
            ->with(compact('filter'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('menus'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'));
    }

    public function sellstate(){
        $id                     = request('state_id');
        if ($id == null){
            $countState             = State::all();
        }else{
            $countState             = State::whereIn('id' , $id)->get();
        }
        $menus                  = Menu::whereStatus(4)->get();
        $sell                   = 1;
        $buy                    = 0;
        $users                  = User::select('id' , 'type_id')->get();
        $products               = Product::whereStatus(4)->get();
        $brand_varietis         = Product_brand_variety::all();
        $selloffers             = Offer::state()->whereStatus(4)->whereBuyorsell('sell')->latest()->paginate('16');
        $max_price              = Offer::state()->whereStatus(4)->max('single_price');
        $min_price              = Offer::state()->whereStatus(4)->min('single_price');
        $carproducts            = Car_product::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = City::all();
        $brands                 = Brand::whereStatus(4)->get();
        $caroffers              = Car_offer::all();
        $filter                 = 0;

        $brandnames = DB::table('offers')
            ->leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('offers.brand_id as brand_offer_id' , 'offers.id as offer_id' , 'product_brand_varieties.brand_id as brand_variety_id' , 'product_brand_varieties.product_id' ,'brands.title_fa')
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('sell')
            ->where('offers.brand_id' , '<>' , null)
            ->get();

        return view('Site.market')
            ->with(compact('brandnames'))
            ->with(compact('products'))
            ->with(compact('brand_varietis'))
            ->with(compact('users'))
            ->with(compact('countState'))
            ->with(compact('sell'))
            ->with(compact('buy'))
            ->with(compact('productgroups'))
            ->with(compact('max_price'))
            ->with(compact('min_price'))
            ->with(compact('caroffers'))
            ->with(compact('selloffers'))
            ->with(compact('cities'))
            ->with(compact('filter'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('menus'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'));
    }

    public function buystate(){
        $id                     = request('state_id');
        if ($id == null){
            $countState             = State::all();
        }else{
            $countState             = State::whereIn('id' , $id)->get();
        }
        $menus                  = Menu::whereStatus(4)->get();
        $sell                   = 1;
        $buy                    = 0;
        $products               = Product::whereStatus(4)->get();
        $brand_varietis         = Product_brand_variety::all();
        $users                  = User::select('id' , 'type_id')->get();
        $selloffers             = Offer::state()->whereStatus(4)->whereBuyorsell('buy')->latest()->paginate('16');
        $max_price              = Offer::state()->whereStatus(4)->max('single_price');
        $min_price              = Offer::state()->whereStatus(4)->min('single_price');
        $carproducts            = Car_product::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = City::all();
        $brands                 = Brand::whereStatus(4)->get();
        $caroffers              = Car_offer::all();
        $filter                 = 0;

        $brandnames = DB::table('offers')
            ->leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('offers.brand_id as brand_offer_id' , 'offers.id as offer_id' , 'product_brand_varieties.brand_id as brand_variety_id' , 'product_brand_varieties.product_id' ,'brands.title_fa')
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('buy')
            ->where('offers.brand_id' , '<>' , null)
            ->get();

        return view('Site.market')
            ->with(compact('brandnames'))
            ->with(compact('products'))
            ->with(compact('brand_varietis'))
            ->with(compact('users'))
            ->with(compact('countState'))
            ->with(compact('sell'))
            ->with(compact('buy'))
            ->with(compact('productgroups'))
            ->with(compact('max_price'))
            ->with(compact('min_price'))
            ->with(compact('caroffers'))
            ->with(compact('selloffers'))
            ->with(compact('cities'))
            ->with(compact('filter'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('menus'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'));
    }

    public function buy(){
        $menus                  = Menu::whereStatus(4)->get();
        $buy                    = 1;
        $sell                   = 0;
        $countState             = null;
        $products               = Product::whereStatus(4)->get();
        $brand_varietis         = Product_brand_variety::all();
        $users                  = User::select('id' , 'type_id')->get();
        $buyoffers              = Offer::whereStatus(4)->whereBuyorsell('buy')->latest()->paginate('16');
        $max_price              = Offer::whereStatus(4)->max('single_price');
        $min_price              = Offer::whereStatus(4)->min('single_price');
        $carproducts            = Car_product::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = City::all();
        $brands                 = Brand::whereStatus(4)->get();
        $caroffers              = Car_offer::all();
        $filter                 = 0;
        $brandnames = DB::table('offers')
            ->leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('offers.brand_id as brand_offer_id' , 'offers.id as offer_id' , 'product_brand_varieties.brand_id as brand_variety_id' , 'product_brand_varieties.product_id' ,'brands.title_fa')
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('buy')
            ->where('offers.brand_id' , '<>' , null)
            ->get();
        return view('Site.market')
            ->with(compact('products'))
            ->with(compact('brand_varietis'))
            ->with(compact('users'))
            ->with(compact('countState'))
            ->with(compact('buy'))
            ->with(compact('sell'))
            ->with(compact('productgroups'))
            ->with(compact('max_price'))
            ->with(compact('min_price'))
            ->with(compact('caroffers'))
            ->with(compact('buyoffers'))
            ->with(compact('cities'))
            ->with(compact('filter'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('menus'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'));
    }

    public function marketsellfilter(){

        $productgroup = request('productgroup_id');
        if(isset($productgroup)  && $productgroup != '') {
            $productgroup_id = Product_group::whereIn('id', $productgroup)->get();
        }else{$productgroup_id = null;}

        $carmodel = request('car_model_id');
        if(isset($carmodel)  && $carmodel != '') {
            $carmodel_id = Car_model::whereIn('id', $carmodel)->get();
        }else{$carmodel_id = null;}

        $brand = request('brand_id');
        if(isset($brand)  && $brand != '') {
            $brand_id = Brand::whereIn('id', $brand)->get();
        }else{$brand_id = null;}

        $city = request('city_id');
        if(isset($city)  && $city != '') {
            $city_id = City::whereIn('id', $city)->get();
        }else{$city_id = null;}
        $countState             = null;
        $users                  = User::select('id' , 'type_id')->get();
        $products               = Product::whereStatus(4)->get();
        $brand_varietis         = Product_brand_variety::all();
        $carproducts            = Car_product::whereStatus(4)->get();
        $caroffers              = Car_offer::all();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $menus                  = Menu::whereStatus(4)->get();
        $selloffers             = Offer::filter()->whereStatus(4)->whereBuyorsell('sell')->latest()->paginate('16');
        $count                  = offer::filter()->whereStatus(4)->whereBuyorsell('sell')->count();
        $max_price              = Offer::filter()->whereStatus(4)->whereBuyorsell('sell')->whereStatus(1)->max('price');
        $min_price              = Offer::filter()->whereStatus(4)->whereBuyorsell('sell')->whereStatus(1)->min('price');
        $brands                 = Brand::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = City::all();
        $filter                 =   1;
        $buy                    =   0;
        $sell                   =   1;
        $brandnames = DB::table('offers')
            ->leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('offers.brand_id as brand_offer_id' , 'offers.id as offer_id' , 'product_brand_varieties.brand_id as brand_variety_id' , 'product_brand_varieties.product_id' ,'brands.title_fa')
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('sell')
            ->where('offers.brand_id' , '<>' , null)
            ->get();
        return view('Site.market')
            ->with(compact('brandnames'))
            ->with(compact('products'))
            ->with(compact('brand_varietis'))
            ->with(compact('users'))
            ->with(compact('countState'))
            ->with(compact('buy'))
            ->with(compact('sell'))
            ->with(compact('carmodel_id'))
            ->with(compact('brand_id'))
            ->with(compact('productgroup_id'))
            ->with(compact('productgroups'))
            ->with(compact('city_id'))
            ->with(compact('count'))
            ->with(compact('max_price'))
            ->with(compact('min_price'))
            ->with(compact('caroffers'))
            ->with(compact('selloffers'))
            ->with(compact('cities'))
            ->with(compact('filter'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('menus'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'));


    }

    public function marketbuyfilter(){

        $productgroup = request('productgroup_id');
        if(isset($productgroup)  && $productgroup != '') {
            $productgroup_id = Product_group::whereIn('id', $productgroup)->get();
        }else{$productgroup_id = null;}

        $carmodel = request('car_model_id');
        if(isset($carmodel)  && $carmodel != '') {
            $carmodel_id = Car_model::whereIn('id', $carmodel)->get();
        }else{$carmodel_id = null;}

        $brand = request('brand_id');
        if(isset($brand)  && $brand != '') {
            $brand_id = Brand::whereIn('id', $brand)->get();
        }else{$brand_id = null;}

        $city = request('city_id');
        if(isset($city)  && $city != '') {
            $city_id = City::whereIn('id', $city)->get();
        }else{$city_id = null;}
        $countState             = null;
        $users                  = User::select('id' , 'type_id')->get();
        $products               = Product::whereStatus(4)->get();
        $brand_varietis         = Product_brand_variety::all();
        $carproducts            = Car_product::whereStatus(4)->get();
        $caroffers              = Car_offer::all();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $menus                  = Menu::whereStatus(4)->get();
        $buyoffers              = Offer::filter()->whereStatus(4)->whereBuyorsell('buy')->latest()->paginate('16');
        $count                  = offer::filter()->whereStatus(4)->whereBuyorsell('buy')->count();
        $max_price              = Offer::filter()->whereStatus(4)->whereBuyorsell('buy')->whereStatus(4)->max('price');
        $min_price              = Offer::filter()->whereStatus(4)->whereBuyorsell('buy')->whereStatus(4)->min('price');
        $brands                 = Brand::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = City::all();
        $filter                 =   1;
        $buy                    =   0;
        $sell                   =   1;
        $brandnames = DB::table('offers')
            ->leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('offers.brand_id as brand_offer_id' , 'offers.id as offer_id' , 'product_brand_varieties.brand_id as brand_variety_id' , 'product_brand_varieties.product_id' ,'brands.title_fa')
            ->where('offers.status' , '=', '4')
            ->whereBuyorsell('sell')
            ->where('offers.brand_id' , '<>' , null)
            ->get();
        return view('Site.market')

            ->with(compact('brandnames'))
            ->with(compact('products'))
            ->with(compact('brand_varietis'))
            ->with(compact('users'))
            ->with(compact('countState'))
            ->with(compact('buy'))
            ->with(compact('sell'))
            ->with(compact('carmodel_id'))
            ->with(compact('brand_id'))
            ->with(compact('productgroup_id'))
            ->with(compact('productgroups'))
            ->with(compact('city_id'))
            ->with(compact('count'))
            ->with(compact('max_price'))
            ->with(compact('min_price'))
            ->with(compact('caroffers'))
            ->with(compact('buyoffers'))
            ->with(compact('cities'))
            ->with(compact('filter'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('menus'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'));


    }

    public function submarket($slug){
        $menus                  = Menu::whereStatus(4)->get();
        $offers                 = Offer::whereSlug($slug)->whereStatus(4)->get();
        $unicode                = Offer::whereSlug($slug)->get();
        $users                  = User::select('id' , 'type_id')->get();
        $brand_varietis         = Product_brand_variety::all();
        foreach ($unicode as $offer) {
            if ($offer->unicode_product != null) {
                $product_id = Product::whereUnicode($offer->unicode_product)->pluck('id');
                $medias = Media::whereProduct_id($product_id)->get();
                $cars = DB::table('car_products')
                    ->join('car_brands', 'car_brands.id', '=', 'car_products.car_brand_id')
                    ->join('car_models', 'car_models.id', '=', 'car_products.car_model_id')
                    ->where('car_products.product_id' , '=' , $product_id)
                    ->select('car_products.product_id', 'car_brands.title_fa as brand', 'car_models.title_fa as model')
                    ->get();
            } else {  $medias = null; $cars = null; }
        }
        $countState             = null;

        $offer_id               = Offer::whereSlug($slug)->pluck('id');
        $comments               = comment::whereCommentable_id($offer_id)->whereApproved(1)->latest()->get();
        $products               = Product::whereStatus(4)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = City::all();
        $carbrands              = Car_brand::all();
        $carmodels              = Car_model::all();
        $cartypes               = Car_type::all();
        $brands                 = Brand::whereStatus(4)->get();
        $caroffers              = Car_offer::all();
        $filter                 = 0;

        return view('Site.submarket')
            ->with(compact('brand_varietis'))
            ->with(compact('users'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'))
            ->with(compact('cartypes'))
            ->with(compact('countState'))
            ->with(compact('productgroups'))
            ->with(compact('comments'))
            ->with(compact('cars'))
            ->with(compact('products'))
            ->with(compact('medias'))
            ->with(compact('caroffers'))
            ->with(compact('offers'))
            ->with(compact('cities'))
            ->with(compact('filter'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('menus'));
    }
    public function option(Request $request){
        $cities = City::whereState_id($request->input('id'))->get();
        $output = [];

        foreach($cities as $City )
        {
            $output[$City->id] = $City->title;
        }
        return $output;
    }
}
