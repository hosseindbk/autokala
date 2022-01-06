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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menudashboards     =   Menudashboard::whereStatus(4)->get();
        $submenudashboards  =   Submenudashboard::whereStatus(4)->get();

        return view('Admin.slides.create')
            ->with(compact('menudashboards'))
            ->with(compact('submenudashboards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(sliderequest $request , Slide $slides)
    {
        $slides = new Slide();

        $slides->title      = $request->input('title');
        $slides->position   = $request->input('position');
        $slides->status     = 1;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::findOrfail($id);
        $slide->delete();
        return redirect(route('slides.index'));
    }

}
