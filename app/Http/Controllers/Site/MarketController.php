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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MarketController extends Controller
{

    public function sell(){
        $menus                  = Menu::whereStatus(4)->get();
        $sell                   = 1;
        $buy                    = 0;
        $countState             = null;
        $users                  = User::select('id' , 'type_id')->get();
        $selloffers             = Offer::whereStatus(4)->whereBuyorsell('sell')->latest()->filter()->paginate('16');
        $max_price              = Offer::whereStatus(4)->filter()->max('single_price');
        $min_price              = Offer::whereStatus(4)->filter()->min('single_price');
        $carproducts            = Car_product::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $products               = Product::whereStatus(4)->get();
        $brand_varietis         = Product_brand_variety::all();
        $states                 = State::all();
        $stats = State::whereId(auth::user()->state_id)->get();
        foreach ($stats as $state){
            $state_id = $state->id;
        }
        $cities             = City::whereState_id($state_id)->get();
        $brands                 = Brand::whereStatus(4)->get();
        $caroffers              = Car_offer::all();
        $filter                 = 0;

        $brandnames = Offer::
        leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('offers.brand_id as brand_offer_id' , 'offers.id as offer_id' , 'product_brand_varieties.brand_id as brand_variety_id' , 'product_brand_varieties.product_id' ,'brands.title_fa')
            ->where('offers.status' , '=', '4')
            ->where('offers.buyorsell' ,'sell')
            ->filter()
            ->get();

        if ($brandnames == '[]'){
            alert()->warning('خطا', 'نتیجه ای  یافت نشد');
            return Redirect::back();
        }

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

    public function sellfilter(){
        $menus                  = Menu::whereStatus(4)->get();
        $sell                   = 1;
        $buy                    = 0;
        $countState             = null;
        $users                  = User::select('id' , 'type_id')->get();
        $selloffers             = Offer::whereStatus(4)->whereBuyorsell('sell')->latest()->filter()->paginate('16');
        $max_price              = Offer::whereStatus(4)->filter()->max('single_price');
        $min_price              = Offer::whereStatus(4)->filter()->min('single_price');
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

        $brandnames = Offer::
        leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('offers.brand_id as brand_offer_id' , 'offers.id as offer_id' , 'product_brand_varieties.brand_id as brand_variety_id' , 'product_brand_varieties.product_id' ,'brands.title_fa')
            ->where('offers.status' , '=', '4')
            ->where('offers.buyorsell' ,'sell')
            ->filter()
            ->get();

        if ($brandnames == '[]'){
            alert()->warning('خطا', 'نتیجه ای  یافت نشد');
            return Redirect::back();
        }

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
        $buyoffers              = Offer::whereStatus(4)->whereBuyorsell('buy')->latest()->filter()->paginate('16');
        $max_price              = Offer::whereStatus(4)->max('single_price');
        $min_price              = Offer::whereStatus(4)->min('single_price');
        $carproducts            = Car_product::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $states                 = State::all();
        $stats = State::whereId(auth::user()->state_id)->get();
        foreach ($stats as $state){
            $state_id = $state->id;
        }
        $cities             = City::whereState_id($state_id)->get();
        $brands                 = Brand::whereStatus(4)->get();
        $caroffers              = Car_offer::all();
        $filter                 = 0;
        $brandnames = Offer::
        leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('offers.brand_id as brand_offer_id' , 'offers.id as offer_id' , 'product_brand_varieties.brand_id as brand_variety_id' , 'product_brand_varieties.product_id' ,'brands.title_fa')
            ->where('offers.status' , '=', '4')
            ->where('offers.buyorsell' ,'buy')
            ->filter()
            ->get();

        if ($brandnames == '[]'){
            alert()->warning('خطا', 'نتیجه ای  یافت نشد');
            return Redirect::back();
        }
        return view('Site.market')
            ->with(compact('brandnames'))
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

    public function buyfilter(){
        $menus                  = Menu::whereStatus(4)->get();
        $buy                    = 1;
        $sell                   = 0;
        $countState             = null;
        $products               = Product::whereStatus(4)->get();
        $brand_varietis         = Product_brand_variety::all();
        $users                  = User::select('id' , 'type_id')->get();
        $buyoffers              = Offer::whereStatus(4)->whereBuyorsell('buy')->latest()->filter()->paginate('16');
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
        $brandnames = Offer::
        leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('offers.brand_id as brand_offer_id' , 'offers.id as offer_id' , 'product_brand_varieties.brand_id as brand_variety_id' , 'product_brand_varieties.product_id' ,'brands.title_fa')
            ->where('offers.status' , '=', '4')
            ->where('offers.buyorsell' ,'buy')
            ->filter()
            ->get();

        if ($brandnames == '[]'){
            alert()->warning('خطا', 'نتیجه ای  یافت نشد');
            return Redirect::back();
        }

        return view('Site.market')
            ->with(compact('brandnames'))
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

        $offer_click            = Offer::whereSlug($slug)->pluck('click');
        $offer_new_click        = $offer_click[0] + 1;
        $offes                  = Offer::findOrfail($offer_id)->first();
        $offes->click           = $offer_new_click;
        $offes->update();


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
