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
use App\Technical_unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TechnicalunitController extends Controller
{
    public function index(){

//        $technicals = Technical_unit::whereNotnull('image')->select('id','image')->get();
//        foreach ($technicals as $technical){
//
//            $imagePath =base_path()."/public/$technical->image";
//            $newname = "images/newtechnicals/".md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
//            $imageName =base_path()."/public/".$newname;
//            $productes = Technical_unit::findOrfail($technical->id);
//            $productes->image = $newname ;
//            $productes->update();
//            $productname =  File::move($imagePath, $imageName);
//        }

//        $technicals = Technical_unit::whereNotnull('image2')->select('id','image2')->get();
//        foreach ($technicals as $technical){
//
//            $imagePath =base_path()."/public/$technical->image2";
//            $newname = "images/technicals/".md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
//            $imageName =base_path()."/public/".$newname;
//            $productes = Technical_unit::findOrfail($technical->id);
//            $productes->image2 = $newname ;
//            $productes->update();
//            $productname =  File::move($imagePath, $imageName);
//        }
//
//        $technicals = Technical_unit::whereNotnull('image3')->select('id','image3')->get();
//        foreach ($technicals as $technical){
//
//            $imagePath =base_path()."/public/$technical->image3";
//            $newname = "images/technicals/".md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
//            $imageName =base_path()."/public/".$newname;
//            $productes = Technical_unit::findOrfail($technical->id);
//            $productes->image3 = $newname ;
//            $productes->update();
//            $productname =  File::move($imagePath, $imageName);
//        }

        $productgroup    = request('productgroup_id');
        $carbrandset     = request('car_brand_id');

        if(isset($productgroup)  && $productgroup != '') {
            $productgroup_id = Product_group::whereIn('id', $productgroup)->get();
        }else{$productgroup_id = null;}

        $carmodel       = request('car_model_id');
        if(isset($carmodel)  && $carmodel != '') {
            $carmodel_id = Car_model::whereIn('id', $carmodel)->get();
        }else{$carmodel_id = null;}

        $city = request('city_id');
        if(isset($city)  && $city != '') {
            $city_id = City::whereIn('id', $city)->get();
        }else{$city_id = null;}
        $countState    = null;
        $technical_id         = Technical_unit::filter()->whereStatus(4)->pluck('id');
        if ($technical_id == '[]'){
            alert()->warning('خطا', 'کلمه مورد نظر یافت نشد');
            return Redirect::back();
        }
        $menus              = Menu::whereStatus(4)->get();
        $technicals         = Technical_unit::filter()->select('id')->whereStatus(4)->get();
        $oldtechnicals      = Technical_unit::filter()->whereStatus(4)->orderBy('id')->paginate(16);
        $count              = Technical_unit::filter()->whereStatus(4)->count();
        $productgroups      = Product_group::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $brands             = Brand::whereStatus(4)->get();
        $carmodels          = Car_model::whereStatus(4)->get();
        $states             = State::all();
        $cities             = City::all();

        $newtechnicals      = Technical_unit::leftjoin('cities' , 'cities.id' , '=' ,'technical_units.city_id')->filter()->state()
            ->select('technical_units.id' , 'technical_units.title' , 'technical_units.slug' , 'technical_units.image' , 'technical_units.manager' , 'technical_units.address' , 'cities.title as citytitle')
            ->where('technical_units.status', 4)
            ->orderBy('id' , 'DESC')
            ->paginate(16);

        $clicktechnicals    = Technical_unit::leftjoin('cities' , 'cities.id' , '=' ,'technical_units.city_id')->filter()->state()
            ->select('technical_units.id' , 'technical_units.title' , 'technical_units.slug' , 'technical_units.image' , 'technical_units.manager' , 'technical_units.address' , 'cities.title as citytitle')
            ->where('technical_units.status', 4)
            ->orderBy('click')
            ->paginate(16);

        $goodtechnicals     = Technical_unit::leftjoin('cities' , 'cities.id' , '=' ,'technical_units.city_id')->filter()->state()
            ->select('technical_units.id' , 'technical_units.title' , 'technical_units.slug' , 'technical_units.image' , 'technical_units.manager' , 'technical_units.address' , 'cities.title as citytitle')
            ->where('technical_units.status', 4)
            ->orderBy('id' , 'DESC')
            ->paginate(16);

        $oldtechnicals     = Technical_unit::leftjoin('cities' , 'cities.id' , '=' ,'technical_units.city_id')->filter()->state()
            ->select('technical_units.id' , 'technical_units.title' , 'technical_units.slug' , 'technical_units.image' , 'technical_units.manager' , 'technical_units.address' , 'cities.title as citytitle')
            ->where('technical_units.status', 4)
            ->orderBy('id')
            ->paginate(16);


        if(isset($productgroup) || isset($carmodel) || isset($carbrandset)){
            $filter = 1;
        }else{
            $filter = 0;
        }

        return view('Site.technicalunit')
            ->with(compact('technicals'))
            ->with(compact('countState'))
            ->with(compact('city_id'))
            ->with(compact('carmodel_id'))
            ->with(compact('count'))
            ->with(compact('productgroup_id'))
            ->with(compact('filter'))
            ->with(compact('brands'))
            ->with(compact('clicktechnicals'))
            ->with(compact('goodtechnicals'))
            ->with(compact('oldtechnicals'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'))
            ->with(compact('productgroups'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('menus'))
            ->with(compact('newtechnicals'));
    }

    public function filterstate(){
        $id                     = request('state_id');
        if ($id == null){
            $countState             = State::all();
        }else{
            $countState             = State::whereIn('id' , $id)->get();
        }
        $menus              = Menu::whereStatus(4)->get();

        $technicals         = Technical_unit::state()->select('id')->whereStatus(4)->get();
        $newtechnicals      = Technical_unit::state()->whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $clicktechnicals    = Technical_unit::state()->whereStatus(4)->orderBy('click')->paginate(16);
        $goodtechnicals     = Technical_unit::state()->whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $oldtechnicals      = Technical_unit::state()->whereStatus(4)->orderBy('id')->paginate(16);
        $productgroups      = Product_group::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $brands             = Brand::whereStatus(4)->get();
        $carmodels          = Car_model::whereStatus(4)->get();
        $states             = State::all();
        $cities             = City::all();
        $filter             =   0;

        return view('Site.technicalunit')
            ->with(compact('countState'))
            ->with(compact('technicals'))
            ->with(compact('filter'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('brands'))
            ->with(compact('carmodels'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('menus'))
            ->with(compact('newtechnicals'))
            ->with(compact('clicktechnicals'))
            ->with(compact('goodtechnicals'))
            ->with(compact('oldtechnicals'));
    }

    public function subtechnical($slug){
        $menus                  = Menu::whereStatus(4)->get();
        $countState             = null;
        $technicalunits         = Technical_unit::whereSlug($slug)->get();
        $technicalunit_id       = Technical_unit::whereSlug($slug)->pluck('id');
        $productgroups          = Product_group::whereStatus(4)->get();
        $medias                 = Media::whereTechnical_id($technicalunit_id)->get();
        $comments               = comment::whereCommentable_id($technicalunit_id)->whereApproved(1)->latest()->get();
        $cities                 = City::all();
        $states                 = State::all();


        $technicalgroups = DB::table('car_technical_groups')
            ->leftJoin('car_brands', 'car_brands.id', '=', 'car_technical_groups.car_brand_id')
            ->leftJoin('car_models', 'car_models.id', '=', 'car_technical_groups.car_model_id')
            ->leftJoin('product_groups', 'product_groups.id', '=', 'car_technical_groups.kala_group_id')
            ->select('car_brands.title_fa as brand_title' , 'car_models.title_fa as model_title' , 'product_groups.related_service')
            ->whereIn('car_technical_groups.technical_id' ,$technicalunit_id)
            ->get();

        $commentrates           = commentrate::whereCommentable_id($technicalunit_id)->whereApproved(1)->latest()->get();
        $commentratecount       = commentrate::whereCommentable_id($technicalunit_id)->whereApproved(1)->count();
        $commentratequality     = commentrate::whereCommentable_id($technicalunit_id)->whereApproved(1)->avg('quality');
        $commentratevalue       = commentrate::whereCommentable_id($technicalunit_id)->whereApproved(1)->avg('value');
        $commentrateinnovation  = commentrate::whereCommentable_id($technicalunit_id)->whereApproved(1)->avg('innovation');
        $commentrateability     = commentrate::whereCommentable_id($technicalunit_id)->whereApproved(1)->avg('ability');
        $commentratedesign      = commentrate::whereCommentable_id($technicalunit_id)->whereApproved(1)->avg('design');
        $commentratecomfort     = commentrate::whereCommentable_id($technicalunit_id)->whereApproved(1)->avg('comfort');


        return view('Site.subtechnicalunit')
            ->with(compact('countState'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('medias'))
            ->with(compact('commentratequality'))
            ->with(compact('commentratevalue'))
            ->with(compact('commentrates'))
            ->with(compact('commentrateinnovation'))
            ->with(compact('commentrateability'))
            ->with(compact('commentratedesign'))
            ->with(compact('commentratecomfort'))
            ->with(compact('commentratecount'))
            ->with(compact('technicalgroups'))
            ->with(compact('productgroups'))
            ->with(compact('menus'))
            ->with(compact('comments'))
            ->with(compact('technicalunits'));
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

    public function updatetechimg(Request $request ,$id)
    {
        $technicals = Technical_unit::findOrfail($id);

        if ($request->input('image') == '0') {
            $technicals->image  = '';
        }
        if($request->input('image2') == '0') {
            $technicals->image2  = '';
        }
        if($request->input('image3') == '0') {
            $technicals->image3  = '';
        }

        $technicals->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
}
