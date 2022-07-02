<?php

namespace App\Http\Controllers\Api\v1;

use App\Brand;
use App\Car_product;
use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Http\Requests\productbrandvarietyrequest;
use App\Media;
use App\Product;
use App\Product_brand_variety;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(){
        $products       = Product::select('unicode' , 'slug' , 'image' , 'title_fa as title')
            ->whereStatus(4)
            ->sort()
            ->filter()
            ->paginate(10);

        $response = [
            'products'=>$products,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function variety(){

        $products       = Product::leftjoin('product_brand_varieties' , 'product_brand_varieties.product_id' , '=' , 'products.id')
            ->select('unicode' , 'slug' , 'image' , 'title_fa as title' )
            ->where('products.status' , 4)
            ->paginate(10);

        $response = [
            'products'=>$products,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function topview(){
        $products       = Product::select('unicode' , 'slug' , 'image' , 'title_fa as title')
            ->whereStatus(4)
            ->orderBy('click')
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

            $brandvarieties = Product_brand_variety::whereIn('product_id', $product_id)
                ->select('product_brand_varieties.item1 as item1'
                    , 'product_brand_varieties.item2 as item2', 'product_brand_varieties.item3 as item3'
                    , 'product_brand_varieties.value_item1 as value1'
                    , 'product_brand_varieties.value_item2 as value2', 'product_brand_varieties.value_item3 as value3'
                    , 'product_brand_varieties.brand_id as brandid')
                ->whereStatus(4)
                ->get();

            $brands = Brand::leftJoin('countries', 'countries.id', '=', 'brands.country_id')
                ->select('brands.id as id', 'brands.title_fa as title_fa', 'brands.slug as slug'
                    , 'brands.image as image', 'countries.name as country')
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
                        'brand_variety'     => []
                    ];
                }
            } else {
                $brandi = [];
            }

            $cars = Car_product::leftJoin('car_brands', 'car_brands.id', '=', 'car_products.car_brand_id')
                ->leftJoin('car_models', 'car_models.id', '=', 'car_products.car_model_id')
                ->select('car_brands.title_fa as brand_title', 'car_models.title_fa as model_title', 'car_products.product_id')
                ->whereIn('product_id', $product_id)
                ->get();


            $products = Product::leftjoin('markusers' , 'markusers.product_id' , '=' , 'products.id')
                ->leftJoin('product_groups', 'product_groups.id', '=', 'products.kala_group_id')
                ->select('products.id as product_id', 'markusers.id as mark_id' , 'products.unicode as unicode'          , 'products.slug as slug'           , 'products.hs as hs',
                    'products.title_bazar_fa as title_bazar'    , 'products.oem as oem'             , 'products.title_specific1' ,
                    'products.code_fani_company as company_code', 'products.title_specific2'        , 'products.title_specific3' ,
                    'products.description as description'       , 'products.image as image'         , 'products.specific3',
                    'product_groups.title_fa as productgroup'   , 'products.title_en as title_en'   , 'products.specific1',
                    'product_groups.id as productgroup_id'      , 'products.title_fa as title'      , 'products.specific2',
                    'products.created_at as created_at'  )
                ->where('products.slug' ,'=',$slug)
                ->get();
            foreach ($products as $product) {
                if ($product->title_specific1 != null) {
                    $test = [
                        'product_id'    => $product->product_id,
                        'mark_id'       => $product->mark_id,
                        'unicode'       => $product->unicode,
                        'slug'          => $product->slug,
                        'hs'            => $product->hs,
                        'oem'           => $product->oem,
                        'image'         => $product->image,
                        'title'         => $product->title,
                        'title_en'      => $product->title_en,
                        'title_bazar'   => $product->title_bazar,
                        'company_code'  => $product->company_code,
                        'specific' => [
                            ['key' => $product->title_specific1, 'value' => $product->specific1],
                            ['key' => $product->title_specific2, 'value' => $product->specific2],
                            ['key' => $product->title_specific3, 'value' => $product->specific3]
                        ],

                        'description'       => $product->description,
                        'productgroup'      => $product->productgroup,
                        'productgroup_id'   => $product->productgroup_id,
                        'brand'             => $brandi,

                    ];

                } elseif ($product->title_specific1 == null) {

                    $test = [
                        'product_id'    => $product->product_id,
                        'mark_id'       => $product->mark_id,
                        'unicode'       => $product->unicode,
                        'slug'          => $product->slug,
                        'hs'            => $product->hs,
                        'oem'           => $product->oem,
                        'image'         => $product->image,
                        'title'         => $product->title,
                        'title_en'      => $product->title_en,
                        'title_bazar'   => $product->title_bazar,
                        'company_code'  => $product->company_code,
                        'specific'      => [],

                        'description'       => $product->description,
                        'productgroup'      => $product->productgroup,
                        'productgroup_id'   => $product->productgroup_id,
                        'brand'             => $brandi,

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

            $proid          = Product::whereSlug($slug)->pluck('id');
            $comments       = comment::whereCommentable_type('App\Product')->where('Commentable_id', $proid)->select('name', 'phone', 'comment', 'id', 'created_at')->whereParent_id(0)->whereApproved(1)->latest()->get();
            $subcomments    = comment::whereCommentable_type('App\Product')->where('Commentable_id', $proid)->select('name','phone', 'comment', 'parent_id')->where('parent_id', '>', 0)->whereApproved(1)->latest()->get();

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

    public function createproductvariety(productbrandvarietyrequest $request)
    {
        if (Auth::user()->type_id == 1) {
            $productbrandvarieties = new Product_brand_variety();

            $productbrandvarieties->brand_id    = $request->input('brand_id');
            $productbrandvarieties->product_id  = $request->input('product_id');
            $productbrandvarieties->guarantee   = $request->input('guarantee');
            $productbrandvarieties->item1       = $request->input('item1');
            $productbrandvarieties->item2       = $request->input('item2');
            $productbrandvarieties->item3       = $request->input('item3');
            $productbrandvarieties->value_item1 = $request->input('value_item1');
            $productbrandvarieties->value_item2 = $request->input('value_item2');
            $productbrandvarieties->value_item3 = $request->input('value_item3');
            $productbrandvarieties->strength1   = $request->input('strength1');
            $productbrandvarieties->strength2   = $request->input('strength2');
            $productbrandvarieties->strength3   = $request->input('strength3');
            $productbrandvarieties->weakness1   = $request->input('weakness1');
            $productbrandvarieties->weakness2   = $request->input('weakness2');
            $productbrandvarieties->weakness3   = $request->input('weakness3');
            $productbrandvarieties->status      = '1';
            $productbrandvarieties->description = $request->input('description');
            $productbrandvarieties->date        = jdate()->format('Ymd ');
            $productbrandvarieties->date_handle = jdate()->format('Ymd ');
            $productbrandvarieties->user_id     = Auth::user()->id;

            if ($request->file('image1') != null) {
                $file = $request->file('image1');
                $img = Image::make($file);
                $imagePath = "images/productbrandvarieties/";
                $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
                $productbrandvarieties->image1 = $file->move($imagePath, $imageName);
                $img->save($imagePath . $imageName);
                $img->encode('jpg');
            }

            if ($request->file('image2') != null) {
                $file = $request->file('image2');
                $img = Image::make($file);
                $imagePath = "images/productbrandvarieties/";
                $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
                $productbrandvarieties->image2 = $file->move($imagePath, $imageName);
                $img->save($imagePath . $imageName);
                $img->encode('jpg');
            }

            if ($request->file('image3') != null) {
                $file = $request->file('image3');
                $img = Image::make($file);
                $imagePath = "images/productbrandvarieties/";
                $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
                $productbrandvarieties->image3 = $file->move($imagePath, $imageName);
                $img->save($imagePath . $imageName);
                $img->encode('jpg');
            }
            $productbrandvarieties->save();

            $response = 'اطلاعات با موفقیت ثبت شد';

            return Response::json(['ok' => true, 'message' => 'success', 'response' => $response]);
        }else{
            $response = 'شما دسترسی لازم جهت ثبت را ندارید';

            return Response::json(['ok' => false, 'message' => 'failed', 'response' => $response]);
        }

    }

    public function productvariety(){
        $productvarietis       = Product_brand_variety::
        leftjoin('products'                 , 'products.id'     , '=' , 'product_brand_varieties.product_id')
            ->leftjoin('brands'             , 'brands.id'       , '=' , 'product_brand_varieties.brand_id')
            ->leftjoin('countries'          , 'countries.id'    , '=' , 'brands.country_id')
            ->select('brands.title_fa as brandtitle' , 'products.title_fa as producttitle' , 'product_brand_varieties.id', 'product_brand_varieties.item1'  , 'product_brand_varieties.item2' , 'product_brand_varieties.item3' , 'product_brand_varieties.value_item1', 'product_brand_varieties.value_item2', 'product_brand_varieties.value_item3'
                , 'product_brand_varieties.strength1' , 'product_brand_varieties.strength2'  , 'product_brand_varieties.strength3' , 'product_brand_varieties.weakness1' , 'product_brand_varieties.weakness2' , 'product_brand_varieties.weakness3' , 'product_brand_varieties.image1' ,'countries.name as country' ,
                DB::raw( '(CASE
            WHEN product_brand_varieties.guarantee = "0" THEN "ندارد"
            WHEN product_brand_varieties.guarantee = "1" THEN "دارد"
            END) AS guarantee'),
                DB::raw( '(CASE
            WHEN product_brand_varieties.status < "4" THEN "false"
            WHEN product_brand_varieties.status = "4" THEN "true"
            END) AS status'))
            ->where('product_brand_varieties.user_id' , auth::user()->id)
            ->get();

        $response = [
            'productvarietis'=>$productvarietis,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

//    public function subproductvariety($id , $slug){
//        $productvarietis       = Product_brand_variety::
//            leftjoin('products' , 'products.id' , '=' , 'product_brand_varieties.product_id')
//            ->leftjoin('brands' , 'brands.id' , '=' , 'product_brand_varieties.brand_id')
//            ->leftjoin('countries' , 'countries.id' , '=' , 'brands.country_id')
//            ->select('brands.title_fa' , 'products.title_fa' , 'product_brand_varieties.id', 'product_brand_varieties.item1'  , 'product_brand_varieties.item2' , 'product_brand_varieties.item3' , 'product_brand_varieties.value_item1', 'product_brand_varieties.value_item2', 'product_brand_varieties.value_item3'
//                , 'product_brand_varieties.strength1' , 'product_brand_varieties.strength2'  , 'product_brand_varieties.strength3' , 'product_brand_varieties.weakness1' , 'product_brand_varieties.weakness2' , 'product_brand_varieties.weakness3' , 'product_brand_varieties.image1', 'product_brand_varieties.image2', 'product_brand_varieties.image3'
//                ,'countries.name as country', 'product_brand_varieties.description' , 'products.title_bazar_fa', 'products.title_en', 'products.code_fani_company'
//                 ,DB::raw( '(CASE
//            WHEN product_brand_varieties.guarantee = "0" THEN "ندارد"
//            WHEN product_brand_varieties.guarantee = "1" THEN "دارد"
//            END) AS guarantee'),
//                DB::raw( '(CASE
//            WHEN product_brand_varieties.status < "4" THEN "false"
//            WHEN product_brand_varieties.status = "4" THEN "true"
//            END) AS status'))
//            ->where('product_brand_varieties.user_id' , auth::user()->id)
//            ->get();
//
//        $productvarity_id               = Product_brand_variety::where('slug', $slug)->pluck('id');
//        $commentratequality     = commentrate::whereCommentable_type('App\Product_brand_variety')->whereIn('Commentable_id', $productvarity_id)->whereApproved(1)->avg('quality');
//        $commentratevalue       = commentrate::whereCommentable_type('App\Product_brand_variety')->whereIn('Commentable_id', $productvarity_id)->whereApproved(1)->avg('value');
//        $commentrateinnovation  = commentrate::whereCommentable_type('App\Product_brand_variety')->whereIn('Commentable_id', $productvarity_id)->whereApproved(1)->avg('innovation');
//        $commentrateability     = commentrate::whereCommentable_type('App\Product_brand_variety')->whereIn('Commentable_id', $productvarity_id)->whereApproved(1)->avg('ability');
//        $commentratedesign      = commentrate::whereCommentable_type('App\Product_brand_variety')->whereIn('Commentable_id', $productvarity_id)->whereApproved(1)->avg('design');
//        $commentratecomfort     = commentrate::whereCommentable_type('App\Product_brand_variety')->whereIn('Commentable_id', $productvarity_id)->whereApproved(1)->avg('comfort');
//
//        $avgcommentrate = ((int)$commentratequality + (int)$commentratevalue + (int)$commentrateinnovation + (int)$commentrateability + (int)$commentratedesign + (int)$commentratecomfort) / 6;
//
//        $comments       = comment::whereCommentable_type('App\Product_brand_variety')->where('Commentable_id', $productvarity_id)->select('name', 'phone', 'comment', 'id', 'created_at')->whereParent_id(0)->whereApproved(1)->latest()->get();
//        $subcomments    = comment::whereCommentable_type('App\Product_brand_variety')->where('Commentable_id', $productvarity_id)->select('name','phone', 'comment', 'parent_id')->where('parent_id', '>', 0)->whereApproved(1)->latest()->get();
//
//        if (trim($comments) != '[]') {
//            foreach ($comments as $comment) {
//                $answer = [];
//                foreach ($subcomments as $subcomment) {
//                    if ($subcomment->parent_id == $comment->id) {
//                        $answer[] = [
//                            'name'          => $subcomment->name,
//                            'phone'         => $subcomment->phone,
//                            'comment'       => $subcomment->comment,
//                            'created_at'    => jdate($subcomment->created_at)->ago(),
//                        ];
//                    }
//                }
//                $comt[] = [
//                    'name'          => $comment->name,
//                    'phone'         => $comment->phone,
//                    'comment'       => $comment->comment,
//                    'created_at'    => jdate($comment->created_at)->ago(),
//                    'answer'        => $answer
//                ];
//            }
//        } else {
//            $comt = [];
//        }
//        $response = [
//            'productvarietis'   =>$productvarietis,
//            'avgcommentrate'    =>$avgcommentrate ,
//            'comment'           =>$comt
//        ];
//        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
//    }

//    public function productbrandvaritydelete($id)
//    {
//        $productvarity = Product_brand_variety::findOrfail($id);
//        $productvarity->delete();
//        $status     = true;
//        $message    = 'success';
//        $response   = 'اطلاعات با موفقیت پاک شد';
//
//        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
//    }
}
