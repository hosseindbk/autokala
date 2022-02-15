<?php

namespace App\Http\Controllers\Api\v1;

use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Technical_unit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class TechnicalunitController extends Controller
{
    public function index(){

        $technicals      = Technical_unit::select('title' , 'slug' , 'address' , 'manager' , 'image')
            ->whereStatus(4)
            ->orderBy('id' , 'DESC')
            ->paginate(10)
            ->toArray();

        $response = ['technical_unit' => $technicals];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }
    public function subtechnical($slug){

        $technicals      = Technical_unit::select('title' , 'slug' , 'address' , 'manager' , 'phone' ,'image' , 'image2' , 'image3' , 'mobile' , 'website' , 'email' , 'whatsapp' , 'autokala' , 'lat' , 'lng' , 'autokala' )
            ->whereStatus(4)
            ->whereSlug($slug)
            ->get()
            ->toArray();

        $image = [$technicals[0]['image'],$technicals[0]['image2'],$technicals[0]['image3']];


        $technical_id      = Technical_unit::whereSlug($slug)->pluck('id');

        $technicalgroups = DB::table('car_technical_groups')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'car_technical_groups.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'car_technical_groups.car_model_id')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'car_technical_groups.kala_group_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'product_groups.related_service')
            ->whereIn('car_technical_groups.technical_id' ,$technical_id)
            ->get();

        $comments               = comment::whereCommentable_type('App\Technical_unit')->whereIn('Commentable_id'   ,$technical_id)->select('phone' , 'comment' , 'id' , 'created_at')->whereParent_id(0)->whereApproved(1)->latest()->get();
        $subcomments            = comment::whereCommentable_type('App\Technical_unit')->whereIn('Commentable_id'   ,$technical_id)->select('phone' , 'comment' , 'parent_id')->where('parent_id' ,'>' ,  0)->whereApproved(1)->latest()->get();
        $commentrates           = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->select('name' , 'phone' , 'quality' , 'value' , 'innovation' , 'ability' , 'design' , 'comfort' ,'comment' , 'created_at')->whereApproved(1)->latest()->get();
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
            $comentratin = null ;
        }
        $commentratecount       = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->count();
        $commentratequality     = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('quality');
        $commentratevalue       = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('value');
        $commentrateinnovation  = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('innovation');
        $commentrateability     = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('ability');
        $commentratedesign      = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('design');
        $commentratecomfort     = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$technical_id)->whereApproved(1)->avg('comfort');


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

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }
}
