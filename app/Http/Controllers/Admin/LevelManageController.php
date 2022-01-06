<?php

namespace App\Http\Controllers\Admin;

use App\Menudashboard;
use App\Role;
use App\Submenudashboard;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LevelManageController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->with('users')->paginate(20);
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.levelAdmins.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('roles'));
    }

    public function create()
    {
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();
        return view('Admin.levelAdmins.create')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'user_id' => 'required',
            'role_id' => 'required'
        ]);

        User::find($request->input('user_id'))->roles()->sync($request->input('role_id'));
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('levelAdmins.index'));

    }

    public function edit($id)
    {
        $user = User::whereId($id)->get();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.levelAdmins.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('user'));
    }

    public function update(Request $request , User $user)
    {
        $user->roles->sync($request->input('role_id'));
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('level.index'));
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('level.index'));
    }
}
