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
@yield('main')

<footer class="footer-main-site">
    <section class="d-block d-xl-block d-lg-block d-md-block d-sm-block order-1">
        <div class="container-fluid">
            <div class="col-12">
                <div class="footer-middlebar">
                    <div class="col-lg-12 d-block pr">
                        <div class="footer-links">
                            <div class="col-lg-3 col-md-3 col-xs-12 pr">
                                <div class="row">
                                    <section class="footer-links-col">
                                        <div class="headline-links">
                                            <a href="#">
                                                راه های ارتباطی
                                            </a>
                                        </div>
                                        <ul class="footer-menu-ul">
                                            <li class="menu-item-type-custom">
                                                <a href="tel:{{$supplier->phone}}">
                                                تلفن ثابت :     {{$supplier->phone}}
                                                </a>
                                            </li>
                                            <li class="menu-item-type-custom">
                                                <a href="tel:{{$supplier->mobile}}">
                                                    تلفن همراه :   {{$supplier->mobile}}
                                                </a>
                                            </li>
                                            <li class="menu-item-type-custom">
                                                <a href="tel:{{$supplier->whatsapp}}">
                                                    شبکه اجتماعی :   {{$supplier->whatsapp}}
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
                                                آدرس
                                            </a>
                                        </div>
                                        <ul class="footer-menu-ul">
                                            <li class="menu-item-type-custom">
                                                <a href="#">
                                                   {{$supplier->address}}
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
                                                استان و شهرستان
                                            </a>
                                        </div>
                                        <ul class="footer-menu-ul">
                                            <li class="menu-item-type-custom">
                                                <a href="#">
                                                    {{$supplier->state_id}}
                                                    {{$supplier->city_id}}
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
                                                موقعیت نقشه
                                            </a>
                                        </div>
                                        <ul class="footer-menu-ul">
                                             <div id="app" style="width: 100%; height: 400px;"></div>
                                        </ul>
                                    </section>
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
