<?php

namespace App\Http\Controllers\Api\v1;

use App\Car_technical_group;
use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Http\Requests\technicalrequest;
use App\Technical_unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class TechnicalunitController extends Controller
{
    public function index(){

        $technicals      = Technical_unit::select('title' , 'slug' , 'address' , 'manager' , 'image')
            ->whereStatus(4)
            ->filter()
            ->orderBy('id' , 'DESC')
            ->paginate(10)
            ->toArray();

        $response = ['technical_unit' => $technicals];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }

    public function subtechnical($slug){

        $technicals      = Technical_unit::leftjoin('markusers' , 'markusers.technical_id' , '=' , 'technical_units.id')
        ->select('markusers.id as mark_id'  , 'technical_units.id'          , 'technical_units.title'       , 'technical_units.slug'    , 'technical_units.address' , 'technical_units.manager' , 'technical_units.phone'
            ,'technical_units.image'        , 'technical_units.image2'      , 'technical_units.image3'      , 'technical_units.mobile'  , 'technical_units.website'
            , 'technical_units.email'       , 'technical_units.whatsapp'    , 'technical_units.autokala'    , 'technical_units.lat'     , 'technical_units.lng'     , 'technical_units.autokala' )
            ->where('technical_units.status','=' , 4)
            ->where('technical_units.slug'  ,'=' , $slug)
            ->get();
        if ($technicals != []) {
            $image = [$technicals[0]['image'], $technicals[0]['image2'], $technicals[0]['image3']];

        $technical_id      = Technical_unit::whereSlug($slug)->pluck('id');

        $technicalgroups = DB::table('car_technical_groups')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'car_technical_groups.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'car_technical_groups.car_model_id')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'car_technical_groups.kala_group_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'product_groups.related_service')
            ->whereIn('car_technical_groups.technical_id' ,$technical_id)
            ->get();


        $comments               = comment::whereCommentable_type('App\Technical_unit')->whereIn('Commentable_id'   ,$technical_id)->select('name','phone' , 'comment' , 'id' , 'created_at')->whereParent_id(0)->whereApproved(1)->latest()->get();
        $subcomments            = comment::whereCommentable_type('App\Technical_unit')->whereIn('Commentable_id'   ,$technical_id)->select('name','phone' , 'comment' , 'parent_id')->where('parent_id' ,'>' ,  0)->whereApproved(1)->latest()->get();
        $commentrates           = commentrate::whereCommentable_type('App\Technical_unit')->whereIn('Commentable_id' ,$technical_id)->select('name' , 'phone' , 'quality' , 'value' , 'innovation' , 'ability' , 'design' , 'comfort' ,'comment' , 'created_at')->whereApproved(1)->latest()->get();
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
        $commentratecount       = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->count();
        $commentratequality     = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('quality');
        $commentratevalue       = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('value');
        $commentrateinnovation  = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('innovation');
        $commentrateability     = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('ability');
        $commentratedesign      = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('design');
        $commentratecomfort     = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('comfort');

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


            $status = true;
            $message = 'success';


        }else{

            $technicals = [];
            $image = [];
            $technicalgroups = [];
            $comt = [];
            $comentratin = [];
            $commentratecount = [];
            $commentratequality = [];
            $commentratevalue = [];
            $commentrateinnovation = [];
            $commentrateability = [];
            $commentratedesign = [];
            $commentratecomfort = [];
            $status = false;
            $message = 'faild';
        }

        $response = [
              'technical_unit'          => $technicals
            , 'image'                   => $image
            , 'technicalgroups'         => $technicalgroups
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

        return Response::json(['ok' => $status ,'message' => $message ,'response'=>$response]);
    }

    public function store(technicalrequest $request)
    {
        $technical_user = Technical_unit::where('user_id', auth::user()->id)->first();
        if ($technical_user === null) {
        $technical_units = new Technical_unit();

        $technical_units->title         = $request->input('title');
        $technical_units->manager       = $request->input('manager');
        $technical_units->state_id      = $request->input('state_id');
        $technical_units->city_id       = $request->input('city_id');
        $technical_units->phone         = $request->input('phone');
        if ($request->input('lat') != null) {
            $technical_units->lat = $request->input('lat');
        }else{
            $technical_units->lat = auth::user()->lat;
        }
        if ($request->input('lng') != null) {
            $technical_units->lng = $request->input('lng');
        }else{
            $technical_units->lng = auth::user()->lng;
        }
        $technical_units->phone2        = $request->input('phone2');
        $technical_units->phone3        = $request->input('phone3');
        $technical_units->mobile        = $request->input('mobile');
        $technical_units->mobile2       = $request->input('mobile2');
        $technical_units->whatsapp      = $request->input('whatsapp');
        $technical_units->status        = '1';
        $technical_units->slug          = 'TU-' . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999);
        $technical_units->email         = $request->input('email');
        $technical_units->website       = $request->input('site');
        $technical_units->address       = $request->input('address');
        $technical_units->description   = $request->input('description');
        $technical_units->user_id       = Auth::user()->id;
        $technical_units->date          = jdate()->format('Ymd ');


        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath = "images/technicals";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $technical_units->image = $file->move($imagePath, $imageName);
            $img->save($imagePath . $imageName);
            $img->encode('jpg');
        }
        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath = "images/technicals";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $technical_units->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath . $imageName);
            $img->encode('jpg');
        }
        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath = "images/technicals";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $technical_units->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath . $imageName);
            $img->encode('jpg');
        }

        $technical_units->save();
            $status = true;
            $message = 'success';
            $response = 'اطلاعات با موفقیت ثبت شد';
            $id = $technical_units->id;
            return Response::json(['ok' => $status, 'message' => $message, 'response' => $response , 'technical_id' => $id]);
    }else{
            $status = false;
            $message = 'faild';
            $response = 'شما قبلا با همین حساب کاربری تعمیرگاه ثبت کرده اید جهت ثبت تعمیرگاه دیگر باید با حساب دیگری اقدام نمایید';

            return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
        }
    }

    public function cartechnicalstore(Request $request)
    {
        if ($request->car_model_id != null) {
            for ($i = 0; $i < count($request->car_model_id); $i++) {
                $carmodel[] = [
                    'kala_group_id' => $request->input('product_group_id'),
                    'car_brand_id'  => $request->input('car_brand_id'),
                    'technical_id'  => $request->input('technical_id'),
                    'status'        => '4',
                    'date'          => jdate()->format('Ymd '),
                    'user_id'       => Auth::user()->id,
                    'car_model_id'  => $request->car_model_id[$i]
                ];
            }

            Car_technical_group::insert($carmodel);
            $status = true;
            $message = 'success';
            $response = 'اطلاعات با موفقیت ثبت شد';

            return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
        }else {

            $cartechnicalgroups = new Car_technical_group();

            $cartechnicalgroups->kala_group_id      = $request->input('product_group_id');
            $cartechnicalgroups->car_brand_id       = $request->input('car_brand_id');
            $cartechnicalgroups->technical_id       = $request->input('technical_id');
            $cartechnicalgroups->date               = jdate()->format('Ymd ');
            $cartechnicalgroups->user_id            = Auth::user()->id;

            $cartechnicalgroups->save();

            $status = true;
            $message = 'success';
            $response = 'اطلاعات با موفقیت ثبت شد';

            return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
        }

    }

    public function technicaldelete(){
        $supplier_id = Technical_unit::whereUser_id(auth::user()->id)->pluck('id');
        if(count($supplier_id) != 0){

            Technical_unit::whereUser_id(auth::user()->id)->delete();

            $status     = true;
            $message    = 'success';
            $response   = 'اطلاعات با موفقیت پاک شد';

            return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);

        }else{
            $status     = false;
            $message    = 'fail';
            $response   = 'اطلاعات با مشخصات شما وجود نداشت';

            return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
        }
    }

    public function bmptechnical(){

        $technicalgroups = Car_technical_group::
              leftjoin('technical_units', 'technical_units.id'  , '=' , 'car_technical_groups.technical_id')
            ->leftJoin('car_brands'     , 'car_brands.id'       , '=' , 'car_technical_groups.car_brand_id')
            ->leftJoin('car_models'     , 'car_models.id'       , '=' , 'car_technical_groups.car_model_id')
            ->leftJoin('product_groups' , 'product_groups.id'   , '=' , 'car_technical_groups.kala_group_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'product_groups.related_service')
            ->where('car_technical_groups.user_id' , Auth::user()->id)
            ->get();

        $status     = true;
        $message    = 'success';
        $response   = $technicalgroups;

        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
    }

}
