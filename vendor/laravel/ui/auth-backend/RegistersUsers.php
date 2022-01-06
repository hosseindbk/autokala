<?php

namespace Illuminate\Foundation\Auth;

use App\ActiveCode;
use App\City;
use App\Http\Requests\userrequest;
use App\State;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use UxWeb\SweetAlert\SweetAlert;
use App\Notifications\ActiveCode as ActiveCodeNotification;



trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function showRegistrationuserForm()
    {
        $states = State::all();
        $cities = City::all();
        return view('Site.auth.register')
            ->with(compact('states'))
            ->with(compact('cities'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    public function registeruser(userrequest $request)
    {
        $user = User::wherePhone($request->input('phone'))->first();
        if ($user === null) {
            $users = new \App\User();

            $users->phone       = $request->input('phone');
            $users->name        = $request->input('name');
            $users->password    = Hash::make($request->input('password'));
            $users->state_id    = $request->input('state_id');
            $users->city_id     = $request->input('city_id');
            $users->type_id      = 4;

            $users->save();

            $user = User::wherePhone($request->input('phone'))->first();

            $request->session()->flash('auth', [
                'user_id' => $user->id,
                'reg' => 1
            ]);

            $code = ActiveCode::generateCode($user);

            $user->notify(new ActiveCodeNotification($code , $request->input('phone')));
            $phone = $request->input('phone');
            return redirect(route('phone.token'))->with(['phone' => $phone]);
        }

        alert()->error('عملیات ناموفق', 'شماره موبایل قبلا ثبت شده است');
        return Redirect::back();



    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
