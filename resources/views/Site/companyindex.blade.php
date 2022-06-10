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
            <div class="slider-main-container d-block">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        @foreach($suppliers as $supplier)
                            <div style="height: 200px">
                                <img src="{{asset($supplier->banner)}}" class="d-block w-100" height="200px" alt="{{$supplier->title}}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block">

            <div class="col-lg-8 col-xs-12 pr mt-3 mb-3">
                <div class="slider-main-container d-block">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                            @foreach($suppliers as $supplier)
                                <div class="carousel-item active">
                                    <img src="{{asset($supplier->slide1)}}" class="d-block w-100" alt="{{$supplier->title}}">
                                </div>
                            @if($supplier->slide2)
                                <div class="carousel-item">
                                    <img src="{{asset($supplier->slide2)}}" class="d-block w-100" alt="{{$supplier->title}}">
                                </div>
                                @endif
                            @if($supplier->slide3)
                                <div class="carousel-item">
                                    <img src="{{asset($supplier->slide3)}}" class="d-block w-100" alt="{{$supplier->title}}">
                                </div>
                                @endif
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="z-index: 1">
                            <span class="fa fa-angle-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="z-index: 1">
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
            <div class="col-lg-12 col-md-12 col-xs-12 order-1 d-block mt-4" style="z-index: -1">
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
                                            </div >
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
                                            <div class="thumb">
                                                <a href="{{url('market'.'/'.$offer->slug)}}" target="_blank" class="d-block">
                                                    <img src="{{asset($offer->image1)}}" style="height: 235px;" alt="{{$offer->title_offer}}">
                                                </a>
                                            </div>
                                            <div class="title">
                                                <h3>{{ \Illuminate\Support\Str::limit($offer->title_offer, 21, $end='...') }}</h3>
                                            </div>
                                            <div  class="title">
                                                <span  class="amount">@if($offer->single_price == 0)
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
