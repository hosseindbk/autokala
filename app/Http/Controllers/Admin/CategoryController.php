<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\representativerequest;
use App\Menudashboard;
use App\Submenudashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories      = category::all();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();
        return view('Admin.categories.all')
            ->with(compact('categories'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }


    public function create()
    {
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();
        return  view('Admin.categories.create')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));

    }

    public function store(representativerequest $request)
    {

        $categories = new category();

        $categories->title = $request->input('title');

        $categories->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('categories.index'));
    }

    public function edit($id)
    {
        $categories      = category::whereId($id)->get();
        return view('Admin.categories.edit' , compact('categories'));
    }


    public function update(representativerequest $request, Category $category)
    {
        $category->title = $request->input('title');

        if($request->input('status') == 'on'){
            $category->status = 1;
        }

        if($request->input('status') == null) {
            $category->status = 0;
        }

        $category->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('categories.index'));
    }
}
