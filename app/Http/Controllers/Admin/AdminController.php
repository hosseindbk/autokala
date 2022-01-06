<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    protected function uploadImages($file)
    {
        $year = Carbon::now()->year;
        $imagePath = "images/stone/{$year}/";
        $orginalimageName = $file->getClientOriginalName();
        $filename = md5(uniqid(rand(), true)) . $orginalimageName;
        $file = $file->move($imagePath , $filename);

        $sizes = ["400" , "900"];
        $url['images'] = $this->resize($file->getRealPath() , $sizes , $imagePath , $filename);
        $url['thumb'] = $url['images'][$sizes[0]];
        $url['asli'] = $url['images'][$sizes[1]];

        return $url;
    }

    private function resize($path , $sizes , $imagePath , $filename)
    {
        $images['original'] = $imagePath . $filename;
        foreach ($sizes as $size) {
            $images[$size] = $imagePath . "{$size}_" . $filename;

            Image::make($path)->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->insert('images/admin/watermark.png', 'bottom')->save($images[$size]);
        }

        return $images;
    }
}
