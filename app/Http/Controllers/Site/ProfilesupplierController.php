<?php

namespace App\Http\Controllers\Site;

use App\Car_brand;
use App\Car_model;
use App\Car_technical_group;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\supplierrequest;
use App\Media;
use App\Menu;
use App\Product_group;
use App\State;
use App\Supplier;
use App\Supplier_product_group;
use App\Technical_unit;
use App\Type_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class ProfilesupplierController extends Controller
{
    public function index(){
        $menus          = Menu::whereStatus(4)->get();
        $states         = State::all();

        return view('Site.profilesupplier')
            ->with(compact('menus'))
            ->with(compact('states'));
    }

    public function prosupplieredit(){
        $menus                  = Menu::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = city::all();
        $carbrands              = Car_brand::all();
        $carmodels              = Car_model::all();
        $supplierproductgroups  = Supplier_product_group::all();
        $productgroups          = Product_group::whereStatus(4)->get();
        $medias                 = Media::select('id' , 'image' , 'supplier_id' , 'technical_id')->whereStatus(1)->get();
        $suppliers              = Supplier::whereUser_id(auth::user()->id)->get();
        $technicalunits         = Technical_unit::whereUser_id(auth::user()->id)->get();
        return view('Site.profilesupplieredit')
            ->with(compact('menus'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'))
            ->with(compact('productgroups'))
            ->with(compact('supplierproductgroups'))
            ->with(compact('medias'))
            ->with(compact('suppliers'))
            ->with(compact('cities'))
            ->with(compact('technicalunits'))
            ->with(compact('states'));
    }
    public function suppliercreate()
    {
        $menus                  = Menu::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = city::all();
        $carbrands              = Car_brand::all();
        $carmodels              = Car_model::all();
        $supplierproductgroups  = Supplier_product_group::all();
        $productgroups          = Product_group::whereStatus(4)->get();
        $suppliers              = Supplier::whereUser_id(auth::user()->id)->get();

        return view('Site.profilesupplier')
            ->with(compact('menus'))
            ->with(compact('supplierproductgroups'))
            ->with(compact('productgroups'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'))
            ->with(compact('cities'))
            ->with(compact('suppliers'))
            ->with(compact('states'));
    }
    public function store(supplierrequest $request , Supplier $suppliers)
    {

        $suppliers = new Supplier();

        if($request->input('manufacturer') == 'on'){
            $suppliers->manufacturer = 1;
        }else{
            $suppliers->manufacturer = 0;
        }
        if($request->input('importer') == 'on'){
            $suppliers->importer = 1;
        }else{
            $suppliers->importer = 0;
        }
        if($request->input('whole_seller') == 'on'){
            $suppliers->whole_seller = 1;
        }else{
            $suppliers->whole_seller = 0;
        }
        if($request->input('retail_seller') == 'on'){
            $suppliers->retail_seller = 1;
        }else{
            $suppliers->retail_seller = 0;
        }
        $suppliers->title       = $request->input('title');
        $suppliers->manager     = $request->input('manager');
        $suppliers->phone       = $request->input('phone');
        $suppliers->mobile      = $request->input('mobile');
        $suppliers->whatsapp    = $request->input('whatsapp');
        $suppliers->email       = $request->input('email');
        $suppliers->website     = $request->input('website');
        $suppliers->state_id    = $request->input('state_id');
        $suppliers->city_id     = $request->input('city_id');
        $suppliers->address     = $request->input('address');
        $suppliers->description = $request->input('description');
        $suppliers->title       = $request->input('title');
        $suppliers->title       = $request->input('title');
        $suppliers->status      = '1';
        $suppliers->description = $request->input('description');
        $suppliers->date        = jdate()->format('Ymd ');
        $suppliers->user_id     = Auth::user()->id;
        $suppliers->date_handle = jdate()->format('Ymd ');

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $suppliers->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        $suppliers->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();

    }

    public function option(Request $request){
        $cities = City::whereState_id($request->input('id'))->get();
        $output = [];

        foreach($cities as $City )
        {
            $output[$City->id] = $City->title;
        }
        return $output;
    }
}
