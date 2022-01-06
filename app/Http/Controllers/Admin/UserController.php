<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\userrequest;
use App\Menudashboard;
use App\Submenudashboard;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {

        $this->authorize('user-manage');
        $users = User::latest()->paginate(25);
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.users.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('users'));
    }
    public function create()
    {
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();
        return view('Admin.users.create')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(userrequest $request)
    {
        $users = new user();

        $users->name = $request->input('name');
        $users->username = $request->input('username');
        $users->email = $request->input('email');
        $users->level = 'admin';
        $users->password = Hash::make($request->input('password'));
        $users->save();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('levelAdmins.index'));

    }


    public function edit($id)
    {
        $users = User::whereId($id)->get();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.users.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('users'));
    }



    public function update(userrequest $request , User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('users.index'));
    }



    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return back();
    }
}
