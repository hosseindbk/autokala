<?php

namespace App\Http\Controllers\Admin;

use App\Car_brand;
use App\Car_model;
use App\Car_type;
use App\Http\Controllers\Controller;
use App\Http\Requests\carbrandrequest;
use App\Http\Requests\carmodelrequest;
use App\Http\Requests\cartyperequest;
use App\Menudashboard;
use App\Status;
use App\Submenudashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CarController extends Controller
{

    public function index()
    {
//        $carmodels          = Car_model::select('id' , 'title_fa' , 'vehicle_brand_id')->get();
//        $carbrands          = Car_brand::select('id' , 'title_fa')->get();
//        $cartypes           = Car_type::select('id' , 'title_fa' , 'car_model_id')->get();
        $statuses           = Status::select('id' , 'title')->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        $shares = DB::table('car_brands')
            ->leftjoin('car_models', 'car_models.vehicle_brand_id', '=', 'car_brands.id')
            ->leftjoin('car_types', 'car_types.car_model_id', '=', 'car_models.id')
            ->select('car_brands.title_fa as brand' , 'car_models.title_fa as model' , 'car_types.title_fa as type' ,'car_models.id as id' )->get();


        return view('Admin.cars.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('statuses'))
            ->with(compact('shares'));
//            ->with(compact('carbrands'))
//            ->with(compact('carmodels'))

    }

    public function create()
    {
        $carbrands          = Car_brand::all();
        $carmodels          = Car_model::all();
        $cartypes           = Car_type::all();
        $statuses           = Status::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.cars.create')
            ->with(compact('carbrands'))
            ->with(compact('statuses'))
            ->with(compact('carmodels'))
            ->with(compact('cartypes'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }
    public function storecarbrand(carbrandrequest $request)
    {
        $carbrands = new Car_brand();

        $carbrands->title_fa    = $request->input('title_fa');
        $carbrands->title_en    = $request->input('title_en');
        $carbrands->status      = '4';

        $carbrands->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();

    }

    public function storecarmodel(carmodelrequest $request)
    {
        $carmodels = new Car_model();

        $carmodels->title_fa         = $request->input('title_fa');
        $carmodels->title_en         = $request->input('title_en');
        $carmodels->vehicle_brand_id = $request->input('vehicle_brand_id');
        $carmodels->status           = '4';
        $carmodels->date             = jdate()->format('Ymd ');
        $carmodels->date_handle      = jdate()->format('Ymd ');
        $carmodels->user_id          = Auth::user()->id;

        $carmodels->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();

    }
    public function storecartype(cartyperequest $request)
    {

        $cartypes = new Car_type();

        $cartypes->title_fa     = $request->input('title_fa');
        $cartypes->title_en     = $request->input('title_en');
        $cartypes->status       = '4';
        $cartypes->car_model_id = $request->input('car_model_id');
        $cartypes->date         = jdate()->format('Ymd ');
        $cartypes->date_handle  = jdate()->format('Ymd ');
        $cartypes->user_id      = Auth::user()->id;

        $cartypes->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();

    }


    public function edit($id)
    {
        $carmodels          = Car_model::select('id' , 'title_fa' , 'title_en')->whereId($id)->get();
        $carbrands          = Car_brand::select('id' , 'title_fa')->get();
        $statuses           = Status::select('id' , 'title')->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.cars.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('statuses'))
            ->with(compact('carbrands'))
            ->with(compact('carmodels'));
    }
    public function caredit(carmodelrequest $request,$id)
    {
        $carmodel = Car_model::findOrfail($id);
        $carmodel->title_fa         = $request->input('title_fa');
        $carmodel->title_en         = $request->input('title_en');
        $carmodel->vehicle_brand_id = $request->input('vehicle_brand_id');
        $carmodel->date_handle      = jdate()->format('Ymd ');
        $carmodel->user_handle      = Auth::user()->name;

        $carmodel->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('carmodels.index'));
    }

    public function update(carmodelrequest $request, Car_model $carmodel)
    {
        $carmodel->title_fa         = $request->input('title_fa');
        $carmodel->title_en         = $request->input('title_en');
        $carmodel->vehicle_brand_id = $request->input('vehicle_brand_id');
        $carmodel->date             = jdate()->format('Ymd ');
        $carmodel->date_handle      = jdate()->format('Ymd ');
        $carmodel->user_handle      = Auth::user()->name;

        $carmodel->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('carmodels.index'));
    }


    public function destroycarbrand($id)
    {
        $carbrand = Car_brand::find($id);
        $carbrand->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
    public function destroycarmodel($id)
    {
        $carmodel = Car_model::find($id);
        $carmodel->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
    public function destroycartype($id)
    {
        $cartype = Car_type::find($id);
        $cartype->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
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
