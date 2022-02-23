<?php

namespace App\Http\Controllers\Site;

use App\City;
use App\Http\Controllers\Controller;
use App\Menu;
use App\State;
use App\visitor;

class HelpController extends Controller
{
    public function index(){
        $cities             = City::all();
        $states             = State::all();
        $countState         = null;
        $menus              = Menu::whereStatus(4)->get();


        $visitors = new Visitor();

        $visitors->ip       =   request()->ip();
        $visitors->datetime =   jdate();
        $visitors->page_id  =  '/';

        $visitors->save();

        return view('Site.help')
            ->with(compact('cities'))
            ->with(compact('countState'))
            ->with(compact('states'))
            ->with(compact('menus'));
    }
}
