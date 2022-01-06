<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\userrequest;
use App\Menudashboard;
use App\Submenudashboard;
use App\Type_user;
use App\User;
use Illuminate\Http\Request;

class SiteuserController extends Controller
{

    public function index()
    {
        $users = User::whereLevel(null)->orderBy('id' , 'DESC')->get();
        $typeusers = Type_user::all();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.siteusers.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('typeusers'))
            ->with(compact('users'));
    }

    public function edit($id)
    {
        $users = User::whereId($id)->get();
        $typeusers = Type_user::all();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.siteusers.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('typeusers'))
            ->with(compact('users'));
    }
    
    public function update(Request $request , $user)
    {
        $user = User::findOrfail($user);
        $user->name         = $request->input('name');
        $user->type_id      = $request->input('type_id');
        $user->status       = $request->input('status');
        $user->phone        = $request->input('phone');
        $user->phone_verify = $request->input('phone_verify');
        $user->phone_number = $request->input('phone_number');
        $user->email        = $request->input('email');

        $user->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('siteusers.index'));
    }


    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return back();
    }
}
