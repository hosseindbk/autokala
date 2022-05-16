<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\comment;
use App\commentrate;
use App\Menudashboard;
use App\Offer;
use App\Product;
use App\Status;
use App\Supplier;
use App\Tblproduct;
use App\Category;
use App\Matn;
use App\Submenudashboard;
use App\Technical_unit;
use App\Type_user;
use App\User;
use App\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{

    public function index()
    {
        $countusers         = User::count();
        $categories         = category::whereStatus(1)->get();
        $suppliers          = Supplier::leftjoin('users' , 'users.id' , '=' , 'suppliers.user_id')
            ->leftjoin('type_users' , 'type_users.id' , '=' , 'users.type_id')
            ->leftjoin('statuses' , 'statuses.id' , '=' , 'suppliers.status')
            ->select('suppliers.id' ,'suppliers.title' , 'suppliers.manager', 'suppliers.user_id' , 'suppliers.mobile' , 'suppliers.email' , 'suppliers.created_at','statuses.title as status',

                DB::raw( '(CASE
            WHEN users.type_id = "1" THEN "کاربر فروشگاه"
            WHEN users.type_id = "3" THEN "کاربر تعمیرگاه"
            WHEN users.type_id = "4" THEN "کاربر عادی"
            END) AS type'))
            ->where('suppliers.status' , '=' , 1)
            ->latest()
            ->get();

        $technicalunits     = Technical_unit::leftjoin('users' , 'users.id' , '=' , 'technical_units.user_id')
            ->leftjoin('type_users' , 'type_users.id' , '=' , 'users.type_id')
            ->leftjoin('statuses' , 'statuses.id' , '=' , 'technical_units.status')
        ->select('technical_units.id' , 'technical_units.title' , 'technical_units.manager', 'technical_units.user_id', 'technical_units.mobile', 'technical_units.created_at', 'statuses.title as status',
            DB::raw( '(CASE
            WHEN users.type_id = "1" THEN "کاربر فروشگاه"
            WHEN users.type_id = "3" THEN "کاربر تعمیرگاه"
            WHEN users.type_id = "4" THEN "کاربر عادی"
            END) AS type'))
            ->where('technical_units.status','=',1)
            ->get();

        $brands             = Brand::select('title_fa' , 'title_en' , 'abstract_title' , 'mobile' , 'created_at' , 'status' , 'id')->whereStatus(1)->latest()->get();
        $allbrands          = Brand::select('id' , 'title_fa')->get();
        $products           = Product::select('unicode' , 'title_fa')->get();
        $offers             = Offer::select('id','title_offer' , 'unicode_product' ,'product_name' , 'brand_id' , 'total' , 'buyorsell' , 'created_at' , 'user_id' , 'status')->whereStatus(1)->latest()->get();
        $statuses           = Status::select('id' , 'title')->get();
        $users              = User::leftjoin('type_users' , 'type_users.id' , '=' , 'users.type_id')
            ->select('users.id','users.name', 'users.type_id','users.phone' , 'users.created_at' , 'type_users.title as type_title',
                DB::raw( '(CASE
            WHEN users.status = "0" THEN "غیر فعال"
            WHEN users.status = "1" THEN "ثبت نام اولیه"
            WHEN users.status = "2" THEN "تایید مدیر"
            END) AS status'))
            ->orderBy('id' , 'DESC')
            ->get();
        $menudashboards     = Menudashboard::whereStatus(4)->get();
        $submenudashboards  = Submenudashboard::whereStatus(4)->get();
        $comments           = comment::whereApproved(0)->latest()->get();
        $commentrates       = commentrate::whereApproved(0)->latest()->get();

        $day = jdate()->getDay();
        $month = jdate()->getMonth();



        $dayvisitos  = Visitor::selectRaw('substring(datetime , 6,2 ) month , substring(datetime , 9,2 ) day, count(ip) publish')
            ->groupBy('day' , 'month')
            ->having('day' , '=', $day)
            ->having('month' , '=', $month)
            ->pluck('publish')->first();




        $monthvisits = Visitor::selectRaw('substring(datetime , 6,2 ) month , count(*) publish')
            ->groupBy('month')
            ->having('month' , '=', $month)
            ->pluck('publish')->first();

        $month = 12;

        $visitos = Visitor::selectRaw('substring(datetime , 6,2 ) month , count(*) publish')
            ->groupBy('month')
            ->pluck('publish');
        $visitors = $this->CheckCount($visitos , $month);

        $pievisitors = Visitor::selectRaw('page_id , count(*) publish')
            ->groupBy('page_id')
            ->pluck('publish');



        $lables = $this->getLastMonths($month);

        return view('Admin.panel.index')

            ->with(compact('offers'))
            ->with(compact('allbrands'))
            ->with(compact('products'))
            ->with(compact('categories'))
            ->with(compact('commentrates'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('dayvisitos'))
            ->with(compact('pievisitors'))
            ->with(compact('brands'))
            ->with(compact('statuses'))
            ->with(compact('visitors'))
            ->with(compact('technicalunits'))
            ->with(compact('suppliers'))
            ->with(compact('users'))
            ->with(compact('comments'))
            ->with(compact('countusers'))
            ->with(compact('monthvisits'))
            ->with(compact('lables'));
    }

    private function getLastMonths($month)
    {
        for ($i = 0 ; $i < $month ; $i++) {
            $labels[] = jdate(Carbon::now()->subMonths($i-1))->format('%B');
        }

        return array_reverse($labels);
    }

    private function CheckCount($count, $month)
    {
        for ($i = 0 ; $i < $month ; $i++) {
            $new[$i] = empty($count[$i]) ? 0 : $count[$i];
        }

        return ($new);
    }

}
