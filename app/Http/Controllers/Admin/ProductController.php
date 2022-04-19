<?php

namespace App\Http\Controllers\Admin;


use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Car_product;
use App\Car_type;
use App\Http\Controllers\Controller;
use App\Http\Requests\productrequest;
use App\Media;
use App\Menudashboard;
use App\Product;
use App\Product_brand_variety;
use App\Product_group;
use App\Status;
use App\Submenudashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('products')
                ->leftjoin('product_groups', 'product_groups.id', '=', 'products.kala_group_id')
                ->select('products.id as idproduct' , 'products.image as image' , 'products.title_fa as titleproduct'
                    , 'products.unicode as unicode' , 'products.status as status' , 'products.code_fani_company as codefani' ,'product_groups.id as idproductgroup' , 'product_groups.title_fa as titleproductgroup')
                ->get();

            return Datatables::of($data)

                ->editColumn('idproduct', function ($data) {
                    return ($data->idproduct);
                })
                ->editColumn('titleproduct', function ($data) {
                    return ($data->titleproduct);
                })
                ->editColumn('unicode', function ($data) {
                    return ($data->unicode);
                })
                ->editColumn('codefani', function ($data) {
                    return ($data->codefani);
                })
                ->editColumn('titleproductgroup', function ($data) {
                    return ($data->titleproductgroup);
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == "1") {
                        return 'پیش نویس';
                    }elseif ($data->status == "2") {
                        return 'درحال بررسی';
                    }elseif ($data->status == "3") {
                        return 'تایید مدیر';
                    }elseif ($data->status == "4") {
                        return 'درحال نمایش';
                    }elseif ($data->status == "5") {
                        return 'معلق شده';
                    }elseif ($data->status == "6") {
                        return 'حذف شده';
                    }
                })
                ->addColumn('image', function ($row) {
                    return '<img src="'.asset($row->image).'"  width="50" class="img-rounded" align="center" />';

                })
                ->addColumn('brandvariety', function ($row) {
                    return '<a href="' . route('product-brand-variety' , $row->idproduct)  .'" class="btn ripple btn-outline-info btn-sm">برند</a>';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="' . route('products.edit' , $row->idproduct) . '" class="btn ripple btn-outline-info btn-sm">Edit</a>
                                  <form action="' . route('products.destroy' , $row->idproduct) .'" method="post"  style="display: inline;">
                                    '.csrf_field().'
                                    '.method_field("DELETE").'
                                         <button type="submit" class="btn ripple btn-outline-danger btn-sm">
                                             <i class="fe fe-trash-2 "></i>
                                         </button>
                                </form>';

                    return $actionBtn;
                })
                ->rawColumns(['action' , 'image' , 'brandvariety'])
                ->make(true);
        }
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.products.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));

    }

    public function create()
    {
        $productgroups      = Product_group::select('id' , 'title_fa')->get();
//        $carmodels = DB::table('Car_brands')
//            ->join('Car_models', 'Car_brands.id', '=', 'Car_models.vehicle_brand_id')
//            ->select('Car_brands.id', 'Car_brands.title_fa' , 'Car_models.id', 'Car_models.title_en')
//            ->get();
        $cartypes           = Car_type::select('id' , 'car_model_id' , 'title_fa')->whereStatus(4)->get();
        $products           = Product::orderby('unicode' , 'DESC')->limit('1')->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        return view('Admin.products.create')
            ->with(compact('products'))
            ->with(compact('cartypes'))
            ->with(compact('productgroups'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }


    public function store(productrequest $request)
    {
        $products = new Product();

        $products->unicode           = $request->input('unicode');
        $products->slug              = $request->input('unicode');
        $products->title_fa          = $request->input('title_fa');
        $products->title_en          = $request->input('title_en');
        $products->kala_group_id     = $request->input('kala_group_id');
        $products->title_bazar_fa    = $request->input('title_bazar_fa');
        $products->title_bazar_en    = $request->input('title_bazar_en');
        $products->code_fani_company = $request->input('code_fani_company');
        $products->status            = '1';
        $products->title_specific1   = $request->input('title_specific1');
        $products->title_specific2   = $request->input('title_specific2');
        $products->title_specific3   = $request->input('title_specific3');
        $products->title_specific4   = $request->input('title_specific4');
        $products->title_specific5   = $request->input('title_specific5');
        $products->title_specific6   = $request->input('title_specific6');
        $products->specific1         = $request->input('specific1');
        $products->specific2         = $request->input('specific2');
        $products->specific3         = $request->input('specific3');
        $products->specific4         = $request->input('specific4');
        $products->specific5         = $request->input('specific5');
        $products->specific6         = $request->input('specific6');
        $products->description       = $request->input('description');
        $products->date              = jdate()->format('Ymd ');
        $products->date_handle       = jdate()->format('Ymd ');
        $products->user_id           = Auth::user()->id;
        $products->user_handle       = Auth::user()->id;

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $unicode = $request->input('unicode');
            $imagePath ="images/products/{$unicode}/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $products->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }
        $products->save();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('products.index'));

    }


    public function edit($id)
    {
        $cartypes           = Car_type::select('id' , 'title_fa')->whereStatus(4)->get();
        $carmodels          = Car_model::select('id' , 'title_fa')->whereStatus(4)->get();
        $carbrands          = Car_brand::select('id' , 'title_fa')->whereStatus(4)->get();
//        $carmodels = DB::table('Car_brands')
//            ->join('Car_models', 'Car_brands.id', '=', 'Car_models.vehicle_brand_id')
//            ->select('Car_brands.id', 'Car_brands.title_fa' , 'Car_models.id', 'Car_models.title_en')
//            ->get();
        $medias             = Media::select('id','product_id' , 'image')->whereProduct_id($id)->get();
        $carproducts        = Car_product::whereProduct_id($id)->get();
        $statuses           = Status::select('id' , 'title')->get();
        $products           = Product::whereId($id)->get();
        $productbrandvarieties  = Product_brand_variety::whereProduct_id($id)->get();
        $brands             = Brand::where('status' , '>=' , 1)->get();
        $productgroups      = Product_group::select('id' , 'title_fa')->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.products.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('medias'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('carmodels'))
            ->with(compact('carproducts'))
            ->with(compact('productbrandvarieties'))
            ->with(compact('statuses'))
            ->with(compact('cartypes'))
            ->with(compact('brands'))
            ->with(compact('products'));
    }

    public function update(productrequest $request , Product $product )
    {

        $product->unicode           = $request->input('unicode');
        $product->title_fa          = $request->input('title_fa');
        $product->title_en          = $request->input('title_en');
        $product->kala_group_id     = $request->input('kala_group_id');
        $product->title_bazar_fa    = $request->input('title_bazar_fa');
        $product->title_bazar_en    = $request->input('title_bazar_en');
        $product->code_fani_company = $request->input('code_fani_company');
        $product->status            = $request->input('status_id');
        $product->description       = $request->input('description');
        $product->title_specific1   = $request->input('title_specific1');
        $product->title_specific2   = $request->input('title_specific2');
        $product->title_specific3   = $request->input('title_specific3');
        $product->title_specific4   = $request->input('title_specific4');
        $product->title_specific5   = $request->input('title_specific5');
        $product->title_specific6   = $request->input('title_specific6');
        $product->specific1         = $request->input('specific1');
        $product->specific2         = $request->input('specific2');
        $product->specific3         = $request->input('specific3');
        $product->specific4         = $request->input('specific4');
        $product->specific5         = $request->input('specific5');
        $product->specific6         = $request->input('specific6');
        $product->date              = jdate()->format('Ymd ');
        $product->user_id           = Auth::user()->id;
        $product->user_handle       = Auth::user()->id;

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $unicode = $request->input('unicode');
            $imagePath ="images/products/{$unicode}/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $product->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        $product->update();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return Redirect::back();
    }

    public function destroy(Product $product)
    {
        $product->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('products.index'));
    }
    public function deleteimage(Media $media)
    {
        dd($media);
        $media->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
    public function updateproimg($id)
    {
        $products = Product::findOrfail($id);
        $products->image  = '';
        $products->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
    public function modeloption(Request $request){
        $carmodels = Car_model::whereVehicle_brand_id($request->input('id'))->get();
        $output = [];

        foreach($carmodels as $Car_model )
        {
            $output[$Car_model->id] = $Car_model->title_fa;
        }

        return $output;
    }
    public function typeoption(Request $request){
        $cartypes = Car_type::whereCar_model_id($request->input('id'))->get();
        $output = [];

        foreach($cartypes as $Car_type )
        {
            $output[$Car_type->id] = $Car_type->title_fa;
        }

        return $output;
    }

}
