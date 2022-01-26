<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Car_technical_group;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\mediarequest;
use App\Http\Requests\supplierrequest;
use App\Http\Requests\technicalrequest;
use App\Media;
use App\Menu;
use App\Offer;
use App\Product_group;
use App\State;
use App\Supplier;
use App\Supplier_product_group;
use App\Technical_unit;
use App\Type_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ProfilebusinessController extends Controller
{
    public function index(){
        $menus                  = Menu::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = city::all();
        $carbrands              = Car_brand::all();
        $carmodels              = Car_model::all();
        $supplierproductgroups  = Supplier_product_group::all();
        $productgroups          = Product_group::whereStatus(4)->get();
        $cartechnicalgroups     = Car_technical_group::whereStatus(4)->whereUser_id(auth::user()->id)->get();
        $types                  = Type_user::all();
        $medias                 = Media::select('id' , 'image' , 'supplier_id' , 'technical_id')->whereStatus(1)->get();
        $suppliers              = Supplier::whereUser_id(auth::user()->id)->get();
        $technicalunits         = Technical_unit::whereUser_id(auth::user()->id)->get();
        $supplierz              = count($suppliers);
        $technicalunitsz        = count($technicalunits);

        if (auth::user()->type_id == 1 || auth::user()->type_id == 4) {
            if ($supplierz != null) {
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
            }else{
                return view('Site.profilesupplier')
                    ->with(compact('menus'))
                    ->with(compact('supplierproductgroups'))
                    ->with(compact('productgroups'))
                    ->with(compact('carbrands'))
                    ->with(compact('carmodels'))
                    ->with(compact('cities'))
                    ->with(compact('states'));
            }
        }elseif(auth::user()->type_id == 3 || auth::user()->type_id == 4) {
            if ($technicalunitsz != null){
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
            }else {
                return view('Site.profiletechnicalunit')
                    ->with(compact('cartechnicalgroups'))
                    ->with(compact('menus'))
                    ->with(compact('productgroups'))
                    ->with(compact('supplierproductgroups'))
                    ->with(compact('carbrands'))
                    ->with(compact('carmodels'))
                    ->with(compact('suppliers'))
                    ->with(compact('cities'))
                    ->with(compact('technicalunits'))
                    ->with(compact('states'));
            }
        }
        if (auth::user()->type_id == 4) {

                return view('Site.profilelowlevel')
                    ->with(compact('types'))
                    ->with(compact('productgroups'))
                    ->with(compact('carbrands'))
                    ->with(compact('carmodels'))
                    ->with(compact('menus'))
                    ->with(compact('cities'))
                    ->with(compact('states'));
        }
    }
    public function suppliermap(Request $request)
    {
        $suppliermap               = Supplier::findOrfail($request->input('id'));
        $suppliermap->lat          = $request->input('lat');
        $suppliermap->lng          = $request->input('lng');

        $suppliermap->update();
    }

    public function technicalunitmap(Request $request)
    {
        $technicalunitmap               = Technical_unit::findOrfail($request->input('id'));
        $technicalunitmap->lat          = $request->input('lat');
        $technicalunitmap->lng          = $request->input('lng');

        $technicalunitmap->update();
    }
    public function profileinfo(){
        $menus                  =  Menu::whereStatus(4)->get();
        $suppliers              =  Supplier::whereUser_id(Auth::user()->id)->get();
        $technicalunits         =  Technical_unit::whereUser_id(Auth::user()->id)->get();
        $typeusers              =  Type_user::whereId(auth::user()->type_id)->get();
        $offers                 =  Offer::all();
        $brands                 =  Brand::all();
        $states                 =  State::all();
        $cities                 =  City::all();
        return view('Site.profileinfo')
            ->with(compact('brands'))
            ->with(compact('offers'))
            ->with(compact('suppliers'))
            ->with(compact('technicalunits'))
            ->with(compact('typeusers'))
            ->with(compact('states'))
            ->with(compact('menus'))
            ->with(compact('cities'));
}

    public function storesupplier(supplierrequest $request)
    {
        $usercheck = Supplier::whereUser_id(Auth::user()->id)->get();

        if (trim($usercheck) != '[]') {
            alert()->error('عملیات ناموفق', 'شما قبلا فروشگاه ثبت نموده اید');
            return Redirect::back();
        } else {

            $suppliers = new Supplier();

            if ($request->input('manufacturer') == 'on') {
                $suppliers->manufacturer = 1;
            } else {
                $suppliers->manufacturer = 0;
            }
            if ($request->input('importer') == 'on') {
                $suppliers->importer = 1;
            } else {
                $suppliers->importer = 0;
            }
            if ($request->input('whole_seller') == 'on') {
                $suppliers->whole_seller = 1;
            } else {
                $suppliers->whole_seller = 0;
            }
            if ($request->input('retail_seller') == 'on') {
                $suppliers->retail_seller = 1;
            } else {
                $suppliers->retail_seller = 0;
            }
            $suppliers->title           = $request->input('title');
            $suppliers->manager         = $request->input('manager');
            $suppliers->phone           = $request->input('phone');
            $suppliers->mobile          = $request->input('mobile');
            $suppliers->whatsapp        = $request->input('whatsapp');
            $suppliers->email           = $request->input('email');
            $suppliers->website         = $request->input('website');
            $suppliers->state_id        = $request->input('state_id');
            $suppliers->city_id         = $request->input('city_id');
            $suppliers->address         = $request->input('address');
            $suppliers->description     = $request->input('description');
            $suppliers->title           = $request->input('title');
            $suppliers->title           = $request->input('title');
            $suppliers->status          = '1';
            $suppliers->slug            = 'SU-' . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999);
            $suppliers->description     = $request->input('description');
            $suppliers->date            = jdate()->format('Ymd ');
            $suppliers->user_id         = Auth::user()->id;
            $suppliers->date_handle     = jdate()->format('Ymd ');

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
    }
    public function imgupload(mediarequest $request)
    {
        $medias = new Media();

        if ($request->file('files') != null) {
            $file = $request->file('files');
            $id   = $request->input('id');
            $img = Image::make($file);
            $imagePath ="images/product/$id";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $medias->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');

        }
        $medias->type       = $request->file('files')->getClientOriginalName();
        $table              = $request->input('table');
        $medias->$table     = $request->input('id');
        $medias->date       = jdate()->format('Ymd ');
        $medias->status     = '1';
        $medias->user_id    = Auth::user()->id;

        $medias->save();
        return Response::json(['success'=>true,'result'=>$medias]);

    }
    public function storetechnical(technicalrequest $request)
    {
        $usercheck = Technical_unit::whereUser_id(Auth::user()->id)->get();

        if (trim($usercheck) != '[]') {
            alert()->error('عملیات ناموفق', 'شما قبلا تعمیرگاه ثبت نموده اید');
            return Redirect::back();
        } else {

            $technical_units = new Technical_unit();

            $technical_units->title         = $request->input('title');
            $technical_units->manager       = $request->input('manager');
            $technical_units->state_id      = $request->input('state_id');
            $technical_units->city_id       = $request->input('city_id');
            $technical_units->phone         = $request->input('phone');
            $technical_units->phone2        = $request->input('phone2');
            $technical_units->phone3        = $request->input('phone3');
            $technical_units->mobile        = $request->input('mobile');
            $technical_units->mobile2       = $request->input('mobile2');
            $technical_units->whatsapp      = $request->input('whatsapp');
            $technical_units->status        = '1';
            $technical_units->slug          = 'TU-' . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999);
            $technical_units->email         = $request->input('email');
            $technical_units->website       = $request->input('website');
            $technical_units->address       = $request->input('address');
            $technical_units->description   = $request->input('description');
            $technical_units->date          = jdate()->format('Ymd ');
            $technical_units->date_handle   = jdate()->format('Ymd ');
            $technical_units->user_id       = Auth::user()->id;

            if ($request->file('image') != null) {
                $file = $request->file('image');
                $img = Image::make($file);
                $imagePath = "images/technicals";
                $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
                $technical_units->image = $file->move($imagePath, $imageName);
                $img->save($imagePath . $imageName);
                $img->encode('jpg');
            }
            if ($request->file('image2') != null) {
                $file = $request->file('image2');
                $img = Image::make($file);
                $imagePath = "images/technicals";
                $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
                $technical_units->image2 = $file->move($imagePath, $imageName);
                $img->save($imagePath . $imageName);
                $img->encode('jpg');
            }
            if ($request->file('image3') != null) {
                $file = $request->file('image3');
                $img = Image::make($file);
                $imagePath = "images/technicals";
                $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
                $technical_units->image3 = $file->move($imagePath, $imageName);
                $img->save($imagePath . $imageName);
                $img->encode('jpg');
            }

            $slug = $technical_units->slug;
            $user = Auth::user()->name;
            $technical_units->save();
            alert()->success('عملیات موفق' ,'اطلاعات تعمیرگاه با موفقیت ثبت شد');

            $technical_id = Technical_unit::whereSlug($slug)->get();
            foreach ($technical_id as $Technical_unit) {

            }
            return redirect(route('protechnicaledit', $Technical_unit->id));
        }
    }

    public function updatetechnical(Request $request,$id)
    {
        $technical_unit = Technical_unit::findOrfail($id);

        $technical_unit->title          = $request->input('title');
        $technical_unit->manager        = $request->input('manager');
        $technical_unit->state_id       = $request->input('state_id');
        $technical_unit->city_id        = $request->input('city_id');
        $technical_unit->phone          = $request->input('phone');
        $technical_unit->phone2         = $request->input('phone2');
        $technical_unit->phone3         = $request->input('phone3');
        $technical_unit->mobile         = $request->input('mobile');
        $technical_unit->mobile2        = $request->input('mobile2');
        $technical_unit->whatsapp       = $request->input('whatsapp');
        $technical_unit->status         = 1;
        $technical_unit->email          = $request->input('email');
        $technical_unit->website        = $request->input('website');
        $technical_unit->address        = $request->input('address');
        $technical_unit->description    = $request->input('description');
        $technical_unit->date           = jdate()->format('Ymd ');
        $technical_unit->date_handle    = jdate()->format('Ymd ');
        $technical_unit->user_id        = Auth::user()->id;

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="image/technicals/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $technical_unit->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="image/technicals/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $technical_unit->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="image/technicals/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $technical_unit->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $technical_unit->update();

        alert()->success('عملیات موفق', 'اطلاعات تعمیرگاه با موفقیت ویرایش شد');
        return Redirect::back();

    }

    public function updatesupplier(Request $request, $id)
    {

        $supplier = Supplier::findOrfail($id);

        if($request->input('manufacturer') == 'on'){
            $supplier->manufacturer = 1;
        }
        if($request->input('manufacturer') == null) {
            $supplier->manufacturer = 0;
        }
        if($request->input('importer') == 'on'){
            $supplier->importer = 1;
        }
        if($request->input('importer') == null) {
            $supplier->importer = 0;
        }
        if($request->input('whole_seller') == 'on'){
            $supplier->whole_seller = 1;
        }
        if($request->input('whole_seller') == null) {
            $supplier->whole_seller = 0;
        }
        if($request->input('retail_seller') == 'on'){
            $supplier->retail_seller = 1;
        }
        if($request->input('retail_seller') == null) {
            $supplier->retail_seller = 0;
        }
        $supplier->title        = $request->input('title');
        $supplier->manager      = $request->input('manager');
        $supplier->phone        = $request->input('phone');
        $supplier->mobile       = $request->input('mobile');
        $supplier->whatsapp     = $request->input('whatsapp');
        $supplier->email        = $request->input('email');
        $supplier->website      = $request->input('website');
        $supplier->state_id     = $request->input('state_id');
        $supplier->city_id      = $request->input('city_id');
        $supplier->address      = $request->input('address');
        $supplier->status       = 2;
        $supplier->description  = $request->input('description');
        $supplier->title        = $request->input('title');
        $supplier->description  = $request->input('description');
        $supplier->date         = jdate()->format('Ymd ');
        $supplier->user_id      = Auth::user()->id;
        $supplier->date_handle  = jdate()->format('Ymd ');

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $supplier->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
         if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $supplier->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
         if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $supplier->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $supplier->update();
        alert()->success('عملیات موفق', 'اطلاعات فروشگاه با موفقیت ویرایش شد');
        return Redirect::back();
    }

    public function cartechnicalstore(Request $request)
    {
        if ($request->car_model_id != null) {
            for ($i = 0; $i < count($request->car_model_id); $i++) {
                $carmodel[] = [
                    'kala_group_id' => $request->input('product_group_id'),
                    'car_brand_id'  => $request->input('car_brand_id'),
                    'technical_id'  => $request->input('technical_id'),
                    'status'        => '4',
                    'date'          => jdate()->format('Ymd '),
                    'date_handle'   => jdate()->format('Ymd '),
                    'user_id'       => Auth::user()->id,
                    'car_model_id'  => $request->car_model_id[$i]
                ];
            }

            Car_technical_group::insert($carmodel);
            return Redirect::back();
        }else {

            $cartechnicalgroups = new Car_technical_group();

            $cartechnicalgroups->kala_group_id      = $request->input('product_group_id');
            $cartechnicalgroups->car_brand_id       = $request->input('car_brand_id');
            $cartechnicalgroups->technical_id       = $request->input('technical_id');
            $cartechnicalgroups->date               = jdate()->format('Ymd ');
            $cartechnicalgroups->date_handle        = jdate()->format('Ymd ');
            $cartechnicalgroups->user_id            = Auth::user()->id;

            $cartechnicalgroups->save();

            return Redirect::back();
        }

    }

    public function carsupplierstore(Request $request)
    {
        if ($request->car_model_id != null) {
            for ($i = 0; $i < count($request->car_model_id); $i++) {
                $carmodel[] = [
                    'kala_group_id' => $request->input('product_group_id'),
                    'car_brand_id'  => $request->input('car_brand_id'),
                    'supplier_id'  => $request->input('supplier_id'),
                    'status'        => '4',
                    'date'          => jdate()->format('Ymd '),
                    'date_handle'   => jdate()->format('Ymd '),
                    'user_id'       => Auth::user()->id,
                    'car_model_id'  => $request->car_model_id[$i]
                ];
            }

            Supplier_product_group::insert($carmodel);

            return Redirect::back();
        }else {

            $carproductgroups = new Supplier_product_group();

            $carproductgroups->kala_group_id = $request->input('product_group_id');
            $carproductgroups->car_brand_id = $request->input('car_brand_id');
            $carproductgroups->supplier_id = $request->input('supplier_id');
            $carproductgroups->date = jdate()->format('Ymd ');
            $carproductgroups->date_handle = jdate()->format('Ymd ');
            $carproductgroups->user_id = Auth::user()->id;

            $carproductgroups->save();

            return Redirect::back();
        }

    }

    public function carsuppliergroupdelete($id)
    {
        $carsuppliergroup = Supplier_product_group::findOrfail($id);
        $carsuppliergroup->delete();
        return Redirect::back();
    }

    public function cartechnicaldelete($id)
    {
        $cartechnicalgroup = Car_technical_group::findOrfail($id);
        $cartechnicalgroup->delete();
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
