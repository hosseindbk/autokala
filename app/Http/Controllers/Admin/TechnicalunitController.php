<?php

namespace App\Http\Controllers\Admin;

use App\Car_brand;
use App\Car_model;
use App\Car_technical_group;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\mediarequest;
use App\Http\Requests\technicalrequest;
use App\Media;
use App\Menudashboard;
use App\Product_group;
use App\State;
use App\Status;
use App\Submenudashboard;
use App\Technical_unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class TechnicalunitController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('technical_units')
                ->leftJoin('states', 'states.id', '=', 'technical_units.state_id')
                ->leftJoin('cities', 'cities.id', '=', 'technical_units.city_id')
                ->select('technical_units.id as tid', 'technical_units.image as image', 'technical_units.title as ttitle', 'technical_units.manager as manager'
                    , 'technical_units.phone as phone', 'technical_units.phone as phone2', 'technical_units.phone as phone3', 'technical_units.mobile as mobile'
                    , 'technical_units.mobile2 as mobile2', 'technical_units.whatsapp as whatsapp', 'states.title as stitle', 'cities.title as ctitle'
                    , 'technical_units.homeshow as homeshow', 'technical_units.status as status')
                ->get();

            return Datatables::of($data)
                ->editColumn('tid', function ($data) {
                    return ($data->tid);
                })
                ->editColumn('ttitle', function ($data) {
                    return ($data->ttitle);
                })
                ->editColumn('manager', function ($data) {
                    return ($data->manager);
                })
                ->editColumn('stitle', function ($data) {
                    return ($data->stitle);
                })
                ->editColumn('ctitle', function ($data) {
                    return ($data->ctitle);
                })
                ->editColumn('phone', function ($data) {
                    return ($data->phone);
                })
                ->editColumn('tstatus', function ($data) {
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
                ->addColumn('image', function ($row) {
                    return '<img src="' . asset($row->image) . '"  width="50" class="img-rounded" align="center" />';

                })
                ->addColumn('location', function ($row) {
                    return '<a href="'. route('technicalunits.address' , $row->tid) .'"  class="btn btn-outline-primary btn-xs"><i class="fe fe-map-pin"></i></a>';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('technicalunits.edit', $row->tid) . '" class="btn ripple btn-outline-info btn-sm">Edit</a>
                                <form action="' . route('technicalunits.destroy' ,$row->tid) .'" method="post"  style="display: inline;">
                                    '.csrf_field().'
                                    '.method_field("DELETE").'
                                         <button type="submit" class="btn ripple btn-outline-danger btn-sm">
                                             <i class="fe fe-trash-2 "></i>
                                         </button>
                                </form>';
                    return $actionBtn;
                })

                ->addColumn('homeshow', function ($row) {
                    if ($row->homeshow == 1) {
                        $homeshow = '<label class="custom-switch">
                              <input type="checkbox" name="homeshow" checked="checked" onclick="handleClick(this);"  class="custom-switch-input" id="' . $row->tid . '" >
                              <span class="custom-switch-indicator"></span></label>';
                        return $homeshow;
                    }else{
                        $homeshow = '<label class="custom-switch">
                              <input type="checkbox" name="homeshow" class="custom-switch-input" onclick="handleClick(this);" id="' . $row->tid . '" >
                              <span class="custom-switch-indicator"></span></label>';
                        return $homeshow;
                    }
                })

//                ->addColumn('homeshow', function ($row) {
//
//                        $homeshow = '<label class="custom-switch">
//                              <input type="checkbox" name="homeshow" class="custom-switch-input" id="' . $row->tid . '" >
//                              <span class="custom-switch-indicator"></span></label>';
//                        return $homeshow;
//                })

                ->rawColumns(['action', 'image', 'homeshow' , 'location'])
                ->make(true);
        }
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();

        return view('Admin.technicalunits.all')
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
        return view('Admin.technicalunits.create')
            ->with(compact('users'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(technicalrequest $request)
    {
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
        $technical_units->email         = $request->input('email');
        $technical_units->slug          = 'TU-'.rand(1,999).chr(rand(97,122)).rand(1,999).chr(rand(97,122)).rand(1,999);
        $technical_units->website       = $request->input('website');
        $technical_units->address       = $request->input('address');
        $technical_units->description   = $request->input('description');
        $technical_units->date          = jdate()->format('Ymd ');
        $technical_units->date_handle   = jdate()->format('Ymd ');
        $technical_units->user_id       = $request->input('user_id');
        $technical_units->user_handle   = Auth::user()->name;

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="image/technicals/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $technical_units->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="image/technicals/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $technical_units->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="image/technicals/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $technical_units->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $technical_units->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('technicalunits.index'));
    }

    public function imgupload(mediarequest $request)
    {
        $medias = new Media();

        if ($request->file('files') != null) {
            $file = $request->file('files');
            $id   = $request->input('id');
            $img = Image::make($file);
            $imagePath ="image/technicals/$id";
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

    public function edit($id)
    {
        $productgroups      = Product_group::select('id' , 'related_service')->whereStatus(4)->get();
        $carmodels          = Car_model::select('id' , 'title_fa')->whereStatus(4)->get();
        $carbrands          = Car_brand::select('id' , 'title_fa')->whereStatus(4)->get();
        $cities             = City::all();
        $states             = State::all();
        $users              = User::select('id' , 'name' , 'phone')->where('id' , '!=' ,1)->get();
        $statuses           = Status::select('id' , 'title')->get();
        $medias             = Media::select('id' , 'image')->whereTechnical_id($id)->whereStatus(1)->get();
        $technicalunits    = Technical_unit::whereId($id)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        $cartechnicalgroups = Car_technical_group::whereTechnical_id($id)->get();


        return view('Admin.technicalunits.edit')
            ->with(compact('users'))
            ->with(compact('menudashboards'))
            ->with(compact('productgroups'))
            ->with(compact('carmodels'))
            ->with(compact('medias'))
            ->with(compact('cartechnicalgroups'))
            ->with(compact('carbrands'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('statuses'))
            ->with(compact('submenudashboards'))
            ->with(compact('technicalunits'));
    }

    public function update(technicalrequest $request,$id)
    {
        if ($request->input('status_id') == 4) {
            if ($request->input('user_id') != null) {
                $user = User::findOrfail($request->input('user_id'));
                if ($user->type_id == 4) {
                    $user->type_id = 3;
                    $user->update();
                }
            }
        }

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
        $technical_unit->status         = $request->input('status_id');
        $technical_unit->email          = $request->input('email');
        $technical_unit->website        = $request->input('website');
        $technical_unit->address        = $request->input('address');
        $technical_unit->description    = $request->input('description');
        $technical_unit->autokala       = $request->input('autokala');
        $technical_unit->date           = jdate()->format('Ymd ');
        $technical_unit->date_handle    = jdate()->format('Ymd ');
        $technical_unit->user_id        = $request->input('user_id');
        $technical_unit->status         = $request->input('status_id');
        $technical_unit->user_handle    = Auth::user()->id;

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="image/technicals/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $technical_unit->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="image/technicals/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $technical_unit->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="image/technicals/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $technical_unit->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $technical_unit->update();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();

    }

    public function updatetechimg(Request $request , $id)
    {
        $technicaslunits = Technical_unit::findOrfail($id);

        if ($request->input('image') == '0') {
            $technicaslunits->image = '';
        }
        if($request->input('image2') == '0') {
            $technicaslunits->image2 = '';
        }
        if($request->input('image3') == '0') {
            $technicaslunits->image3 = '';
        }
        $technicaslunits->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }

    public function destroy($id)
    {
        $technicaslunits=Technical_unit::whereId($id);
        $technicaslunits->delete();
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

    public function modeloption(Request $request){
        $carmodels = Car_model::whereVehicle_brand_id($request->input('id'))->get();
        $output = [];

        foreach($carmodels as $Car_model )
        {
            $output[$Car_model->id] = $Car_model->title_fa;
        }

        return $output;
    }

    public function technicalhomeshow(Request $request){
        $technicalunit = Technical_unit::findOrfail($request->input('id'));

        if($technicalunit->homeshow == 1){
            $technicalunit->homeshow = 0;
        }elseif($technicalunit->homeshow == 0){
            $technicalunit->homeshow = 1;
        }
        $technicalunit->update();

    }

    public function map($id){
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        $technicals         = Technical_unit::whereId($id)->get();

        return view('Admin.technicalunits.map')
            ->with(compact('technicals'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with('id' , $id);
    }

    public function mapset(Request $request){
        $technicalunit = Technical_unit::findOrfail($request->input('id'));
        $technicalunit->lat = $request->input('lat');
        $technicalunit->lng = $request->input('lng');

        $technicalunit->update();

    }

    public function techkeyword(Request $request,$id)
    {

        $technical_unit = Technical_unit::findOrfail($id);
        $technical_unit->tech_keyword   = $request->input('tech_keyword');

        $technical_unit->update();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();

    }

}
