<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Requests\representativerequest;
use App\Menudashboard;
use App\Representative;
use App\Representative_supplier;
use App\Status;
use App\Submenudashboard;
use App\Supplier;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RepresentController extends Controller
{

    public function index()
    {
        $representatives            = Representative::all();
        $brands                     = Brand::all();
        $representative_suppliers   = Representative_supplier::all();
        $suppliers                  = Supplier::all();
        $statuses                   = Status::all();
        $menudashboards             = Menudashboard::whereStatus(4)->get();
        $submenudashboards          = Submenudashboard::whereStatus(4)->get();
        return view('Admin.representatives.all')
            ->with(compact('representatives'))
            ->with(compact('representative_suppliers'))
            ->with(compact('suppliers'))
            ->with(compact('statuses'))
            ->with(compact('brands'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function create()
    {
        $representatives    = Representative::all();
        $suppliers          = Supplier::all();
        $brands             = Brand::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.representatives.create')

            ->with(compact('suppliers'))
            ->with(compact('brands'))
            ->with(compact('representatives'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));

    }

    public function store(representativerequest $request)
    {
        if($request->brand_id != null) {
            for ($i = 0; $i < count($request->brand_id); $i++) {
                $brand[] = [
                    'supplier_id'   => $request->input('supplier_id'),
                    'status'        => '1',
                    'exp_date'      => jdate()->format('Ymd '),
                    'date'          => jdate()->format('Ymd '),
                    'date_handle'          => jdate()->format('Ymd '),
                    'user_id'       => Auth::user()->id,
                    'user_handle'       => Auth::user()->id,
                    'brand_id'  => $request->brand_id[$i]
                ];
            }

            Representative::insert($brand);
        }
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logos      = Logo::whereId($id)->get();
        return view('Admin.logos.edit' , compact('logos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(logorequest $request, Logo $logo)
    {
        $logo->title = $request->input('title');
        $logo->description = $request->input('description');
        $logo->category_id = $request->input('category_id');

        if ($request->hasFile('images')) {
            $year = Carbon::now()->year;
            $imagePath = "images/logo/{$year}";
            $file = $request->file('images');
            $orginalimageName = $file->getClientOriginalName();
            $imageName =  md5(uniqid(rand(), true)) . $orginalimageName;
            $logo->imageUrl = $file->move($imagePath , $imageName);
        }

        $logo->update();

        return redirect(route('logos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Representative $representative )
    {
        $representative->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
}
