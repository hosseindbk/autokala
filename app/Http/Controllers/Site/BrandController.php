<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Car_brand;
use App\City;
use App\comment;
use App\commentrate;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\brandrequest;
use App\Media;
use App\Menu;
use App\State;
use App\Product;
use App\Product_brand_variety;
use App\Product_group;
use App\Representative_supplier;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function index(){
        $menus              = Menu::whereStatus(4)->get();
        $states             = State::all();
        $countState         = null;
        $countries          = Country::all();
        $productgroups      = Product_group::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $newbrands          = Brand::whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $clickbrands        = Brand::whereStatus(4)->orderBy('click')->paginate(16);
        $goodbrands         = Brand::whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $oldbrands          = Brand::whereStatus(4)->orderBy('id')->paginate(16);
        $brands             = Brand::whereStatus(4)->get();
        return view('Site.brand')
            ->with(compact('countries'))
            ->with(compact('countState'))
            ->with(compact('newbrands'))
            ->with(compact('states'))
            ->with(compact('clickbrands'))
            ->with(compact('goodbrands'))
            ->with(compact('brands'))
            ->with(compact('oldbrands'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('menus'));
    }

    public function brandfilter(){
        $menus              = Menu::whereStatus(4)->get();
        $states             = State::all();
        $countState         = null;
        $countries          = Country::all();
        $productgroups      = Product_group::whereStatus(4)->get();
        $carbrands          = Car_brand::whereStatus(4)->get();
        $newbrands          = Brand::filter()->whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $clickbrands        = Brand::filter()->whereStatus(4)->orderBy('click')->paginate(16);
        $goodbrands         = Brand::filter()->whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $oldbrands          = Brand::filter()->whereStatus(4)->orderBy('id')->paginate(16);
        $brands             = Brand::filter()->whereStatus(4)->get();
        return view('Site.brand')
            ->with(compact('countries'))
            ->with(compact('countState'))
            ->with(compact('newbrands'))
            ->with(compact('states'))
            ->with(compact('clickbrands'))
            ->with(compact('goodbrands'))
            ->with(compact('brands'))
            ->with(compact('oldbrands'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('menus'));
    }

    public function brandindex(){
        $id                     = request('state_id');
        if ($id == null){
            $countState             = State::all();
        }else{
            $countState             = State::whereIn('id' , $id)->get();
        }
        $menus                  = Menu::whereStatus(4)->get();
        $suppliers              = Supplier::whereStatus(4)->get();
        $products               = Product::whereStatus(4)->get();
        $states                 = State::all();
        $countries          = Country::all();
        $brands                 = Brand::whereStatus(4)->get();
        $countries              = Country::whereStatus(4)->get();
        $brandcreate            = Brand::whereUser_id(Auth::user()->id)->get();

        return view('Site.brand-create')
            ->with(compact('countries'))
            ->with(compact('countState'))
            ->with(compact('brandcreate'))
            ->with(compact('menus'))
            ->with(compact('brands'))
            ->with(compact('states'))
            ->with(compact('products'))
            ->with(compact('suppliers'))
            ->with(compact('countries'));
    }

    public function brandedit($id){
        $menus                  = Menu::whereStatus(4)->get();
        $suppliers              = Supplier::whereStatus(4)->get();
        $products               = Product::whereStatus(4)->get();
        $states                 = State::all();
        $brands                 = Brand::whereStatus(4)->get();
        $countries              = Country::whereStatus(4)->get();
        $brandcreate            = Brand::whereUser_id(Auth::user()->id)->whereId($id)->get();

        return view('Site.brand-edit')
            ->with(compact('brandcreate'))
            ->with(compact('menus'))
            ->with(compact('brands'))
            ->with(compact('states'))
            ->with(compact('products'))
            ->with(compact('suppliers'))
            ->with(compact('countries'));
    }

    public function brandupdate(Request $request , $id)
    {
        $brand = Brand::findOrfail($id);

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

    public function brandcreate(brandrequest $request)
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
        return Redirect::back();
    }

    public function subbrand($slug){
        $menus                  = Menu::whereStatus(4)->get();
        $products               = Product::whereStatus(4)->get();
        $states                 = State::all();
        $cities                 = City::all();
        $countState             = null;

        $productgroups          = Product_group::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $brands                 = Brand::whereStatus(4)->whereSlug($slug)->get();
        $brand_id               = Brand::whereStatus(4)->whereSlug($slug)->pluck('id');
        $countries              = Country::whereStatus(4)->get();
        $medias                 = Media::whereTechnical_id($brand_id)->get();
        $supplier_id            = Representative_supplier::whereBrand_id($brand_id)->pluck('supplier_id');
        $suppliers              = Supplier::whereIn('id' , $supplier_id)->get();
        $comments               = comment::whereCommentable_id($brand_id)->whereApproved(1)->latest()->get();
        $commentrates           = commentrate::whereCommentable_id($brand_id)->whereApproved(1)->latest()->get();
        $commentratecount       = commentrate::whereCommentable_id($brand_id)->whereApproved(1)->count();
        $commentratequality     = commentrate::whereCommentable_id($brand_id)->whereApproved(1)->avg('quality');
        $commentratevalue       = commentrate::whereCommentable_id($brand_id)->whereApproved(1)->avg('value');
        $commentrateinnovation  = commentrate::whereCommentable_id($brand_id)->whereApproved(1)->avg('innovation');
        $commentrateability     = commentrate::whereCommentable_id($brand_id)->whereApproved(1)->avg('ability');
        $commentratedesign      = commentrate::whereCommentable_id($brand_id)->whereApproved(1)->avg('design');
        $commentratecomfort     = commentrate::whereCommentable_id($brand_id)->whereApproved(1)->avg('comfort');


        return view('Site.subbrand')
            ->with(compact('cities'))
            ->with(compact('countState'))
            ->with(compact('countries'))
            ->with(compact('products'))
            ->with(compact('comments'))
            ->with(compact('commentrates'))
            ->with(compact('suppliers'))
            ->with(compact('states'))
            ->with(compact('commentratecount'))
            ->with(compact('commentratequality'))
            ->with(compact('commentratevalue'))
            ->with(compact('commentrateinnovation'))
            ->with(compact('commentrateability'))
            ->with(compact('commentratedesign'))
            ->with(compact('commentratecomfort'))
            ->with(compact('medias'))
            ->with(compact('brands'))
            ->with(compact('carbrands'))
            ->with(compact('productgroups'))
            ->with(compact('menus'));
    }

    public function branddelete($id){

        $brands = Brand::findOrfail($id);

        $brands->delete();
        return Redirect::back();
    }


}
