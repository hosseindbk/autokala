<?php

namespace App\Http\Controllers\Api\v1;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Http\Controllers\Controller;
use App\Markuser;
use App\Product_group;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{
    public function index(){

        $brands             = Brand::select('title_fa as title' , 'slug' , 'image')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $orginal_slides     = Slide::select('image as images')->whereStatus(4)->wherePosition(1)->latest()->get();

        $offers = DB::table('offers')
            ->leftJoin('products', 'products.unicode', '=', 'offers.unicode_product')
            ->leftJoin('product_brand_varieties', 'product_brand_varieties.id', '=', 'offers.brand_id')
            ->leftJoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->leftJoin('states', 'states.id', '=', 'offers.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'offers.city_id')
            ->leftJoin('users', 'users.id', '=', 'offers.user_id')
            ->select('brands.title_fa as brand' , 'offers.total as numberofsell', 'offers.slug'  , 'offers.image1 as image' , 'offers.title_offer as title'
                            ,'states.title as state' , 'cities.title as city' , 'offers.price as wholesaleprice' , 'offers.single_price as retailprice','offers.created_at as time' ,

            DB::raw( '(CASE
            WHEN users.type_id = "1" THEN "فروشگاه"
            WHEN users.type_id = "3" THEN "شخصی"
            WHEN users.type_id = "4" THEN "شخصی"
            END) AS type'),
                DB::raw( '(CASE
            WHEN offers.buyorsell = "sell" THEN "پیشنهاد فروش"
            WHEN offers.buyorsell = "buy" THEN "پیشنهاد خرید"
            END) AS type'))
            ->where('offers.status' , '=', '4')
            ->where('offers.homeshow' , '=', '1')
            ->inRandomOrder()
            ->get();

        foreach ($offers as $offer){
            $offera[] = [
            'brand'             => $offer->brand,
            'numberofsell'      => $offer->numberofsell,
            'slug'              => $offer->slug,
            'image'             => $offer->image,
            'title'             => $offer->title,
            'state'             => $offer->state,
            'city'              => $offer->city,
            'wholesaleprice'    => $offer->wholesaleprice,
            'retailprice'       => $offer->retailprice,
            'time'              => jdate($offer->time)->ago(),
            ];
        }

        $technicalunits = DB::table('technical_units')
            ->leftJoin('states', 'states.id', '=', 'technical_units.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'technical_units.city_id')
            ->select('technical_units.title' , 'technical_units.slug' , 'technical_units.image' , 'states.title as state' , 'cities.title as city')
            ->where('technical_units.status' , '=', '4')
            ->where('technical_units.homeshow' , '=', '1')
            ->inRandomOrder()
            ->get();

        $suppliers = DB::table('suppliers')
            ->leftJoin('states', 'states.id', '=', 'suppliers.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'suppliers.city_id')
            ->select('suppliers.title' , 'suppliers.slug' , 'suppliers.image' , 'states.title as state' , 'cities.title as city')
            ->where('suppliers.status' , '=', '4')
            ->where('suppliers.homeshow' , '=', '1')
            ->inRandomOrder()
            ->get();

        foreach($orginal_slides as $orginal_slide) {
            $slide [] = $orginal_slide->images;
        }

        $response = [
                'offer'          => $offera ,
                'brand'          => $brands,
                'technicalunits' => $technicalunits  ,
                'suppliers'      => $suppliers ,
                'orginal_slides' => $slide,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
    public function carbrand(){
        $carbrands              = Car_brand::select('title_fa as brand' , 'id as brand_id')->get();

        $response = [
            'brand'          => $carbrands ,
            ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
    public function carproduct(){
        $productgroups          = Product_group::select('title_fa as supplier_service' , 'id as productgroup_id' , 'related_service as technical_service')->whereStatus(4)->get();
        $response = [
            'productgroup'   => $productgroups  ,
        ];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }
    public function carmodel(Request $request){
        $carmodels              = Car_model::select('title_fa as model' , 'id as model_id')->whereVehicle_brand_id($request->input('brand_id'))->get();
        $response = [
            'model'          => $carmodels,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }
    public function brand(){
        $brands = Brand::select('id' , 'title_fa', 'title_en' , 'abstract_title' , 'slug' , 'image')->get();

        $response = [
            'brand' => $brands
        ];
        return Response::json(['ok'=>true , 'message' =>'success','response'=>$response ]);
    }
    public function productgroup(){
        $productgroups = Product_group::select('id','title_fa', 'related_service')->get();

        $response = [
            'brand' => $productgroups
        ];
        return Response::json(['ok'=>true , 'message' =>'success','response'=>$response ]);
    }
    public function markuser(){

        $suppliers       = Markuser::leftjoin('suppliers'  , 'suppliers.id' , '=' , 'markusers.supplier_id')
            ->select('suppliers.title as supplier' , 'suppliers.id' , 'suppliers.image')
            ->where('markusers.user_id' , Auth::user()->id)
            ->get();

        $offers          = Markuser::leftjoin('offers'     , 'offers.id'     , '=' , 'markusers.offer_id')
            ->select('offers.id' , 'offers.title_offer as offer' , 'offers.image1')
            ->where('markusers.user_id' , Auth::user()->id)
            ->get();

        $products        = Markuser::leftjoin('products'   , 'products.id'    , '=' , 'markusers.product_id')
            ->select('products.title_fa as product' , 'products.id' , 'products.image')
            ->where('markusers.user_id' , Auth::user()->id)
            ->get();

        $technical_units = Markuser::leftjoin('technical_units' , 'technical_units.id'  , '=' , 'markusers.technical_id')
            ->select('technical_units.id' , 'technical_units.title as technical' , 'technical_units.image')
            ->where('markusers.user_id' , Auth::user()->id)
            ->get();

        $response = [
            'supplier'          => $suppliers,
            'offer'             => $offers,
            'product'           => $products,
            'technical_unit'    => $technical_units
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
    public function markusercreate(Request $request){

        $markusers = new Markuser();

        $markusers->supplier_id         = $request->input('supplier_id');
        $markusers->technical_id        = $request->input('technical_id');
        $markusers->offer_id            = $request->input('offer_id');
        $markusers->product_id          = $request->input('product_id');
        $markusers->user_id             = Auth::user()->id;

        $markusers->save();
        $status     = true;
        $message    = 'success';
        $response   = 'اطلاعات با موفقیت ثبت شد';
        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);

    }
    public function markdelete(){

    }

}
