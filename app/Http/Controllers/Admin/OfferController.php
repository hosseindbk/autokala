<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Car_offer;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\offerrequest;
use App\Media;
use App\Menudashboard;
use App\Offer;
use App\Product;
use App\Product_brand_variety;
use App\Product_group;
use App\State;
use App\Status;
use App\Submenudashboard;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class OfferController extends Controller
{

    public function index()
    {
        $states             =   State::select('id','title')->get();
        $cities             =   City::select('title' , 'state_id' , 'id')->get();
        $statuses           =   Status::select('id','title')->get();
        $offers             =   Offer::all();
        $suppliers          =   Supplier::all();
        $medias             =   Media::select('technical_id' , 'image')->get();
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();

        return view('Admin.offers.all')
            ->with(compact('offers'))
            ->with(compact('medias'))
            ->with(compact('suppliers'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('statuses'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function offerhomeshow(Request $request){
        $offer = Offer::findOrfail($request->input('id'));

        if($offer->homeshow == 1){
            $offer->homeshow = 0;
        }elseif($offer->homeshow == 0){
            $offer->homeshow = 1;
        }
        $offer->update();

    }

    public function create()
    {
        $cities             = City::all();
        $states             = State::all();
        $carbrands          = Car_brand::all();
        $suppliers          = Supplier::all();
        $brands             = Brand::all();
        $productgroups      = Product_group::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.offers.create')
            ->with(compact('productgroups'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('suppliers'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }


    public function store(offerrequest $request , Offer  $offers)
    {
        $offers = new Offer();

        $offers->title              = $request->input('title');
        $offers->single             = $request->input('single');
        $offers->buyorsell          = $request->input('buyorsell');
        $offers->state_id           = $request->input('state_id');
        $offers->supplier_id        = $request->input('supplier_id');
        $offers->single_price       = $request->input('single_price');
        $offers->city_id            = $request->input('city_id');
        $offers->permanent_supplier = $request->input('permanent_supplier');
        $offers->brand_id           = $request->input('brand_id');
        $offers->price              = $request->input('price');
        $offers->total              = $request->input('total');
        $offers->status             = 1;
        $offers->slug               = 'OFFER-'.rand(1,999).chr(rand(97,122)).rand(1,999).chr(rand(97,122)).rand(1,999);
        $offers->mobile             = $request->input('mobile');
        $offers->product_group      = $request->input('product_group');
        $offers->address            = $request->input('address');
        $offers->description        = $request->input('description');
        $offers->user_id            = Auth::user()->id;


        if ($request->file('image1') != null) {
            $file = $request->file('image1');
            $img = Image::make($file);
            $imagePath ="image/offers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $offers->image1 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="image/offers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $offers->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="image/offers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $offers->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $slug = $offers->slug;

        $offers->save();
        if($request->car_model_id > 1) {
            $offer_id = Offer::whereSlug($slug)->get();
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
        }
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');

        return redirect(route('offers.index'));
    }


    public function edit($id)
    {
        $states             =   State::select('id','title')->get();
        $cities             =   City::select('title' , 'state_id' , 'id')->get();
        $statuses           =   Status::select('id','title')->get();
        $offers             =   Offer::whereId($id)->get();
        $products           =   Product::whereStatus(4)->get();
        $productgroups      =   Product_group::all();
        $suppliers          =   Supplier::all();
        $carbrands          =   Car_brand::all();
        $carmodels          =   Car_model::all();
        $caroffers          =   Car_offer::whereOffer_id($id)->get();
        $brands             =   Brand::all();
        $users             =   User::all();
        $medias             =   Media::select('technical_id' , 'image')->get();
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();
        $unicode_product    =   Offer::whereId($id)->pluck('unicode_product');
        $product_id         =   Product::whereUnicode($unicode_product)->pluck('id');
        $brand_varietis     =   Product_brand_variety::whereIn('product_id' ,$product_id)->get();


        return view('Admin.offers.edit')
            ->with(compact('brand_varietis'))
            ->with(compact('products'))
            ->with(compact('users'))
            ->with(compact('productgroups'))
            ->with(compact('carmodels'))
            ->with(compact('caroffers'))
            ->with(compact('offers'))
            ->with(compact('medias'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('suppliers'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('statuses'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function imgoffer1update($id)
    {

        $offers = Offer::findOrfail($id);
        $offers->image1 = null;
        $offers->update();
        return Redirect::back();
    }
    public function imgoffer2update($id)
    {
        $offers = Offer::findOrfail($id);
        $offers->image2 = null;
        $offers->update();
        return Redirect::back();
    }
    public function imgoffer3update($id)
    {
        $offers = Offer::findOrfail($id);
        $offers->image3 = null;
        $offers->update();
        return Redirect::back();
    }

    public function update(offerrequest $request, Offer $offer)
    {
        $offer->title_offer         = $request->input('title_offer');
        $offer->product_group       = $request->input('product_group');
        $offer->state_id            = $request->input('state_id');
        $offer->buyorsell           = $request->input('buyorsell');
        $offer->unicode_product     = $request->input('unicode_product');
        $offer->product_name        = $request->input('product_name');
        if($request->input('single_price')) {
            $offer->single_price    = str_replace(',', '', $request->input('single_price'));
        }
        $offer->city_id             = $request->input('city_id');
        $offer->mobile              = $request->input('mobile');
        $offer->brand_id            = $request->input('brand_id');
        $offer->brand_name          = $request->input('brand_name');
        $offer->total               = $request->input('total');
        $offer->description         = $request->input('description');
        $offer->address             = $request->input('address');
        $offer->phone               = $request->input('phone');

        $offer->single              = $request->input('single');
        if($request->input('price')) {
            $offer->price           = str_replace(',', '', $request->input('price'));
        }
        $offer->supplier_id         = $request->input('supplier_id');
        $offer->permanent_supplier  = $request->input('permanent_supplier');
        $offer->status              = $request->input('status_id');
        $offer->user_handle         = Auth::user()->id;


        if ($request->file('image1') != null) {
            $file = $request->file('image1');
            $img = Image::make($file);
            $imagePath ="image/offers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $offer->image1 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="image/offers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $offer->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="image/offers/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $offer->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $offer->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');

        return Redirect::back();
    }

    public function createcar(Request $request){

        if($request->car_model_id > 1) {

            for ($i = 0; $i < count($request->car_model_id); $i++) {
                $carmodel[] = [
                    'car_brand_id'  => $request->input('car_brand_id'),
                    'offer_id'      => $request->input('offer_id'),
                    'car_model_id' => $request->car_model_id[$i]
                ];
            }
            Car_offer::insert($carmodel);
        }
        return Redirect::back();
    }


    public function destroy(Offer $offer)
    {
        $offer->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }

    public function deletecar($id)
    {
        $caroffer = Car_offer::findOrfail($id);
        $caroffer->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
}
