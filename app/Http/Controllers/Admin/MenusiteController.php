<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Menudashboard;
use App\Submenudashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MenusiteController extends Controller
{
    public function index()
    {
        $menudashs              = Menudashboard::all();
        $menudashboards         = Menudashboard::whereStatus(4)->get();
        $submenudashboards      = Submenudashboard::all();
        $sitemenus              = Menu::whereStatus(4)->select('id' , 'title')->orderBy('id')->get();

        return view('Admin.sitemenus.all')
            ->with(compact('sitemenus'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('menudashs'));
    }

    public function edit($id)
    {
        $submenus               = Submenudashboard::whereId($id)->get();
        $menudashboards         = Menudashboard::whereStatus(4)->get();
        $submenudashboards      = Submenudashboard::whereStatus(4)->get();
        $sitemenus              = Menu::whereId($id)->get();

        return view('Admin.sitemenus.edit')
            ->with(compact('sitemenus'))
            ->with(compact('submenus'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));

    }

    public function update(Request $request , $id)
    {
        $sitemenus = Menu::findOrfail($id);

        $sitemenus->description     = $request->input('description');
        $sitemenus->textpage        = $request->input('textpage');

        $sitemenus->update();

        return Redirect::back();
    }
}
