<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\mediarequest;
use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class MediaController extends Controller
{



    public function imgupload(mediarequest $request)
    {
        $medias = new Media();

        if ($request->file('files') != null) {
            $file = $request->file('files');
            $id   = $request->input('id');
            $img = Image::make($file);
            $imagePath ="images/product/$id";
            $imageName = md5(uniqid(rand(), true)) . $file->getClientOriginalName();
            $medias->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');

        }
        $medias->type       = $request->file('files')->getClientOriginalName();
        $table              = $request->input('table');
        $medias->$table     = $request->input('id');
        $medias->date       = jdate()->format('Ymd ');
        $medias->status     = '1';
        $medias->user_id    = Auth::user()->id;

        $medias->save();
        return Response::json(['success'=>true,'result'=>$medias]);

    }



    public function destroy($id)
    {
        $media = Media::findOrfail($id);
        $media->delete();
        alert()->success('عملیات موفق', 'اطلاعات با موفقیت پاک شد');
        return Redirect::back();
    }
}
