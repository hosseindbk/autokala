<?php

namespace App\Http\Controllers\Api\v1;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\IndexCollection;
use App\State;
use Illuminate\Support\Facades\Response;

class IndexController extends Controller
{
    public function index(){


//        $citis = City::select('id','title' , 'state_id')->orderBy('id')->get();
//        $state = State::select('id','title')->orderBy('id')->get();

        $citis = City::select('id as city_id','title as city' , 'state_id')->get()->toArray();
        $state = State::select('id as state_id','title as state')->get()->toArray();

        return Response::json(['citis' => $citis , 'state'=>$state]);

    }
}
