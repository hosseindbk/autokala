<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Car_offer;
use App\Car_product;
use App\Car_type;
use App\City;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Offer;
use App\Product;
use App\Product_brand_variety;
use App\Product_group;
use App\State;
use App\Supplier;
use App\Technical_unit;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use UxWeb\SweetAlert\SweetAlert;

class SearchController extends Controller
{
    public function search(){
        $keywords               = request('search');
        $products               = Product::search($keywords)->whereStatus(4)->latest()->paginate(12);
        $product_id             = Product::search($keywords)->pluck('id');
        if ($product_id == '[]'){
            alert()->warning('خطا', 'کلمه مورد نظر یافت نشد');
            return Redirect::back();
        }
        $menus                  = Menu::whereStatus(4)->get();
        $states                 = State::all();
        $countState         = null;

        $carmodels              = Car_model::whereStatus(4)->get();
        $cartypes               = Car_type::whereStatus(4)->get();
        //$carproducts            = Car_product::whereStatus(4)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $brands                 = Brand::whereStatus(4)->get();
        if (trim($product_id) != '[]') {
            $productbrandvarieties = Product_brand_variety::whereProduct_id($product_id)->get();
        }else{
            $productbrandvarieties = null;
        }

        $carproducts = DB::table('car_products')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'car_products.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'car_products.car_model_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'car_products.product_id')
            ->get();

        return view('Site.search')
            ->with(compact('carmodels'))
            ->with(compact('countState'))
            ->with(compact('carproducts'))
            ->with(compact('cartypes'))
            ->with(compact('productbrandvarieties'))
            ->with(compact('states'))
            ->with(compact('menus'))
            ->with(compact('productgroups'))
            ->with(compact('carbrands'))
            ->with(compact('brands'))
            ->with(compact('products'));
    }

    public function technicalsearch(){

        $keywords               = request('technicalsearch');
        $technicalunits         = Technical_unit::technicalsearch($keywords)->whereStatus(4)->latest()->paginate(12);
        $states                 = State::all();
        $cities                 = City::all();
        $countState             = null;
        $filter                 =   0;
        $menus                  = Menu::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $cartypes               = Car_type::whereStatus(4)->get();
        $carproducts            = Car_product::whereStatus(4)->get();
        $product_id             = Technical_unit::technicalsearch($keywords)->pluck('id');
        $productgroups          = Product_group::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $brands                 = Brand::whereStatus(4)->get();
        if (trim($product_id) != '[]') {
            $productbrandvarieties = Product_brand_variety::whereProduct_id($product_id)->get();
        }else{
            $productbrandvarieties = null;
        }

        return view('Site.technicalsearch')
            ->with(compact('filter'))
            ->with(compact('countState'))
            ->with(compact('carmodels'))
            ->with(compact('carproducts'))
            ->with(compact('cartypes'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('productbrandvarieties'))
            ->with(compact('menus'))
            ->with(compact('productgroups'))
            ->with(compact('carbrands'))
            ->with(compact('brands'))
            ->with(compact('technicalunits'));
    }

    public function suppliersearch(){
        $keywords               = request('suppliersearch');
        $suppliers              = Supplier::suppliersearch($keywords)->whereStatus(4)->orderBy('id' , 'DESC')->paginate(12);
        $menus                  = Menu::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = City::all();
        $countState             = null;
        $filter                 =   0;
        $cartypes               = Car_type::whereStatus(4)->get();
        $carproducts            = Car_product::whereStatus(4)->get();
        $product_id             = Supplier::suppliersearch($keywords)->pluck('id');
        $productgroups          = Product_group::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $brands                 = Brand::whereStatus(4)->get();
        if (trim($product_id) != '[]') {
            $productbrandvarieties = Product_brand_variety::whereProduct_id($product_id)->get();
        }else{
            $productbrandvarieties = null;
        }
        return view('Site.suppliersearch')
            ->with(compact('filter'))
            ->with(compact('countState'))
            ->with(compact('carmodels'))
            ->with(compact('carproducts'))
            ->with(compact('cartypes'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('productbrandvarieties'))
            ->with(compact('menus'))
            ->with(compact('productgroups'))
            ->with(compact('carbrands'))
            ->with(compact('brands'))
            ->with(compact('suppliers'));
    }

    public function brandsearch(){
        $keywords           = request('brandsearch');
        $menus              = Menu::whereStatus(4)->get();
         $states            = State::all();
        $countState         = null;

        $productgroups      = Product_group::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $brands             = Brand::brandsearch($keywords)->whereStatus(4)->latest()->paginate(12);

        return view('Site.brandsearch')
            ->with(compact('countState'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('states'))
            ->with(compact('menus'));
    }

    public function offersearchsell(){
        $keywords           = request('offersearch');
        $menus              = Menu::whereStatus(4)->get();
        $offers             = Offer::offersearchsell($keywords)->whereStatus(4)->latest()->paginate(12);
        $selloffers         = Offer::offersearchsell($keywords)->whereStatus(4)->whereBuyorsell('sell')->paginate('16');
        $max_price          = Offer::offersearchsell($keywords)->whereStatus(4)->max('single_price');
        $min_price          = Offer::offersearchsell($keywords)->whereStatus(4)->min('single_price');
        $carproducts        = Car_product::whereStatus(4)->get();
        $productgroups      = Product_group::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $carmodels          = Car_model::whereStatus(4)->get();
         $states            = State::all();
        $cities                 = City::all();
        $countState         = null;
        $users                  = User::select('id' , 'type_id')->get();
        $products               = Product::whereStatus(4)->get();
        $brand_varietis         = Product_brand_variety::all();
        $brands             = Brand::whereStatus(4)->get();
        $caroffers          = Car_offer::all();
        $filter             = 0;

        return view('Site.marketsearchsell')
            ->with(compact('products'))
            ->with(compact('brand_varietis'))
            ->with(compact('users'))
            ->with(compact('countState'))
            ->with(compact('selloffers'))
            ->with(compact('max_price'))
            ->with(compact('min_price'))
            ->with(compact('productgroups'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('caroffers'))
            ->with(compact('filter'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'))
            ->with(compact('carproducts'))
            ->with(compact('offers'))
            ->with(compact('brands'))
            ->with(compact('menus'));
    }

    public function offersearchbuy(){
        $keywords           = request('offersearch');
        $menus              = Menu::whereStatus(4)->get();
        $users                  = User::select('id' , 'type_id')->get();
        $products               = Product::whereStatus(4)->get();
        $brand_varietis         = Product_brand_variety::all();
        $offers             = Offer::offersearchbuy($keywords)->whereStatus(4)->latest()->paginate(12);
        $buyoffers          = Offer::offersearchbuy($keywords)->whereStatus(4)->whereBuyorsell('buy')->paginate('16');
        $max_price          = Offer::offersearchbuy($keywords)->whereStatus(4)->max('single_price');
        $min_price          = Offer::offersearchbuy($keywords)->whereStatus(4)->min('single_price');
        $productgroups      = Product_group::whereStatus(4)->get();
        $carproducts        = Car_product::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $carmodels          = Car_model::whereStatus(4)->get();
        $states             = State::all();
        $cities             = City::all();
        $brands             = Brand::whereStatus(4)->get();
        $caroffers          = Car_offer::all();
        $filter             = 0;

        return view('Site.marketsearchbuy')
            ->with(compact('products'))
            ->with(compact('brand_varietis'))
            ->with(compact('users'))
            ->with(compact('buyoffers'))
            ->with(compact('max_price'))
            ->with(compact('min_price'))
            ->with(compact('productgroups'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('caroffers'))
            ->with(compact('filter'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'))
            ->with(compact('carproducts'))
            ->with(compact('offers'))
            ->with(compact('brands'))
            ->with(compact('menus'));
    }

}
