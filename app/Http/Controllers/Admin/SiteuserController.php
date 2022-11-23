<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Menudashboard;
use App\Submenudashboard;
use App\Type_user;
use App\User;
use App\State;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class SiteuserController extends Controller
{

    public function index(Request $request)
    {
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        if ($request->ajax()) {
            $data = DB::table('users')->LeftJoin('type_users', 'type_users.id', '=', 'users.type_id')
                ->leftjoin('states' , 'states.id' , '=' , 'users.state_id')
                ->leftjoin('cities' , 'cities.id' , '=' , 'users.city_id')
                ->select('users.name as username' , 'users.id as userid' , 'users.phone as userphone'
                    , 'users.phone_verify as userphoneverify' , 'users.status as userstatus' , 'users.created_at as usercreated' ,'states.title as statename','cities.title as cityname' , 'type_users.title as typetitle')
                ->where('users.level','=',null)
                ->orderBy('users.id', 'desc')
                ->get();
            return Datatables::of($data)

                    ->editColumn('cityname', function ($data) {
                        return ($data->cityname);
                    })
                 ->editColumn('statename', function ($data) {
                        return ($data->statename);
                    })
                 ->editColumn('userid', function ($data) {
                        return ($data->userid);
                    })
                ->editColumn('username', function ($data) {
                        return ($data->username);
                    })
                    ->editColumn('userphone', function ($data) {
                        return ($data->userphone);
                    })
                    ->editColumn('typetitle', function ($data) {
                        return ($data->typetitle);
                    })
                    ->editColumn('usercreated', function ($data) {
                        return \Morilog\Jalali\Jalalian::forge($data->usercreated)->format('%Y/%m/%d');
                    })
                    ->editColumn('userphoneverify', function ($data) {
                        if ($data->userphoneverify == "0") {
                            return "تایید نشده";
                        }
                        elseif ($data->userphoneverify == "1") {
                            return "تایید شده";
                        }
                    })
                    ->editColumn('userstatus', function ($data) {
                        if ($data->userstatus == "0") {
                            return "غیر فعال";
                        }
                        elseif ($data->userstatus == "1") {
                            return "ثبت نام اولیه";
                        }
                        elseif ($data->userstatus == "2") {
                            return "تایید مدیر";
                        }
                    })
                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="' . route('siteusers.edit', $row->userid) . '" class="btn ripple btn-outline-info btn-sm">Edit</a>
                                <form action="' . route('deleteuser' ,$row->userid) .'" method="post" style="display: inline;">
                                    '.csrf_field().'
                                    '.method_field("DELETE").'
                                         <button type="submit" class="btn ripple btn-outline-danger btn-sm">
                                             <i class="fe fe-trash-2 "></i>
                                         </button>
                                </form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.siteusers.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));

    }

    public function edit($id)
    {
        $users = User::whereId($id)->get();
        $typeusers = Type_user::all();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();
        $states = State::all();
        $cities= City::all();

        return view('Admin.siteusers.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('typeusers'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('users'));
    }

    public function update(Request $request , $user)
    {
        $user = User::findOrfail($user);
        $user->name         = $request->input('name');
        $user->type_id      = $request->input('type_id');
        $user->status       = $request->input('status');
        $user->state_status = $request->input('state_status');
        $user->phone        = $request->input('phone');
        $user->state_id     = $request->input('state_id');
        $user->city_id      = $request->input('city_id');
        $user->phone_verify = $request->input('phone_verify');
        $user->phone_number = $request->input('phone_number');
        $user->email        = $request->input('email');
        if ($request->input('password') != null) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->update();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('siteusers.index'));
    }


    public function destroy($id)
    {

    }
    public function deleteuser($id)
    {
        User::findOrfail($id)->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return back();
    }
}
