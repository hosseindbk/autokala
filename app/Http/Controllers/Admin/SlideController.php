<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\sliderequest;
use App\Menudashboard;
use App\Slide;
use App\Submenudashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class SlideController extends Controller
{

    public function index(Request $request)
    {
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();

        if ($request->ajax()) {
            $data = DB::table('slides')
                ->select('slides.id', 'slides.image' , 'slides.position' , 'slides.title' , 'slides.status')
                ->get();
            return Datatables::of($data)

                ->editColumn('id', function ($data) {
                    return ($data->id);
                })
                ->editColumn('title', function ($data) {
                    return ($data->title);
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == "0") {
                        return "عدم نمایش";
                    }
                    elseif ($data->status == "4") {
                        return "در حال نمایش";
                    }
                })
                ->editColumn('position', function ($data) {
                    if ($data->position == "1") {
                        return "اسلاید اصلی";
                    }
                    elseif ($data->position == "2") {
                        return "اسلاید چپ بالا";
                    }
                    elseif ($data->position == "3") {
                        return "اسلاید چپ پایین";
                    }
                })
                ->addColumn('image', function ($row) {
                    return '<img src="'.asset($row->image).'"  width="200" class="img-rounded" align="center" />';

                })

                ->addColumn('action', function($row){
                    $actionBtn = '<a href="' . route('slides.edit' , $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>
                                  <a href="' . route('slides.destroy' , $row->id)  .'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action' , 'image'])
                ->make(true);
        }

        return view('Admin.slides.all')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function create()
    {
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();

        return view('Admin.slides.create')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function store(sliderequest $request , Slide $slides)
    {
        $slides = new Slide();

        $slides->title      = $request->input('title');
        $slides->position   = $request->input('position');
        $slides->status     = 4;
        $slides->user_id    = Auth::user()->id;

        if ($request->file('image') != null) {

            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="images/slides/";
            $imageName = md5(uniqid(rand(), true)) .'.'. $file->clientExtension();
            $slides->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        $slides->save();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('slides.index'));
    }

    public function edit($id)
    {
        $slides             =   Slide::whereId($id)->get();
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();

        return view('Admin.slides.edit')
            ->with(compact('slides'))
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    public function update(Request $request , Slide  $slide)
    {
        $slide->title           = $request->input('title');
        $slide->position        = $request->input('position');
        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="images/slides/";
            $imageName = md5(uniqid(rand(), true)) .'.'. $file->clientExtension();
            $slide->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        $slide->update();
        return redirect(route('slides.index'));
    }

    public function destroy($id)
    {
        $slide = Slide::findOrfail($id);
        $slide->delete();
        return redirect(route('slides.index'));
    }

}
