<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Car_product;
use App\Car_type;
use App\comment;
use App\commentrate;
use App\Country;
use App\Http\Controllers\Controller;
use App\Media;
use App\Menu;
use App\Product;
use App\Product_brand_variety;
use App\Product_group;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index(){
        $menus          = Menu::whereStatus(4)->get();
        $countState     = null;
        $newproducts    = Product::whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $clickproducts  = Product::whereStatus(4)->orderBy('click')->paginate(16);
        $goodproducts   = Product::whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $oldproducts    = Product::whereStatus(4)->orderBy('id')->paginate(16);
        //$carproducts    = Car_product::whereStatus(4)->get();
        $productgroups  = Product_group::whereStatus(4)->get();
        $carbrands      = Car_brand::whereStatus(4)->get();
        $carmodels      = Car_model::whereStatus(4)->get();
        $brands         = Brand::whereStatus(4)->get();
        $filter         = 0;
        $states         = State::all();

        $carproducts = DB::table('car_products')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'car_products.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'car_products.car_model_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'car_products.product_id')
            ->get();

        return view('Site.product')
            ->with(compact('countState'))
            ->with(compact('filter'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('menus'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'))
            ->with(compact('newproducts'))
            ->with(compact('clickproducts'))
            ->with(compact('goodproducts'))
            ->with(compact('oldproducts'));
    }

    public function productfilter(){

        $productgroup = request('productgroup_id');
        if(isset($productgroup)  && $productgroup != '') {
            $productgroup_id = Product_group::whereIn('id', $productgroup)->get();
        }else{$productgroup_id = null;}

        $carmodel = request('car_model_id');
        if(isset($carmodel)  && $carmodel != '') {
            $carmodel_id = Car_model::whereIn('id', $carmodel)->get();
        }else{$carmodel_id = null;}

        $brand = request('brand_id');
        if(isset($brand)  && $brand != '') {
            $brand_id = Brand::whereIn('id', $brand)->get();
        }else{$brand_id = null;}
        $countState     = null;

        $menus              = Menu::whereStatus(4)->get();
        $count              = Product::filter()->whereStatus(4)->count();
        $newproducts        = Product::filter()->whereStatus(4)->paginate(16);
        $clickproducts      = Product::filter()->whereStatus(4)->orderBy('click')->paginate(16);
        $goodproducts       = Product::filter()->whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $oldproducts        = Product::filter()->whereStatus(4)->orderBy('id')->paginate(16);
        $states             = State::all();
        $productgroups      = Product_group::whereStatus(4)->get();
        $carproducts        = Car_product::whereStatus(4)->get();
        $carmodels          = Car_model::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $brands             = Brand::whereStatus(4)->get();
        $filter             = 1;
        return view('Site.product')
            ->with(compact('countState'))
            ->with(compact('count'))
            ->with(compact('brand_id'))
            ->with(compact('filter'))
            ->with(compact('carmodel_id'))
            ->with(compact('productgroup_id'))
            ->with(compact('brands'))
            ->with(compact('states'))
            ->with(compact('clickproducts'))
            ->with(compact('goodproducts'))
            ->with(compact('oldproducts'))
            ->with(compact('carbrands'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'))
            ->with(compact('productgroups'))
            ->with(compact('menus'))
            ->with(compact('newproducts'));

    }

    public function subproduct($slug){

        $menus                  = Menu::whereStatus(4)->get();
        $states                 = State::all();
        $countState             = null;
        $countries              = Country::all();
        $brands                 = Brand::whereStatus(4)->get();
        $products               = Product::whereSlug($slug)->get();
        //$carproducts            = Car_product::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $cartypes               = Car_type::whereStatus(4)->get();
        $product_id             = Product::whereSlug($slug)->pluck('id');
        $medias                 = Media::whereProduct_id($product_id)->get();
        $product_group_id       = Product::whereSlug($slug)->pluck('kala_group_id');
        $productgroups          = Product_group::whereId($product_group_id)->get();
        $productbrandvarieties  = Product_brand_variety::whereStatus(4)->get();
        $productvarieties       = Product_brand_variety::whereIn('Product_id' , $product_id)->whereStatus(4)->get();


        $carproducts = DB::table('car_products')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'car_products.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'car_products.car_model_id')
            ->leftJoin('car_types' , 'car_types.id' , '=', 'car_products.car_type_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title ' , 'car_types.title_fa as type_title')
            ->whereProduct_id($product_id)->get();


        $comments               = comment::whereCommentable_id($product_id)->whereApproved(1)->latest()->get();
        $commentrates           = commentrate::whereCommentable_id($product_id)->whereApproved(1)->latest()->get();
        $commentratecount       = commentrate::whereCommentable_id($product_id)->whereApproved(1)->count();
        $commentratequality     = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('quality');
        $commentratevalue       = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('value');
        $commentrateinnovation  = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('innovation');
        $commentrateability     = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('ability');
        $commentratedesign      = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('design');
        $commentratecomfort     = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('comfort');

        return view('Site.subproduct')
            ->with(compact('productvarieties'))
            ->with(compact('countState'))
            ->with(compact('countries'))
            ->with(compact('commentratequality'))
            ->with(compact('commentratevalue'))
            ->with(compact('commentrateinnovation'))
            ->with(compact('commentrateability'))
            ->with(compact('commentratedesign'))
            ->with(compact('commentratecomfort'))
            ->with(compact('commentratecount'))
            ->with(compact('commentrates'))
            ->with(compact('menus'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'))
            ->with(compact('cartypes'))
            ->with(compact('comments'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('medias'))
            ->with(compact('productbrandvarieties'))
            ->with(compact('products'));
    }

    public function productbrand($slug , $id){
        $menus                  = Menu::whereStatus(4)->get();
        $brands                 = Brand::whereStatus(4)->get();
        $products               = Product::whereSlug($slug)->get();
        $carproducts            = Car_product::whereStatus(1)->get();
        $states                 = State::all();
        $countState             = null;
        $carmodels              = Car_model::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $cartypes               = Car_type::whereStatus(4)->get();
        $product_id             = Product::whereSlug($slug)->pluck('id');
        $medias                 = Media::whereProduct_id($product_id)->get();
        $product_group_id       = Product::whereSlug($slug)->pluck('kala_group_id');
        $productgroups          = Product_group::whereId($product_group_id)->get();
        $productbrandvarieties  = Product_brand_variety::whereId($id)->get();
        $brand_id               = Product_brand_variety::whereId($id)->pluck('brand_id');
        $brandproducts          = Brand::whereId($brand_id)->get();
        $comments               = comment::whereCommentable_id($product_id)->whereApproved(1)->latest()->get();
        $commentrates           = commentrate::whereCommentable_id($product_id)->whereApproved(1)->latest()->get();
        $commentratecount       = commentrate::whereCommentable_id($product_id)->whereApproved(1)->count();
        $commentratequality     = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('quality');
        $commentratevalue       = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('value');
        $commentrateinnovation  = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('innovation');
        $commentrateability     = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('ability');
        $commentratedesign      = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('design');
        $commentratecomfort     = commentrate::whereCommentable_id($product_id)->whereApproved(1)->avg('comfort');

        return view('Site.productbrand')
            ->with(compact('countState'))
            ->with(compact('commentratequality'))
            ->with(compact('commentratevalue'))
            ->with(compact('commentrateinnovation'))
            ->with(compact('commentrateability'))
            ->with(compact('commentratedesign'))
            ->with(compact('commentratecomfort'))
            ->with(compact('commentratecount'))
            ->with(compact('commentrates'))
            ->with(compact('menus'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('brandproducts'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'))
            ->with(compact('cartypes'))
            ->with(compact('comments'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('medias'))
            ->with(compact('productbrandvarieties'))
            ->with(compact('products'));
    }

    public function comment(Request $request){

        $valiData = $request->validate([
            'commentable_id'    => 'required',
            'commentable_type'  => 'required',
            'parent_id'         => 'required',
            'comment'           => 'required',
            'phone'             => 'required',
        ]);

        comment::create($valiData);

        return back();
    }

    public function commentrate(Request $request){

        $commentData = $request->validate([
            'commentable_id'    => 'required',
            'commentable_type'  => 'required',
            'comment'           => 'required',
            'phone'             => 'required',
            'name'              => 'required',
            'quality'           => 'required',
            'value'             => 'required',
            'innovation'        => 'required',
            'ability'           => 'required',
            'design'            => 'required',
            'comfort'           => 'required',
        ]);

        commentrate::create($commentData);

        return Redirect::back();
    }

    public function modeloption(Request $request){
        $carmodels = Car_model::whereVehicle_brand_id($request->input('id'))->get();
        $output = [];

        foreach($carmodels as $Car_model )
        {
            $output[$Car_model->id] = $Car_model->title_fa;
        }

        return $output;
    }

}
