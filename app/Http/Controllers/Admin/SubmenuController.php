<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\submenurequest;
use App\Menu;
use App\Menudashboard;
use App\Supplier;
use App\Submenudashboard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $submenus      = Supplier::all();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.submenus.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('submenus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus      = menu::whereStatus(4)->whereSubmenu(1)->get();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.submenus.create')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(submenurequest $request)
    {
        $submenus = new Supplier();

        $submenus->title = $request->input('title');
        $submenus->menu_id = $request->input('menu_id');
        $submenus->description = $request->input('description');
        $submenus->text = $request->input('text');

        if ($request->file('images') != null) {
            $year = Carbon::now()->year;
            $imagePath ="images/submenu/{$year}/";
            $file = $request->file('images');

            $img = Image::make($file);

            $orginalimageName = $file->getClientOriginalName();
            $imageName = md5(uniqid(rand(), true)) . $orginalimageName;

            $submenus->images = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
        }
        $submenus->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('submenus.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $submenus           = Supplier::whereId($id)->get();
        $menus              = Menu::whereStatus(4)->whereSubmenu('1')->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();


        return view('Admin.submenus.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('menus'))
            ->with(compact('submenus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(submenurequest $request, Supplier $submenu)
    {
        $submenu->title = $request->input('title');

        $submenu->menu_id = $request->input('menu_id');

        $submenu->description = $request->input('description');
        $submenu->text = $request->input('text');


        if($request->input('status') == 'on'){
            $submenu->status = 1;
        }

        if($request->input('status') == null) {
            $submenu->status = 0;
        }
        if ($request->file('images') != null) {
            $year = Carbon::now()->year;
            $imagePath ="images/submenu/{$year}/";
            $file = $request->file('images');

            $img = Image::make($file);

            $orginalimageName = $file->getClientOriginalName();
            $imageName = md5(uniqid(rand(), true)) . $orginalimageName;

            $submenu->images = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
        }
        $submenu->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('submenus.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $submenu)
    {
        $submenu->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('submenus.index'));
    }
}
