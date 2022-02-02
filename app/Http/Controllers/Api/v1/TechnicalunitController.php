<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Menu;
use App\Technical_unit;
use Illuminate\Support\Facades\Response;

class TechnicalunitController extends Controller
{
    public function index(){

        $technicals      = Technical_unit::select('title' , 'slug' , 'address' , 'manager' , 'image')
            ->whereStatus(4)
            ->orderBy('id' , 'DESC')
            ->paginate(10)
            ->toArray();

        $response = ['technical_unit' => $technicals];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }
    public function subtechnical($slug){

        $technicals      = Technical_unit::select('title' , 'slug' , 'address' , 'manager' , 'image' , 'image2' , 'image3' , 'phone' , 'mobile' , 'website' , 'email' , 'whatsapp' , 'autokala')
            ->whereStatus(4)
            ->whereSlug($slug)
            ->get()
            ->toArray();

        $response = ['technical_unit' => $technicals];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }
}
