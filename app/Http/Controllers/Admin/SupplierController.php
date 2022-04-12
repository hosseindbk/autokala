<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\mediarequest;
use App\Http\Requests\supplierrequest;
use App\Media;
use App\Menudashboard;
use App\Product_group;
use App\Representative;
use App\Representative_supplier;
use App\State;
use App\Status;
use App\Submenudashboard;
use App\Supplier;
use App\Supplier_product_group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = DB::table('suppliers')
                ->leftJoin('states', 'states.id', '=', 'suppliers.state_id')
                ->leftJoin('cities', 'cities.id', '=', 'suppliers.city_id')
                ->select('suppliers.id as sid', 'suppliers.image as image','suppliers.manufacturer' , 'suppliers.importer'
                    , 'suppliers.whole_seller', 'suppliers.retail_seller' , 'suppliers.title as stitle', 'suppliers.manager as manager'
                    , 'suppliers.phone as phone', 'suppliers.mobile as mobile','suppliers.whatsapp as whatsapp', 'states.title as statetitle'
                    , 'cities.title as ctitle' , 'suppliers.homeshow as homeshow', 'suppliers.status as status')
                ->get();

        return Datatables::of($data)
            ->editColumn('sid', function ($data) {
                return ($data->sid);
            })
            ->editColumn('stitle', function ($data) {
                return ($data->stitle);
            })
            ->editColumn('manager', function ($data) {
                return ($data->manager);
            })
            ->editColumn('statetitle', function ($data) {
                return ($data->statetitle);
            })
            ->editColumn('ctitle', function ($data) {
                return ($data->ctitle);
            })
            ->editColumn('phone', function ($data) {
                return ($data->phone);
            })
            ->editColumn('status', function ($data) {
                if ($data->status == "1") {
                    return 'پیش نویس';
                } elseif ($data->status == "2") {
                    return 'درحال بررسی';
                } elseif ($data->status == "3") {
                    return 'تایید مدیر';
                } elseif ($data->status == "4") {
                    return 'درحال نمایش';
                } elseif ($data->status == "5") {
                    return 'معلق شده';
                } elseif ($data->status == "6") {
                    return 'حذف شده';
                }
            })
            ->editColumn('noe', function ($data) {
                if ($data->manufacturer == "1") {
                    $manufacturer   = 'تولید کننده';
                }else{
                    $manufacturer = null;
                } if ($data->importer == "1") {
                    $importer       = 'وارد کننده';
                }
                else{
                    $importer = null;
                }
                if ($data->whole_seller == "1") {
                    $whole_seller   =  'عمده فروش';
                }else{
                    $whole_seller = null;
                }  if ($data->retail_seller == "1") {
                    $retail_seller  =  'خرده فروش';
                }else{
                    $retail_seller = null;
                }
                return ([$manufacturer , $importer, $whole_seller,$retail_seller]);
            })
            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '"  width="50" class="img-rounded" align="center" />';

            })
            ->addColumn('location', function ($row) {
                return '<a href="'. route('suppliers.address' , $row->sid) .'"  class="btn btn-outline-primary btn-xs"><i class="fe fe-map-pin"></i></a>';
            })


            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="' . route('suppliers.edit', $row->sid) . '" class="btn ripple btn-outline-info btn-sm">Edit</a>
                                <form action="' . route('suppliers.destroy' ,$row->sid) .'" method="post"  style="display: inline;">
                                    '.csrf_field().'
                                    '.method_field("DELETE").'
                                         <button type="submit" class="btn ripple btn-outline-danger btn-sm">
                                             <i class="fe fe-trash-2 "></i>
                                         </button>
                                </form>';
                return $actionBtn;
            })

            ->addColumn('homeshow', function ($row) {
                $homeshow = '<label class="custom-switch">
                              <input type="checkbox" name="homeshow" class="custom-switch-input" id="' . $row->sid . '" >
                              <span class="custom-switch-indicator"></span></label>';
                return $homeshow;
            })
            ->rawColumns(['action', 'image', 'homeshow' , 'location' , 'noe'])
            ->make(true);
        }
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();

        return view('Admin.suppliers.all')
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
        $suppliers->autokala       = $request->input('autokala');
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
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $suppliers->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $suppliers->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
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
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
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
            if($request->input('user_id') != null) {
                $user = User::findOrfail($request->input('user_id'));
                if($user->type_id == 4) {
                    $user->type_id = 1;
                    $user->update();
                }
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
        $supplier->autokala     = $request->input('autokala');
        $supplier->description  = $request->input('description');
        $supplier->user_id      = $request->input('user_id');
        $supplier->date         = jdate()->format('Ymd ');
        $supplier->user_handle  = Auth::user()->id;
        $supplier->date_handle  = jdate()->format('Ymd ');


        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $supplier->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $supplier->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="image/suppliers/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
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
