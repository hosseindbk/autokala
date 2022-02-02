<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Supplier;
use Illuminate\Support\Facades\Response;

class SupplierController extends Controller
{
    public function index(){
        $suppliers       = Supplier::select('title' , 'slug' , 'address' , 'manager' , 'image')
            ->whereStatus(4)
            ->orderBy('id' , 'DESC')
            ->paginate(10)
            ->toArray();

        $response = ['supplier' => $suppliers];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
    public function subsupplier($slug){
        $suppliers       = Supplier::select('title' , 'slug' , 'address' , 'manager' , 'image')
            ->whereStatus(4)
            ->whereSlug($slug)
            ->get()
            ->toArray();

        $response = ['supplier' => $suppliers];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }
}
