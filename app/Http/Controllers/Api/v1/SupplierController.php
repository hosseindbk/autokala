<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Supplier;
use Illuminate\Support\Facades\Response;

class SupplierController extends Controller
{
    public function index(){
        $menus           = Menu::select('title' , 'slug')->get()->toArray();
        $suppliers       = Supplier::select('title' , 'slug' , 'address' , 'manager' , 'image')->whereStatus(4)->orderBy('id' , 'DESC')->paginate(10)->toArray();

        return Response::json(['menu' => $menus , 'supplier' => $suppliers]);

    }
}
