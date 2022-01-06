<?php

namespace App\Http\Controllers\Admin;

use App\Car_brand;
use App\Http\Requests\carbrandrequest;
use App\Menudashboard;
use App\Status;
use App\Submenudashboard;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;

class CarbrandController extends Controller
{

    public function index()
    {
        $carbrands          = Car_brand::all();
        $statuses           = Status::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.carbrands.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('statuses'))
            ->with(compact('carbrands'));

    }

    public function create()
    {
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.carbrands.create')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(carbrandrequest $request)
    {
        $carbrands = new Car_brand();

        $carbrands->title_fa    = $request->input('title_fa');
        $carbrands->title_en    = $request->input('title_en');
        $carbrands->status      = '1';
        $carbrands->description = $request->input('description');

        $carbrands->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('carbrands.index'));

    }

    public function edit($id)
    {
        $carbrands          = Car_brand::whereId($id)->get();
        $statuses           = Status::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.carbrands.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('statuses'))
            ->with(compact('carbrands'));
    }

    public function update(carbrandrequest $request, Car_brand $carbrand)
    {
        $carbrand->title_fa     = $request->input('title_fa');
        $carbrand->title_en     = $request->input('title_en');
        $carbrand->description  = $request->input('description');
        $carbrand->status       = $request->input('status_id');

        $carbrand->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('carbrands.index'));
    }

    public function destroy(Car_brand $carbrand)
    {
        $carbrand->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('carbrands.index'));
    }
}
