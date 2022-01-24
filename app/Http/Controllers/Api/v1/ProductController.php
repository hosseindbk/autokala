<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Product;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function index(){
        $menus          = Menu::select('title' , 'slug')->whereStatus(4)->get()->toArray();
        $products       = Product::select('unicode' , 'slug' , 'image' , 'title_fa as title')->whereStatus(4)->orderBy('id' , 'DESC')->paginate(10)->toArray();

        return Response::json(['menus' => $menus , 'products'=>$products ]);
    }
}
