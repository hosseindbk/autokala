@extends('master-main')
@section('title')
<title>فرم اطلاعات پروفایل کاربری اتوکالا</title>
<link rel="stylesheet" href="{{asset('site/css/mapp.min.css')}}">
<link rel="stylesheet" href="{{asset('site/css/fa/style.css')}}" data-locale="true">
<link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('main')
<div class="nav-categories-overlay"></div>
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

                                        @if(! Auth::user()->image)
                                        <img src="{{asset('site/images/man.png')}}">
                                        @else
                                            <img src="{{Auth::user()->image}}" alt="">
                                        @endif
                                    </div>
                                </header>
                                <footer class="profile-box-content-footer">
                                    <span class="profile-box-nameuser">{{Auth::user()->name}}</span>
                                    <span class="profile-box-registery-date">به وبسایت اتوکالا خوش آمدید </span>
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
                                            <a href="{{url('profile-user')}}" class="active"><i class="mdi mdi-account-outline"></i>
                                                حساب کاربری
                                            </a>
                                        </li>
                                        @if(Auth::user()->type_id == 1 || Auth::user()->type_id == 3 )
                                            <li class="profile-account-nav-item navigation-link-dashboard">
                                                <a href="{{url('profile-business')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                    حساب کسب و کار
                                                </a>
                                            </li>
                                        @endif
                                        <li class="profile-account-nav-item navigation-link-dashboard">
                                            <a href="{{url('profile-info')}}" class=""><i class="mdi mdi-tooltip-text-outline"></i>
                                                اطلاعات حساب
                                            </a>
                                        </li>
                                        <li class="profile-account-nav-item navigation-link-dashboard">
                                            <a href="{{url('offer')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                فرم آگهی
                                            </a>
                                        </li>
                                        @if(Auth::user()->type_id != 4)

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
                                                <div class="text-center"><h3 class="main-content-label text-center text-info">ثبت اطلاعات کاربری </h3></div>
                                            </div>
                                            <form action="{{route('profile_user_update' , Auth::user()->id)}}" method="post" class="form-checkout" enctype="multipart/form-data">
                                                {{method_field('patch')}}
                                                @csrf
                                                <div class="row row-sm">
                                                    <div class="col-md-12">
                                                        @include('error')
                                                    </div>
                                                    <div class="col-md-12" >
                                                        <h4 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin: 20px 0px;">مشخصات فردی</h4>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10"> نام و نام خانوادگی<span style="color: #ff3d00">*</span></p>
                                                            <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">شماره موبایل<span style="color: #ff3d00">*</span></p>
                                                            <input type="text" name="phone" disabled value="{{Auth::user()->phone}}" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">شماره ثابت<span style="color: #ff3d00">*</span></p>
                                                            <input type="text" name="phone_number" value="{{Auth::user()->phone_number}}" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">آدرس ایمیل<span style="color: #ff3d00">*</span></p>
                                                            <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">انتخاب استان<span style="color: #ff3d00">*</span></p>
                                                            <select name="state_id" class="form-control select2" id="state_id">
                                                                @foreach($states as $state)
                                                                    <option value="{{$state->id}}" {{$state->id == Auth::user()->state_id ? 'selected' : ''}}>{{$state->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
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
                                                            <p class="mg-b-10">تصویر کاربر</p>
                                                            <input type="file" name="image" class="dropify" data-height="200">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">آدرس<span style="color: #ff3d00">*</span></p>
                                                            <textarea name="address" id="address" class="form-control" cols="30" rows="8">{{Auth::user()->address}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <p class="mg-b-10">موقعیت مکانی خود را با کلیک بر روی نقشه انتخاب نمایید</p>
                                                        <div id="app" style="width: 100%; height: 325px;"></div>
                                                    </div>

                                                </div>
                                                <div class="col-lg-12 mg-b-10 text-center">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
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
    <script  src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('site/js/mapp.env.js')}}"></script>
    <script src="{{asset('site/js/mapp.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var crosshairIcon = {
                iconUrl: '{{asset('site/assets/images/icon-marker.svg')}}',
                iconSize:     [40, 50], // size of the icon
                iconAnchor:   [20, 55], // point of the icon which will correspond to marker's location
            };
            var app = new Mapp({
                element: '#app',
                    @if(Auth::user()->lat == '' && Auth::user()->lng == '')
                presets: {
                    latlng: {
                        lat: 35.73249,
                        lng: 51.42268,
                    },
                    zoom: 14
                },
                @else
                presets: {
                    latlng: {
                        lat: {{Auth::user()->lat}},
                        lng: {{Auth::user()->lng}},
                    },
                    icon: crosshairIcon,
                    zoom: 20,
                    popup: {
                        title: {
                            i18n: 'موقعیت مکانی',
                        },
                        description: {
                            i18n: 'توضیحات',
                        },
                        class: 'marker-class',
                        open: false,

                    },
                },
                @endif
                apiKey: "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI0OTE4ZjYzNjQ0ZmUxNTNjMWNiY2Y1NzcyNTJlOTkzNGNkZWZhMmQyM2ZhZjBjMzdkOWViNmUzZDgyYjJmMGQ4ZjU1MDY1ZjgyY2EyNWE2In0.eyJhdWQiOiIxNTQ5NCIsImp0aSI6IjI0OTE4ZjYzNjQ0ZmUxNTNjMWNiY2Y1NzcyNTJlOTkzNGNkZWZhMmQyM2ZhZjBjMzdkOWViNmUzZDgyYjJmMGQ4ZjU1MDY1ZjgyY2EyNWE2IiwiaWF0IjoxNjMxNzc5MjQ0LCJuYmYiOjE2MzE3NzkyNDQsImV4cCI6MTYzNDQ2MTI0NCwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.VsRI2wiG_IvFVkVKXt_XnOBpzyjMIygnv6s_s81u9WVC_Z-stANinKYH_6iJPuJ3lRdAX8SdtHwYCr2DZVF2hi6WiTu-BSvMuXPb6sg0iYXgYREKQjzsWU4NPf2kOwd4q6aj1R6UOT_EA7GIrJQ5FPYDceAmeT8va1VdK6xYp-Ypstja-clURippQKEk0mDe9Z_ABYWQNAWfqUt_ubYEZrETjnDoSQHbJxJc46vxWvYmwoK1sIZ4NoXaQbRrAb0QKZ_7Lnh3H3_vHqQGMB0vJELzwSJEmiNxr_h7uIvugtRAUneAa878lOJuv03976YNjIoepK_aWhxzrP-RmE4O5A",
            });
            app.addLayers();
            app.addZoomControls();
            app.addGeolocation({
                history: false,
                onLoad: false,
                onLoadCallback: function(){
                    console.log(app.states.user.latlng);
                },
            });
            app.addLogo({
                url: '{{asset('site/images/maplogo.png')}}',
            });

            @if(Auth::user()->lat != '' && Auth::user()->lng != '')

            app.markReverseGeocode({
                state: {
                    latlng: {
                        lat: {{Auth::user()->lat}},
                        lng: {{Auth::user()->lng}},
                    },
                    zoom: 14,
                    icon: crosshairIcon,
                },
            });
            @endif

            app.map.on('click', function (e) {

                var marker = app.addMarker({
                    name: 'advanced-marker',
                    latlng: {
                        lat: e.latlng.lat,
                        lng: e.latlng.lng,
                    },
                    icon: crosshairIcon,
                    popup: {
                        title: {
                            i18n: 'موقعیت مکانی',
                        },
                        description: {
                            i18n: 'توضیحات',
                        },
                        class: 'marker-class',
                        open: false,
                    },
                });
                $.ajax({
                    url: '{{ route( 'usermap' ) }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "_token": "{{ csrf_token() }}",
                        lat     : e.latlng.lat,
                        lng     : e.latlng.lng,
                        'id'    :{{Auth::user()->id}},
                    },
                    type: 'patch',
                    dataType: 'json',
                }).done(function (data) {
                    console.log(data);
                });
            })
        });
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
@endsection
