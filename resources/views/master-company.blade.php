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
    <link rel="stylesheet" href="{{asset('site/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/bootstrap-slider.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/mapp.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/fa/style.css')}}" data-locale="true">

    <meta name="description" content="@foreach($suppliers as $supplier){!! $supplier->description !!}@endforeach">
    <meta name="keywords" content="@foreach($menus as $menu) @if(count(Request::segments()) <= 1) @if($menu->keycheck == Request::segment(1)) {{$menu->keyword}} @endif @endif @endforeach">
    <meta name="author" content="Bestagroup">
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
                            <div class="col-lg-4 col-md-4 col-xs-12 pr">
                                <div class="row">
                                    <section class="footer-links-col">
                                        <div class="headline-links">
                                            <a href="#">
                                                راه های ارتباطی
                                            </a>
                                        </div>
                                        <div class="post-content" style="">
                                            <i class="fa fa-phone" style="color: #0cc745" ></i>
                                            <a href="Tel:{{$supplier->phone}}" style="color: #716f6f;font-size: 20px" target="_blank">{{$supplier->phone}}</a> - <a href="Tel:{{$supplier->phone}}" target="_blank" style="color: #716f6f;font-size: 20px">{{$supplier->phone}}</a>
                                        </div>
                                        <div class="post-content">
                                            <i class="fa fa-mobile" style="color: #0ab2e6"></i>
                                            <a href="telegram:{{$supplier->mobile}}" style="color: #716f6f;font-size: 20px" target="_blank"> {{$supplier->mobile}} </a>
                                        </div>
                                        <div class="post-content">
                                            <i class="fa fa-whatsapp" style="color: #0cc745">  </i>
                                            <a href="whatsapp:{{$supplier->whatsapp}}" style="color: #716f6f;font-size: 20px" target="_blank"> {{$supplier->whatsapp}} </a>
                                        </div>
                                        <div class="post-content">
                                            <i class="fa fa-instagram" style="color: #e81a1a"></i>
                                            <a href="{{'https://'.$supplier->website}}" style="color: #716f6f;font-size: 20px" target="_blank"> اینستاگرام </a>
                                        </div>
                                        <div class="post-content">
                                            <i class="fa fa-map-pin" style="color: #ff3d00"></i>
                                            <a href="" style="color: #716f6f;font-size: 20px">استان {{$supplier->state}} شهرستان {{$supplier->city}} - {{$supplier->address}} </a>
                                        </div>
                                        <div class="post-content">
                                            <span>
                                            <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=244309&amp;Code=dfxWaqnQkjgkX5PcBJnK" class="d-block hover-img-link mt-0">
                                                <img referrerpolicy="origin" src="https://trustseal.enamad.ir/Content/Images/Star/star1.png?v=5.0.0.47" alt="اینماد" style="cursor:pointer;width: 100px" id="dfxWaqnQkjgkX5PcBJnK">
                                            </a>
                                        </span>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12 pr">
                                <div class="row">
                                    <section class="footer-links-col">
                                        <div class="headline-links">
                                            <a href="#">
                                                {{$supplier->title}}
                                            </a>
                                        </div>
                                        <img src="{{asset($supplier->logo)}}" alt="{{$supplier->title}}">
                                    </section>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-12 pr">
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
                                <p class="text-left">Developed By <a href="https://bestagroup.ir" target="_blank">Bestagroup</a> </p>
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
<script src="{{asset('site/js/main.js')}}"></script>
<script src="{{asset('site/js/vendor/bootstrap-slider.min.js')}}"></script>
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
            @if($supplier->lat != null && $supplier->lng != null)
            presets: {
                latlng: {
                    lat: {{$supplier->lat}},
                    lng: {{$supplier->lng}},
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
            @else
            presets: {
                latlng: {
                    lat: 35.73249,
                    lng: 51.42268,
                },
                zoom: 14
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

        @if($supplier->lat != null && $supplier->lng != null)

        app.markReverseGeocode({
            state: {
                latlng: {
                    lat: {{$supplier->lat}},
                    lng: {{$supplier->lng}},
                },
                zoom: 14,
                icon: crosshairIcon,
            },
        });
        @endif
    });
</script>
<script>
    $('#select-all').click(function(event) {
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });
</script>
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
</script>

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
