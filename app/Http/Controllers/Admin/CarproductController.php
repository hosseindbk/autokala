<?php

namespace App\Http\Controllers\Admin;

use App\Car_brand;
use App\Car_model;
use App\Car_product;
use App\Car_type;
use App\Http\Controllers\Controller;
use App\Http\Requests\carproductrequest;
use App\Menudashboard;
use App\Product;
use App\Status;
use App\Submenudashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CarproductController extends Controller
{

    public function index()
    {
        $carproducts        = Car_product::all();
        $products           = Product::all();
        $carmodels          = Car_model::all();
        $cartypes           = Car_type::all();
        $carbrands          = Car_brand::all();
        $statuses           = Status::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.carproducts.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('carmodels'))
            ->with(compact('cartypes'))
            ->with(compact('statuses'))
            ->with(compact('carbrands'))
            ->with(compact('products'))
            ->with(compact('carproducts'));
    }

    public function create()
    {
        $products       = Product::all();
        $carmodels      = Car_model::all();
        $cartypes       = Car_type::all();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.carproducts.create')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('carmodels'))
            ->with(compact('cartypes'))
            ->with(compact('products'));
    }

    public function store(carproductrequest $request){
        if($request->car_type_id > 1) {
            for ($i = 0; $i < count($request->car_type_id); $i++) {
                $cartype[] = [
                    'car_brand_id'    => $request->input('car_brand_id'),
                    'car_model_id'    => $request->input('car_model_id'),
                    'product_id'    => $request->input('product_id'),
                    'status'          => '1',
                    'date'          => jdate()->format('Ymd '),
                    'user_id'       => Auth::user()->id,
                    'car_type_id'  => $request->car_type_id[$i]
                ];
            }

            Car_product::insert($cartype);
            return Redirect::back();
        }else {
            $carproducts = new Car_product();
            $carproducts->car_brand_id    = $request->input('car_brand_id');
            $carproducts->car_model_id    = $request->input('car_model_id');
            $carproducts->product_id    = $request->input('product_id');

            $carproducts->status         = '4';
            $carproducts->date           = jdate()->format('Ymd ');
            $carproducts->user_id        = Auth::user()->id;

            $carproducts->save();

            return Redirect::back();
        }
    }

    public function edit($id)
    {
        $carproducts        = Car_product::whereId($id)->get();
        $cartypes           = Car_type::all();
        $carmodels          = Car_model::all();
        $products           = Product::all();
        $statuses           = Status::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.carproducts.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('carmodels'))
            ->with(compact('statuses'))
            ->with(compact('cartypes'))
            ->with(compact('carproducts'))
            ->with(compact('products'));
    }

    public function update(carproductrequest $request,Car_product $carproduct)
    {
        $carproduct->car_type_id    = $request->input('car_type_id');
        $carproduct->status         = $request->input('status_id');
        $carproduct->description    = $request->input('description');
        $carproduct->date           = jdate()->format('Ymd ');
        $carproduct->user_id        = Auth::user()->id;

        $carproduct->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('carproducts.index'));
    }

    public function destroy(Car_product $carproduct)
    {
        $carproduct->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
}
