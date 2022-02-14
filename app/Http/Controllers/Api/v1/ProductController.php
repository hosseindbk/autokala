<?php

namespace App\Http\Controllers\Api\v1;

use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Media;
use App\Product;
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

        $product_id       = Product::whereSlug($slug)->pluck('id');

        $commentratecount       = commentrate::whereCommentable_type('App\Product')->where('Commentable_id' ,$product_id)->whereApproved(1)->count();
        $comments               = comment::whereCommentable_type('App\Product')->whereIn('Commentable_id'   ,$product_id)->select('phone' , 'comment' , 'id as comment_id')->whereParent_id(0)->whereApproved(1)->latest()->get();


        $subcomments            = comment::whereCommentable_type('App\Product')->whereIn('Commentable_id'   ,$product_id)->select('phone' , 'comment' , 'parent_id')->where('parent_id' , '>', 0)->whereApproved(1)->latest()->get();

        $cars = DB::table('car_products')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'car_products.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'car_products.car_model_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'car_products.product_id')
            ->whereIn('product_id'  , $product_id)
            ->get();

        $products = DB::table('products')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'products.kala_group_id')
            ->select('products.unicode' , 'products.slug' , 'products.image' , 'products.title_fa' , 'products.title_en' ,
                'products.title_bazar_fa' , 'products.code_fani_company as company_code' , 'products.description' , 'product_groups.title_fa as productgroup')
            ->whereSlug($slug)
            ->first();
        $tmp=json_decode(json_encode($products), true);;
        $medias                 = Media::select('image')->whereProduct_id($product_id)->get();
        $medias = [$medias[0]['image']];
        $tmp['p-image']=$medias;

        $response = [
            'products'          => $tmp,
            'cars'              => $cars,
            'comment'           => $comments,
            'subcomment'        => $subcomments,
            'commentratecount'  => $commentratecount,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response ]);
    }
}
