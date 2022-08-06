<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')

    <link rel="stylesheet" href="{{asset('site/css/vendor/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/materialdesignicons.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/jquery.jqZoom.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/sweetalert.css')}}">
    <script src="{{asset('site/js/sweetalert.min.js')}}"></script>
    <link rel="icon" type="image/x-icon" href="{{asset('site/images/favicon.png')}}">

    <meta name="description" content="اتوکالا سامانه جامع قطعات خودرو و ماشین آلات راهسازی کشاورزی فروشگاهای لوازم یدکی ، نزدیکترین تعمیرگاه ، برندهای قطعات خودرو مشخصات فنی لوازم یدکی خودرو لیست تامین کنندگان تولیدکنندگان واردکنندگان صادرکنندگان لوازم اتومبیل ماشین آلات راهسازی کشاورزی">
    <meta name="keywords" content="@foreach($menus as $menu) @if(count(Request::segments()) <= 1) @if($menu->keycheck == Request::segment(1)) {{$menu->keyword}} @endif @endif @endforeach">
    <meta name="author" content="Bestagroup">

</head>

<body>
<header class="header-main">
    <div class="container-main">
        <div class="d-block">
            @yield('top-header')
            <div>
                <nav class="header-main-nav">
                    <div class="d-block">


                        <div class="align-items-center">
                            <ul class="menu-ul mega-menu-level-one">
                                @foreach($menus as $menu)
                                <li  class="menu-item active">
                                    <a href="{{url($menu->slug)}}" class="current-link-menu">
                                        {{$menu->title}}
                                    </a>
                                </li>
                                @endforeach
                                <div class="col-lg-3 pl">
                                    <div class="header-account text-left">
                                        <div class="d-block">


                                            @if(! Auth::check())
                                                <div class="account-box">
                                                    <div class="nav-account d-block pl">
                                                        <a href="{{url('login')}}" class="btn btn-outline-info"><b class="fa fa-user"></b> ورود به حساب </a>
                                                    </div>
                                                </div>
                                            @elseif(Auth::check())

                                                <div class="account-box" style="margin-left: 20px">
                                                    <div class="nav-account d-block pl">
                                                         <span class="icon-account">
                                                            @if(Auth::user()->image)
                                                                 <img src="{{asset(Auth::user()->image)}}" class="avator">
                                                             @else
                                                                 <img src="{{asset('site/images/man.png')}}" class="avator">
                                                             @endif
                                                        </span>
                                                        <span class="title-account">{{Auth::user()->name}}</span>
                                                        <div class="dropdown-menu">
                                                            <ul class="account-uls mb-0">
                                                                <li class="account-item">
                                                                    <a href="{{url('profile-user')}}" class="account-link">تنظیمات حساب</a>
                                                                </li>
                                                                <li class="account-item">
                                                                    <a href="{{url('logout')}}" class="account-link">خروج</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                                @if(Request::segment(1) == 'supplier' ||Request::segment(1) == 'market' || Request::segment(1) == 'technical' || Request::segment(1) == null)
                                                    <div class="account-box">
                                                        <div class="nav-account d-block pl">
                                                            <select name="state_id" class="form-control select2" id="state_filter">
                                                                @foreach($states as $state)
                                                                    @if(auth::check() && auth::user()->state_status == 1)
                                                                        <option value="{{$state->id}}" @if(request('state_id') != null) {{request('state_id') == $state->id ? 'selected' : ''}} @else {{Auth::user()->state_id == $state->id ? 'selected' : ''}} @endif>{{$state->title}} </option>
                                                                    @elseif(auth::check()&& auth::user()->state_status != 1)
                                                                        <option value="{{$state->id}}" {{Auth::user()->state_id == $state->id ? 'selected' : 'disabled="disabled"'}}>{{$state->title}}</option>
                                                                    @elseif(!auth::check())
                                                                        <option value="{{$state->id}}" {{ $state->id == 8 ? 'selected' : 'disabled'}}  >{{$state->title}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <div class="align-items-center">
                            @if(auth::check() && auth::user()->phone_verify == 0)
                                <div class="alert alert-danger text-right" role="alert">
                                    شماره موبایل شما هنوز تایید نشده است لطفا جهت تایید شماره تلفن <a href="{{route('setphone') , auth::user()->phone}}">کلیک</a> نمایید
                                </div>
                            @endif
                        </div>
                        <nav class="sidebar">
                            <div class="nav-header">
                                <div class="header-cover"></div>
                                <div class="logo-wrap">
                                    <a class="logo-icon" href="#"><img alt="logo-icon" src="{{asset('site/images/logo.png')}}" style="width: 50px;"></a>
                                </div>
                            </div>
                            <ul class="nav-categories ul-base">
                                @foreach($menus as $menu)
                                    <li><a href="{{url($menu->slug)}}">{{$menu->title}}</a></li>
                                @endforeach
                            </ul>
                        </nav>
                        <div class="nav-btn nav-slider">
                            <span class="linee1"></span>
                            <span class="linee2"></span>
                            <span class="linee3"></span>
                        </div>
                        <div class="overlay"></div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="nav-categories-overlay"></div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">استان مورد نظر خود را انتخاب نمایید</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">

                    @foreach($states as $state)
                        <div class="col-md-4 col-sm-12">
                            <button type="button" class="btn btn-outline-secondary" style="width: 80%;margin: 10px 25px">{{$state->title}}</button>
                            <input type="text" name="state" value="{{$state->title}}">
                        </div>
                    @endforeach
            </div>
            <div class="modal-footer" style=" align-items: center !important; justify-content: center; ">
                <button type="button" class="btn btn-primary" style="margin: 0 20px">تایید استان</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin: 0 20px">بازگشت</button>
            </div>
        </div>
    </div>
</div>

@yield('main')

@yield('footer')
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>

{{--<div class="P-loader">--}}
{{--    <div class="P-loader-content">--}}
{{--        <div class="logo-loader">--}}
{{--            <img src="{{asset('site/images/logo_load.png')}}" alt="logo">--}}
{{--        </div>--}}
{{--        <div class="pic-loader text-center">--}}
{{--            <img src="{{asset('site/images/three-dots.svg')}}" width="50" alt="">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<script src="{{asset('site/js/vendor/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('site/js/vendor/bootstrap.js')}}"></script>
<script src="{{asset('site/js/vendor/owl.carousel.min.js')}}"></script>
<script src="{{asset('site/js/vendor/jquery.countdown.js')}}"></script>
<script src="{{asset('site/js/vendor/ResizeSensor.min.js')}}"></script>
<script src="{{asset('site/js/vendor/theia-sticky-sidebar.min.js')}}"></script>
<script src="{{asset('site/js/vendor/wNumb.js')}}"></script>
<script src="{{asset('site/js/vendor/nouislider.min.js')}}"></script>
<script src="{{asset('site/js/vendor/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('site/js/vendor/lightgallery-all.js')}}"></script>
<script src="{{asset('site/js/vendor/jquery.jqZoom.js')}}"></script>
<script src="{{asset('site/js/vendor/jquery.ez-plus.js')}}"></script>
<script src="{{asset('site/js/vendor/sweetalert.min.js')}}"></script>
<script src="{{asset('site/js/main.js')}}"></script>
@yield('script')


<script>
    window.onscroll = function() {

        var doc = document.documentElement;
        var width = window.innerWidth;
        var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
        if (top > 120 && width > 768) {
            jQuery(".header-main-nav").css('position', 'fixed');
        }
        if (top < 120 && width > 768) {
            jQuery(".header-main-nav").css('position', 'relative');
        }
    }
</script>
</body>
</html>
