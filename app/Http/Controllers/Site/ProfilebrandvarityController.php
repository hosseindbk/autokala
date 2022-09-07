<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\productbrandvarietyrequest;
use App\Menu;
use App\Offer;
use App\Product;
use App\Product_brand_variety;
use App\Product_group;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class ProfilebrandvarityController extends Controller
{
    public function index($id){
        $menus              = Menu::whereStatus(4)->get();
        $brands             = Brand::whereStatus(4)->get();
        $states             = State::all();
        $countState         = null;
        $products           = Product::whereUnicode($id)->get();
        $product_group_id   = Product::whereUnicode($id)->first();
        $productgroups      = Product_group::whereId($product_group_id->kala_group_id)->get();

        return view('Site.brand-variety-create')
            ->with(compact('countState'))
            ->with(compact('products'))
            ->with(compact('productgroups'))
            ->with(compact('states'))
            ->with(compact('brands'))
            ->with(compact('menus'));


    }

    public function store(productbrandvarietyrequest $request)
    {

        $productbrandvarieties = new Product_brand_variety();

        $productbrandvarieties->brand_id             = $request->input('brand_id');
        $productbrandvarieties->product_id           = $request->input('product_id');
        $productbrandvarieties->guarantee            = $request->input('guarantee');
        $productbrandvarieties->item1                = $request->input('item1');
        $productbrandvarieties->item2                = $request->input('item2');
        $productbrandvarieties->item3                = $request->input('item3');
        $productbrandvarieties->value_item1          = $request->input('value_item1');
        $productbrandvarieties->value_item2          = $request->input('value_item2');
        $productbrandvarieties->value_item3          = $request->input('value_item3');
        $productbrandvarieties->strength1            = $request->input('strength1');
        $productbrandvarieties->strength2            = $request->input('strength2');
        $productbrandvarieties->strength3            = $request->input('strength3');
        $productbrandvarieties->strength4            = $request->input('strength4');
        $productbrandvarieties->weakness1            = $request->input('weakness1');
        $productbrandvarieties->weakness2            = $request->input('weakness2');
        $productbrandvarieties->weakness3            = $request->input('weakness3');
        $productbrandvarieties->weakness4            = $request->input('weakness4');
        $productbrandvarieties->status               = '1';
        $productbrandvarieties->description          = $request->input('description');
        $productbrandvarieties->date                 = jdate()->format('Ymd ');
        $productbrandvarieties->date_handle          = jdate()->format('Ymd ');
        $productbrandvarieties->user_id              = Auth::user()->id;

        if ($request->hasfile('image1')) {
            $file = $request->file('image1');
            $img = Image::make($file);
            $imagePath ="images/productbrandvarieties/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $productbrandvarieties->image1 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('image2') != null) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="images/productbrandvarieties/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $productbrandvarieties->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->file('image3') != null) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="images/productbrandvarieties/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $productbrandvarieties->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $productbrandvarieties->save();

        $productcount           = Product_brand_variety::whereProduct_id($request->input('product_id'))->count();

        $product                = Product::findOrFail($productbrandvarieties->product_id);
        $product->countvarity   = $productcount;
        $product->update();

        $productunicode         = Product::whereId($request->input('product_id'))->pluck('unicode');
        $offer_id               = Offer::whereUnicode_product($productunicode)->pluck('id');
        $offers                  = Offer::whereIn('id' , $offer_id)->get();

        foreach ($offers as $offer) {
            $offer = $offer->findOrfail($offer->id);
            $offer->countvarity     = $productcount;
            $offer->update();
        }

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();

    }
}
