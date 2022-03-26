<?php

namespace App\Http\Controllers\Api\v1;

use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Http\Requests\supplierrequest;
use App\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    public function index(){
        $suppliers       = Supplier::select('title' , 'slug' , 'address' , 'manager' , 'image')
            ->whereStatus(4)
            ->orderBy('id' , 'DESC')
            ->paginate(10)
            ->toArray();

        $response = ['supplier' => $suppliers];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
    public function subsupplier($slug){
        $suppliers       = Supplier::select(
            'title' , 'slug' , 'address' , 'manager' , 'image' , 'image2' , 'image3'
            , 'manufacturer' , 'importer' , 'whole_seller' , 'retail_seller' , 'phone' , 'mobile'
            , 'website', 'email' , 'whatsapp' , 'lat' , 'lng' , 'state_id' , 'city_id' ,'autokala')
            ->whereStatus(4)
            ->whereSlug($slug)
            ->get()
            ->toArray();
        if ($suppliers != []) {
            $image = [$suppliers[0]['image'], $suppliers[0]['image2'], $suppliers[0]['image3']];

            $supplier_id = Supplier::whereSlug($slug)->pluck('id');

            $suppliergroups = DB::table('supplier_product_groups')
                ->leftJoin('car_brands', 'car_brands.id', '=', 'supplier_product_groups.car_brand_id')
                ->leftJoin('car_models', 'car_models.id', '=', 'supplier_product_groups.car_model_id')
                ->leftJoin('product_groups', 'product_groups.id', '=', 'supplier_product_groups.kala_group_id')
                ->select('car_brands.title_fa as brand_title', 'car_models.title_fa as model_title', 'product_groups.title_fa as product_group')
                ->whereIn('supplier_product_groups.supplier_id', $supplier_id)
                ->get();

            $comments       = comment::whereCommentable_type('App\Supplier')->whereIn('Commentable_id', $supplier_id)->select('name','phone', 'comment', 'id', 'created_at')->whereParent_id(0)->whereApproved(1)->latest()->get();
            $subcomments    = comment::whereCommentable_type('App\Supplier')->whereIn('Commentable_id', $supplier_id)->select('name','phone', 'comment', 'parent_id')->where('parent_id', '>', 0)->whereApproved(1)->latest()->get();
            $commentrates   = commentrate::whereCommentable_type('App\Supplier')->whereIn('Commentable_id', $supplier_id)->select('name', 'phone', 'quality', 'value', 'innovation', 'ability', 'design', 'comfort', 'comment', 'created_at')->whereApproved(1)->latest()->get();
            if (trim($commentrates) != '[]') {
                foreach ($commentrates as $commentrate) {
                    $comentratin[] = [
                        'name'          => $commentrate->name,
                        'phone'         => $commentrate->phone,
                        'quality'       => $commentrate->quality,
                        'value'         => $commentrate->value,
                        'innovation'    => $commentrate->innovation,
                        'ability'       => $commentrate->ability,
                        'design'        => $commentrate->design,
                        'comfort'       => $commentrate->comfort,
                        'comment'       => $commentrate->comment,
                        'avgcommentrate' => ((int)$commentrate->quality + (int)$commentrate->value + (int)$commentrate->innovation + (int)$commentrate->ability + (int)$commentrate->design + (int)$commentrate->comfort) / 6,
                        'created_at' => jdate($commentrate->created_at)->ago()
                    ];
                }
            } else {
                $comentratin = [];
            }

            $commentratecount       = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id', $supplier_id)->whereApproved(1)->count();
            $commentratequality     = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id', $supplier_id)->whereApproved(1)->avg('quality');
            $commentratevalue       = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id', $supplier_id)->whereApproved(1)->avg('value');
            $commentrateinnovation  = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id', $supplier_id)->whereApproved(1)->avg('innovation');
            $commentrateability     = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id', $supplier_id)->whereApproved(1)->avg('ability');
            $commentratedesign      = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id', $supplier_id)->whereApproved(1)->avg('design');
            $commentratecomfort     = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id', $supplier_id)->whereApproved(1)->avg('comfort');

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

            $suppliers = [];
            $image = [];
            $suppliergroups = [];
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
              'supplier'                => $suppliers
            , 'supplierimage'           => $image
            , 'suppliergroup'           => $suppliergroups
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

        return Response::json(['ok' =>$status ,'message' => $message,'response'=>$response]);

    }

    public function store(supplierrequest $request , Supplier $suppliers)
    {
        $supplier_user = Supplier::where('user_id', auth::user()->id)->first();
        if ($supplier_user === null) {

            $suppliers = new Supplier();

            if ($request->input('manufacturer') != null) {
                $suppliers->manufacturer = 1;
            } else {
                $suppliers->manufacturer = 0;
            }
            if ($request->input('importer') != null) {
                $suppliers->importer = 1;
            } else {
                $suppliers->importer = 0;
            }
            if ($request->input('whole_seller') != null) {
                $suppliers->whole_seller = 1;
            } else {
                $suppliers->whole_seller = 0;
            }
            if ($request->input('retail_seller') != null) {
                $suppliers->retail_seller = 1;
            } else {
                $suppliers->retail_seller = 0;
            }
            $suppliers->title       = $request->input('title');
            $suppliers->manager     = $request->input('manager');
            $suppliers->phone       = $request->input('phone');
            $suppliers->mobile      = $request->input('mobile');
            if ($request->input('lat') != null) {
                $suppliers->lat     = $request->input('lat');
            } else {
                $suppliers->lat     = auth::user()->lat;
            }
            if ($request->input('lng') != null) {
                $suppliers->lng     = $request->input('lng');
            } else {
                $suppliers->lng     = auth::user()->lng;
            }
            $suppliers->whatsapp    = $request->input('whatsapp');
            $suppliers->email       = $request->input('email');
            $suppliers->website     = $request->input('website');
            $suppliers->state_id    = $request->input('state_id');
            $suppliers->city_id     = $request->input('city_id');
            $suppliers->address     = $request->input('address');
            $suppliers->slug        = 'SU-' . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999);
            $suppliers->description = $request->input('description');
            $suppliers->status      = '1';
            $suppliers->date        = jdate()->format('Ymd ');

            $suppliers->user_id     = Auth::user()->id;

            if ($request->file('image') != null) {
                $file = $request->file('image');
                $img = Image::make($file);
                $imagePath = "images/suppliers";
                $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
                $suppliers->image = $file->move($imagePath, $imageName);
                $img->save($imagePath . $imageName);
                $img->encode('jpg');
            }
            if ($request->file('image2') != null) {
                $file = $request->file('image2');
                $img = Image::make($file);
                $imagePath = "images/suppliers";
                $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
                $suppliers->image2 = $file->move($imagePath, $imageName);
                $img->save($imagePath . $imageName);
                $img->encode('jpg');
            }
            if ($request->file('image3') != null) {
                $file = $request->file('image3');
                $img = Image::make($file);
                $imagePath = "images/suppliers";
                $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
                $suppliers->image3 = $file->move($imagePath, $imageName);
                $img->save($imagePath . $imageName);
                $img->encode('jpg');
            }

            $suppliers->save();
            $status     = true;
            $message    = 'success';
            $response   = 'اطلاعات با موفقیت ثبت شد';

            return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);

        } else {
            $status     = false;
            $message    = 'faild';
            $response   = 'شما قبلا با همین حساب کاربری فروشگاه ثبت کرده اید جهت ثبت فروشگاه دیگر باید با حساب دیگری اقدام نمایید';

            return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
        }
    }
}
