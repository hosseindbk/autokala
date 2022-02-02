<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Product;
use App\Product_group;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function index(){
        $products       = Product::select('unicode' , 'slug' , 'image' , 'title_fa as title')
            ->whereStatus(4)
            ->orderBy('id' , 'DESC')
            ->paginate(10)
            ->toArray();

        $response = [
            'products'=>$products,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function subproduct($slug){
        $products       = Product::select('unicode' , 'slug' , 'image' , 'title_fa' , 'title_en' , 'title_bazar_fa' , 'code_fani_company as company_code' , 'description' )
            ->whereStatus(4)
            ->whereSlug($slug)
            ->get()
            ->toArray();

        $product_group_id       = Product::whereSlug($slug)->pluck('kala_group_id');
        $productgroups          = Product_group::select('title_fa as productgroup_title')->whereIn('id' , $product_group_id)->get()->toArray();

        $response = [
            'products'      =>  $products,
            'productgroups' =>  $productgroups,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }
}
