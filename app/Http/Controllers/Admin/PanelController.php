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
        $typeusers          = Type_user::all();
        $suppliers          = Supplier::whereStatus(1)->latest()->get();
        $brands             = Brand::whereStatus(1)->latest()->get();
        $allbrands          = Brand::select('id' , 'title_fa')->get();
        $products           = Product::select('unicode' , 'title_fa')->get();
        $offers             = Offer::whereStatus(1)->latest()->get();
        $technicalunits     = Technical_unit::whereStatus(1)->get();
        $statuses           = Status::all();
        $users              = User::orderBy('id' , 'DESC')->get();
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
            ->with(compact('typeusers'))
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
