<?php

namespace App\Http\Controllers\Api\v1;

use App\Brand;
use App\City;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Offer;
use App\Slide;
use App\State;
use App\Supplier;
use App\Technical_unit;
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{
    public function index(){

        $citis              = City::select('id as city_id','title as city' , 'state_id')->get()->toArray();
        $state              = State::select('id as state_id','title as state')->get()->toArray();
        $offers             = Offer::select('slug' , 'unicode_product' , 'supplier_id' , 'title_offer as title' , 'buyorsell' , 'single_price' , 'image1')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get()->toArray();
        $brands             = Brand::select('title_fa as title' , 'slug' , 'image')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get()->toArray();
        $technicalunits     = Technical_unit::select('title' , 'slug' , 'image')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get()->toArray();
        $suppliers          = Supplier::select('title' , 'slug' , 'image')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get()->toArray();
        $orginal_slides     = Slide::select('image')->whereStatus(4)->wherePosition(1)->latest()->get()->toArray();

        $response = [
                'citis'         => $citis ,
                'state'         =>$state ,
                'offer'         =>$offers ,
                'brand'         =>$brands,
                'technicalunits'=>$technicalunits  ,
                'suppliers'     =>$suppliers ,
                'orginal_slides'=>$orginal_slides,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
}
