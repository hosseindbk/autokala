<?php

namespace App\Http\Controllers\Admin;

use App\Car_technical_group;
use App\Http\Controllers\Controller;
use App\Http\Requests\carproductrequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartechnicalgroupController extends Controller
{

    public function store(carproductrequest $request)
    {
        if ($request->car_model_id != null) {
            for ($i = 0; $i < count($request->car_model_id); $i++) {
                $carmodel[] = [
                    'kala_group_id' => $request->input('product_group_id'),
                    'car_brand_id'  => $request->input('car_brand_id'),
                    'technical_id'  => $request->input('technical_id'),
                    'status'        => '1',
                    'date'          => jdate()->format('Ymd '),
                    'date_handle'   => jdate()->format('Ymd '),
                    'user_id'       => Auth::user()->id,
                    'user_handle'   => Auth::user()->id,
                    'car_model_id'  => $request->car_model_id[$i]
                ];
            }

            Car_technical_group::insert($carmodel);
            return Redirect::back();
        }else {

            $cartechnicalgroups = new Car_technical_group();

            $cartechnicalgroups->kala_group_id = $request->input('product_group_id');
            $cartechnicalgroups->car_brand_id = $request->input('car_brand_id');
            $cartechnicalgroups->technical_id = $request->input('technical_id');
            $cartechnicalgroups->date = jdate()->format('Ymd ');
            $cartechnicalgroups->date_handle = jdate()->format('Ymd ');
            $cartechnicalgroups->user_id = Auth::user()->id;
            $cartechnicalgroups->user_handle = Auth::user()->id;

            $cartechnicalgroups->save();

            return Redirect::back();
        }

    }


    public function destroy($id)
    {
        $cartechnicalgroup = Car_technical_group::findOrfail($id);
        $cartechnicalgroup->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
}
