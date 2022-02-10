<?php

namespace App\Http\Controllers\Api\v1;

use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_group;
use Illuminate\Support\Facades\DB;
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

        $product_id       = Product::whereSlug($slug)->pluck('id');
        $kala_group_id       = Product::whereSlug($slug)->pluck('kala_group_id');

        $commentratecount       = commentrate::whereCommentable_type('App\Product')->where('Commentable_id' ,$product_id)->whereApproved(1)->count();
        $comments               = comment::whereCommentable_type('App\Product')->whereIn('Commentable_id'   ,$product_id)->select('phone' , 'comment')->whereApproved(1)->latest()->get();


        $cars = DB::table('car_products')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'car_products.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'car_products.car_model_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'car_products.product_id')
            ->whereIn('product_id'  , $product_id)
            ->get();

        $productgroups = Product_group::select('title_fa as title')->whereId($kala_group_id)->get()->toArray();

        $response = [
            'products'          =>  $products,
            'cars'              =>  $cars,
            'comment'           => $comments,
            'commentratecount'  => $commentratecount,
            'productgroup'      => $productgroups

        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }
}
