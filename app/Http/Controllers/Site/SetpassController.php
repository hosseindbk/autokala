<?php

namespace App\Http\Controllers\Site;

use App\ActiveCode;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ActiveCode as ActiveCodeNotification;


class SetpassController extends Controller
{
    public function index()
    {
        return view('Site.auth.passwordset');
    }

    public function setphoneshow()
    {
        return view('Site.auth.setphone');
    }

    public function setphone(Request $request){

        $user = User::wherePhone(auth::user()->phone)->first();
if ($user != null){
        $request->session()->flash('auth', [
            'user_id' => $user->id,
            'reg' => 1
        ]);

        $code = ActiveCode::generateCode($user);

         $user->notify(new ActiveCodeNotification($code , auth::user()->phone));
        $phone = auth::user()->phone;
        return redirect(route('phone.token'))->with(['phone' => $phone]);
    }else{
    return redirect(url('/'));
    }
}

    public function update(Request $request){
        $user = User::findOrfail(auth::user()->id);
        $request->validate(['password' => 'required|string|min:8|confirmed']);
        $user->password = Hash::make($request->input('password'));
        $user->update();
        return redirect(route('/'));
    }
}
