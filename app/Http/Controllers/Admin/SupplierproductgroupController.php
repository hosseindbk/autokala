<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\supplierproductgrouprequest;
use App\Supplier_product_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SupplierproductgroupController extends Controller
{

    public function store(supplierproductgrouprequest $request)
    {

        if($request->car_model_id != null) {
            for ($i = 0; $i < count($request->car_model_id); $i++) {
                $cartype[] = [
                    'supplier_id' => $request->input('supplier_id'),
                    'car_brand_id' => $request->input('car_brand_id'),
                    'kala_group_id' => $request->input('product_group_id'),
                    'status' => '1',
                    'date' => jdate()->format('Ymd '),
                    'date_handle' => jdate()->format('Ymd '),
                    'user_id' => Auth::user()->id,
                    'user_handle' => Auth::user()->id,
                    'car_model_id' => $request->car_model_id[$i]
                ];
            }

            Supplier_product_group::insert($cartype);
            return Redirect::back();
        }else {
            return Redirect::back();
        }
    }


    public function destroy(Supplier_product_group $supplierproductgroup)
    {
        $supplierproductgroup->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
}
