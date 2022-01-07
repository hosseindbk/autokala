<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\City;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Offer;
use App\Slide;
use App\State;
use App\Supplier;
use App\Technical_unit;
use App\Visitor;
use Illuminate\Http\Request;

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
}
