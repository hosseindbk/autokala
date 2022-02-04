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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
                                                        <a href="{{url('login')}}" class="btn btn-outline-info"><b class="fa fa-user"></b> ورود به حساب کاربری </a>
                                                    </div>
                                                </div>
                                            @elseif(Auth::check())

                                                <div class="account-box" style="margin-left: 20px">
                                                    <div class="nav-account d-block pl">
                                                        <span class="icon-account">
                                                            <img src="{{asset('site/images/man.png')}}" class="avator">
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
                                                <div class="account-box">
                                                    <div class="nav-account d-block pl">
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><b class="fa fa-map-marker"></b>@if($countState && count($countState) > 1 && count($countState) < 10) {{count($countState)}} استان  @elseif($countState && count($countState) == 1) @foreach($countState as $state) استان {{$state->title}}  @endforeach @else  تمام استان ها @endif </button>
                                                    </div>
                                                </div>
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

@yield('main')

<footer class="footer-main-site">
    <section class="d-block d-xl-block d-lg-block d-md-block d-sm-block order-1">
        <div class="container-fluid">
            <div class="col-12">
                <div class="footer-middlebar">
                    <div class="col-lg-8 d-block pr">
                        <div class="footer-links">
                            <div class="col-lg-3 col-md-3 col-xs-12 pr">
                                <div class="row">
                                    <section class="footer-links-col">
                                        <div class="headline-links">
                                            <a href="#">
                                                منو اتوکالا
                                            </a>
                                        </div>
                                        <ul class="footer-menu-ul">
                                            @foreach($menus as $menu)
                                                <li class="menu-item-type-custom">
                                                    <a href="{{url($menu->slug)}}">
                                                        {{$menu->title}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </section>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-12 pr">
                                <div class="row">
                                    <section class="footer-links-col">
                                        <div class="headline-links">
                                            <a href="#">
                                                خدمات اتوکالا
                                            </a>
                                        </div>
                                        <ul class="footer-menu-ul">
                                            <li class="menu-item-type-custom">
                                                <a href="#">
                                                    امتیاز دهی کاربران
                                                </a>
                                            </li>
                                            <li class="menu-item-type-custom">
                                                <a href="#">
                                                    پرسش و پاسخ کاربران
                                                </a>
                                            </li>
                                            <li class="menu-item-type-custom">
                                                <a href="#">
                                                    شرایط استفاده
                                                </a>
                                            </li>
                                            <li class="menu-item-type-custom">
                                                <a href="#">
                                                    حریم خصوصی
                                                </a>
                                            </li>
                                        </ul>
                                    </section>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-12 pr">
                                <div class="row">
                                    <section class="footer-links-col">
                                        <div class="headline-links">
                                            <a href="#">
                                                راهنمای وبسایت اتوکالا
                                            </a>
                                        </div>
                                        <ul class="footer-menu-ul">
                                            <li class="menu-item-type-custom">
                                                <a href="#">
                                                    نحوه ثبت نام و عضویت
                                                </a>
                                            </li>
                                            <li class="menu-item-type-custom">
                                                <a href="#">
                                                    سطوح کاربری
                                                </a>
                                            </li>
                                            <li class="menu-item-type-custom">
                                                <a href="#">
                                                    شیوه های ثبت آگهی
                                                </a>
                                            </li>
                                        </ul>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-block pl">
                        <div class="shortcode-widget-area">
                            <form action="#" class="form-newsletter">
                                <fieldset>
                                        <span class="form-newsletter-title"> با عضویت در خبرنامه از آخرین اخبار و
                                            محصولات سایت مطلع شوید...</span>
                                    <div class="input-group-newsletter">
                                        <input type="email" class="input-field form-control"
                                               placeholder="آدرس ایمیل خود را وارد کنید">
                                        <button class="btn btn-info btn-secondary" type="submit">ارسال</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="footer-safety-partner">
                            <div class="widget widget-product card mb-0">
                                <div class="product-carousel-symbol owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                                            <div class="owl-item active" style="width: 300.75px; margin-left: 10px;">
                                                <div class="item">
                                                    <a href="#" class="d-block hover-img-link mt-0">
                                                        <img referrerpolicy='origin' id = 'nbqejzpefukzwlaofukzsizp' style = 'cursor:pointer;width: 100px;' onclick = 'window.open("https://logo.samandehi.ir/Verify.aspx?id=276469&p=uiwkjyoegvkaaodsgvkapfvl", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' alt = 'logo-samandehi' src = 'https://logo.samandehi.ir/logo.aspx?id=276469&p=odrfyndtwlbqshwlwlbqbsiy' />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-more-info">
                        <div class="footer-copyright">
                            <div class="footer-copyright-text">
                                <p>کلیه حقوق این وبسایت به اتوکالا نیک آراد (سامانه جامع قطعات و خدمات خودرو) تعلق دارد</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>

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
