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


        $cars = DB::table('car_products')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'car_products.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'car_products.car_model_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'car_products.product_id')
            ->whereIn('product_id'  , $product_id)
            ->get();

        $products = DB::table('products')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'products.kala_group_id')
            ->select('products.unicode as unicode' , 'products.slug as slug' , 'products.image as image' , 'products.title_fa as title' , 'products.title_en as title_en' ,
                'products.title_bazar_fa as title_bazar' , 'products.code_fani_company as company_code' , 'products.description as description' , 'product_groups.title_fa as productgroup'
            ,'products.created_at as created_at')
            ->whereSlug($slug)
            ->get();
        foreach ($products as $product) {

            $test = [
                'unicode'       => $product->unicode,
                'slug'          => $product->slug,
                'image'         => $product->image,
                'title'         => $product->title,
                'title_en'      => $product->title_en,
                'title_bazar'   => $product->title_bazar,
                'company_code'  => $product->company_code,
                'description'   => $product->description,
                'productgroup'  => $product->productgroup,
                'created_at'    => jdate($product->created_at)->ago(),
            ];
        }
        $tmp        = json_decode(json_encode($test), true);
        $medias     = Media::select('image')->whereIn('product_id' , $product_id)->get();

        foreach ($medias as $media){
            $medis[]  =  $media->image;
        }
        $tmp['product-image']=$medis;

        $comments               = comment::whereCommentable_type('App\Product')->whereIn('Commentable_id'   ,$product_id)->select('phone' , 'comment' , 'id as comment_id' , 'created_at')->whereParent_id(0)->whereApproved(1)->latest()->get();
        $subcomments            = comment::whereCommentable_type('App\Product')->whereIn('Commentable_id'   ,$product_id)->select('phone' , 'comment' , 'parent_id')->where('parent_id' ,'>' ,  0)->whereApproved(1)->latest()->get();


        $response = [
            'products'          => $tmp,
            'cars'              => $cars,
            'comment'           => $comments,
//            'subcomment'        => $subcomments,
            'commentratecount'  => $commentratecount,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response ]);
    }
}
