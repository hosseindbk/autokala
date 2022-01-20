<?php

namespace App\Http\Controllers\Site;

use App\Car_brand;
use App\Car_model;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\supplierrequest;
use App\Menu;
use App\Product_group;
use App\State;
use App\Supplier;
use App\Supplier_product_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $suppliers              = Supplier::whereUser_id(auth::user()->id)->get();
        return view('Site.profilesupplieredit')
            ->with(compact('menus'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'))
            ->with(compact('productgroups'))
            ->with(compact('supplierproductgroups'))
            ->with(compact('suppliers'))
            ->with(compact('cities'))
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
        $supplier_userid        = Supplier::whereUser_id(auth::user()->id)->pluck('user_id');
        if ($supplier_userid != '[]') {
        return view('Site.profilesupplieredit')
            ->with(compact('menus'))
            ->with(compact('supplierproductgroups'))
            ->with(compact('productgroups'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'))
            ->with(compact('cities'))
            ->with(compact('suppliers'))
            ->with(compact('states'));
        } else {
            return view('Site.profilesupplier')
                ->with(compact('menus'))
                ->with(compact('carbrands'))
                ->with(compact('carmodels'))
                ->with(compact('productgroups'))
                ->with(compact('supplierproductgroups'))
                ->with(compact('suppliers'))
                ->with(compact('cities'))
                ->with(compact('states'));
        }
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
            $imagePath = "images/suppliers";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $suppliers->image = $file->move($imagePath, $imageName);
            $img->save($imagePath . $imageName);
            $img->encode('jpg');
        }
        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath = "images/suppliers";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $suppliers->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath . $imageName);
            $img->encode('jpg');
        }
        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath = "images/suppliers";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $suppliers->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath . $imageName);
            $img->encode('jpg');
        }
        $slug = $suppliers->slug;

        $suppliers->save();

        alert()->success('عملیات موفق', 'اطلاعات فروشگاه با موفقیت ثبت شد');

        $supplier_id = Supplier::whereSlug($slug)->get();
        foreach ($supplier_id as $Supplier) {

        }
        return redirect(route('prosupplieredit', $Supplier->id));

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
