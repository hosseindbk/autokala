<?php

namespace Illuminate\Foundation\Auth;

use App\ActiveCode;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Notifications\ActiveCode as ActiveCodeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use UxWeb\SweetAlert\SweetAlert;


trait AuthenticatesUsers
{
    use RedirectsUsers, ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::check()){
            return Redirect::url()->previous();
        }
        return view('Admin.auth.login');
    }
    public function showLoginuserForm()
    {

        if (Auth::check()){
            return Redirect::url()->previous();
        }
        session()->flash('url' , url()->previous());
        return view('Site.auth.login');
    }
    public function showLoginrememberForm()
    {
        return view('Site.auth.remember');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function loginuser(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
            'password' => 'required',
        ]);

        if ($request->input('phone') != null && $request->input('password') != null) {
            $user = User::wherePhone($request->input('phone'))->first();
            if ($user != null) {
                if (Hash::check($request->input('password'), $user->password)) {
                    Auth::loginUsingId($user->id);
                    alert()->success($user->name.' به وبسایت اتوکالا ' , 'خوش آمدید' );
                    return Redirect::route('/');
                } else {
                    alert()->error('عملیات ناموفق', 'شماره تلفن و یا رمز عبور اشتباه است');
                    return Redirect::back();
                }
            } else {

                alert()->error('عملیات ناموفق', 'شماره تلفن و یا رمز عبور وارد نشده است');
                return Redirect::back();
            }
        } else {
            alert()->error('عملیات ناموفق', 'شماره تلفن و یا رمز عبور وارد نشده است');
            return Redirect::back();
        }
    }
    public function remember(Request $request){

        $validData = $request->validate([
            'phone' => ['required', 'exists:users,phone']
        ]);

        $user = User::wherePhone($validData['phone'])->first();

        $request->session()->flash('auth', [
            'user_id' => $user->id
        ]);

        $code = ActiveCode::generateCode($user);

        $user->notify(new ActiveCodeNotification($code , $user->phone));
        $phone = $validData['phone'];
        return redirect(route('phone.token'))->with(['phone' => $phone]);
    }


    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function validateLoginuser(Request $request)
    {
        $request->validate([
            $this->phone() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }


}
