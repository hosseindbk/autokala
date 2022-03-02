<?php

namespace App\Http\Controllers\Api\v1;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Slide;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{
    public function index(){

        $offers             = Offer::select('slug' , 'unicode_product' , 'supplier_id' , 'title_offer as title' , 'buyorsell' , 'single_price' , 'image1')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $brands             = Brand::select('title_fa as title' , 'slug' , 'image')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $orginal_slides     = Slide::select('image as images')->whereStatus(4)->wherePosition(1)->latest()->get();

        $technicalunits = DB::table('technical_units')
            ->leftJoin('states', 'states.id', '=', 'technical_units.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'technical_units.city_id')
            ->select('technical_units.title' , 'technical_units.slug' , 'technical_units.image' , 'states.title as state' , 'cities.title as city')
            ->where('technical_units.status' , '=', '4')
            ->where('technical_units.homeshow' , '=', '1')
            ->get();

        $suppliers = DB::table('suppliers')
            ->leftJoin('states', 'states.id', '=', 'suppliers.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'suppliers.city_id')
            ->select('suppliers.title' , 'suppliers.slug' , 'suppliers.image' , 'states.title as state' , 'cities.title as city')
            ->where('suppliers.status' , '=', '4')
            ->where('suppliers.homeshow' , '=', '1')
            ->get();

        foreach($orginal_slides as $orginal_slide) {
            $slide [] = $orginal_slide->images;
        }

        $response = [
                'offer'          => $offers ,
                'brand'          => $brands,
                'technicalunits' => $technicalunits  ,
                'suppliers'      => $suppliers ,
                'orginal_slides' => $slide,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
}
