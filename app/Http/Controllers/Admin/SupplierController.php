<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\mediarequest;
use App\Http\Requests\servicerequest;
use App\Http\Requests\supplierrequest;
use App\Media;
use App\Menudashboard;
use App\Product;
use App\Product_group;
use App\Representative;
use App\Representative_supplier;
use App\State;
use App\Status;
use App\User;
use App\Submenudashboard;
use App\Supplier;
use App\Supplier_product_group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{

    public function index()
    {
        $states             =   State::select('id','title')->get();
        $cities             =   City::select('title' , 'state_id' , 'id')->get();
        $statuses           =   Status::select('id','title')->get();
        $suppliers          =   Supplier::all();
        $users              =   User::select('id' , 'name')->where('id' , '!=' ,1)->get();
        $medias             =   Media::select('technical_id' , 'image')->get();
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();

        return view('Admin.suppliers.all')
            ->with(compact('users'))
            ->with(compact('suppliers'))
            ->with(compact('medias'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('statuses'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }


    public function create()
    {
        $cities             = City::all();
        $states             = State::all();
        $users              = User::select('id' , 'name' , 'phone')->where('id' , '!=' ,1)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.suppliers.create')
            ->with(compact('users'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
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
        $suppliers->status      = '1';
        $suppliers->slug        = 'SU-'.rand(1,999).chr(rand(97,122)).rand(1,999).chr(rand(97,122)).rand(1,999);
        $suppliers->description = $request->input('description');
        $suppliers->date        = jdate()->format('Ymd ');
        $suppliers->user_id     = $request->input('user_id');
        $suppliers->user_handle = Auth::user()->id;
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
        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $suppliers->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $suppliers->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        $suppliers->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('suppliers.index'));

    }
    public function map($id){
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        $suppliers         = Supplier::whereId($id)->get();

        return view('Admin.suppliers.map')
            ->with(compact('suppliers'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with('id' , $id);
    }

    public function show($id)
    {
        $medias             = Media::whereSupplier_id($id)->get();
        $suppliers          = Supplier::whereId($id)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.suppliers.image')
            ->with(compact('suppliers'))
            ->with(compact('medias'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function imgupload(mediarequest $request)
    {
        $medias = new Media();

        if ($request->file('files') != null) {
            $file = $request->file('files');
            $id   = $request->input('id');
            $img = Image::make($file);
            $imagePath ="image/suppliers/$id";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $medias->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');

        }
        $medias->type = $request->file('files')->getClientOriginalName();
        $table = $request->input('table');
        $medias->$table = $request->input('id');
        $medias->date = jdate()->format('Ymd ');
        $medias->user_id = Auth::user()->id;

        $medias->save();
        return Response::json(['success'=>true,'result'=>$medias]);

    }
    public function mapset(Request $request){
        $supplier = Supplier::findOrfail($request->input('id'));
        $supplier->lat = $request->input('lat');
        $supplier->lng = $request->input('lng');
        $supplier->update();

    }

    public function edit($id)
    {
        $productgroups      = Product_group::select('id' , 'title_fa')->whereStatus(4)->get();
        $carmodels          = Car_model::select('id' , 'title_fa')->whereStatus(4)->get();
        $carbrands          = Car_brand::select('id' , 'title_fa')->whereStatus(4)->get();
        $cities             = City::all();
        $states             = State::all();
        $users              = User::select('id' , 'name' , 'phone')->where('id' , '!=' ,1)->get();
        $brands             = Brand::select('id' , 'title_fa')->whereStatus(4)->get();
        $medias             = Media::select('id' , 'image')->whereSupplier_id($id)->whereStatus(4)->get();
        $representativesuppliers = Representative_supplier::all();
        $representatives    = Representative::all();
        $supplierproductgroups = Supplier_product_group::whereSupplier_id($id)->get();
        $statuses           = Status::select('id' , 'title')->get();
        $suppliers          = Supplier::whereId($id)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();


        return view('Admin.suppliers.edit')
            ->with(compact('users'))
            ->with(compact('productgroups'))
            ->with(compact('carmodels'))
            ->with(compact('medias'))
            ->with(compact('carbrands'))
            ->with(compact('suppliers'))
            ->with(compact('representatives'))
            ->with(compact('representativesuppliers'))
            ->with(compact('supplierproductgroups'))
            ->with(compact('brands'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('statuses'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }
    public function updatesupimg($id)
    {
        $suppliers = Supplier::findOrfail($id);
        $suppliers->image  = '';
        $suppliers->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
    public function update(supplierrequest $request, Supplier $supplier)
    {
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
        if ($request->input('status_id') == 4) {

            $user = User::findOrfail($request->input('user_id'));
            if($user->type_id == 4) {
                $user->type_id = 1;
                $user->update();
            }
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
        $supplier->status       = $request->input('status_id');
        $supplier->description  = $request->input('description');
        $supplier->title        = $request->input('title');
        $supplier->title        = $request->input('title');
        $supplier->description  = $request->input('description');
        $supplier->date         = jdate()->format('Ymd ');
        $supplier->user_id      = $request->input('user_id');
        $supplier->user_handle  = Auth::user()->id;
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
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();
    }
    public function supplierhomeshow(Request $request){
       $supplier = Supplier::findOrfail($request->input('id'));

        if($supplier->homeshow == 1){
            $supplier->homeshow = 0;
        }elseif($supplier->homeshow == 0){
            $supplier->homeshow = 1;
        }
       $supplier->update();

    }
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
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
