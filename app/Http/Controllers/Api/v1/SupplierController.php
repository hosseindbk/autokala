<?php

namespace App\Http\Controllers\Api\v1;

use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Menu;
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
            , 'website', 'email' , 'whatsapp' , 'lat' , 'lng' , 'state_id' , 'city_id')
            ->whereStatus(4)
            ->whereSlug($slug)
            ->get()
            ->toArray();

        $supplier_id            = Supplier::whereSlug($slug)->pluck('id');

        $suppliergroups = DB::table('supplier_product_groups')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'supplier_product_groups.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'supplier_product_groups.car_model_id')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'supplier_product_groups.kala_group_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'product_groups.title_fa as product_group')
            ->whereIn('supplier_product_groups.supplier_id' ,$supplier_id)
            ->get();

        $comments               = comment::whereCommentable_type('App\Technical_unit')->whereIn('Commentable_id'   ,$supplier_id)->select('phone' , 'comment')->whereApproved(1)->latest()->get();
        $commentrates           = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$supplier_id)->select('name' , 'phone' , 'quality' , 'value' , 'innovation' , 'ability' , 'design' , 'comfort' ,'comment')->whereApproved(1)->latest()->get();
        $commentratecount       = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$supplier_id)->select('name' , 'phone' , 'quality' , 'value' , 'innovation' , 'ability' , 'design' , 'comfort' ,'comment')->whereApproved(1)->count();
        $commentratequality     = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('quality');
        $commentratevalue       = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('value');
        $commentrateinnovation  = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('innovation');
        $commentrateability     = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('ability');
        $commentratedesign      = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('design');
        $commentratecomfort     = commentrate::whereCommentable_type('App\Technical_unit')->where('Commentable_id' ,$supplier_id)->whereApproved(1)->avg('comfort');


        $response = [
              'supplier'                => $suppliers
            , 'suppliergroup'           => $suppliergroups
            , 'comment'                 => $comments
            , 'commentrates'            => $commentrates
            , 'commentratecount'        => $commentratecount
            , 'commentratequality'      => $commentratequality
            , 'commentratevalue'        => $commentratevalue
            , 'commentrateinnovation'   => $commentrateinnovation
            , 'commentrateability'      => $commentrateability
            , 'commentratedesign'       => $commentratedesign
            , 'commentratecomfort'      => $commentratecomfort];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
}
