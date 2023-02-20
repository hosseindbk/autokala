<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Car_product;
use App\Car_type;
use App\Http\Controllers\Controller;
use App\Http\Requests\productbrandvarietyrequest;
use App\Media;
use App\Menudashboard;
use App\Product;
use App\Product_brand_variety;
use App\Status;
use App\Submenudashboard;
use App\Technical_unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class ProductbrandvarietyController extends Controller
{

    public function index()
    {
//        $productbrandvarieties  = Product_brand_variety::all();
//        $products               = Product::select('id' , 'title_fa' , 'unicode')->get();
//        $brands                 = Brand::select('id' , 'title_fa')->get();
//        $statuses               = Status::select('id' , 'title')->get();
        $menudashboards         = Menudashboard::whereStatus(4)->get();
        $submenudashboards      = Submenudashboard::whereStatus(4)->get();

        $productbrandvarieties  = Product_brand_variety::join('products' , 'products.id' , '=' , 'product_brand_varieties.product_id')
            ->join('brands' , 'brands.id' , '=' , 'product_brand_varieties.brand_id')
            ->join('statuses' , 'statuses.id' , '=' , 'product_brand_varieties.status')
            ->select('product_brand_varieties.id' , 'products.title_fa as product_title' ,'brands.title_fa as brand_title' ,'statuses.title as status_title' ,'products.unicode' ,'product_brand_varieties.image1')
            ->get();

        return view('Admin.productbrandvarieties.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('productbrandvarieties'));
//            ->with(compact('statuses'))
//            ->with(compact('brands'))
//            ->with(compact('products'))
    }

    public function create()
    {
        $productbrandvarieties  = Product_brand_variety::all();
        $products               = Product::all();
        $brands                 = Brand::where('status' , '>=' , 1)->get();
        $statuses               = Status::select('id' , 'title')->get();
        $menudashboards         = Menudashboard::whereStatus(4)->get();
        $submenudashboards      = Submenudashboard::whereStatus(4)->get();
        $carbrands              = Car_brand::select('id' , 'title_fa')->get();
        $carproducts            = Car_product::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $cartypes               = Car_type::whereStatus(4)->get();

        return view('Admin.productbrandvarieties.create')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('statuses'))
            ->with(compact('carbrands'))
            ->with(compact('productbrandvarieties'))
            ->with(compact('brands'))
            ->with(compact('carproducts'))
            ->with(compact('carmodels'))
            ->with(compact('cartypes'))
            ->with(compact('products'));
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

        if ($request->hasfile('image1') ) {
            $file = $request->file('image1');
            $img = Image::make($file);
            $imagePath ="images/productbrandvarieties/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $productbrandvarieties->image1 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->hasfile('image2')) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="images/productbrandvarieties/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $productbrandvarieties->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->hasfile('image3')) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="images/productbrandvarieties/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $productbrandvarieties->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $productbrandvarieties->save();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();

    }

    public function edit($id)
    {
        $productbrandvarieties  = Product_brand_variety::whereId($id)->get();
        $medias                 = Media::select('id','productbrandvariety_id' , 'image')->whereProductbrandvariety_id($id)->get();
        $products               = Product::where('status' , '>=' , 1)->get();
        $brands                 = Brand::where('status' , '>=' , 1)->get();
        $statuses               = Status::select('id' , 'title')->get();
        $menudashboards         = Menudashboard::whereStatus(4)->get();
        $submenudashboards      = Submenudashboard::whereStatus(4)->get();

        return view('Admin.productbrandvarieties.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('medias'))
            ->with(compact('statuses'))
            ->with(compact('productbrandvarieties'))
            ->with(compact('brands'))
            ->with(compact('products'));
    }

    public function pupdate(Request $request,$id)
    {
        $productbrandvariety = Product_brand_variety::findOrfail($id);

        $productbrandvariety->brand_id       = $request->input('brand_id');
        $productbrandvariety->product_id     = $request->input('product_id');
        $productbrandvariety->guarantee      = $request->input('guarantee');
        $productbrandvariety->item1          = $request->input('item1');
        $productbrandvariety->item2          = $request->input('item2');
        $productbrandvariety->item3          = $request->input('item3');
        $productbrandvariety->value_item1    = $request->input('value_item1');
        $productbrandvariety->value_item2    = $request->input('value_item2');
        $productbrandvariety->value_item3    = $request->input('value_item3');
        $productbrandvariety->strength1      = $request->input('strength1');
        $productbrandvariety->strength2      = $request->input('strength2');
        $productbrandvariety->strength3      = $request->input('strength3');
        $productbrandvariety->strength4      = $request->input('strength4');
        $productbrandvariety->weakness1      = $request->input('weakness1');
        $productbrandvariety->weakness2      = $request->input('weakness2');
        $productbrandvariety->weakness3      = $request->input('weakness3');
        $productbrandvariety->weakness4      = $request->input('weakness4');
        $productbrandvariety->status         = $request->input('status_id');
        $productbrandvariety->description    = $request->input('description');
        $productbrandvariety->review         = $request->input('review');
        $productbrandvariety->date           = jdate()->format('Ymd ');
        $productbrandvariety->date_handle    = jdate()->format('Ymd ');
        $productbrandvariety->user_handle    = Auth::user()->id;

        if ($request->hasfile('image1') ) {
            $file = $request->file('image1');
            $img = Image::make($file);
            $imagePath ="images/productbrandvarieties/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $productbrandvariety->image1 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->hasfile('image2')) {
            $file = $request->file('image2');
            $img = Image::make($file);
            $imagePath ="images/productbrandvarieties/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $productbrandvariety->image2 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        if ($request->hasfile('image3')) {
            $file = $request->file('image3');
            $img = Image::make($file);
            $imagePath ="images/productbrandvarieties/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $productbrandvariety->image3 = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $productbrandvariety->save();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('productbrandvarieties.index'));
    }

    public function img1update($id)
    {

        $productbrandvariety = Product_brand_variety::findOrfail($id);
        $productbrandvariety->image1 = null;
        $productbrandvariety->update();
        return Redirect::back();
    }

    public function img2update($id)
    {
        $productbrandvariety = Product_brand_variety::findOrfail($id);
        $productbrandvariety->image2 = null;
        $productbrandvariety->update();
        return Redirect::back();
    }

    public function img3update($id)
    {
        $productbrandvariety = Product_brand_variety::findOrfail($id);
        $productbrandvariety->image3 = null;
        $productbrandvariety->update();
        return Redirect::back();
    }

    public function destroy(Product_brand_variety $productbrandvariety)
    {
        $productbrandvariety->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
}
