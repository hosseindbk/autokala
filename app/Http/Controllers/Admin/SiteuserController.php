<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Menudashboard;
use App\Submenudashboard;
use App\Type_user;
use App\User;
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
                ->select('users.name as username' , 'users.id as userid' , 'users.phone as userphone'
                    , 'users.phone_verify as userphoneverify' , 'users.status as userstatus' , 'users.created_at as usercreated' , 'type_users.title as typetitle')
                ->where('users.level','=',null)
                ->orderBy('users.id', 'desc')
                ->get();
            return Datatables::of($data)

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
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Admin.siteusers.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
        /*if ($request->ajax()) {
            $datas = DB::table('users')->LeftJoin('type_users', 'type_users.id', '=', 'users.type_id')
                ->select('users.name as username' , 'users.id as userid' , 'users.phone as userphone'
                    , 'users.phone_verify as userphoneverify' , 'users.status as userstatus' , 'users.created_at as usercreated' , 'type_users.title as typetitle')
                ->where('users.level','=',null)
                ->orderBy('users.id', 'desc')
                ->get();
            return Datatables::of($datas)

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
                    return \Morilog\Jalali\Jalalian::forge($data->usercreated)->format(' H:i:s %Y/%m/%d');
                })
                ->editColumn('userphoneverify', function ($data) {
                    if ($data->userphoneverify == "0") {
                        return "تایید نشده";
                    }
                    elseif ($data->ticket_type == "1") {
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
                ->addIndexColumn()
                ->make(true);

            }*/

    }

    public function edit($id)
    {
        $users = User::whereId($id)->get();
        $typeusers = Type_user::all();
        $menudashboards = Menudashboard::whereStatus(4)->get();
        $submenudashboards = Submenudashboard::whereStatus(4)->get();

        return view('Admin.siteusers.edit')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'))
            ->with(compact('typeusers'))
            ->with(compact('users'));
    }

    public function update(Request $request , $user)
    {
        $user = User::findOrfail($user);
        $user->name         = $request->input('name');
        $user->type_id      = $request->input('type_id');
        $user->status       = $request->input('status');
        $user->phone        = $request->input('phone');
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


    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return back();
    }
}
