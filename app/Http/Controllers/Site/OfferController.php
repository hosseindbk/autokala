<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Car_offer;
use App\Car_product;
use App\Car_type;
use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\offerrequest;
use App\Menu;
use App\Offer;
use App\Product;
use App\Product_brand_variety;
use App\Product_group;
use App\State;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class OfferController extends Controller
{
    public function index(){
        $menus                  = Menu::whereStatus(4)->get();
        $suppliers              = Supplier::whereStatus(4)->get();
        $carbrands              = Car_brand::all();
        $countState             = null;
        $products               = Product::whereStatus(4)->get();
        $brands                 = Brand::whereStatus(4)->get();
        $productgroups          = Product_group::all();
        $cities                 = City::all();
        $states                 = State::all();
        $countries              = Country::all();
        $caroffers              = Car_offer::all();
        $productbrandvarieties  = Product_brand_variety::whereStatus(4)->get();
        $offers                 = Offer::whereUser_id(Auth::user()->id)->get();

        return view('Site.offer')
            ->with(compact('countState'))
            ->with(compact('caroffers'))
            ->with(compact('countries'))
            ->with(compact('cities'))
            ->with(compact('productgroups'))
            ->with(compact('states'))
            ->with(compact('offers'))
            ->with(compact('carbrands'))
            ->with(compact('menus'))
            ->with(compact('brands'))
            ->with(compact('products'))
            ->with(compact('suppliers'))
            ->with(compact('productbrandvarieties'));
    }

    public function offerproduct($id){
        $cities                 = City::all();
        $states                 = State::all();
        $carbrands              = Car_brand::all();
        $carmodels              = Car_model::all();
        $cartypes               = Car_type::all();
        $car_offers             = Car_offer::all();
        $menus                  = Menu::whereStatus(4)->get();
        $suppliers              = Supplier::whereStatus(4)->get();
        $products               = Product::whereStatus(4)->whereId($id)->get();
        $product_id             = Product::whereStatus(4)->whereId($id)->pluck('id');
        $kalagroup_id           = Product::whereStatus(4)->whereId($id)->pluck('kala_group_id');
        $brand_varietis         = Product_brand_variety::whereIn('product_id', $product_id)->get();
        $productgroups          = Product_group::whereIn('id' , $kalagroup_id)->get();
        $carproducts            = Car_product::whereIn('product_id' , $product_id)->get();
        $brands                 = Brand::all();
        $varity                 = 0;
        $offers                 = Offer::whereUser_id(Auth::user()->id)->get();
         $kalabrands = Product_brand_variety::leftjoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
                ->select('product_brand_varieties.id', 'product_brand_varieties.item1', 'product_brand_varieties.item2', 'product_brand_varieties.item3',
                    'product_brand_varieties.value_item1', 'product_brand_varieties.value_item2', 'product_brand_varieties.value_item3', 'brands.title_fa')
                ->whereIn('product_brand_varieties.product_id', $product_id)
                ->get();

//        $shares = DB::table('brands')
//            ->leftjoin('car_models', 'car_models.vehicle_brand_id', '=', 'car_brands.id')
//            ->leftjoin('car_types', 'car_types.car_model_id', '=', 'car_models.id')
//            ->select('car_brands.title_fa as brand' , 'car_models.title_fa as model' , 'car_types.title_fa as type' ,'car_brands.id as id' )->
//            whereIn('id' , $brand_id)->get();

        return view('Site.offerproduct')
            ->with(compact('varity'))
            ->with(compact('brand_varietis'))
            ->with(compact('car_offers'))
            ->with(compact('cartypes'))
            ->with(compact('kalabrands'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('offers'))
            ->with(compact('menus'))
            ->with(compact('brands'))
            ->with(compact('products'))
            ->with(compact('suppliers'));
    }

    public function offerproductvarity($id , $slug){
        $cities                 = City::all();
        $states                 = State::all();
        $carbrands              = Car_brand::all();
        $carmodels              = Car_model::all();
        $cartypes               = Car_type::all();
        $car_offers             = Car_offer::all();
        $menus                  = Menu::whereStatus(4)->get();
        $suppliers              = Supplier::whereStatus(4)->get();
        $products               = Product::whereStatus(4)->whereId($id)->get();
        $product_id             = Product::whereStatus(4)->whereId($id)->pluck('id');
        $kalagroup_id           = Product::whereStatus(4)->whereId($id)->pluck('kala_group_id');
        if (!$slug) {
            $brand_varietis = Product_brand_variety::whereIn('product_id', $product_id)->get();
        }else{
            $brand_varietis = Product_brand_variety::whereId($slug)->get();
        }
        $productgroups          = Product_group::whereIn('id' , $kalagroup_id)->get();
        $carproducts            = Car_product::whereIn('product_id' , $product_id)->get();
        $brands                 = Brand::all();
        $offers                 = Offer::whereUser_id(Auth::user()->id)->get();
        $varity                 = 1;
        $kalabrands = Product_brand_variety::leftjoin('brands', 'brands.id', '=', 'product_brand_varieties.brand_id')
            ->select('product_brand_varieties.id', 'product_brand_varieties.item1', 'product_brand_varieties.item2', 'product_brand_varieties.item3',
                'product_brand_varieties.value_item1', 'product_brand_varieties.value_item2', 'product_brand_varieties.value_item3', 'product_brand_varieties.image1', 'brands.title_fa')
            ->where('product_brand_varieties.id', $slug)
            ->get();

//        $shares = DB::table('brands')
//            ->leftjoin('car_models', 'car_models.vehicle_brand_id', '=', 'car_brands.id')
//            ->leftjoin('car_types', 'car_types.car_model_id', '=', 'car_models.id')
//            ->select('car_brands.title_fa as brand' , 'car_models.title_fa as model' , 'car_types.title_fa as type' ,'car_brands.id as id' )->
//            whereIn('id' , $brand_id)->get();

        return view('Site.offerproduct')
            ->with(compact('varity'))
            ->with(compact('brand_varietis'))
            ->with(compact('car_offers'))
            ->with(compact('cartypes'))
            ->with(compact('kalabrands'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('offers'))
            ->with(compact('menus'))
            ->with(compact('brands'))
            ->with(compact('products'))
            ->with(compact('suppliers'));
    }

    public function offercreate(offerrequest $request)
    {
        $offers = new Offer();

        $offers->title                  = $request->input('title');
        $offers->title_offer            = $request->input('title_offer');
        $offers->product_group          = $request->input('product_group');
        $offers->noe                    = $request->input('noe');
        if ($request->input('lat') != null) {
            $offers->lat = $request->input('lat');
        } else {
            $offers->lat = auth::user()->lat;
        }
        if ($request->input('lng') != null) {
            $offers->lng = $request->input('lng');
        } else {
            $offers->lng = auth::user()->lng;
        }
        $offers->state_id               = $request->input('state_id');
        $offers->buyorsell              = $request->input('buyorsell');
        if ($request->input('unicode_product') != null) {
            $offers->unicode_product    = $request->input('unicode_product');
        }
        $offers->product_name           = $request->input('product_name');
        if ($request->input('single_price')) {
            $offers->single_price       = str_replace(',', '', $request->input('single_price'));
        }
        $offers->city_id            = $request->input('city_id');
        $offers->mobile             = $request->input('mobile');
        $offers->brand_id           = $request->input('brand_id');
        $offers->brand_name         = $request->input('brand_name');
        $offers->total              = $request->input('total');
        $offers->description        = $request->input('description');
        $offers->address            = $request->input('address');
        $offers->phone              = $request->input('phone');
        $offers->mobile             = $request->input('mobile');
        if ($request->input('image1')) {
            $offers->image1         = $request->input('image1');
        }
        if (auth::user()->type_id == 4 || auth::user()->type_id == 3) {
            $offers->single = 1;
        } elseif (auth::user()->type_id == 1) {
            $offers->single = $request->input('single');
        }
        if ($request->input('price')) {
            $offers->price = str_replace(',', '', $request->input('price'));
        }

        $supplier_id = Supplier::whereUser_id(auth::user()->id)->pluck('id');
        if (trim($supplier_id) != '[]')
        {
            $offers->supplier_id = $supplier_id[0];
        }
        $offers->permanent_supplier = $request->input('permanent_supplier');
        $offers->slug               = 'OFFER-' . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999) . chr(rand(97, 122)) . rand(1, 999);
        $offers->status             = '1';
        $offers->user_id            = Auth::user()->id;


        if ($request->hasFile('image1')) {
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

        alert()->success('<h3>اطلاعات آگهی با موفقیت ثبت شد</h3><p>برای ورود اطلاعات خودرو <a href="#carset">کلیک</a> نمایید و سپس دکمه تایید را بزنید</p>')->html()->persistent('تایید');
        return redirect(route('offer-edit' , $offers->id));
    }

    public function offermap(Request $request)
    {
        $offermap               = Offer::findOrfail($request->input('id'));
        $offermap->lat          = $request->input('lat');
        $offermap->lng          = $request->input('lng');

        $offermap->update();
    }

    public function offeredit($id)
    {
        $menus                  = Menu::whereStatus(4)->get();
        $suppliers              = Supplier::whereStatus(4)->get();
        $unicode                = Offer::whereUser_id(Auth::user()->id)->whereId($id)->pluck('unicode_product');
        $unicode_product        = Product::whereStatus(4)->whereUnicode($unicode)->get();
        $products               = Product::select('unicode' , 'title_fa')->whereStatus(4)->get();
        $brands                 = Brand::select('id' , 'title_fa')->whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $carmodels              = Car_model::all();
        $cartypes               = Car_type::all();
        $car_offers             = Car_offer::all();
        $states                 = State::select('id' , 'title')->get();
        $cities                 = City::select('id' , 'title')->get();
        $productgroups          = Product_group::select('id','title_fa')->get();
        $alloffers              = Offer::whereUser_id(Auth::user()->id)->get();


        $offers = Offer::select('offers.id' , 'offers.buyorsell' , 'offers.unicode_product' , 'offers.product_name' , 'offers.brand_id' , 'offers.brand_name' , 'offers.product_group' , 'offers.title_offer'
        ,'offers.permanent_supplier' , 'offers.description' , 'offers.image1', 'offers.image2', 'offers.image3', 'offers.single', 'offers.single_price', 'offers.price', 'offers.total' , 'offers.address', 'offers.noe', 'offers.lat', 'offers.lng')
            ->where('offers.user_id' , Auth::user()->id)
            ->where('offers.id' , $id)
            ->get();


//        $brands = Brand::
//            leftjoin('product_brand_varieties' ,'product_brand_varieties.brand_id' ,'=' , 'brands.id')
//            ->leftjoin('offers' ,'offers.brand_id' ,'=' , 'product_brand_varieties.id')
//            ->select('product_brand_varieties.id' , 'product_brand_varieties.brand_id' , 'product_brand_varieties.item1', 'product_brand_varieties.value_item1', 'product_brand_varieties.item2', 'product_brand_varieties.value_item2'
//                , 'product_brand_varieties.item3', 'product_brand_varieties.value_item3' , 'brands.id as brand_id' , 'brands.title_fa as brand_title')
//            ->where('brands.status' , 4)
//            ->get();


        $productbrandvarieties = Product_brand_variety::
            leftjoin('offers' ,'offers.brand_id' ,'=' , 'product_brand_varieties.id')
            ->leftjoin('brands' ,'brands.id' ,'=' , 'product_brand_varieties.id')
            ->select('product_brand_varieties.id' , 'product_brand_varieties.brand_id' , 'product_brand_varieties.item1', 'product_brand_varieties.value_item1', 'product_brand_varieties.item2', 'product_brand_varieties.value_item2'
                , 'product_brand_varieties.item3', 'product_brand_varieties.value_item3')
            ->where('product_brand_varieties.status' , 4)
            ->get();


        return view('Site.offeredit')
            ->with(compact('carmodels'))
            ->with(compact('cartypes'))
            ->with(compact('car_offers'))
            ->with(compact('unicode_product'))
            ->with(compact('productgroups'))
            ->with(compact('carbrands'))
            ->with(compact('cities'))
            ->with(compact('states'))
            ->with(compact('offers'))
            ->with(compact('alloffers'))
            ->with(compact('menus'))
            ->with(compact('brands'))
            ->with(compact('products'))
            ->with(compact('suppliers'))
            ->with(compact('productbrandvarieties'));

    }

    public function update(Request $request , $id)
    {
        $offer = Offer::findOrfail($id);

        $offer->title_offer        = $request->input('title_offer');
        $offer->product_group      = $request->input('product_group');
        $offer->noe                = $request->input('noe');
        $offer->state_id           = Auth::user()->state_id;
        $offer->city_id            = Auth::user()->city_id;
        $offer->mobile             = Auth::user()->mobile;
        $offer->buyorsell          = $request->input('buyorsell');
        if ($request->input('unicode_product') != null) {
            $offer->unicode_product = $request->input('unicode_product');
        }
        $offer->product_name       = $request->input('product_name');
        if($request->input('single_price')) {
            $offer->single_price = str_replace(',', '', $request->input('single_price'));
        }
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

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();
    }

    public function offerdelete($id)
    {
        $offer = Offer::findOrfail($id);
        $offer->delete();
        alert()->success('عملیات موفق', 'خودرو با موفقیت پاک شد');
        return Redirect::back();
    }

    public function titleproduct(Request $request){
        $product_id = Product::whereUnicode($request->input('id'))->pluck('id');
        $kala_group_id = Product::whereUnicode($request->input('id'))->pluck('kala_group_id');
        $productgroups = Product_group::whereId($kala_group_id)->get();
        $brand_id = Product_brand_variety::whereProduct_id($product_id)->pluck('brand_id');
        $brands = Brand::whereIn('id' , $brand_id)->get();
        $output1 = [];


        foreach($brands as $brand )
        {
            $output1[$brand->id] = $brand->title_fa;
        }


        return $output1;
    }

    public function caroffercreate(Request $request){

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

        }elseif($request->car_brand_id != null && $request->car_model_id == null){

            $offer_id = Offer::whereId($request->input('offer_id'))->get();
            foreach($offer_id as $offer){
                $x  = $offer->id;
            }


            $caroffers = new Car_offer();

            $caroffers->car_brand_id       = $request->input('car_brand_id');
            $caroffers->offer_id           = $x;

            $caroffers->save();

        }
        return Redirect::back();

    }

    public function carofferdelete($id)
    {
        $caroffer = Car_offer::findOrfail($id);
        $caroffer->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
}
