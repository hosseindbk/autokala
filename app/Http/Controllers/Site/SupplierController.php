<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\City;
use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Media;
use App\Menu;
use App\Product_group;
use App\State;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
{
    public function index(){
        $menus              = Menu::select('id' , 'title' , 'slug' , 'keyword' ,'keycheck')->whereStatus(4)->get();
        $productgroup       = request('productgroup_id');
        $carbrandset        = request('car_brand_id');
        $countState         = null;
        $suppliers          = Supplier::filter()->select('id')->whereStatus(4)->get();
        $productgroups      = Product_group::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $brands             = Brand::whereStatus(4)->get();
        $carmodels          = Car_model::whereStatus(4)->get();
        $states             = State::all();
        $cities             = City::all();

        $newsuppliers       = Supplier::leftjoin('cities' , 'cities.id' , '=' ,'suppliers.city_id')->filter()->state()
            ->select('suppliers.id' , 'suppliers.title' , 'suppliers.slug' , 'suppliers.image' , 'suppliers.manager' , 'suppliers.address' , 'cities.title as citytitle')
            ->where('suppliers.status', 4)
            ->orderBy('id' , 'DESC')
            ->paginate(16);
        $clicksuppliers     = Supplier::leftjoin('cities' , 'cities.id' , '=' ,'suppliers.city_id')->filter()->state()
            ->select('suppliers.id' , 'suppliers.title' , 'suppliers.slug' , 'suppliers.image' , 'suppliers.manager' , 'suppliers.address' , 'cities.title as citytitle')
            ->where('suppliers.status', 4)
            ->orderBy('click')
            ->paginate(16);
        $goodsuppliers      = Supplier::leftjoin('cities' , 'cities.id' , '=' ,'suppliers.city_id')->filter()->state()
            ->select('suppliers.id' , 'suppliers.title' , 'suppliers.slug' , 'suppliers.image' , 'suppliers.manager' , 'suppliers.address' , 'cities.title as citytitle')
            ->where('suppliers.status', 4)
            ->orderBy('id' , 'DESC')
            ->paginate(16);
        $oldsuppliers       = Supplier::leftjoin('cities' , 'cities.id' , '=' ,'suppliers.city_id')->filter()->state()
            ->select('suppliers.id' , 'suppliers.title' , 'suppliers.slug' , 'suppliers.image' , 'suppliers.manager' , 'suppliers.address' , 'cities.title as citytitle')
            ->where('suppliers.status', 4)
            ->orderBy('id')
            ->paginate(16);


        if(isset($productgroup)  && $productgroup != '') {
            $productgroup_id = Product_group::whereIn('id', $productgroup)->get();
        }else{$productgroup_id = null;}

        $city = request('city_id');
        if(isset($city)  && $city != '') {
            $city_id = City::whereIn('id', $city)->get();
        }else{$city_id = null;}

        $carmodel = request('car_model_id');
        if(isset($carmodel)  && $carmodel != '') {
            $carmodel_id = Car_model::whereIn('id', $carmodel)->get();
        }else{$carmodel_id = null;}

        $supplier_id        = Supplier::filter()->whereStatus(4)->pluck('id');
        if ($supplier_id == '[]'){
            alert()->warning('خطا', 'کلمه مورد نظر یافت نشد');
            return Redirect::back();
        }

        if(isset($productgroup) || isset($carmodel) || isset($carbrandset)){
            $filter = 1;
        }else{
            $filter = 0;
        }

        return view('Site.supplier')
            ->with(compact('countState'))
            ->with(compact('carmodel_id'))
            ->with(compact('city_id'))
            ->with(compact('productgroup_id'))
            ->with(compact('suppliers'))
            ->with(compact('filter'))
            ->with(compact('carmodels'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('menus'))
            ->with(compact('newsuppliers'))
            ->with(compact('clicksuppliers'))
            ->with(compact('goodsuppliers'))
            ->with(compact('oldsuppliers'));
    }

    public function indexstate(){
        $menus              = Menu::whereStatus(4)->get();
        $id                     = request('state_id');
        if ($id == null){
            $countState             = State::all();
        }else{
            $countState             = State::whereIn('id' , $id)->get();
        }
        $suppliers          = Supplier::state()->select('id')->whereStatus(4)->get();
        $newsuppliers       = Supplier::state()->whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $clicksuppliers     = Supplier::state()->whereStatus(4)->orderBy('click')->paginate(16);
        $goodsuppliers      = Supplier::state()->whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $oldsuppliers       = Supplier::state()->whereStatus(4)->orderBy('id')->paginate(16);
        $productgroups      = Product_group::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $brands             = Brand::whereStatus(4)->get();
        $carmodels          = Car_model::whereStatus(4)->get();
        $states             = State::all();
        $cities             = City::all();
        $filter             = 0;


        return view('Site.supplier')
            ->with(compact('countState'))
            ->with(compact('suppliers'))
            ->with(compact('filter'))
            ->with(compact('states'))
            ->with(compact('carmodels'))
            ->with(compact('cities'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('menus'))
            ->with(compact('newsuppliers'))
            ->with(compact('clicksuppliers'))
            ->with(compact('goodsuppliers'))
            ->with(compact('oldsuppliers'));
    }

    public function subsupplier($slug){

        $menus                  = Menu::whereStatus(4)->get();
        $cities                 = City::all();
        $states                 = State::all();
        $countState             = null;
        $suppliers              = Supplier::whereSlug($slug)->get();
        $supplier_id            = Supplier::whereSlug($slug)->pluck('id');
        $medias                 = Media::whereSupplier_id($supplier_id)->get();


        $suppliergroups = DB::table('supplier_product_groups')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'supplier_product_groups.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'supplier_product_groups.car_model_id')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'supplier_product_groups.kala_group_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'product_groups.title_fa as product_group')
            ->whereIn('supplier_product_groups.supplier_id' ,$supplier_id)
            ->get();

        $comments               = comment::whereCommentable_id($supplier_id)->whereApproved(1)->latest()->get();
        $commentrates           = commentrate::whereCommentable_id($supplier_id)->whereApproved(1)->latest()->get();
        $commentratecount       = commentrate::whereCommentable_id($supplier_id)->whereApproved(1)->count();
        $commentratequality     = commentrate::whereCommentable_id($supplier_id)->whereApproved(1)->avg('quality');
        $commentratevalue       = commentrate::whereCommentable_id($supplier_id)->whereApproved(1)->avg('value');
        $commentrateinnovation  = commentrate::whereCommentable_id($supplier_id)->whereApproved(1)->avg('innovation');
        $commentrateability     = commentrate::whereCommentable_id($supplier_id)->whereApproved(1)->avg('ability');
        $commentratedesign      = commentrate::whereCommentable_id($supplier_id)->whereApproved(1)->avg('design');
        $commentratecomfort     = commentrate::whereCommentable_id($supplier_id)->whereApproved(1)->avg('comfort');

        return view('Site.subsupplier')
            ->with(compact('countState'))
            ->with(compact('suppliergroups'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('menus'))
            ->with(compact('commentrates'))
            ->with(compact('commentratequality'))
            ->with(compact('commentratevalue'))
            ->with(compact('commentrateinnovation'))
            ->with(compact('commentrateability'))
            ->with(compact('commentratedesign'))
            ->with(compact('commentratecomfort'))
            ->with(compact('commentratecount'))
            ->with(compact('medias'))
            ->with(compact('comments'))
            ->with(compact('suppliers'));
    }

    public function updatesupimg(Request $request ,$id)
    {
        $suppliers = Supplier::findOrfail($id);

        if ($request->input('image') == '0') {
            $suppliers->image  = '';
        }
        if($request->input('image2') == '0') {
            $suppliers->image2  = '';
        }
        if($request->input('image3') == '0') {
            $suppliers->image3  = '';
        }

        $suppliers->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
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
