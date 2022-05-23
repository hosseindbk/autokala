<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\representativerequest;
use App\Representative_supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RepresentativesupplierController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(representativerequest $request)
    {
        if ($request->supplier_id != null) {
            for ($i = 0; $i < count($request->supplier_id); $i++) {
                $supplier[] = [
                    'brand_id' => $request->input('brand_id'),
                    'status' => '1',
                    'date' => jdate()->format('Ymd '),
                    'user_id' => Auth::user()->id,
                    'supplier_id' => $request->supplier_id[$i]
                ];
            }

            Representative_supplier::insert($supplier);

            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $representetivesuppliers = Representative_supplier::findorfail($id);
        $representetivesuppliers->delete();
        return Redirect::back();
    }
}
