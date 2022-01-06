@extends('Admin.admin')
@section('title')
    <title> ویرایش کاربران</title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کاربران</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/users')}}"> مدیریت کاربران</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش کاربران</li>
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
                                        <h6 class="main-content-label text-center mb-5">ویرایش اطلاعات کاربران</h6>
                                    </div>

                                    <form action="{{ route('users.update', $user->id)}}" method="POST">
                                        {{csrf_field()}}
                                        {{ method_field('PATCH') }}
                                        <div class="row row-sm">
                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام کاربری</p>
                                                    <input type="text" name="username" data-required="1" value="{{$user->username}}" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">آدرس ایمیل</p>
                                                    <input type="text" name="email" data-required="1" value="{{$user->email}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mb-2">فعال/غیر فعال</p>
                                                    <label class="custom-switch">
                                                        @if($user->status == '0')
                                                            <input type="checkbox" name="status" class="custom-switch-input">
                                                        @elseif($user->status == '1')
                                                            <input type="checkbox" name="status" class="custom-switch-input" checked="">
                                                        @endif
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>

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
@endsection
@endsection
