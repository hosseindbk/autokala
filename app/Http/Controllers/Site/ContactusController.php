<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Menu;
use App\State;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function index(){
        $menus              = Menu::whereStatus(4)->get();
        $states             = State::all();
        $countState         = null;

        return view('Site.contactus')
            ->with(compact('countState'))
            ->with(compact('states'))
            ->with(compact('menus'));
    }
}
