<?php

namespace App\Http\Controllers\Api\v1;

use App\Car_offer;
use App\Car_product;
use App\Http\Controllers\Controller;
use App\Http\Requests\offerrequest;
use App\Offer;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class OfferController extends Controller
{
    public function store(offerrequest $request)
    {

        $offers = new Offer();

        $offers->title              = $request->input('title');
        $offers->title_offer        = $request->input('title_offer');
        $offers->product_group      = $request->input('product_group');
        $offers->noe                = $request->input('noe');
        if ($request->input('lat') != null){
            $offers->lat                = $request->input('lat');
        }else{
            $offers->lat = auth::user()->lat;
        }
        if ($request->input('lng') != null){
            $offers->lng                = $request->input('lng');
        }else{
            $offers->lng = auth::user()->lng;
        }
        $offers->state_id           = $request->input('state_id');
        $offers->buyorsell          = $request->input('buyorsell');
        if ($request->input('unicode_product') != null) {
            $offers->unicode_product = $request->input('unicode_product');
        }
        $offers->product_name       = $request->input('product_name');
        if ($request->input('single_price')) {
            $offers->single_price   = str_replace(',', '', $request->input('single_price'));
        }
        $offers->city_id            = $request->input('city_id');
        $offers->mobile             = $request->input('mobile');
        $offers->brand_id           = $request->input('brand_id');
        $offers->brand_name         = $request->input('brand_name');
        $offers->total              = $request->input('total');
        $offers->description        = $request->input('description');
        $offers->address            = $request->input('address');
        $offers->phone              = $request->input('phone');
        if ($request->input('image1')) {
            $offers->image1 = $request->input('image1');
        }
        if (auth::user()->type_id == 4 || auth::user()->type_id == 3){
            $offers->single = 1;
        }elseif (auth::user()->type_id == 1) {
            $offers->single         = $request->input('single');
        }
        if ($request->input('price')) {
            $offers->price      = str_replace(',', '', $request->input('price'));
        }
        $offers->supplier_id        = $request->input('supplier_id');
        $offers->permanent_supplier = $request->input('permanent_supplier');
        $offers->slug               = 'OFFER-' . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999);
        $offers->status             = '1';
        $offers->user_id            = Auth::user()->id;


        if ($request->file('image1') != null) {
            $file = $request->file('image1');
            $img = Image::make($file);
            $imagePath = "images/offer";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $offers->image1 = $file->move($imagePath, $imageName);
            $img->save($imagePath . $imageName);
            $img->encode('jpg');
        }

        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath = "images/offer";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $offers->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath . $imageName);
            $img->encode('jpg');
        }

        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath = "images/offer";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $offers->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath . $imageName);
            $img->encode('jpg');
        }

        $offers->save();

        $product_id = Product::whereUnicode($offers->unicode_product)->pluck('id');
        $cars = Car_product::whereIn('product_id' , $product_id)->get();
        foreach($cars as $car) {
            $caroffers = new Car_offer();

            $caroffers->offer_id = $offers->id;
            $caroffers->car_brand_id = $car->car_brand_id;
            $caroffers->car_model_id = $car->car_model_id;

            $caroffers->save();
        }

        $status = true;
        $message = 'success';
        $response = 'اطلاعات با موفقیت ثبت شد';
        return Response::json(['ok' =>$status ,'message' => $message, 'response' => $response]);

    }
}
