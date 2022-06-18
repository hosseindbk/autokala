@extends('master')
@section('title')
    <title> وبسایت اتوکالا</title>
    <link rel="stylesheet" href="{{asset('site/css/vendor/lightgallery.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/noUISlider.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/bootstrap-slider.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/mapp.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/fa/style.css')}}" data-locale="true">
@endsection
@section('top-header')
    <section class="h-main-row">
        <div class="col-lg-12 col-md-12 col-xs-12 pr">
            <div class="header-right">
                <div class="col-lg-4 pr">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            @foreach($offers as $offer)
                                @if($offer->buyorsell == 'sell')
                                    <form action="{{route('offer-search-sell')}}" method="get" class="form-search">
                                @elseif($offer->buyorsell == 'buy')
                                    <form action="{{route('offer-search-buy')}}" method="get" class="form-search">
                                @endif
                            @endforeach
                                    <input type="text" class="header-search-input" name="offersearch" placeholder="نام کالای مورد نظر خود را جستجو کنید…">
                                        <div class="action-btns">
                                            <button class="btn btn-search" type="submit">
                                                <img src="{{asset('site/images/search.png')}}" alt="search">
                                            </button>
                                        </div>
                                    </form>
                                {{--                            <div class="search-result">--}}
                                {{--                                <ul class="search-result-list mb-0">--}}

                                {{--                                </ul>--}}
                                {{--                                <div class="localSearchSimple"></div>--}}
                                {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <div class="col-lg-4 pr">
                    <a href="{{url('/')}}"> <img src="{{asset('site/images/logo.png')}}" alt="اتوکالا"> </a>
                    <h2 style="padding: 2px 0px 0px 0px;font-size: 12px;">اتوکالا سامانه جامع قطعات و خدمات خودرو</h2>
                </div>
            </div>
            <div class="header-left">
                <div class="col-lg-4 pl">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('productsearchandfilter')}}" method="get" class="form-search">
                                <input type="search" class="header-search-input-code green-place" value="{{request('unicode')}}" name="unicode" placeholder="جستجوی یونیکد (شناسه 10 رقمی کالا)">
                                <div class="action-btns">
                                    <button class="btn btn-search btn-search-green" type="submit">
                                        <img src="{{asset('site/images/search.png')}}" alt="search">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay-search-box"></div>
    </section>
@endsection
@section('main')
<div class="container-main">
    <div class="d-block">
        <div class="page-content page-row">
            <div class="main-row">
                <div id="breadcrumb">
                    <i class="mdi mdi-home"></i>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
                            <li class="breadcrumb-item"><a href="{{url('market')}}">آگهی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@foreach($offers as $offer) {{$offer->title}} @endforeach</li>
                        </ol>
                    </nav>
                </div>
                @foreach($offers as $offer)
                    @if($offer->buyorsell == 'sell')
                    <div class="col-lg">
                        <div class="product type-product">
                            <section class="product-gallery">
                                <div class="gallery">
                                    <div class="gallery-item">
                                        <div>
                                            <ul class="" style="float: left;">
                                                <li class="unic_code">
                                                    <a href="#" class="btn btn-outline-success">
                                                        <span> تاریخ ثبت آگهی  {{jdate($offer->created_at)->ago()}} </span>
                                                    </a>
                                                </li>
                                                <li class="unic_code">
                                                    @foreach($states as $state) @if($offer->state_id == $state->id ) استان :  {{$state->title}} @endif @endforeach
                                                    |
                                                    @foreach($cities as $city) @if($offer->city_id == $city->id ) شهر :  {{$city->title}} @endif @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="col-lg-5 col-xs-12 pr d-block" style="padding: 0;">
                                <section class="product-gallery">
                                    <div class="gallery">
                                        <div class="gallery-item">
                                            <div>
                                                <ul class="gallery-actions">
                                                    <li class="text-info">
                                                        <button class="btn btn-danger">آگهی فروش</button>
                                                    </li>
                                                    <li class="text-info">
                                                        @foreach($users as $user)
                                                            @if($offer->user_id == $user->id)
                                                                @if($user->type_id == 1 )
                                                                    <button class="btn btn-outline-danger">آگهی دهنده : فروشگاه</button>
                                                                @elseif($user->type_id == 4 || $user->type_id == 3)
                                                                    <button class="btn btn-outline-success"> آگهی دهنده : شخصی</button>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img">
                                                <a href="#">
                                                    @if(! $offer->image1)
                                                        <img class="zoom-img" id="img-product-zoom" src="{{asset('images/supplier_defult.png')}}" data-zoom-image="{{asset('images/supplier_defult.png')}}" width="411" />
                                                    @else
                                                        <img class="zoom-img" id="img-product-zoom" src="{{asset($offer->image1)}}" data-zoom-image="{{asset($offer->image1)}}" width="411" />
                                                    @endif
                                                    <div id="gallery_01f" style="width:420px;float:right;">
                                                </a>
                                                <ul class="gallery-items owl-carousel owl-theme" id="gallery-slider">
                                                    @if($offer->image1)
                                                        <li class="item">
                                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($offer->image1)}}" data-zoom-image="{{asset($offer->image1)}}">
                                                                <img src="{{asset($offer->image1)}}" width="100" /></a>
                                                        </li>
                                                    @endif
                                                    @if($offer->image2)
                                                        <li class="item">
                                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($offer->image2)}}" data-zoom-image="{{asset($offer->image2)}}">
                                                                <img src="{{asset($offer->image2)}}" width="100" /></a>
                                                        </li>
                                                    @endif
                                                    @if($offer->image3)
                                                        <li class="item">
                                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($offer->image3)}}" data-zoom-image="{{asset($offer->image3)}}">
                                                                <img src="{{asset($offer->image3)}}" width="100" /></a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-lg-7 col-xs-12 pl mt-5 d-block">
                                <section class="product-info">
                                    <div class="product-headline">
                                        <h1 class="product-title" style="color: #ef394e">{{$offer->title_offer}} </h1>
                                    </div>

                                    <div class="product-config-wrapper">
                                        <div class="col=lg-6 col-md-6 col-xs-12 pr">
                                            <div class="product-params pt-3">
                                                <div class="product-headline">
                                                    <span class="product-title" style="color: #ff3d00;"> اطلاعات آگهی </span>
                                                </div>
                                                <ul >
                                                    <li>
                                                        <span>یونیکد : </span>
                                                        @if($offer->unicode_product != null)
                                                            <span>
                                                                <a href="{{url('product/'.$offer->unicode_product)}}" target="_blank">{{$offer->unicode_product}}</a>
                                                            </span>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <span>نام قطعه : </span>
                                                        @if($offer->unicode_product != null)
                                                            <span>
                                                                @foreach($products as $product)
                                                                    @if($offer->unicode_product == $product->unicode)
                                                                        {{$product->title_fa}}
                                                                    @endif
                                                                @endforeach
                                                            </span>
                                                        @elseif($offer->product_name != null)
                                                            <span>{{$offer->product_name}}</span>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <span>دسته بندی : </span>
                                                        <span>
                                                    @foreach($productgroups as $product_group)
                                                                @if($product_group->id == $offer->product_group)
                                                                    {{$product_group->title_fa}}
                                                                @endif
                                                            @endforeach
                                                </span>
                                                    </li>
                                                    <li>


                                                            @if($offer->brand_id != null)
                                                                @foreach($products as $product)
                                                                    @if($offer->unicode_product == $product->unicode)
                                                                        @foreach($brand_varietis as $Product_brand_variety)
                                                                            @if($offer->brand_id == $Product_brand_variety->id)
                                                                                @foreach($brands as $brand)
                                                                                    @if($brand->id == $Product_brand_variety->brand_id)
                                                                                        @if($product->id == $Product_brand_variety->product_id)
                                                                                        <span>برند : </span>
                                                                                        <span>
                                                                                            <a href="{{url('productbrand'.'/'.$product->slug.'/'.$Product_brand_variety->id)}}">{{$brand->title_fa}}</a>
                                                                                        </span>
                                                                                        @if($Product_brand_variety->item1 != null)
                                                                                            <li>
                                                                                                <span>{{$Product_brand_variety->item1}} : </span>
                                                                                                <span>{{$Product_brand_variety->value_item1}}</span>
                                                                                            </li>
                                                                                            @endif
                                                                                            @if($Product_brand_variety->item2 != null)
                                                                                                <li>
                                                                                                    <span>{{$Product_brand_variety->item2}} : </span>
                                                                                                    <span>{{$Product_brand_variety->value_item2}}</span>
                                                                                                </li>
                                                                                            @endif
                                                                                            @if($Product_brand_variety->item3 != null)
                                                                                                <li>
                                                                                                    <span>{{$Product_brand_variety->item3}} : </span>
                                                                                                    <span>{{$Product_brand_variety->value_item3}}</span>
                                                                                                </li>
                                                                                                @endif
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @elseif($offer->brand_id == null)
                                                        <span>برند : </span>
                                                              <span>  {{$offer->brand_name}} </span>
                                                            @endif
                                                        </span>
                                                    </li>

                                                    @if($offer->single = 1)
                                                        <li>
                                                            <span>قیمت : </span>
                                                            @if($offer->single_price == 0)
                                                                <span>توافقی</span>
                                                            @else
                                                            <span>{{number_format($offer->single_price)}} تومان</span>
                                                            @endif
                                                        </li>
                                                    @endif
                                                    @if(Auth::check() && Auth::user()->type_id == 1)
                                                        <li>
                                                            <span>قیمت عمده فروشی: </span>
                                                            @if($offer->price == 0)
                                                                <span>توافقی</span>
                                                            @else
                                                                <span>{{number_format($offer->price)}} تومان</span>
                                                            @endif
                                                        </li>
                                                        <li>
                                                            <span>حداقل تعداد سفارش : </span>
                                                            <span>{{$offer->total}}</span>
                                                        </li>
                                                    @endif
                                                    @if($offer->noe != null)
                                                        <li>
                                                            <span>وضعیت کالا : </span>
                                                            <span>@if($offer->noe == 'new') نو @elseif($offer->noe == 'old') کارکرده @endif</span>
                                                        </li>
                                                    @endif

                                                </ul>
                                                <div class="product-headline">
                                                    <span class="product-title" style="color: #ff3d00;"> شرح آگهی </span>
                                                </div>

                                                <ul>
                                                    <li>
                                                        <p>
                                                            {!! $offer->description !!}
                                                        </p>
                                                    </li>
                                                </ul>
                                                <div class="product-headline">
                                                    <span class="product-title" style="color: #ff3d00;"> اطلاعات تماس </span>
                                                </div>
                                                <ul>
                                                    <li>
                                                        <span>تلفن ثابت : </span>
                                                        <span>{{$offer->phone}}</span>
                                                    </li>
                                                    <li>
                                                        <span>تلفن موبایل : </span>
                                                        <span>{{$offer->mobile}}</span>
                                                    </li>
                                                    <li>
                                                        <span>آدرس : </span>
                                                        <span>{{$offer->address}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col=lg-6 col-md-6 col-xs-12 pr">
                                            <div class="product-seller-info-overal">
                                                <div class="seller-info-changable">
                                                    <table class="table table-borderless table-profile-comment">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">نام خودرو</th>
                                                            <th scope="col">مدل خودرو</th>
                                                            <th scope="col">تیپ و تریم</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($caroffers as $car_offer)
                                                            @if($car_offer->offer_id == $offer->id)
                                                                @foreach($carbrands as $car_brand)
                                                                    @if($car_brand->id == $car_offer->car_brand_id)
                                                                        <tr>
                                                                            <td>{{$car_brand->title_fa}}
                                                                            @foreach($carmodels as $car_model)
                                                                                @if($car_model->id == $car_offer->car_model_id)
                                                                                    <td> {{$car_model->title_fa}}
                                                                                    @foreach($cartypes as $car_type)
                                                                                        @if($car_type->id == $car_offer->car_type_id)
                                                                                            <td>{{$car_type->title_fa}}</td>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    </td>
                                                                                @endif
                                                                            @endforeach
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12 pl" style="margin-top: 20px;">
                                        <div id="app" style="width: 100%; height: 400px;"></div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    @elseif($offer->buyorsell == 'buy')
                    <div class="col-lg">
                        <div class="product type-product">
                            <section class="product-gallery">
                                <div class="gallery">
                                    <div class="gallery-item">
                                        <div>
                                            <ul class="" style="float: left;">
                                                <li class="unic_code">
                                                    <a href="#" class="btn btn-outline-success">
                                                        <span> تاریخ ثبت آگهی  {{jdate($offer->created_at)->ago()}} </span>
                                                    </a>
                                                </li>
                                                <li class="unic_code">
                                                    @foreach($states as $state) @if($offer->state_id == $state->id ) استان :  {{$state->title}} @endif @endforeach
                                                    |
                                                    @foreach($cities as $city) @if($offer->city_id == $city->id ) شهر :  {{$city->title}} @endif @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="col-lg-5 col-xs-12 pr d-block" style="padding: 0;">
                                <section class="product-gallery">
                                    <div class="gallery">
                                        <div class="gallery-item">
                                            <div>
                                                <ul class="gallery-actions">
                                                    <li class="text-info">
                                                        <button class="btn btn-success">آگهی خرید</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="gallery-item">
                                            <div class="gallery-img">
                                                <a href="#">
                                                    @if(! $offer->image1)
                                                        <img class="zoom-img" id="img-product-zoom" src="{{asset('images/supplier_defult.png')}}" data-zoom-image="{{asset('images/supplier_defult.png')}}" width="411" />
                                                    @else
                                                        <img class="zoom-img" id="img-product-zoom" src="{{asset($offer->image1)}}" data-zoom-image="{{asset($offer->image1)}}" width="411" />
                                                    @endif
                                                    <div id="gallery_01f" style="width:420px;float:right;">
                                                </a>
                                                <ul class="gallery-items owl-carousel owl-theme" id="gallery-slider">
                                                    @if($offer->image1)
                                                        <li class="item">
                                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($offer->image1)}}" data-zoom-image="{{asset($offer->image1)}}">
                                                                <img src="{{asset($offer->image1)}}" width="100" /></a>
                                                        </li>
                                                    @endif
                                                    @if($offer->image2)
                                                        <li class="item">
                                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($offer->image2)}}" data-zoom-image="{{asset($offer->image2)}}">
                                                                <img src="{{asset($offer->image2)}}" width="100" /></a>
                                                        </li>
                                                        @endif
                                                    @if($offer->image3)
                                                        <li class="item">
                                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($offer->image3)}}" data-zoom-image="{{asset($offer->image3)}}">
                                                                <img src="{{asset($offer->image3)}}" width="100" /></a>
                                                        </li>
                                                    @endif
                                                    @if($medias != null)
                                                        @foreach($medias as $media)
                                                            <li class="item">
                                                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($media->image)}}" data-zoom-image="{{asset($media->image)}}">
                                                                    <img src="{{asset($media->image)}}" width="100" /></a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-lg-7 col-xs-12 pl mt-5 d-block">
                                <section class="product-info">
                                    <div class="product-headline">
                                        <h1 class="product-title" style="color: #ef394e">{{$offer->title_offer}} </h1>
                                    </div>

                                    <div class="product-config-wrapper">
                                        <div class="col=lg-6 col-md-6 col-xs-12 pr">
                                            <div class="product-params pt-3">
                                                <div class="product-headline">
                                                    <span class="product-title" style="color: #ff3d00;"> اطلاعات آگهی </span>
                                                </div>
                                                <ul>
                                                    <li>
                                                        <span>یونیکد : </span>
                                                        @if($offer->unicode_product != null)
                                                            <span>
                                                                <a href="{{url('product/'.$offer->unicode_product)}}" target="_blank">{{$offer->unicode_product}}</a>
                                                            </span>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <span>نام قطعه : </span>
                                                        @if($offer->unicode_product != null)
                                                            <span>
                                                    @foreach($products as $product)
                                                                    @if($offer->unicode_product == $product->unicode)

                                                                        {{$product->title_fa}}
                                                                    @endif
                                                                @endforeach
                                                </span>
                                                        @elseif($offer->product_name != null)
                                                            <span>{{$offer->product_name}}</span>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        <span>دسته بندی : </span>
                                                        <span>
                                                    @foreach($productgroups as $product_group)
                                                                @if($product_group->id == $offer->product_group)
                                                                    {{$product_group->title_fa}}
                                                                @endif
                                                            @endforeach
                                                </span>
                                                    </li>
                                                    <li>
                                                        <span>برند : </span>
                                                        @if($offer->brand_id != null)
                                                            <span>
                                                    @foreach($brands as $brand)
                                                                    @if($offer->brand_id == $brand->id)

                                                                        {{$brand->title_fa}}
                                                                    @endif
                                                                @endforeach
                                                </span>
                                                        @elseif($offer->brand_name != null)
                                                            <span>{{$offer->brand_name}}</span>
                                                        @endif
                                                    </li>

                                                    @if($offer->single = 1)
                                                        <li>
                                                            <span>قیمت : </span>
                                                            <span>{{number_format($offer->single_price)}} تومان</span>
                                                        </li>
                                                    @endif
                                                    @if(Auth::check() && Auth::user()->type_id == 1)
                                                        <li>
                                                            <span>قیمت عمده فروشی: </span>
                                                            <span>{{number_format($offer->price)}} تومان</span>
                                                        </li>
                                                        <li>
                                                            <span>حداقل تعداد سفارش : </span>
                                                            <span>{{$offer->total}}</span>
                                                        </li>
                                                    @endif
                                                    @if($offer->noe != null)
                                                        <li>
                                                            <span>وضعیت کالا : </span>
                                                            <span>@if($offer->noe == 'new') نو @elseif($offer->noe == 'old') کارکرده @endif</span>
                                                        </li>
                                                    @endif

                                                </ul>
                                                <div class="product-headline">
                                                    <span class="product-title" style="color: #ff3d00;"> شرح آگهی </span>
                                                </div>

                                                <ul>
                                                    <li>
                                                        <p>
                                                            {!! $offer->description !!}
                                                        </p>
                                                    </li>
                                                </ul>
                                                <div class="product-headline">
                                                    <span class="product-title" style="color: #ff3d00;"> اطلاعات تماس </span>
                                                </div>
                                                <ul>
                                                    <li>
                                                        <span>تلفن ثابت : </span>
                                                        <span>{{$offer->phone}}</span>
                                                    </li>
                                                    <li>
                                                        <span>تلفن موبایل : </span>
                                                        <span>{{$offer->mobile}}</span>
                                                    </li>
                                                    <li>
                                                        <span>آدرس : </span>
                                                        <span>{{$offer->address}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col=lg-6 col-md-6 col-xs-12 pr">
                                            <div class="product-seller-info-overal">
                                                <div class="seller-info-changable">
                                                    <table class="table table-borderless table-profile-comment">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">نام خودرو</th>
                                                            <th scope="col">مدل خودرو</th>
                                                            <th scope="col">تیپ و تریم</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($caroffers as $car_offer)
                                                            @if($car_offer->offer_id == $offer->id)
                                                                @foreach($carbrands as $car_brand)
                                                                    @if($car_brand->id == $car_offer->car_brand_id)
                                                                        <tr>
                                                                            <td>{{$car_brand->title_fa}}
                                                                            @foreach($carmodels as $car_model)
                                                                                @if($car_model->id == $car_offer->car_model_id)
                                                                                    <td> {{$car_model->title_fa}}
                                                                                    @foreach($cartypes as $car_type)
                                                                                        @if($car_type->id == $car_offer->car_type_id)
                                                                                            <td>{{$car_type->title_fa}}</td>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    </td>
                                                                                @endif
                                                                            @endforeach
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12 pl" style="margin-top: 20px;">
                                        <div id="app" style="width: 100%; height: 400px;"></div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        <div class="tabs">
            <div class="tab-box">
                <ul class="tab nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="question-and-answer-tab" data-toggle="tab"
                           href="#question-and-answer" role="tab" aria-controls="question-and-answer"
                           aria-selected="false">
                            <i class="mdi mdi-comment-question-outline"></i>
                            پرسش و پاسخ
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg">
                <div class="tabs-content">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="question-and-answer" role="tabpanel" aria-labelledby="question-and-answer-tab">
                            <div class="faq">
                                <h2 class="params-headline">پرسش و پاسخ
                                    <span>پرسش خود را در مورد محصول مطرح نمایید</span>
                                </h2>
                                <form action="{{route('send-comment')}}" class="form-faq" method="post">
                                                @csrf
                                                <input type="hidden" name="commentable_id" value="{{$offer->id}}">
                                                <input type="hidden" name="commentable_type" value="{{get_class($offer)}}">
                                                <input type="hidden" name="parent_id" value="0">
                                                <div class="form-checkout-row">
                                                    <div class="col-lg-4 col-md-4 col-xs-12 fc-direction-rtl">
                                                        <label for="phone-number">شماره موبایل
                                                            <abbr class="required" title="ضروری" style="color:red;">*</abbr>
                                                        </label>
                                                        <input type="text" required name="phone" value="@if(Auth::check()){{Auth::user()->phone}}@endif" class="form-control text-left">
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-xs-12 pl"></div>
                                                </div>
                                                <div class="form-checkout-row">
                                                    <div class="col-lg-9 col-md-9 col-xs-12 fc-direction-rtl">
                                                        <div class="form-faq-row mt-4">
                                                            <div class="form-faq-col">
                                                                <div class="ui-textarea">
                                                                    <textarea name="comment" placeholder="متن سوال" class="ui-textarea-field"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-xs-12 pl">
                                                    <div class="form-faq-row mt-4">
                                                        <div class="form-faq-col form-faq-col-submit">
                                                            <button class="btn-tertiary btn btn-secondary" type="submit">ثبت پرسش</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                <div id="product-questions-list">
                                    @foreach($comments as $comment)
                                        @if($comment->parent_id == 0)
                                            <div class="questions-list">
                                                <ul class="faq-list">
                                                    <li class="is-question">
                                                        <div class="section">
                                                            <div class="faq-header">
                                                                <span class="icon-faq">?</span>
                                                                <p class="h5">
                                                                    پرسش :
                                                                    <span>کاربر</span>
                                                                </p>
                                                            </div>
                                                            <p>{{$comment->comment}}</p>
                                                            <div class="faq-date">
                                                                <em>{{jdate($comment->created_at)->ago()}}</em>
                                                            </div>
                                                            <a href="#" class="js-add-answer-btn" data-toggle="modal" data-target="#answercommentchild{{$comment->id}}">پاسخ به پرسش</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                        @foreach($comment->child as $ChildComment)
                                                @if($ChildComment->approved == 1)
                                                    <div class="questions-list answer-questions">
                                                        <ul class="faq-list">
                                                            <li class="is-question">
                                                                <div class="section">
                                                                    <div class="faq-header"><span class="icon-faq"><i class="mdi mdi-storefront"></i></span>
                                                                        <p class="h5">
                                                                            پاسخ فروشنده :
                                                                            <span>حسن</span>
                                                                        </p>
                                                                    </div>
                                                                    <p>{{$ChildComment->comment}}</p>
                                                                    <div class="faq-date">
                                                                        <em>{{jdate($comment->created_at)->ago()}}</em>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="modal fade" id="answercommentchild{{$comment->id}}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <form action="{{route('send-comment')}}" class="form-faq" method="post">
                                                                @csrf
                                                                <input type="hidden" name="commentable_id" value="{{$product->id}}">
                                                                <input type="hidden" name="commentable_type" value="{{get_class($product)}}">
                                                                <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                                                <div class="form-checkout-row">
                                                                    <div class="col-lg-12 col-md-12 col-xs-12 fc-direction-rtl">
                                                                        <label for="phone-number">شماره موبایل
                                                                            <abbr class="required" title="ضروری" style="color:red;">*</abbr>
                                                                        </label>
                                                                        <input type="text" required name="phone" value="@if(Auth::check()){{Auth::user()->phone}}@endif" class="form-control text-left">
                                                                    </div>
                                                                    <div class="col-lg-12 col-md-12 col-xs-12 fc-direction-rtl">
                                                                        <label for="phone-number">نام و نام خانوادگی
                                                                            <abbr class="required" title="ضروری" style="color:red;">*</abbr>
                                                                        </label>
                                                                        <input type="text" required name="name" value="@if(Auth::check()){{Auth::user()->name}}@endif" class="form-control text-left">
                                                                    </div>
                                                                </div>
                                                                <div class="form-checkout-row">
                                                                    <div class="col-lg-12 col-md-12 col-xs-12 fc-direction-rtl">
                                                                        <div class="form-faq-row mt-4">
                                                                            <div class="form-faq-col">
                                                                                <div class="ui-textarea">
                                                                                    <textarea name="comment" placeholder="متن پاسخ" class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-xs-12 pl">
                                                                    <div class="form-faq-row mt-4">
                                                                        <div class="form-faq-col form-faq-col-submit">
                                                                            <button class="btn-tertiary btn btn-secondary" type="submit">ثبت پاسخ</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
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
                    @if($offer->lat != null && $offer->lng != null)
                    presets: {
                        latlng: {
                            lat: {{$offer->lat}},
                            lng: {{$offer->lng}},
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

                @if($offer->lat != null && $offer->lng != null)

                app.markReverseGeocode({
                    state: {
                        latlng: {
                            lat: {{$offer->lat}},
                            lng: {{$offer->lng}},
                        },
                        zoom: 14,
                        icon: crosshairIcon,
                    },
                });
                @endif
            });
        </script>

@endsection
