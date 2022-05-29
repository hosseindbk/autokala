<?php

namespace App\Http\Controllers\Api\v1;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Markuser;
use App\Product_group;
use App\Representative_supplier;
use App\Slide;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{
    public function index(){

        $brands             = Brand::select('title_fa as title' , 'slug' , 'image')->whereStatus(4)->whereHomeshow(1)->inRandomOrder()->get();
        $orginal_slides     = Slide::select('image as images' , 'link')->whereStatus(4)->wherePosition(1)->inRandomOrder()->get();

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
            WHEN offers.buyorsell = "sell" THEN "آگهی فروش"
            WHEN offers.buyorsell = "buy" THEN "آگهی خرید"
            END) AS buyorsell'))
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
            'buyorsell'         => $offer->buyorsell,
            'type'              => $offer->type,
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
            $slide [] = [
               'image' => $orginal_slide->images,
               'link' => $orginal_slide->link,
            ];
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

    public function subbrand($slug){
        $brands = Brand::leftjoin('countries' , 'countries.id' , '=' ,  'brands.country_id')
            ->select('brands.id' , 'brands.title_fa', 'brands.title_en' , 'brands.abstract_title' , 'brands.slug' , 'brands.image' , 'brands.phone' ,
            'brands.mobile' , 'brands.email' , 'brands.whatsapp' , 'brands.website' , 'brands.address', 'brands.description' , 'countries.name as country')
            ->where('brands.slug' ,'=' ,$slug)
            ->get();

        $brand_id               = Brand::whereStatus(4)->whereSlug($slug)->pluck('id');
        $supplier_id            = Representative_supplier::whereBrand_id($brand_id)->pluck('supplier_id');
        $suppliers              = Supplier::select('suppliers.title as supplier_title' , 'suppliers.slug as supplier_slug' , 'suppliers.manager as supplier_manager' ,'suppliers.phone as supplier_phone' ,
            'suppliers.mobile as supplier_mobile' , 'suppliers.state_id as supplier_stateID' , 'suppliers.city_id as supplier_cityID' , 'suppliers.address as supplier_address')
            ->whereIn('id' , $supplier_id)->get();

        $comments               = comment::whereCommentable_type('App\Brand')->whereIn('Commentable_id'   ,$brand_id)->select('name','phone' , 'comment' , 'id' , 'created_at')->whereParent_id(0)->whereApproved(1)->latest()->get();
        $subcomments            = comment::whereCommentable_type('App\Brand')->whereIn('Commentable_id'   ,$brand_id)->select('name','phone' , 'comment' , 'parent_id')->where('parent_id' ,'>' ,  0)->whereApproved(1)->latest()->get();
        $commentrates           = commentrate::whereCommentable_type('App\Brand')->whereIn('Commentable_id' ,$brand_id)->select('name' , 'phone' , 'quality' , 'value' , 'innovation' , 'ability' , 'design' , 'comfort' ,'comment' , 'created_at')->whereApproved(1)->latest()->get();
        if (trim($commentrates) != '[]') {
            foreach ($commentrates as $commentrate) {
                $comentratin[] = [
                    'name' => $commentrate->name,
                    'phone' => $commentrate->phone,
                    'quality' => $commentrate->quality,
                    'value' => $commentrate->value,
                    'innovation' => $commentrate->innovation,
                    'ability' => $commentrate->ability,
                    'design' => $commentrate->design,
                    'comfort' => $commentrate->comfort,
                    'comment' => $commentrate->comment,
                    'avgcommentrate' => ((int)$commentrate->quality + (int)$commentrate->value + (int)$commentrate->innovation + (int)$commentrate->ability + (int)$commentrate->design + (int)$commentrate->comfort) / 6,
                    'created_at' => jdate($commentrate->created_at)->ago()
                ];
            }
        }else{
            $comentratin = [] ;
        }
        $commentratecount       = commentrate::whereCommentable_type('App\Brand')->where('Commentable_id' ,$brand_id)->whereApproved(1)->count();
        $commentratequality     = commentrate::whereCommentable_type('App\Brand')->where('Commentable_id' ,$brand_id)->whereApproved(1)->avg('quality');
        $commentratevalue       = commentrate::whereCommentable_type('App\Brand')->where('Commentable_id' ,$brand_id)->whereApproved(1)->avg('value');
        $commentrateinnovation  = commentrate::whereCommentable_type('App\Brand')->where('Commentable_id' ,$brand_id)->whereApproved(1)->avg('innovation');
        $commentrateability     = commentrate::whereCommentable_type('App\Brand')->where('Commentable_id' ,$brand_id)->whereApproved(1)->avg('ability');
        $commentratedesign      = commentrate::whereCommentable_type('App\Brand')->where('Commentable_id' ,$brand_id)->whereApproved(1)->avg('design');
        $commentratecomfort     = commentrate::whereCommentable_type('App\Brand')->where('Commentable_id' ,$brand_id)->whereApproved(1)->avg('comfort');

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
            'brand'                     => $brands
            ,'representative_supplier'  => $suppliers
            , 'comment'                 => $comt
            , 'commentrates'            => $comentratin
            , 'commentratecount'        => $commentratecount
            , 'commentratequality'      => $commentratequality
            , 'commentratevalue'        => $commentratevalue
            , 'commentrateinnovation'   => $commentrateinnovation
            , 'commentrateability'      => $commentrateability
            , 'commentratedesign'       => $commentratedesign
            , 'commentratecomfort'      => $commentratecomfort
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

        $suppliers       = Markuser::join('suppliers'  , 'suppliers.id' , '=' , 'markusers.supplier_id')
            ->select('markusers.id as markID' , 'suppliers.id as supplierID' , 'suppliers.title as supplier_title' , 'suppliers.manager' , 'suppliers.slug',  'suppliers.image' , 'suppliers.address')
            ->where('markusers.user_id' , Auth::user()->id)
            ->get();

        $offers          = Markuser::join('offers'     , 'offers.id'     , '=' , 'markusers.offer_id')
            ->leftJoin('users', 'users.id', '=', 'offers.user_id')
            ->leftJoin('states', 'states.id', '=', 'offers.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'offers.city_id')
            ->select('markusers.id as markID' ,'offers.id as offerID','offers.total as numberofsell' , 'offers.slug' , 'offers.image1 as image' ,
                'offers.title_offer as title' , 'states.title as state' , 'cities.title as city' , 'offers.price as wholesaleprice' , 'offers.single_price as retailprice' ,'offers.created_at' ,
                DB::raw( '(CASE
            WHEN users.type_id = "1" THEN "فروشگاه"
            WHEN users.type_id = "3" THEN "شخصی"
            WHEN users.type_id = "4" THEN "شخصی"
            END) AS type'))
            ->where('markusers.user_id' , Auth::user()->id)
            ->get();
        if (trim($offers) != '[]') {
            foreach ($offers as $offer) {
                $offer[] = [
                    'markID' => $offer->markID,
                    'offerID' => $offer->offerID,
                    'numberofsell' => $offer->numberofsell,
                    'slug' => $offer->slug,
                    'image' => $offer->image,
                    'title' => $offer->title,
                    'state' => $offer->state,
                    'city' => $offer->city,
                    'wholesaleprice' => $offer->wholesaleprice,
                    'retailprice' => $offer->retailprice,
                    'type' => $offer->type,
                    'date' => jdate($offer->created_at)->ago(),
                ];
            }
        }else{
            $offer[] = null;
        }

        $products        = Markuser::join('products'   , 'products.id'    , '=' , 'markusers.product_id')
            ->select('markusers.id as markID' ,'products.title_fa as product_title' , 'products.id as productID' , 'products.slug' ,'products.image' , 'products.unicode')
            ->where('markusers.user_id' , Auth::user()->id)
            ->get();

        $technical_units = Markuser::join('technical_units' , 'technical_units.id'  , '=' , 'markusers.technical_id')
            ->select('markusers.id as markID' ,'technical_units.id as technicalID' , 'technical_units.title as technical_title' , 'technical_units.slug' ,  'technical_units.image' , 'technical_units.manager' , 'technical_units.address')
            ->where('markusers.user_id' , Auth::user()->id)
            ->get();

        $response = [
            'supplier'          => $suppliers,
            'offer'             => $offer,
            'product'           => $products,
            'technical_unit'    => $technical_units
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }

    public function markusercreate(Request $request)
    {

        $markusers = new Markuser();

        $markusers->supplier_id    = $request->input('supplier_id');
        $markusers->technical_id   = $request->input('technical_id');
        $markusers->offer_id       = $request->input('offer_id');
        $markusers->product_id     = $request->input('product_id');
        $markusers->user_id        = Auth::user()->id;

        $markusers->save();
        $mark_id    = $markusers->id;
        $status     = true;
        $message    = 'success';
        $response   =
            [
                'response'  =>  'اطلاعات با موفقیت ثبت شد',
                'mark_id'   =>  $mark_id
            ];

        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
    }

    public function markdelete($id){
        $unmark = Markuser::findOrfail($id);
        $unmark->delete();

        $status     = true;
        $message    = 'success';
        $response   = 'اطلاعات با موفقیت حذف شد';
        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);

    }
}
