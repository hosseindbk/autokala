<?php

namespace App\Http\Controllers\Api\v1;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Slide;
use App\Supplier;
use App\Technical_unit;
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{
    public function index(){

        $offers             = Offer::select('slug' , 'unicode_product' , 'supplier_id' , 'title_offer as title' , 'buyorsell' , 'single_price' , 'image1')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $brands             = Brand::select('title_fa as title' , 'slug' , 'image')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $technicalunits     = Technical_unit::select('title' , 'slug' , 'image')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $suppliers          = Supplier::select('title' , 'slug' , 'image')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $orginal_slides     = Slide::select('image as images')->whereStatus(4)->wherePosition(1)->latest()->get();

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
