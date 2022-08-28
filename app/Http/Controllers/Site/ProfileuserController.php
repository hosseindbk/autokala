<?php

namespace App\Http\Controllers\Site;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\profileuserrequest;
use App\Menu;
use App\State;
use App\Type_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class ProfileuserController extends Controller
{
    public function index(){
        $menus          = Menu::whereStatus(4)->get();
        $typeusers      = Type_user::orderBy('id' , 'DESC')->get();
        $states         = State::all();
        $cities         = City::all();

        return view('Site.profileuser')
            ->with(compact('menus'))
            ->with(compact('states'))
            ->with(compact('cities'))
            ->with(compact('typeusers'));
    }

    public function setmapuser($id){
        $menus              = Menu::whereStatus(4)->get();
        $suppliers          = User::whereId($id)->get();
        $states             = State::all();
        $cities             = city::all();

        return view('Site.setmapuser')
            ->with(compact('suppliers' , 'menus' , 'states' , 'cities'))
            ->with('id' , $id);
    }

    public function usermapset(Request $request)
    {
        $usermap               = User::findOrfail($request->input('id'));
        $usermap->lat          = $request->input('lat');
        $usermap->lng          = $request->input('lng');

        $usermap->update();
        return Redirect::back();
    }

    public function update(profileuserrequest $request,$id)
    {

        $user               = User::findOrfail($id);

        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->address      = $request->input('address');
        $user->state_id     = $request->input('state_id');
        $user->city_id      = $request->input('city_id');
        if ($request->input('lat') != null) {
            $user->lat = $request->input('lat');
        }
        if ($request->input('lng') != null) {
            $user->lng = $request->input('lng');
        }
        $user->status       = 0;


        if ($request->file('image') != null) {
            $file = $request->file('image');
            $img = Image::make($file);
            $imagePath ="image/user/";
            $imageName = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true)) . '.jpg';
            $user->image = $file->move($imagePath, $imageName);
            $img->save($imagePath.$imageName);
            $img->encode('jpg');
        }

        $user->update();

        alert()->success('عملیات موفق', 'اطلاعات با موفقیت ثبت شد');
        return redirect(route('profile-info'));
    }

    public function option(Request $request){
        $cities = City::whereState_id($request->input('id'))->get();
        $output = [];

        foreach($cities as $City )
        {
            $output[$City->id] = $City->title;
        }
        return $output;
    }
}
