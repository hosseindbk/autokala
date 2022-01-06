<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\State;
use App\City;
class StateController extends Controller
{
    public function state(Request $request){
        $cities = City::whereState_id($request->input('id'))->get();
        $output = [];

        foreach($cities as $City )
        {
            $output[$City->id] = $City->title;
        }
        return $output;
    }
}