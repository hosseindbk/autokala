<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Car_technical_group;
use App\City;
use App\comment;
use App\commentrate;
use App\Http\Controllers\Controller;
use App\Media;
use App\Menu;
use App\Product;
use App\Product_group;
use App\State;
use App\Technical_unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechnicalunitController extends Controller
{
    public function index(){

        $menus              = Menu::whereStatus(4)->get();
        $countState         = null;
        $totaltechnical     = Technical_unit::whereStatus(4)->count();
        $newtechnicals      = Technical_unit::whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $clicktechnicals    = Technical_unit::whereStatus(4)->orderBy('click')->paginate(16);
        $goodtechnicals     = Technical_unit::whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $oldtechnicals      = Technical_unit::whereStatus(4)->orderBy('id')->paginate(16);
        $productgroups      = Product_group::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $brands             = Brand::whereStatus(4)->get();
        $carmodels          = Car_model::whereStatus(4)->get();
        $states             = State::all();
        $cities             = City::all();
        $filter             =   0;

        return view('Site.technicalunit')
            ->with(compact('countState'))
            ->with(compact('totaltechnical'))
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

    public function filterstate(){
        $id                     = request('state_id');
        if ($id == null){
            $countState             = State::all();
        }else{
            $countState             = State::whereIn('id' , $id)->get();
        }
        $menus              = Menu::whereStatus(4)->get();

        $totaltechnical     = Technical_unit::state()->whereStatus(4)->count();
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
            ->with(compact('totaltechnical'))
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
        $countState         = null;
        $technicalunits         = Technical_unit::whereSlug($slug)->get();
        $technicalunit_id       = Technical_unit::whereSlug($slug)->pluck('id');
        $cartechnicalgroups     = Car_technical_group::whereTechnical_id($technicalunit_id)->get();
        $productgroups          = Product_group::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $medias                 = Media::whereTechnical_id($technicalunit_id)->get();
        $comments               = comment::whereCommentable_id($technicalunit_id)->whereApproved(1)->latest()->get();
        $cities                 = City::all();
        $states                 = State::all();
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
            ->with(compact('cartechnicalgroups'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'))
            ->with(compact('productgroups'))
            ->with(compact('menus'))
            ->with(compact('comments'))
            ->with(compact('technicalunits'));
    }

    public function technicalfilter(){
        $productgroup = request('productgroup_id');
        if(isset($productgroup)  && $productgroup != '') {
            $productgroup_id = Product_group::whereIn('id', $productgroup)->get();
        }else{$productgroup_id = null;}

        $carmodel = request('car_model_id');
        if(isset($carmodel)  && $carmodel != '') {
            $carmodel_id = Car_model::whereIn('id', $carmodel)->get();
        }else{$carmodel_id = null;}

        $city = request('city_id');
        if(isset($city)  && $city != '') {
            $city_id = City::whereIn('id', $city)->get();
        }else{$city_id = null;}
        $countState         = null;

        $menus              = Menu::whereStatus(4)->get();
        $newtechnicals      = Technical_unit::filter()->whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $clicktechnicals    = Technical_unit::filter()->whereStatus(4)->orderBy('click')->paginate(16);
        $goodtechnicals     = Technical_unit::filter()->whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $oldtechnicals      = Technical_unit::filter()->whereStatus(4)->orderBy('id')->paginate(16);
        $count              = Technical_unit::filter()->whereStatus(4)->count();
        $productgroups      = Product_group::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $brands             = Brand::whereStatus(4)->get();
        $carmodels          = Car_model::whereStatus(4)->get();
        $states             = State::all();
        $cities             = City::all();
        $filter             =   1;

        return view('Site.technicalunit')
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
