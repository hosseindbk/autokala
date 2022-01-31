<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\sliderequest;
use App\Menudashboard;
use App\Slide;
use App\Submenudashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class SlideController extends Controller
{

    public function index()
    {
        $slides             =   Slide::all();
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();

        return view('Admin.slides.all')
            ->with(compact('slides'))
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
