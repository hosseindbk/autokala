<?php

namespace App\Http\Controllers\Api\v1;

use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Media;
use App\Product;
use App\Product_brand_variety;
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

        $product_id         = Product::whereSlug($slug)->pluck('id');
        if ($product_id != []) {
            $brand_id = Product_brand_variety::whereIn('product_id', $product_id)->pluck('brand_id');
            $brandvarieties = Product_brand_variety::whereIn('product_id', $product_id)->select('product_brand_varieties.item1 as item1'
                , 'product_brand_varieties.item2 as item2', 'product_brand_varieties.item3 as item3', 'product_brand_varieties.value_item1 as value1'
                , 'product_brand_varieties.value_item2 as value2', 'product_brand_varieties.value_item3 as value3', 'product_brand_varieties.brand_id as brandid')->whereStatus(4)->get();
            $brands = DB::table('brands')
                ->leftJoin('countries', 'countries.id', '=', 'brands.country_id')
                ->select('brands.id as id', 'brands.title_fa as title_fa', 'brands.slug as slug', 'brands.image as image', 'countries.name as country')
                ->whereIn('brands.id', $brand_id)
                ->get();
            $commentratequality     = commentrate::whereCommentable_type('App\Product')->whereIn('Commentable_id', $brand_id)->whereApproved(1)->avg('quality');
            $commentratevalue       = commentrate::whereCommentable_type('App\Product')->whereIn('Commentable_id', $brand_id)->whereApproved(1)->avg('value');
            $commentrateinnovation  = commentrate::whereCommentable_type('App\Product')->whereIn('Commentable_id', $brand_id)->whereApproved(1)->avg('innovation');
            $commentrateability     = commentrate::whereCommentable_type('App\Product')->whereIn('Commentable_id', $brand_id)->whereApproved(1)->avg('ability');
            $commentratedesign      = commentrate::whereCommentable_type('App\Product')->whereIn('Commentable_id', $brand_id)->whereApproved(1)->avg('design');
            $commentratecomfort     = commentrate::whereCommentable_type('App\Product')->whereIn('Commentable_id', $brand_id)->whereApproved(1)->avg('comfort');

            $avgcommentrate = ((int)$commentratequality + (int)$commentratevalue + (int)$commentrateinnovation + (int)$commentrateability + (int)$commentratedesign + (int)$commentratecomfort) / 6;

            if (trim($brandvarieties) != '[]' && trim($brands) != '[]') {
                foreach ($brandvarieties as $brandvariety) {
                    foreach ($brands as $brand) {
                        if ($brandvariety->brandid == $brand->id) {
                            $brandi[] = [
                                'brand_name'        => $brand->title_fa,
                                'guarantee'         => $brandvariety->guarantee,
                                'country'           => $brand->country,
                                'avgcommentrate'    => $avgcommentrate,
                                'slug'              => $brand->slug,
                                'brand_image'       => $brand->image,
//                                'brand_variety' => [
//                                    $brand_variety[] = ['key' => $brandvariety->item1, 'value' => $brandvariety->value1],
//                                    $brand_variety[] = ['key' => $brandvariety->item2, 'value' => $brandvariety->value2],
//                                    $brand_variety[] = ['key' => $brandvariety->item3, 'value' => $brandvariety->value3]
//                                ]
                            ];
                        }
                    }
                }
            } elseif (trim($brands) != '[]' && trim($brandvarieties) == '[]') {
                foreach ($brands as $brand) {
                    $brandi[] = [
                        'brand_name'        => $brand->title_fa,
                        'country'           => $brand->country,
                        'guarantee'         => null,
                        'avgcommentrate'    => $avgcommentrate,
                        'slug'              => $brand->slug,
                        'brand_image'       => $brand->image,
                        'brand_variety' => []
                    ];
                }
            } else {
                $brandi = [];
            }

            $cars = DB::table('car_products')
                ->leftJoin('car_brands', 'car_brands.id', '=', 'car_products.car_brand_id')
                ->leftJoin('car_models', 'car_models.id', '=', 'car_products.car_model_id')
                ->select('car_brands.title_fa as brand_title', 'car_models.title_fa as model_title', 'car_products.product_id')
                ->whereIn('product_id', $product_id)
                ->get();


            $products = DB::table('products')
                ->leftJoin('product_groups', 'product_groups.id', '=', 'products.kala_group_id')
                ->select('products.unicode as unicode', 'products.slug as slug', 'products.image as image', 'products.title_fa as title', 'products.title_en as title_en',
                    'products.title_bazar_fa as title_bazar', 'products.code_fani_company as company_code', 'products.description as description', 'product_groups.title_fa as productgroup'
                    , 'products.created_at as created_at', 'products.hs as hs', 'products.oem as oem', 'title_specific1', 'title_specific2', 'title_specific3', 'specific1', 'specific2', 'specific3')
                ->whereSlug($slug)
                ->get();
            foreach ($products as $product) {
                if ($product->title_specific1 != null) {
                    $test = [
                        'unicode' => $product->unicode,
                        'slug' => $product->slug,
                        'hs' => $product->hs,
                        'oem' => $product->oem,
                        'image' => $product->image,
                        'title' => $product->title,
                        'title_en' => $product->title_en,
                        'title_bazar' => $product->title_bazar,
                        'company_code' => $product->company_code,
                        'specific' => [
                            ['key' => $product->title_specific1, 'value' => $product->specific1],
                            ['key' => $product->title_specific2, 'value' => $product->specific2],
                            ['key' => $product->title_specific3, 'value' => $product->specific3]
                        ],

                        'description' => $product->description,
                        'productgroup' => $product->productgroup,
                        'brand' => $brandi,

                    ];

                } elseif ($product->title_specific1 == null) {

                    $test = [
                        'unicode' => $product->unicode,
                        'slug' => $product->slug,
                        'hs' => $product->hs,
                        'oem' => $product->oem,
                        'image' => $product->image,
                        'title' => $product->title,
                        'title_en' => $product->title_en,
                        'title_bazar' => $product->title_bazar,
                        'company_code' => $product->company_code,
                        'specific' => [],

                        'description' => $product->description,
                        'productgroup' => $product->productgroup,
                        'brand' => $brandi,

                    ];
                }
            }
            $tmp = json_decode(json_encode($test), true);
            $medias = Media::select('image')->whereIn('product_id', $product_id)->get();

            if (trim($medias) != '[]') {
                foreach ($medias as $media) {
                    $medis[] = $media->image;
                }
                $tmp['product-image'] = $medis;
            } else {
                $tmp['product-image'] = [];
            }
            $proid = Product::whereSlug($slug)->pluck('id');
            $comments = comment::whereCommentable_type('App\Product')->where('Commentable_id', $proid)->select('name', 'phone', 'comment', 'id', 'created_at')->whereParent_id(0)->whereApproved(1)->latest()->get();
            $subcomments = comment::whereCommentable_type('App\Product')->where('Commentable_id', $proid)->select('name','phone', 'comment', 'parent_id')->where('parent_id', '>', 0)->whereApproved(1)->latest()->get();
            if (trim($comments) != '[]') {
                foreach ($comments as $comment) {
                    $answer = [];
                    foreach ($subcomments as $subcomment) {
                        if ($subcomment->parent_id == $comment->id) {
                            $answer[] = [
                                'name'          => $subcomment->name,
                                'phone'         => $subcomment->phone,
                                'comment'       => $subcomment->comment,
                                'created_at'    => jdate($subcomment->created_at)->ago(),
                            ];
                        }
                    }
                    $comt[] = [
                        'name'          => $comment->name,
                        'phone'         => $comment->phone,
                        'comment'       => $comment->comment,
                        'created_at'    => jdate($comment->created_at)->ago(),
                        'answer'        => $answer
                    ];
                }
            } else {
                $comt = [];
            }

            $status = true;
            $message = 'success';


        }else{
            $tmp     = [];
            $cars    = [];
            $comt    = [];
            $status  = false;
            $message = 'faild';
        }

        $response = [
            'products'          => $tmp,
            'cars'              => $cars,
            'comment'           => $comt,
        ];
        return Response::json(['ok' => $status ,'message' => $message ,'response'=>$response ]);
    }
}
