<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\City;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Offer;
use App\Representative_supplier;
use App\Slide;
use App\State;
use App\Supplier;
use App\Technical_unit;
use App\User;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{

    public function index(){
        $cities             = City::all();
        $states             = State::all();
        $countState         = null;
        $menus              = Menu::whereStatus(4)->get();
        $offers             = Offer::whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $brands             = Brand::whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $technicalunits     = Technical_unit::whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $suppliers          = Supplier::whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $orginal_slides     = Slide::whereStatus(4)->wherePosition(1)->latest()->get();
        $left_top_slides    = Slide::whereStatus(4)->wherePosition(2)->limit(1)->get();
        $left_bottom_slides = Slide::whereStatus(4)->wherePosition(3)->limit(1)->get();
        $minid              = Slide::whereStatus(4)->wherePosition(1)->min('id');

        $visitors = new Visitor();

        $visitors->ip       =   request()->ip();
        $visitors->datetime =   jdate();
        $visitors->page_id  =  '/';

        $visitors->save();

        return view('Site.index')
            ->with(compact('cities'))
            ->with(compact('countState'))
            ->with(compact('states'))
            ->with(compact('offers'))
            ->with(compact('suppliers'))
            ->with(compact('technicalunits'))
            ->with(compact('brands'))
            ->with(compact('minid'))
            ->with(compact('orginal_slides'))
            ->with(compact('left_top_slides'))
            ->with(compact('left_bottom_slides'))
            ->with(compact('menus'));
    }

    public function indexstate(){
        $id                 = request('state_id');
        if ($id == null){
            $countState     = State::all();
        }else{
            $countState     = State::whereIn('id' , $id)->get();
        }
        $cities             = City::all();
        $states             = State::all();
        $menus              = Menu::whereStatus(4)->get();
        $offers             = Offer::state()->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $brands             = Brand::whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $technicalunits     = Technical_unit::state()->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $suppliers          = Supplier::state()->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $orginal_slides     = Slide::whereStatus(4)->wherePosition(1)->latest()->get();
        $left_top_slides    = Slide::whereStatus(4)->wherePosition(2)->limit(1)->get();
        $left_bottom_slides = Slide::whereStatus(4)->wherePosition(3)->limit(1)->get();
        $minid              = Slide::whereStatus(4)->wherePosition(1)->min('id');
        return view('Site.index')
            ->with(compact('cities'))
            ->with(compact('countState'))
            ->with(compact('states'))
            ->with(compact('offers'))
            ->with(compact('suppliers'))
            ->with(compact('technicalunits'))
            ->with(compact('brands'))
            ->with(compact('minid'))
            ->with(compact('orginal_slides'))
            ->with(compact('left_top_slides'))
            ->with(compact('left_bottom_slides'))
            ->with(compact('menus'));
    }

    public function company($slug)
    {
        $suppliers = Supplier::
          leftjoin('states' , 'states.id' , '=' ,'suppliers.state_id')
        ->leftjoin('cities' , 'cities.id' ,'=' ,'suppliers.city_id')
        ->select('suppliers.id' ,'suppliers.logo' ,'suppliers.title' ,'suppliers.description' ,'suppliers.lat' ,'suppliers.lng' ,
            'suppliers.phone' ,'suppliers.mobile' ,'suppliers.whatsapp' ,'suppliers.address' ,'states.title' ,'cities.title')
        ->where('suppliers.pageurl' , $slug)->get();
        if (trim($suppliers) == '[]') {
            return Redirect::to('/');

        } else {
            $cities         = City::select('id', 'title')->get();
            $states         = State::select('id', 'title')->get();
            $countState     = null;
            $menus          = Menu::select('title', 'slug')->whereStatus(4)->get();
            $user_id        = Supplier::wherePageurl($slug)->pluck('user_id');
            $brands         = Brand::whereStatus(4)->whereUser_id($user_id)->get();
            $supplier_id    = Supplier::wherePageurl($slug)->pluck('id');
            $offers         = Offer::whereStatus(4)->whereSupplier_id($supplier_id)->get();
            $users          = User::select('id', 'type_id')->get();

            $brandnames = Offer::leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
                ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
                ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
                ->select('offers.brand_id as brand_offer_id', 'offers.id as offer_id', 'product_brand_varieties.brand_id as brand_variety_id', 'product_brand_varieties.product_id', 'brands.title_fa')
                ->where('offers.status', '=', '4')
                ->whereBuyorsell('sell')
                ->where('offers.brand_id', '<>', null)
                ->get();
            $visitors = new Visitor();

            $visitors->ip = request()->ip();
            $visitors->datetime = jdate();
            $visitors->page_id = '/';

            $visitors->save();

            return view('Site.companyindex')
                ->with(compact('brandnames'))
                ->with(compact('cities'))
                ->with(compact('users'))
                ->with(compact('countState'))
                ->with(compact('states'))
                ->with(compact('offers'))
                ->with(compact('suppliers'))
                ->with(compact('brands'))
                ->with(compact('menus'));
        }
    }
}
