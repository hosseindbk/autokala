<?php

namespace App\Http\Controllers\Admin;

use App\commentrate;
use App\Http\Controllers\Controller;
use App\Menudashboard;
use App\Product;
use App\Submenudashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentrateController extends Controller
{

    public function index()
    {
        $products           = Product::all();
        $commentrates        = commentrate::latest()->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.commentrates.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('commentrates'))
            ->with(compact('products'));
    }

    public function edit($id)
    {
        $commentrates       = commentrate::whereId($id)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.commentrates.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('commentrates'));
    }

    public function update(Request $request, $id)
    {
        $commentrate = commentrate::findOrfail($id);

        $commentrate->comment  = $request->input('comment');
        $commentrate->approved  = $request->input('approved');

        $commentrate->update();

        return redirect(route('commentrates.index'));
    }

    public function destroy(commentrate $commentrate)
    {
        $commentrate->delete();

        return Redirect::back();
    }
}
