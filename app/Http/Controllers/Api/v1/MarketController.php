<?php

namespace App\Http\Controllers\Api\v1;


use App\Car_offer;
use App\comment;
use App\Http\Controllers\Controller;
use App\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class MarketController extends Controller
{
    public function sell(){

        $brandnames = Offer::leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->leftJoin('states', 'states.id', '=', 'offers.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'offers.city_id')
            ->leftJoin('users', 'users.id', '=', 'offers.user_id')
            ->select('brands.title_fa as brand' ,'offers.total as numberofsell' , 'offers.slug' , 'offers.image1 as image' , 'offers.title_offer as title' , 'states.title as state' , 'cities.title as city' , 'offers.price as wholesaleprice' , 'offers.single_price as retailprice',

            DB::raw( '(CASE
            WHEN users.type_id = "1" THEN "فروشگاه"
            WHEN users.type_id = "3" THEN "شخصی"
            WHEN users.type_id = "4" THEN "شخصی"
            END) AS type'))
            ->where('offers.status' , '=', '4')
            ->where('offers.buyorsell' ,'=' , 'sell')
            ->where('offers.brand_id' , '<>' , null)
            ->filter()
            ->paginate(16);
        foreach ($brandnames as $brandname)
        {
            $brandname = [
                'brand' => $brandname->brand,
                'numberofsell'      => $brandname->numberofsell,
                'slug'              => $brandname->slug,
                'image'             => $brandname->image,
                'title'             => $brandname->title,
                'state'             => $brandname->state,
                'city'              => $brandname->city,
                'wholesaleprice'    => $brandname->wholesaleprice,
                'retailprice'       => $brandname->retailprice,
                'type'              => $brandname->type,
                'noeoffer'          => 'آگهی فروش',
            ];
        }
        $response = [
            'selloffer'=>$brandname,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function buy(){
        $brandnames = Offer::leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands' , 'brands.id'   , '='   , 'product_brand_varieties.brand_id')
            ->leftJoin('states' , 'states.id'   , '='   , 'offers.state_id')
            ->leftJoin('cities' , 'cities.id'   , '='   , 'offers.city_id')
            ->leftJoin('users'  , 'users.id'    , '='   , 'offers.user_id')
            ->select('brands.title_fa as brand' ,'offers.total as numberofsell', 'offers.slug' , 'offers.image1 as image'
                , 'offers.title_offer as title' , 'states.title as state' , 'cities.title as city' , 'offers.price as wholesaleprice'
                , 'offers.single_price as retailprice',
            DB::raw( '(CASE
            WHEN users.type_id = "1" THEN "فروشگاه"
            WHEN users.type_id = "3" THEN "شخصی"
            WHEN users.type_id = "4" THEN "شخصی"
            END) AS type') )
            ->where('offers.status' , '=', '4')
            ->where('offers.buyorsell' ,'=' , 'buy')
            ->filter()
            ->where('offers.brand_id' , '<>' , null)
            ->paginate(16);

        foreach ($brandnames as $brandname)
        {
            $brandname = [
                'brand' => $brandname->brand,
                'numberofsell'      => $brandname->numberofsell,
                'slug'              => $brandname->slug,
                'image'             => $brandname->image,
                'title'             => $brandname->title,
                'state'             => $brandname->state,
                'city'              => $brandname->city,
                'wholesaleprice'    => $brandname->wholesaleprice,
                'retailprice'       => $brandname->retailprice,
                'type'              => $brandname->type,
                'noeoffer'          => 'آگهی خرید',
            ];
        }

        $response = [
            'buyoffer'=>$brandname,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function submarket($slug){

        $offers = Offer::leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'offers.product_group')
            ->leftJoin('states', 'states.id', '=', 'offers.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'offers.city_id')
            ->leftJoin('users', 'users.id', '=', 'offers.user_id')
            ->leftjoin('markusers' , 'markusers.offer_id' , '=' , 'offers.id')
            ->select('offers.id as offer_id' , 'markusers.id as mark_id','brands.title_fa as brand' ,'offers.total as number', 'offers.slug' , 'offers.image1', 'offers.image2', 'offers.image3' ,
                'offers.title_offer as title' , 'states.title as state' , 'cities.title as city' , 'offers.price as wholesaleprice' ,
                'offers.single_price as retailprice' ,'offers.unicode_product as unicode' ,'offers.description' , 'offers.phone', 'offers.mobile' , 'offers.address' ,
                'offers.lat','offers.lng' ,'product_groups.title_fa as product_group' , 'offers.created_at as created_at' ,

                DB::raw( '(CASE
            WHEN users.type_id = "1" THEN "فروشگاه"
            WHEN users.type_id = "3" THEN "شخصی"
            WHEN users.type_id = "4" THEN "شخصی"
            END) AS type') ,
                DB::raw( '(CASE
            WHEN offers.noe = "old" THEN "کارکرده"
            WHEN offers.noe = "new" THEN "نو"
            END) AS noe'),
                DB::raw( '(CASE
            WHEN offers.buyorsell = "sell" THEN "آگهی فروش"
            WHEN offers.buyorsell = "buy" THEN "آگهی خرید"
            END) AS buyorsell'))
            ->where('offers.status' , '=', '4')
            ->where('offers.slug' , '=' , $slug)
            ->get();

        foreach($offers as $offer){
            $markets = [
                'offer_id'          => $offer->offer_id,
                'mark_id'           => $offer->mark_id,
                'brand'             => $offer->brand,
                'number'            => $offer->number,
                'slug'              => $offer->slug,
                'image1'            => $offer->image1,
                'image2'            => $offer->image2,
                'image3'            => $offer->image3,
                'title'             => $offer->title,
                'state'             => $offer->state,
                'type'              => $offer->type,
                'noe'               => $offer->noe,
                'buyorsell'         => $offer->buyorsell,
                'city'              => $offer->city,
                'wholesaleprice'    => $offer->wholesaleprice,
                'retailprice'       => $offer->retailprice,
                'unicode'           => $offer->unicode,
                'description'       => $offer->description,
                'phone'             => $offer->phone,
                'mobile'            => $offer->mobile,
                'address'           => $offer->address,
                'lat'               => $offer->lat,
                'lng'               => $offer->lng,
                'product_group'     => $offer->product_group,
                'created_at'        => jdate($offer->created_at)->ago(),
            ];
        }

            $offer_id = Offer::whereSlug($slug)->pluck('id');

            $cars = Car_offer::
                leftjoin('car_brands', 'car_brands.id', '=', 'car_offers.car_brand_id')
                ->leftjoin('car_models', 'car_models.id', '=', 'car_offers.car_model_id')
                ->where('car_offers.offer_id' , '=' , $offer_id)
                ->select('car_brands.title_fa as brand', 'car_models.title_fa as model')
                ->get();

        $comments               = comment::whereCommentable_type('App\Offer')->whereIn('Commentable_id'   ,$offer_id)->select('name','phone' , 'comment' , 'id' , 'created_at')->whereParent_id(0)->whereApproved(1)->latest()->get();
        $subcomments            = comment::whereCommentable_type('App\Offer')->whereIn('Commentable_id'   ,$offer_id)->select('name','phone' , 'comment' , 'parent_id')->where('parent_id' ,'>' ,  0)->whereApproved(1)->latest()->get();

        if (trim($comments) != '[]') {
            foreach ($comments as $comment) {
                $answer = [];
                foreach ($subcomments as  $subcomment) {
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
        }else{
            $comt= [];
        }

        $response = [
            'offer'     =>  $markets,
            'car'       =>  $cars,
            'comment'   =>  $comt

        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function bmpmarket(){

        $carsells = Car_offer::
        leftjoin('offers', 'offers.id'  , '=' , 'car_offers.offer_id')
            ->leftJoin('car_brands'     , 'car_brands.id'       , '=' , 'car_offers.car_brand_id')
            ->leftJoin('car_models'     , 'car_models.id'       , '=' , 'car_offers.car_model_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title')
            ->where('offers.user_id' , Auth::user()->id)
            ->where('car_offers.offer_id' , request('offer_id'))
            ->get();

        $status     = true;
        $message    = 'success';
        $response   = $carsells;

        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
    }


}
