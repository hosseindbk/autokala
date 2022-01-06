<?php

namespace App\Http\Controllers\Admin;

use App\comment;
use App\Http\Controllers\Controller;
use App\Menudashboard;
use App\Product;
use App\Submenudashboard;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{

    public function index()
    {
        $products           = Product::all();
        $comments           = comment::latest()->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.comments.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('comments'))
            ->with(compact('products'));
    }


    public function edit($id)
    {
        $comments           = comment::whereId($id)->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.comments.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('comments'));
    }


    public function update(Request $request, $id)
    {
        $comment = comment::findOrfail($id);

        $comment->comment  = $request->input('comment');
        $comment->approved  = $request->input('approved');

        $comment->update();

        return redirect(route('comments.index'));
    }


    public function destroy(comment $comment)
    {
        $comment->delete();

        return Redirect::back();
    }
}
