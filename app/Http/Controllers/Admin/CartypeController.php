<?php

namespace App\Http\Controllers\Admin;

use App\Car_brand;
use App\Car_model;
use App\Car_type;
use App\Http\Controllers\Controller;
use App\Http\Requests\cartyperequest;
use App\Menudashboard;
use App\Status;
use App\Submenudashboard;
use Illuminate\Support\Facades\Auth;

class CartypeController extends Controller
{

    public function index()
    {
        $cartypes           = Car_type::all();
        $carmodels          = Car_model::all();
        $carbrands          = Car_brand::all();
        $statuses           = Status::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.cartypes.all')
            ->with(compact('carmodels'))
            ->with(compact('cartypes'))
            ->with(compact('carbrands'))
            ->with(compact('statuses'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function create()
    {
        $carmodels          = Car_model::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.cartypes.create')

            ->with(compact('carmodels'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(cartyperequest $request)
    {

        $cartypes = new Car_type();

        $cartypes->title_fa     = $request->input('title_fa');
        $cartypes->title_en     = $request->input('title_en');
        $cartypes->status       = '1';
        $cartypes->car_model_id = $request->input('car_model_id');
        $cartypes->description  = $request->input('description');
        $cartypes->date         = jdate()->format('Ymd ');
        $cartypes->date_handle  = jdate()->format('Ymd ');
        $cartypes->user_id      = Auth::user()->id;
        $cartypes->user_handle  = Auth::user()->name;

        $cartypes->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('cartypes.index'));

    }

    public function edit($id)
    {
        $cartypes           = Car_type::whereId($id)->get();
        $carmodels          = Car_model::all();
        $statuses           = Status::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.cartypes.edit')
            ->with(compact('carmodels'))
            ->with(compact('cartypes'))
            ->with(compact('statuses'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function update(cartyperequest $request, Car_type $cartype)
    {

        $cartype->title_fa      = $request->input('title_fa');
        $cartype->title_en      = $request->input('title_en');
        $cartype->car_model_id  = $request->input('car_model_id');
        $cartype->description   = $request->input('description');
        $cartype->status        = $request->input('status_id');
        $cartype->date          = jdate()->format('Ymd ');
        $cartype->date_handle   = jdate()->format('Ymd ');
        $cartype->user_id       = Auth::user()->id;
        $cartype->user_handle   = Auth::user()->name;

        $cartype->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('cartypes.index'));
    }

    public function destroy(Car_type $cartype)
    {
        $cartype->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('cartypes.index'));
    }
}
