<?php

namespace App\Http\Controllers\Api\v1;

use App\City;
use App\Http\Controllers\Controller;
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

            return Response([
                'data' => 'اطلاعات صحیح نیست',
                'status' => 'error'
            ]);

        }

        auth()->user()->update([
                'api_token' => Str::random(100)
            ]);
        //$user = User::select('id', 'name', 'api_token')->whereId(auth::user()->id)->get()->toArray();

        return Response::json(['api_token'=>auth()->user()->api_token]);

        //return response()->json(['user' => $user->only(['id', 'name', 'phone', 'api_token'])]);

    }

    public function getregister(){

            $citis              = City::select('id as city_id','title as city' , 'state_id')->get()->toArray();
            $state              = State::select('id as state_id','title as state')->get()->toArray();

        return Response::json(['citis' => $citis , 'state'=>$state]);

    }
    public function register(Request $request){

        $validData = $this->validate($request, [
            'phone'     => 'required',
            'name'      => 'required|string',
            'password'  => 'required|string|min:8|confirmed',
            'state_id'  => 'required',
            'city_id'   => 'required',
        ]);

        $user = User::create([

        'phone'         => $validData['phone'],
        'name'          => $validData['name'],
        'password'      => bcrypt($validData['password']),
        'state_id'      => $validData['state_id'],
        'city_id'       => $validData['city_id'],
        'type_id'       =>  4
        ]);

        return $user ;
    }
}
