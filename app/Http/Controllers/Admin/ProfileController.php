<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\profilerequest;
use App\Menudashboard;
use App\Role;
use App\Submenudashboard;
use App\User;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $users          = User::all();
        $roles          = Role::where('id' , '>' , 9)->get();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();
        return view('Admin.profile.all')
            ->with(compact('roles'))
            ->with(compact('users'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }
        public function update(profilerequest $request , User $user)
        {
            $user->name = $request->input('name');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->whatsapp = $request->input('whatsapp');
            $user->instagram = $request->input('instagram');
            $user->telegram = $request->input('telegram');

            $user->update();

            alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
            return redirect(route('profile.index'));
        }
}
