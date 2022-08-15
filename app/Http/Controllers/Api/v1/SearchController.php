<?php

namespace App\Http\Controllers\Api\v1;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Response;

class SearchController extends Controller
{
    public function searchunicode(){
        $keywords      = request('unicodesearch');
        dd($keywords);
        $products      = Product::select('unicode' , 'slug' , 'image' , 'title_fa as title')
            ->where('unicode', 'LIKE', '%' . $keywords . '%')
            ->whereStatus(4)
            ->latest()
            ->paginate(10);

        $response = [
            'products'=>$products,
        ];
        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);

    }

    public function brand(){
        $keywords           = request('brandsearch');

        $brands             = Brand::brandsearch($keywords)->whereStatus(4)->latest()->paginate(12);

    }


}
