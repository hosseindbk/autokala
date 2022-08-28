@extends('Admin.admin')
@section('title')
    <title> ویرایش کاربران سایت</title>
    <link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/sumoselect/sumoselect-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css-rtl/colors/default.css')}}" rel="stylesheet">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کاربران سایت</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/siteusers')}}"> مدیریت کاربران سایت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش کاربران سایت</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            @foreach($users as $user)
                                <div class="card-body">
                                    <div>
                                        <h6 class="main-content-label text-center mb-5">ویرایش اطلاعات کاربران سایت</h6>
                                    </div>

                                    <form action="{{ route('siteusers.update', $user->id)}}" method="POST">
                                        {{csrf_field()}}
                                        {{ method_field('PATCH') }}
                                        <div class="row row-sm">
                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام و نام خانوادگی</p>
                                                    <input type="text" name="name" data-required="1" value="{{$user->name}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب وضعیت کاربر</p>
                                                    <select name="type_id" class="form-control select-lg select2">
                                                        @foreach($typeusers as $type_user)
                                                                <option value="{{$type_user->id}}" {{$user->type_id == $type_user->id ? 'selected' : ''}}>{{$type_user->title}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">وضعیت شماره کاربر</p>
                                                    <select name="phone_verify" class="form-control select-lg select2">
                                                        <option value="0" {{$user->phone_verify == 0 ? 'selected' : ''}}>عدم تایید شماره</option>
                                                        <option value="1" {{$user->phone_verify == 1 ? 'selected' : ''}}> تایید شماره</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                            <p class="mg-b-10">انتخاب استان<span style="color: #ff3d00">*</span></p>
                                                            <select name="state_id" class="form-control select2" id="state_id">
                                                                @foreach($states as $state)
                                                                    <option value="{{$state->id}}" {{$state->id == Auth::user()->state_id ? 'selected' : ''}}>{{$state->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                                                                        <div class="form-group">
                                                            <p class="mg-b-10">انتخاب شهرستان<span style="color: #ff3d00">*</span></p>
                                                            <select name="city_id" class="form-control select2" id="city_id">
                                                                @foreach($cities as $city)
                                                                    <option value="{{$city->id}}" {{$city->id == Auth::user()->city_id ? 'selected' : ''}}>{{$city->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">آدرس ایمیل</p>
                                                    <input type="text" name="email" value="{{$user->email}}" id="mail" class="form-control" />
                                                </div>

                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب وضعیت کاربر</p>
                                                    <select name="status" class="form-control select-lg select2">
                                                        @if($user->status == 1)
                                                            <option value="1">در حال بررسی </option>
                                                            <option value="2">تایید </option>
                                                        @elseif($user->status == 2)
                                                            <option value="2">تایید </option>
                                                            <option value="1">در حال بررسی</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-account-title">
                                                    <label>رمز عبور</label>
                                                    <input type="password" id="pass" name="password"  autocomplete="new-password" class="form-control" />
                                                    <i class="fa fa-eye-slash" style="float: left;margin-top: -25px;margin-left: 15px;" onclick="togglePassword()"></i>

                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">شماره موبایل</p>
                                                    <input type="text" name="phone" value="{{$user->phone}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">تلفن ثابت</p>
                                                    <input type="text" name="phone_number" value="{{$user->phone_number}}" class="form-control" />
                                                </div>
                                                <div class="form-account-title">
                                                    <label>تکرار رمز عبور</label>
                                                    <input type="password" name="password_confirmation" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mg-b-10 text-center">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@section('end')
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>
    <script type="text/javascript">
        function togglePassword(){
            x = document.getElementById("togglePassword")
            y = document.getElementById("pass")
            if (y.type ==="password") {
                y.type = 'text';
            } else{
                y.type="password";
                y.innerHTML = "Show"
            }
        }
    </script>

@endsection

