<?php

namespace App\Http\Controllers\Admin;


use App\Brand;
use App\Country;
use App\Http\Requests\brandrequest;
use App\Menudashboard;
use App\Representative_supplier;
use App\Status;
use App\Submenudashboard;
use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{

    public function index()
    {
        $brands             = Brand::all();
        $countries          = Country::all();
        $statuses           = Status::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.brands.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('statuses'))
            ->with(compact('countries'))
            ->with(compact('brands'));
    }

    public function brandhomeshow(Request $request){
        $brand = Brand::findOrfail($request->input('id'));

        if($brand->homeshow == 1){
            $brand->homeshow = 0;
        }elseif($brand->homeshow == 0){
            $brand->homeshow = 1;
        }
        $brand->update();

    }
    public function create()
    {
        $countries          = Country::all();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();

        return view('Admin.brands.create')
            ->with(compact('menudashboards'))
            ->with(compact('countries'))
            ->with(compact('submenudashboards'));
    }


    public function store(brandrequest $request)
    {
        $brands = new Brand();

        $brands->title_fa       = $request->input('title_fa');
        $brands->title_en       = $request->input('title_en');
        $brands->abstract_title = $request->input('abstract_title');
        $brands->phone          = $request->input('phone');
        $brands->mobile         = $request->input('mobile');
        $brands->whatsapp       = $request->input('whatsapp');
        $brands->email          = $request->input('email');
        $brands->website        = $request->input('website');
        $brands->country_id     = $request->input('country_id');
        $brands->description    = $request->input('description');
        $brands->address        = $request->input('address');
        $brands->status         = '1';
        $brands->slug          = 'BR-'.rand(1,999).chr(rand(97,122)).rand(1,999).chr(rand(97,122)).rand(1,999);
        $brands->date           = jdate()->format('Ymd ');
        $brands->date_handle    = jdate()->format('Ymd ');
        $brands->user_id        = Auth::user()->id;
        $brands->user_handle    = Auth::user()->name;

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="image/brands/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $brands->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        $brands->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('brands.index'));
    }
    public function updatebrandimg($id)
    {
        $brands = Brand::findOrfail($id);
        $brands->image  = '';
        $brands->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }

    public function edit($id)
    {
        $countries                  = Country::all();
        $statuses                   = Status::all();
        $brands                     = Brand::whereId($id)->get();
        $brand_id                   = Brand::whereId($id)->pluck('id');
        $suppliers                  = Supplier::whereStatus(4)->get();
        $representetivesuppliers    = Representative_supplier::whereBrand_id($brand_id)->get();
        $menudashboards             = Menudashboard::whereStatus(4)->get();
        $submenudashboards          = Submenudashboard::whereStatus(4)->get();

        return view('Admin.brands.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('statuses'))
            ->with(compact('representetivesuppliers'))
            ->with(compact('suppliers'))
            ->with(compact('countries'))
            ->with(compact('brands'));
    }

    public function update(brandrequest $request, Brand $brand)
    {

        $brand->title_fa       = $request->input('title_fa');
        $brand->title_en       = $request->input('title_en');
        $brand->abstract_title = $request->input('abstract_title');
        $brand->phone          = $request->input('phone');
        $brand->mobile         = $request->input('mobile');
        $brand->whatsapp       = $request->input('whatsapp');
        $brand->email          = $request->input('email');
        $brand->website        = $request->input('website');
        $brand->status         = $request->input('status_id');
        $brand->country_id     = $request->input('country_id');
        $brand->description    = $request->input('description');
        $brand->address        = $request->input('address');
        $brand->date           = jdate()->format('Ymd ');
        $brand->date_handle    = jdate()->format('Ymd ');
        $brand->user_id        = Auth::user()->id;
        $brand->user_handle    = Auth::user()->name;

        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="image/brands/";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $brand->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        $brand->update();

        return Redirect::back();
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return redirect(route('brands.index'));
    }
}
