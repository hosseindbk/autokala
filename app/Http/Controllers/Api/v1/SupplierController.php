<?php

namespace App\Http\Controllers\Api\v1;

use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

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

        $image = [$suppliers[0]['image'],$suppliers[0]['image2'],$suppliers[0]['image3']];

        $supplier_id            = Supplier::whereSlug($slug)->pluck('id');

        $suppliergroups = DB::table('supplier_product_groups')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'supplier_product_groups.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'supplier_product_groups.car_model_id')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'supplier_product_groups.kala_group_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'product_groups.title_fa as product_group')
            ->whereIn('supplier_product_groups.supplier_id' ,$supplier_id)
            ->get();

        $comments               = comment::whereCommentable_type('App\Supplier')->whereIn('Commentable_id'   ,$supplier_id)->select('phone' , 'comment' , 'id' , 'created_at')->whereParent_id(0)->whereApproved(1)->latest()->get();
        $subcomments            = comment::whereCommentable_type('App\Supplier')->whereIn('Commentable_id'   ,$supplier_id)->select('phone' , 'comment' , 'parent_id')->where('parent_id' ,'>' ,  0)->whereApproved(1)->latest()->get();
        $commentrates           = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id' ,$supplier_id)->select('name' , 'phone' , 'quality' , 'value' , 'innovation' , 'ability' , 'design' , 'comfort' ,'comment' , 'created_at')->whereApproved(1)->latest()->get();
        if (trim($commentrates) != '[]') {
            foreach ($commentrates as $commentrate) {
                $comentratin = [
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
            $comentratin = null;
        }

        $commentratecount       = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->count();
        $commentratequality     = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('quality');
        $commentratevalue       = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('value');
        $commentrateinnovation  = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('innovation');
        $commentrateability     = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('ability');
        $commentratedesign      = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('design');
        $commentratecomfort     = commentrate::whereCommentable_type('App\Supplier')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('comfort');

        if (trim($comments) != '[]' && trim($subcomments) != '[]') {
            foreach ($comments as $comment) {
                foreach ($subcomments as $subcomment) {
                    if ($comment->id == $subcomment->parent_id) {
                        $comt[] = [
                            'phone' => $comment->phone,
                            'comment' => $comment->comment,
                            'created_at' => jdate($comment->created_at)->ago(),
                            'subcomment' => $subcomts[] = [
                                'phone' => $subcomment->phone,
                                'comment' => $subcomment->comment,
                                'created_at' => jdate($subcomment->created_at)->ago(),
                            ],
                        ];
                    }
                }
            }
        }elseif(trim($comments) != '[]' && trim($subcomments) == '[]'){
            foreach ($comments as $comment) {
                $comt[] = [
                    'phone' => $comment->phone,
                    'comment' => $comment->comment,
                    'created_at' => jdate($comment->created_at)->ago()
                ];
            }

        }elseif(trim($comments) == '[]' && trim($subcomments) == '[]')
        {
            $comt = null;
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

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
}
