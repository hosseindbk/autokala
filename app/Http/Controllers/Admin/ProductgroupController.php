<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\productgrouprequest;
use App\Menudashboard;
use App\Product_group;
use App\Status;
use App\Submenudashboard;
use Illuminate\Support\Facades\Auth;

class ProductgroupController extends Controller
{

    public function index()
    {
        $productgroups      = Product_group::all();
        $statuses           = Status::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.productgroups.all')
            ->with(compact('productgroups'))
            ->with(compact('statuses'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }


    public function create()
    {
        $productgroups      = Product_group::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.productgroups.create')
            ->with(compact('productgroups'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }


    public function store(productgrouprequest $request)
    {
        $productgroups = new Product_group();

        $productgroups->title_fa                = $request->input('title_fa');
        $productgroups->related_service         = $request->input('related_service');
        $productgroups->code                    = $request->input('code');
        $productgroups->status                  = '4';
        $productgroups->service_title           = $request->input('service_title');
        $productgroups->part_description        = $request->input('part_description');
        $productgroups->service_description     = $request->input('service_description');
        $productgroups->date                    = jdate()->format('Ymd ');
        $productgroups->date_handle             = jdate()->format('Ymd ');
        $productgroups->user_id                 = Auth::user()->id;
        $productgroups->user_handle             = Auth::user()->id;

        $productgroups->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('productgroups.index'));
    }


    public function edit($id)
    {

        $productgroups      = Product_group::whereId($id)->get();
        $statuses           = Status::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.productgroups.edit')
            ->with(compact('productgroups'))
            ->with(compact('statuses'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function update(productgrouprequest $request, $id)
    {
        $product_group = Product_group::findOrfail($id);
        $product_group->title_fa            = $request->input('title_fa');
        $product_group->related_service     = $request->input('related_service');
        $product_group->code                = $request->input('code');
        $product_group->status              = $request->input('status_id');
        $product_group->service_title       = $request->input('service_title');
        $product_group->part_description    = $request->input('part_description');
        $product_group->service_description = $request->input('service_description');

        $product_group->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('productgroups.index'));
    }


    public function destroy(Product_group $productgroup)
    {
        $productgroup->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('productgroups.index'));
    }
}
