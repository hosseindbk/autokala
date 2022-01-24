<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Technical_unit;
use Illuminate\Support\Facades\Response;

class TechnicalunitController extends Controller
{
    public function index(){
        $menus           = Menu::select('title' , 'slug')->get()->toArray();
        $technicals      = Technical_unit::select('title' , 'slug' , 'address' , 'manager' , 'image')->whereStatus(4)->orderBy('id' , 'DESC')->paginate(10)->toArray();

        return Response::json(['menu' => $menus , 'technical_unit' => $technicals]);
    }
}
