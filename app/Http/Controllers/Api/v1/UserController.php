<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

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
        return auth()->user();

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
