<?php

namespace App\Http\Controllers\Admin;

use App\Car_brand;
use App\Car_model;
use App\Car_technical_group;
use App\Car_type;
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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class TechnicalunitController extends Controller
{

    public function index()
    {
        $technicalunits     =   Technical_unit::all();
        $states             =   State::select('id','title')->get();
        $cities             =   City::select('title' , 'state_id' , 'id')->get();
        $statuses           =   Status::select('id','title')->get();
        $users              =   User::select('id' , 'name')->where('id' , '!=' ,1)->get();
        $medias             =   Media::select('technical_id' , 'image')->get();
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();

        return view('Admin.technicalunits.all')
            ->with(compact('users'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('statuses'))
            ->with(compact('medias'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('technicalunits'));

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
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $technical_units->image = $file->move($imagePath, $imageName);
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

    public function edit($id)
    {
        $productgroups      = Product_group::select('id' , 'related_service')->whereStatus(4)->get();
        $carmodels          = Car_model::select('id' , 'title_fa')->whereStatus(4)->get();
        $carbrands          = Car_brand::select('id' , 'title_fa')->whereStatus(4)->get();
        $cities             = City::all();
        $states             = State::all();
        $users              = User::select('id' , 'name' , 'phone')->where('id' , '!=' ,1)->get();
        $statuses           = Status::select('id' , 'title')->get();
        $medias             = Media::select('id' , 'image')->whereTechnical_id($id)->whereStatus(4)->get();
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
        $technical_unit->date           = jdate()->format('Ymd ');
        $technical_unit->date_handle    = jdate()->format('Ymd ');
        $technical_unit->user_id       = $request->input('user_id');
        $technical_unit->status         = $request->input('status_id');
        $technical_unit->user_handle    = Auth::user()->name;

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="image/technicals/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $technical_unit->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $technical_unit->update();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();

    }
    public function updatetechimg($id)
    {
        $technicaslunits = Technical_unit::findOrfail($id);
        $technicaslunits->image  = '';
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
}
