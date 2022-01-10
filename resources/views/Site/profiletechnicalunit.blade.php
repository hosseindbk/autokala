@extends('master-main')
@section('title')
    <title>پروفایل اطلاعات واحد خدمات فنی</title>
    <link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    <div class="container-main">
        @include('sweet::alert')
        <div class="d-block">
            <section class="profile-home">
                <div class="col-lg">
                    <div class="post-item-profile order-1 d-block">
                        <div class="col-lg-3 col-md-3 col-xs-12 pr">
                            <div class="sidebar-profile sidebar-navigation">
                                <section class="profile-box">
                                    <header class="profile-box-header-inline">
                                        <div class="profile-avatar user-avatar profile-img">
                                            <img src="{{asset('site/images/man.png')}}">
                                        </div>
                                    </header>
                                    <footer class="profile-box-content-footer">
                                        <span class="profile-box-nameuser">{{Auth::user()->name}}</span>
                                        <span class="profile-box-registery-date">عضویت به عنوان واحد خدمات فنی </span>
                                        <span class="profile-box-phone">شماره همراه : {{Auth::user()->phone}}</span>
                                        <div class="profile-box-tabs">
                                            <a href="{{url('logout')}}" class="profile-box-tab-sign-out"><i class="mdi mdi-logout-variant"></i>خروج از حساب</a>
                                        </div>
                                    </footer>
                                </section>
                                <section class="profile-box">
                                    <ul class="profile-account-navs">
                                        @if(Auth::user()->phone_verify == 1)
                                            <li class="profile-account-nav-item navigation-link-dashboard">
                                                <a href="{{url('profile-user')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                    حساب کاربری
                                                </a>
                                            </li>
                                            @if(Auth::user()->type_id == 1 || Auth::user()->type_id == 3 )
                                                <li class="profile-account-nav-item navigation-link-dashboard">
                                                    <a href="{{url('profile-business')}}" class="active"><i class="mdi mdi-account-outline"></i>
                                                        حساب کسب و کار
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="profile-account-nav-item navigation-link-dashboard">
                                                <a href="{{url('profile-info')}}" class=""><i class="mdi mdi-tooltip-text-outline"></i>
                                                    اطلاعات حساب
                                                </a>
                                            </li>
                                            @if(Auth::user()->phone_verify == 1 && Auth::user()->type_id != 4)
                                                <li class="profile-account-nav-item navigation-link-dashboard">
                                                    <a href="{{url('offer')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                        فرم آگهی
                                                    </a>
                                                </li>
                                                <li class="profile-account-nav-item navigation-link-dashboard">
                                                    <a href="{{url('brand-create')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                        فرم برند قطعات
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                </section>

                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-xs-12 pl">
                            <div class="profile-content">
                                <div class="profile-stats">
                                    <div class="profile-address">
                                        <div class="middle-container">
                                            <div class="card-body">
                                                <div class="text-center"><h3 class="main-content-label text-center text-info">ثبت مشخصات تعمیرگاه / خدمات فنی </h3></div>
                                            </div>
                                            <form action="{{ route('profiletechnicalstore')}}" method="POST" enctype="multipart/form-data">
                                                <div class="row row-sm">
                                                    {{csrf_field()}}
                                                    <div class="col-md-12">
                                                        @include('error')
                                                    </div>

                                                    <div class="col-md-12" >
                                                        <h4 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin: 20px 0px;">مشخصات تعمیرگاه / خدمات فنی</h4>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">نام تعمیرگاه</p>
                                                            <input type="text" name="title" placeholder="نام تعمیرگاه را وارد کنید" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">نام مدیر</p>
                                                            <input type="text" name="manager" value="{{Auth::user()->name}}" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">اطلاعات تکمیلی</p>
                                                            <textarea name="description" id="editor" placeholder="خلاصه ای از سوابق و مزایای صنفی خود را تایپ نمایید"></textarea>
                                                            <style>
                                                                .ck-editor{
                                                                    direction: rtl;
                                                                    text-align: right;
                                                                }
                                                            </style>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">تصویر اصلی تعمیرگاه </p>
                                                            <input type="file" name="image" class="dropify" data-height="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">تصویر دوم تعمیرگاه </p>
                                                            <input type="file" name="image2" class="dropify" data-height="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">تصویر سوم تعمیرگاه </p>
                                                            <input type="file" name="image3" class="dropify" data-height="200">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12" >
                                                        <h4 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">مشخصات تماس</h4>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">انتخاب استان</p>
                                                            <select name="state_id" class="form-control select-lg select2" id="state_id">
                                                                <option value="">انتخاب استان</option>
                                                                @foreach($states as $state)
                                                                    <option value="{{$state->id}}" {{Auth::user()->state_id == $state->id ? 'selected' : ''}}>{{$state->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">انتخاب شهرستان</p>
                                                            <select name="city_id" id="city_id" class="form-control select-lg select2">
                                                                <option value="">انتخاب شهرستان</option>
                                                                @foreach($cities as $city)
                                                                    <option value="">انتخاب شهرستان</option>
                                                                    <option value="{{$city->id}}" {{Auth::user()->city_id == $city->id ? 'selected' : ''}}>{{$city->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">تلفن موبایل</p>
                                                            <input type="text" name="mobile" value="{{Auth::user()->phone}}" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">تلفن ثابت</p>
                                                            <input type="text" name="phone" value="{{Auth::user()->phone_number}}" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">شماره واتس اپ</p>
                                                        <input type="text" name="whatsapp" placeholder="شماره واتس اپ را وارد کنید" class="form-control" />
                                                    </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">آدرس</p>
                                                            <textarea name="address" cols="30" rows="1" class="form-control" placeholder="آدرس را وارد کنید">{{Auth::user()->address}}</textarea>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
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
    <script src="{{asset('admin/assets/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        $(function(){
            $('#state_id').change(function(){
                $("#city_id option").remove();
                var id = $('#state_id').val();

                $.ajax({
                    url : '{{ route( 'state' ) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function( result )
                    {
                        $.each( result, function(k, v) {
                            $('#city_id').append($('<option>', {value:k, text:v}));
                        });
                    },
                    error: function()
                    {
                        //handle errors
                        alert('error...');
                    }
                });
            });
        });
    </script>
    <script>
        $(function(){
            $('#car_brand_id').change(function(){
                $("#car_model_id option").remove();
                var id = $('#car_brand_id').val();
                $.ajax({
                    url : '{{ route( 'modeloption' ) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function( result )
                    {
                        $.each( result, function(k, v) {
                            $('#car_model_id').append($('<option>', {value:k, text:v}));
                        });
                    },
                    error: function()
                    {
                        alert('error...');
                    }
                });
            });
        });
    </script>
@endsection
