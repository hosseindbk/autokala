@extends('master-company')
@section('title')
    <title>اتوکالا سامانه جامع قطعات و خدمات خودرو</title>
    <link rel="stylesheet" href="{{asset('site/css/vendor/lightgallery.css')}}">
    <meta name="enamad" content="745189" />
@endsection
@section('main')
    <div class="container-main">
        @include('sweet::alert')
        <div class="d-block">
            <div class="col-lg-1 col-xs-6">
                <div class="slider-main-container d-block">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($suppliers as $supplier)
                                <div class="carousel-item active" style="text-align: center;">
                                    <a href="#" class="adplacement-item"  target="_blank">
                                        @if($supplier->logo == null)
                                            <img src="{{asset('images/supplier_defult.png')}}" style="height: 235px;" alt="{{$supplier->title}}">
                                        @else
                                            <img src="{{asset($supplier->logo)}}" class="d-block w-100" alt="{{$supplier->title}}">
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-11 col-xs-6">
                <div class="carousel-inner">
                    @foreach($suppliers as $supplier)
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
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-block">

            <div class="col-lg-8 col-xs-12 pr mt-3 mb-3">
                <div class="slider-main-container d-block">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($orginal_slides as $slide)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$slide->id}}" class="@if($slide->id == $minid) active @endif"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($orginal_slides as $slide)
                                <div class="carousel-item @if($slide->id == $minid) active @endif">
                                    <a href="{{$slide->link}}" class="adplacement-item"  target="_blank">
                                        <img src="{{asset($slide->image)}}" class="d-block w-100" alt="{{$slide->title}}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev"  href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="fa fa-angle-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous </span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="fa fa-angle-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12 pl mt-3">
                <div class="adplacement-container-column">
                    <div class="slider-main-container d-block">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($suppliers as $supplier)
                                    <h2 style="text-align: center;padding: 20px;">{{$supplier->title}}</h2>
                                    <div class="p-4" style="line-height: 40px;text-align: justify;height: 535px;">{!! $supplier->description !!}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block">
            <div class="col-lg-12 col-md-12 col-xs-12 order-1 d-block mt-4">
                <div class="slider-widget-products">
                    <div class="widget widget-product card mb-0">
                        <div class="product-carousel-brand owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transition: all 0s ease 0s; width: 2234px;">
                                    @foreach($brands as $brand)
                                        <div class="owl-item active" style="width: 50px;">
                                            <div class="item">
                                                <a href="{{url('brand/'.$brand->slug)}}" target="_blank" class="d-block hover-img-link">
                                                    <img src="{{asset($brand->image)}}" class="img-fluid img-brand" style="width: 130px;margin: 0 auto;" alt="{{$brand->name}}">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 order-1 d-block">
                <div class="shop-archive-content mt-3 d-block">
                    <div class="product-items">
                        <div class="row">
                            @foreach($offers as $offer)
                                @if(Auth::check() && Auth::user()->type_id == 1)
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                                        <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                            <div style="float: right">
                                                @foreach($users as $user)
                                                    @if($offer->user_id == $user->id)
                                                        @if($user->type_id == 1 )
                                                            <button class="btn btn-danger">فروشگاه</button>
                                                        @elseif($user->type_id != 1)
                                                            <button class="btn btn-success">شخصی</button>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="thumb">
                                                <a href="{{url('market'.'/'.$offer->slug)}}" target="_blank" class="d-block">
                                                    @if($offer->image1)
                                                        <img src="{{asset($offer->image1)}}" style="height: 235px;" alt="{{$offer->title_offer}}">
                                                    @else
                                                        <img src="{{asset('images/techndical_defult.png')}}" style="height: 235px;" alt="{{$offer->title_offer}}">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="title">
                                                @if($offer->title_offer)
                                                    <h3>{{ \Illuminate\Support\Str::limit($offer->title_offer, 21, $end='...') }}</h3>
                                                @elseif($offer->title)
                                                    <h3>{{ \Illuminate\Support\Str::limit($offer->title, 21, $end='...') }}</h3>
                                                @endif
                                            </div>
                                            <div class="title">
                                                @if($offer->price > 100)
                                                    <span class="amount">{{number_format($offer->price)}}
                                                        <span>تومان</span>
                                                    </span>
                                                @elseif($offer->price < 100 && $offer->single_price > 100)
                                                    <span class="amount">{{number_format($offer->single_price)}}
                                                        <span>تومان</span>
                                                    </span>
                                                @elseif($offer->price < 100 && $offer->single_price < 100)
                                                    <span>توافقی</span>
                                                @endif
                                            </div>
                                            @if($offer->total > 1)
                                                <div class="title">
                                                    <span class="amount">
                                                        حداقل تعداد سفارش  {{$offer->total}} عدد
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="title">
                                                @if($offer->brand_id != null)
                                                    @foreach($brandnames as $brandname)
                                                        @if($offer->id == $brandname->offer_id)
                                                            {{$brandname->title_fa}}
                                                        @endif
                                                    @endforeach
                                                @elseif($offer->brand_id == null)
                                                    {{$offer->brand_name}}
                                                @endif
                                            </div>
                                            <div class="price">
                                                <span class="amount">{{jdate($offer->created_at)->ago()}}</span>
                                            </div>
                                        </section>
                                    </div>
                                @elseif(Auth::check() && Auth::user()->type_id != 1 && $offer->single == 1)
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                                        <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                            <div style="float: right">
                                                @foreach($users as $user)
                                                    @if($offer->user_id == $user->id)
                                                        @if($user->type_id == 1 )
                                                            <button class="btn btn-danger">فروشگاه</button>
                                                        @elseif($user->type_id == 4 || $user->type_id == 3)
                                                            <button class="btn btn-success">شخصی</button>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="thumb">
                                                <a href="{{url('market'.'/'.$offer->slug)}}" target="_blank" class="d-block">
                                                    <img src="{{asset($offer->image1)}}" style="height: 235px;" alt="{{$offer->title_offer}}">
                                                </a>
                                            </div>
                                            <div class="title">
                                                <h3>{{ \Illuminate\Support\Str::limit($offer->title_offer, 21, $end='...') }}</h3>
                                            </div>
                                            <div class="title"><span class="amount">@if($offer->single_price == 0)<span>توافقی</span>@else{{number_format($offer->single_price)}}
                                                    <span>تومان</span>@endif</span>
                                            </div>
                                            <div class="title">
                                                @if($offer->brand_id != null)
                                                    @foreach($brandnames as $brandname)
                                                        @if($offer->id == $brandname->offer_id)
                                                            {{$brandname->title_fa}}
                                                        @endif
                                                    @endforeach
                                                @elseif($offer->brand_id == null)
                                                    {{$offer->brand_name}}
                                                @endif
                                            </div>
                                            <div class="price">
                                                <span class="amount">{{jdate($offer->created_at)->ago()}}</span>
                                            </div>
                                        </section>
                                    </div>
                                @elseif(! Auth::check() && $offer->single == 1)
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                                        <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                            <div style="float: right">
                                                @foreach($users as $user)
                                                    @if($offer->user_id == $user->id)
                                                        @if($user->type_id == 1 )
                                                            <button class="btn btn-danger">فروشگاه</button>
                                                        @elseif($user->type_id == 4 || $user->type_id == 3)
                                                            <button class="btn btn-success">شخصی</button>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="thumb">
                                                <a href="{{url('market'.'/'.$offer->slug)}}" target="_blank" class="d-block">
                                                    <img src="{{asset($offer->image1)}}" style="height: 235px;" alt="{{$offer->title_offer}}">
                                                </a>
                                            </div>
                                            <div class="title">
                                                <h3>{{ \Illuminate\Support\Str::limit($offer->title_offer, 21, $end='...') }}</h3>
                                            </div>
                                            <div class="title">
                                                <span class="amount">@if($offer->single_price == 0)
                                                        <span>توافقی</span>
                                                    @else
                                                        {{number_format($offer->single_price)}}
                                                        <span>تومان</span>
                                                    @endif</span>
                                            </div>
                                            <div class="title">
                                                @if($offer->brand_id != null)
                                                    @foreach($brandnames as $brandname)
                                                        @if($offer->id == $brandname->offer_id)
                                                            {{$brandname->title_fa}}
                                                        @endif
                                                    @endforeach
                                                @elseif($offer->brand_id == null)
                                                    {{$offer->brand_name}}
                                                @endif
                                            </div>
                                            <div class="price">
                                                <span class="amount">{{jdate($offer->created_at)->ago()}}</span>
                                            </div>
                                        </section>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
@section('script')
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
@endsection
