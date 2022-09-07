<?php

namespace App\Http\Controllers\Site;

use App\Car_brand;
use App\Car_model;
use App\Car_technical_group;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\technicalrequest;
use App\Media;
use App\Menu;
use App\Product_group;
use App\State;
use App\Supplier;
use App\Supplier_product_group;
use App\Technical_unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfiletechnicalunitController extends Controller
{
    public function index(){
        $states         = State::all();
        $menus          = Menu::whereStatus(1)->get();
        return view('Site.profiletechnicalunit')
            ->with(compact('menus'))
            ->with(compact('states'));
    }

    public function profiletechnicaledit(){
        $menus                  = Menu::whereStatus(4)->get();
        $states                 = State::whereId(auth::user()->id)->get();
        foreach ($states as $state) {
           $state_id = $state->id;
        }
        $cities                 = city::whereState_id($state_id)->get();
        $carbrands              = Car_brand::all();
        $carmodels              = Car_model::all();
        $supplierproductgroups  = Supplier_product_group::all();
        $productgroups          = Product_group::whereStatus(4)->get();
        $cartechnicalgroups     = Car_technical_group::whereStatus(4)->whereUser_id(auth::user()->id)->get();
        $medias                 = Media::select('id' , 'image' , 'supplier_id' , 'technical_id')->whereStatus(1)->get();
        $suppliers              = Supplier::whereUser_id(auth::user()->id)->get();
        $technicalunits         = Technical_unit::whereUser_id(auth::user()->id)->get();

        return view('Site.profiletechnicalunitedit')
            ->with(compact('cartechnicalgroups'))
            ->with(compact('menus'))
            ->with(compact('productgroups'))
            ->with(compact('supplierproductgroups'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'))
            ->with(compact('cities'))
            ->with(compact('medias'))
            ->with(compact('suppliers'))
            ->with(compact('technicalunits'))
            ->with(compact('states'));
    }

    public function technicalcreate()
    {
        $menus = Menu::whereStatus(4)->get();
        $states = State::all();
        $cities = city::all();
        $carbrands = Car_brand::all();
        $carmodels = Car_model::all();
        $supplierproductgroups = Supplier_product_group::all();
        $productgroups = Product_group::whereStatus(4)->get();
        $cartechnicalgroups = Car_technical_group::whereStatus(4)->get();
        $technicalunits = Technical_unit::whereUser_id(auth::user()->id)->get();
        $technicalunit_userid = Technical_unit::whereUser_id(auth::user()->id)->pluck('user_id');

        if ($technicalunit_userid != '[]') {
            return view('Site.profiletechnicalunitedit')
                ->with(compact('cartechnicalgroups'))
                ->with(compact('menus'))
                ->with(compact('productgroups'))
                ->with(compact('supplierproductgroups'))
                ->with(compact('carbrands'))
                ->with(compact('carmodels'))
                ->with(compact('cities'))
                ->with(compact('technicalunits'))
                ->with(compact('states'));
        } else {
            return view('Site.profiletechnicalunit')
                ->with(compact('cartechnicalgroups'))
                ->with(compact('menus'))
                ->with(compact('productgroups'))
                ->with(compact('supplierproductgroups'))
                ->with(compact('carbrands'))
                ->with(compact('carmodels'))
                ->with(compact('cities'))
                ->with(compact('technicalunits'))
                ->with(compact('states'));
        }
    }

    public function store(technicalrequest $request)
    {
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
        $technical_units->email         = $request->input('email');
        $technical_units->website       = $request->input('site');
        $technical_units->address       = $request->input('address');
        $technical_units->description   = $request->input('description');
        $technical_units->date          = jdate()->format('Ymd ');
        $technical_units->date_handle   = jdate()->format('Ymd ');
        $technical_units->user_id       = Auth::user()->id;

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
        $slug = $technical_units->slug;

        $technical_units->save();
        alert()->success('عملیات موفق', 'اطلاعات تعمیرگاه با موفقیت ثبت شد');

        $technical_id = Technical_unit::whereSlug($slug)->get();
        foreach ($technical_id as $Technical_unit) {

        }
        return redirect(route('protechnicaledit', $Technical_unit->id));
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
