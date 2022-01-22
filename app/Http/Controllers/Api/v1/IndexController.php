<?php

namespace App\Http\Controllers\Api\v1;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\IndexCollection;
use App\State;

class IndexController extends Controller
{
    public function index(){


//        $citis = City::select('id','title' , 'state_id')->orderBy('id')->get();
//        $state = State::select('id','title')->orderBy('id')->get();

        $citis = City::all();
        $state = State::all();

        return new IndexCollection($state);

    }
}
