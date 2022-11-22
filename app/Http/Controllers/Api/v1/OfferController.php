<?php

namespace App\Http\Controllers\Api\v1;

use App\Car_offer;
use App\Car_product;
use App\Http\Controllers\Controller;
use App\Http\Requests\offerrequest;
use App\Offer;
use App\Product;
use Illuminate\Http\Request;
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
        $offersid = $offers->id;
        $status = true;
        $message = 'success';

        $response = [
        'response'      =>    'اطلاعات با موفقیت ثبت شد',
        'offer_id'      => $offersid
        ];
        return Response::json(['ok' =>$status ,'message' => $message, 'response' => $response]);

    }

    public function carofferstore(Request $request){

        if($request->car_brand_id != null && $request->car_model_id != null) {
            $offer_id = Offer::whereId($request->input('offer_id'))->get();
            foreach($offer_id as $offer){
                $x  = $offer->id;
            }

            for ($i = 0; $i < count($request->car_model_id); $i++) {
                $carmodel[] = [
                    'car_brand_id'  => $request->input('car_brand_id'),
                    'offer_id'      => $x,
                    'car_model_id' => $request->car_model_id[$i]
                ];
            }
            Car_offer::insert($carmodel);

            $status     = true;
            $message    = 'success';
            $response   = 'اطلاعات با موفقیت ثبت شد';

            return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);

        }elseif($request->car_brand_id != null && $request->car_model_id == null){

            $offer_id = Offer::whereId($request->input('offer_id'))->get();
            foreach($offer_id as $offer){
                $x  = $offer->id;
            }


            $caroffers = new Car_offer();

            $caroffers->car_brand_id       = $request->input('car_brand_id');
            $caroffers->offer_id           = $x;

            $caroffers->save();

            $status     = true;
            $message    = 'success';
            $response   = 'اطلاعات با موفقیت ثبت شد';

            return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
        }


        $status     = false;
        $message    = 'failed';
        $response   = 'اطلاعات با کامل نمی باشد';

        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);

    }

    public function update(Request $request , $id)
    {
        $offer = Offer::findOrfail($id);

        $offer->title_offer        = $request->input('title_offer');
        $offer->product_group      = $request->input('product_group');
        $offer->noe                = $request->input('noe');
        $offer->state_id           = $request->input('state_id');
        $offer->buyorsell          = $request->input('buyorsell');
        if ($request->input('unicode_product') != null) {
            $offer->unicode_product = $request->input('unicode_product');
        }
        $offer->product_name       = $request->input('product_name');
        if($request->input('single_price')) {
            $offer->single_price = str_replace(',', '', $request->input('single_price'));
        }
        $offer->city_id            = $request->input('city_id');
        $offer->mobile             = $request->input('mobile');
        $offer->brand_id           = $request->input('brand_id');
        $offer->brand_name         = $request->input('brand_name');
        $offer->total              = $request->input('total');
        $offer->lat                = $request->input('lat');
        $offer->lng                = $request->input('lng');
        $offer->description        = $request->input('description');
        $offer->address            = $request->input('address');
        $offer->phone              = $request->input('phone');
        if ($request->input('single') != null) {
            $offer->single = $request->input('single');
        }
        if($request->input('price')) {
            $offer->price = str_replace(',', '', $request->input('price'));
        }
        $offer->supplier_id        = $request->input('supplier_id');
        $offer->permanent_supplier = $request->input('permanent_supplier');
        $offer->status             = '1';

        if ($request->file('image1') != null) {
            $file = $request->file('image1');
            $img = Image::make($file);
            $imagePath ="images/offer";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $offer->image1 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="images/offer";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $offer->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="images/offer";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $offer->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $offer->update();

        $status     = true;
        $message    = 'success';
        $response   = 'اطلاعات با موفقیت ثبت شد';

        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
    }

    public function offerdelete($id)
    {
        $offer = Offer::findOrfail($id);
        $offer->delete();
        $status     = true;
        $message    = 'success';
        $response   = 'اطلاعات با موفقیت پاک شد';

        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
    }

    public function carofferdelete($id)
    {
        $caroffer = Car_offer::findOrfail($id);
        $caroffer->delete();
        $status     = true;
        $message    = 'success';
        $response   = 'اطلاعات با موفقیت پاک شد';

        return Response::json(['ok' => $status, 'message' => $message, 'response' => $response]);
    }

    public function editoffer($id){
        $offers = Offer::select('offers.id' , 'offers.buyorsell' , 'offers.unicode_product' , 'offers.product_name' , 'offers.brand_id' , 'offers.brand_name' , 'offers.product_group' , 'offers.title_offer'
            ,'offers.permanent_supplier' , 'offers.description' , 'offers.image1', 'offers.image2', 'offers.image3', 'offers.single', 'offers.single_price', 'offers.price', 'offers.total' , 'offers.address', 'offers.noe', 'offers.lat', 'offers.lng')
            ->where('offers.user_id' , Auth::user()->id)
            ->where('offers.id' , $id)
            ->get();

        $response = ['offers' => $offers];

        return Response::json(['ok' =>true ,'message' => 'success','response'=>$response]);
    }
}
