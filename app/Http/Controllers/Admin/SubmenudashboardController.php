<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\submenudashboardrequest;
use App\Menudashboard;
use App\Submenudashboard;
use Illuminate\Http\Request;

class SubmenudashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $submenudashs = Submenudashboard::all();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.submenudashboards.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('submenudashs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.submenudashboards.create')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(submenudashboardrequest $request )
    {
        $submenudashboards = new Submenudashboard();

        $submenudashboards->title = $request->input('title');
        $submenudashboards->name = $request->input('name');
        $submenudashboards->namayesh = $request->input('namayesh');
        $submenudashboards->menu_id = $request->input('menu_id');

        $submenudashboards->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('submenudashboards.index'));
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
        $submenus = Submenudashboard::whereId($id)->get();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();
        return view('Admin.submenudashboards.edit')
            ->with(compact('submenus'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(submenudashboardrequest $request, Submenudashboard $submenudashboard)
    {
        $submenudashboard->title = $request->input('title');
        $submenudashboard->name = $request->input('name');
        $submenudashboard->namayesh = $request->input('namayesh');

        if($request->input('status') == 'on'){
            $submenudashboard->status = 1;
        }

        if($request->input('status') == null) {
            $submenudashboard->status = 0;
        }

        $submenudashboard->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('submenudashboards.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submenudashboard $submenudashboard)
    {
        $submenudashboard->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('submenudashboards.index'));
    }
}
