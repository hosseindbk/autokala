<?php

namespace App\Http\Controllers\Api\v1;

use App\ActiveCode;
use App\City;
use App\Http\Controllers\Controller;
use App\Notifications\ActiveCode as ActiveCodeNotification;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request){

        $validData = $this->validate($request, [
           'phone' => 'required|exists:users',
            'password' => 'required'
        ]);


        if (! auth()->attempt($validData)){
            $response = [
                'error' => 'شماره موبایل و یا رمز عبور نادرست است',
            ];

            return Response::json(['ok' => false,'message' => 'failed','response' => $response]);

        }

        auth()->user()->update([
                'api_token' => Str::random(100)
            ]);
        $response = [
            'api_token'=>auth()->user()->api_token,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }

    public function getregister(){

            $citis              = City::select('id as city_id','title as city' , 'state_id')->get()->toArray();
            $state              = State::select('id as state_id','title as state')->get()->toArray();
            $response = [
                'city' => $citis,
                'state' => $state,
                ];

            return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
    public function register(Request $request)
    {

        $user = User::wherePhone($request->input('phone'))->first();
        if ($user === null) {

            $validData = $this->validate($request, [
                'phone' => 'required',
                'name' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
                'state_id' => 'required',
                'city_id' => 'required',
            ]);

            $user = User::create([

                'phone' => $validData['phone'],
                'name' => $validData['name'],
                'password' => bcrypt($validData['password']),
                'state_id' => $validData['state_id'],
                'city_id' => $validData['city_id'],
                'type_id' => 4
            ]);

            $user->update([
                'api_token' => Str::random(100)
            ]);

            $code = ActiveCode::generateCode($user);

            $user->notify(new ActiveCodeNotification($code , $validData['phone']));
            $response = [
                'token' => $user->api_token,
            ];

            return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

        }else{
            $errorResponse = [
                'error' => 'شماره موبایل قبلا ثبت شده',
            ];
            return Response::json(['ok' =>false ,'message' => 'failed','response'=>$errorResponse]);
        }
    }

    public function token(Request $request){

        $token= (int)$request->input('token');
        $user = auth()->user();

        $status = $user->activeCode()->whereCode($token)->where('expired_at' , '>' , now())->first();


        if(! $status) {
            $errorResponse = [
                'error' => 'کد فعال سازی نادرست',
            ];
            return Response::json(['ok' =>false ,'message' => 'failed','response'=>$errorResponse]);

        }else{
            $user = auth()->user();
            $user->activeCode()->delete();
            $user->phone_verify = 1;
            $user->update();

            $response = [
                'good' => 'ورود با موفقیت انجام شد',
            ];
            return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

        }
    }
}
