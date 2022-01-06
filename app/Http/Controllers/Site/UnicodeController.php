<?php

namespace App\Http\Controllers\Site;

use App\Brand;
use App\Car_brand;
use App\Car_model;
use App\Car_product;
use App\Car_type;
use App\comment;
use App\Http\Controllers\Controller;
use App\Media;
use App\Menu;
use App\State;
use App\Product;
use App\Product_brand_variety;
use App\Product_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use UxWeb\SweetAlert\SweetAlert;
class UnicodeController extends Controller
{
    public function unicode(){
        $unicode                = request('unicode');
        $countState         = null;

        $newproducts            = Product::where('unicode', 'LIKE', '%' . $unicode . '%')->whereStatus(4)->paginate(16);
        $clickproducts          = Product::where('unicode', 'LIKE', '%' . $unicode . '%')->whereStatus(4)->orderBy('click')->paginate(16);
        $goodproducts           = Product::where('unicode', 'LIKE', '%' . $unicode . '%')->whereStatus(4)->orderBy('id' , 'DESC')->paginate(16);
        $oldproducts            = Product::where('unicode', 'LIKE', '%' . $unicode . '%')->whereStatus(4)->orderBy('id')->paginate(16);
        $productgroups          = Product_group::whereStatus(4)->get();
        $carproducts            = Car_product::whereStatus(4)->get();
        $carmodels              = Car_model::whereStatus(4)->get();
        $carbrands              = Car_brand::whereStatus(4)->get();
        $brands                 = Brand::whereStatus(4)->get();
        $menus                  = Menu::whereStatus(4)->get();
        $states                 = State::all();
        $filter                 = 0;


        return view('Site.product')
            ->with(compact('countState'))
            ->with(compact('filter'))
            ->with(compact('carmodels'))
            ->with(compact('carproducts'))
            ->with(compact('menus'))
            ->with(compact('productgroups'))
            ->with(compact('carbrands'))
            ->with(compact('brands'))
            ->with(compact('states'))
            ->with(compact('newproducts'))
            ->with(compact('clickproducts'))
            ->with(compact('goodproducts'))
            ->with(compact('oldproducts'));
    }
}
