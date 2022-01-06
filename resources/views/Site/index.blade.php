@extends('master')
@section('title')
    <title>اتوکالا سامانه جامع قطعات و خدمات خودرو</title>
    <link rel="stylesheet" href="{{asset('site/css/vendor/lightgallery.css')}}">
    <meta name="enamad" content="745189" />
@endsection
@section('top-header')
    <section class="h-main-row">
        <div class="col-lg-12 col-md-12 col-xs-12 pr">
            <div class="header-right">
                <div class="col-lg-4 pr">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('search')}}" method="get" class="form-search">
                                <input type="search" class="header-search-input" name="search" placeholder="نام کالا، برند و یا دسته مورد نظر خود را جستجو کنید…">
                                <div class="action-btns">
                                    <button class="btn btn-search" type="submit">
                                        <img src="{{asset('site/images/search.png')}}" alt="search">
                                    </button>
                                    <div class="search-filter">
                                        <div class="form-ui">
                                            <div class="custom-select-ui">
                                                <select class="right" name="category_id">
                                                    <option value="all">همه دسته ها</option>
                                                    <option value="title_fa">نام کالا</option>
                                                    <option value="title_bazar_fa">عنوان رایج در بازار</option>
                                                    <option value="title_fani_fa">نام فنی فارسی</option>
                                                    <option value="title_fani_en">نام فنی لاتین</option>
                                                    <option value="code_fani_company">کد فنی کارخانه</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
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
                            <form action="{{route('unicode')}}" method="get" class="form-search">
                                <input type="search" class="header-search-input-code green-place" name="unicode" placeholder="جستجوی یونیکد (شناسه 10 رقمی کالا)">
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
    </section>
@endsection

@section('main')
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">استان مورد نظر خود را انتخاب نمایید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('filterstate')}}" method="get" class="form-search">

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="text-center">
                                <label for="select-all" class="btn btn-outline-secondary" style="width: 80%;margin: 10px 25px">
                                انتخاب همه
                                    @if($countState && count($countState) == 31)
                                        <input type="checkbox"  name="select-all" id="select-all" checked/>
                                        @else
                                        <input type="checkbox"  name="select-all" id="select-all" />
                                    @endif
                                </label>
                            </div>
                        </div>
                        @foreach($states as $state)
                            <div class="col-md-4 col-sm-12">
                                <button type="button" for="radio{{$state->id}}" class="btn btn-outline-secondary" style="width: 80%;margin: 10px 25px">
                                    {{$state->title}}
                                    <input type="checkbox" multiple="multiple" name="state_id[]" id="radio{{$state->id}}" value="{{$state->id}}" @if($countState) @foreach($countState as $stateselect) {{$state->id == $stateselect->id ? 'checked' : ''}} @endforeach @endif class="btn btn-outline-secondary">
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer" style=" align-items: center !important; justify-content: center; ">
                        <button type="submit" class="btn btn-primary" style="margin: 0 20px">تایید استان</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin: 0 20px">بازگشت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-main">
        @include('sweet::alert')
        <div class="d-block">
            <div class="col-lg-8 col-xs-12 pr mt-3">
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
                                    <img src="{{asset($slide->image)}}" class="d-block w-100" alt="{{$slide->title}}">
                                </div>
                            @endforeach

                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <span class="fa fa-angle-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="fa fa-angle-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12 pl mt-1">
                <div class="adplacement-container-column">
                    <a href="#" class="adplacement-item">
                        @foreach($left_top_slides as $slide)
                            <div class="adplacement-sponsored-box">
                                <img src="{{asset($slide->image)}}">
                            </div>
                        @endforeach
                    </a>
                    <a href="#" class="adplacement-item">
                        @foreach($left_bottom_slides as $slide)
                            <div class="adplacement-sponsored-box">
                                <img src="{{asset($slide->image)}}">
                            </div>
                        @endforeach
                    </a>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 pr order-1 d-block">
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
            <section class="section-slider amazing-section pt-3">
                <div class="container-amazing col-12">
                    <div class="col-lg-2 display-md-none pull-right">
                        <div class="amazing-product text-center" style="margin-top: 200px">
                            <h3 class="amazing-heading-title amazing-size-default" style="transform: rotate(90deg);">آگهی های منتخب </h3>
                            <br>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-12 pull-left">
                        <div class="slider-widget-products mb-0">
                            <div class="widget widget-product card">
                                <header class="card-header">
                                    <span class="title-one">آگهی های منتخب</span>
                                    <a href="{{url('market/sell')}}" target="_blank" class="card-title">مشاهده همه</a>
                                </header>
                                <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                                    <div class="owl-stage-outer">
                                        @if(Auth::check() && Auth::user()->type_id == 1)
                                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 2s; width: 2234px;">
                                            @foreach($offers as $offer)
                                                <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">
                                                    <div>
                                                        @if($offer->buyorsell == 'sell')
                                                            <button class="btn btn-danger">آگهی فروش</button>
                                                        @elseif($offer->buyorsell == 'buy')
                                                            <button class="btn btn-success">آگهی خرید</button>
                                                        @endif
                                                    </div>
                                                <div class="item">
                                                    <a href="{{url('market/'.$offer->slug)}}" target="_blank" class="d-block">
                                                        <img src="{{asset($offer->image1)}}" class="img-fluid" alt="">
                                                    </a>
                                                    <h2 class="post-title pt-4">
                                                        <a href="{{url('market/'.$offer->slug)}}" target="_blank">{{$offer->title_offer}}</a>
                                                    </h2>
                                                    <div class="price">
                                                        @if($offer->price > 1)
                                                        <ins>
                                                            <span>{{number_format($offer->price)}}<span> تومان </span></span>
                                                        </ins>
                                                        @else
                                                            <ins style="color: #fff !important;">0</ins>
                                                        @endif
                                                    </div>
                                                    <div class="post-title">
                                                        <a href="{{url('market/'.$offer->slug)}}" target="_blank" class="btn btn-outline-warning">مشاهده آگهی</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @else
                                            <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 2s; width: 2234px;">
                                                @foreach($offers as $offer)
                                                    <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">
                                                        <div>
                                                            @if($offer->buyorsell == 'sell')
                                                                <button class="btn btn-danger">آگهی فروش</button>
                                                            @elseif($offer->buyorsell == 'buy')
                                                                <button class="btn btn-success">آگهی خرید</button>
                                                            @endif
                                                        </div>
                                                        <div class="item">
                                                            <a href="{{url('market/'.$offer->slug)}}" target="_blank" class="d-block hover-img-link" data-toggle="modal"
                                                               data-target="#exampleModal">
                                                                <img src="{{asset($offer->image1)}}" class="img-fluid" alt="">
                                                            </a>
                                                            <h2 class="post-title pt-4">
                                                                <a href="{{url('market/'.$offer->slug)}}" target="_blank">{{$offer->title_offer}}</a>
                                                            </h2>
                                                            <div class="price">
                                                                @if($offer->single_price > 1)
                                                                <ins>
                                                                    <span>{{number_format($offer->single_price)}}<span> تومان </span></span>
                                                                </ins>
                                                                @else
                                                                    <ins style="color: #fff !important;">0</ins>
                                                                @endif
                                                            </div>
                                                            <div class="post-title">
                                                                <a href="{{url('market/'.$offer->slug)}}" target="_blank" class="btn btn-outline-warning">مشاهده آگهی</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="col-lg-12 col-md-12 col-xs-12 pr order-1 d-block">
                <div class="slider-widget-products">
                    <div class="widget widget-product card">
                        <header class="card-header">
                            <span class="title-one">تعمیرگاه های منتخب</span>
                            <h3 class="card-title"></h3>
                        </header>
                        <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage"style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                                    @foreach($technicalunits as $technical_unit)
                                        <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">
                                        <div class="item">
                                            <a href="{{url('technical/sub/'.$technical_unit->slug)}}" target="_blank" class="d-block hover-img-link">
                                                <img src="{{asset($technical_unit->image)}}" class="img-fluid" alt="">
                                            </a>
                                            <h2 class="post-title">
                                                <a href="{{url('technical/sub/'.$technical_unit->slug)}}" target="_blank">{{$technical_unit->title}}</a>
                                            </h2>
                                            <p class="post-title">
                                                @foreach($states as $state) @if($technical_unit->state_id == $state->id ) استان :  {{$state->title}} @endif @endforeach
                                                |
                                                @foreach($cities as $city) @if($technical_unit->city_id == $city->id ) شهر :  {{$city->title}} @endif @endforeach
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 pr order-1 d-block">
                <div class="slider-widget-products">
                    <div class="widget widget-product card">
                        <header class="card-header">
                            <span class="title-one">فروشگاه های منتخب</span>
                            <h3 class="card-title"></h3>
                        </header>
                        <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                                    @foreach($suppliers as $supplier)
                                        <div class="owl-item active" style="width: 309.083px; margin-left: 10px;">
                                            <div class="item">
                                                <a href="{{url('supplier/sub/'.$supplier->slug)}}" target="_blank" class="d-block hover-img-link">
                                                    <img src="{{asset($supplier->image)}}" class="img-fluid" alt="">
                                                </a>
                                                <h2 class="post-title">
                                                    <a href="{{url('supplier/sub/'.$supplier->slug)}}" target="_blank"> {{$supplier->title}} </a>
                                                </h2>
                                                <p class="post-title">
                                                    @foreach($states as $state) @if($supplier->state_id == $state->id ) استان :  {{$state->title}} @endif @endforeach
                                                        |
                                                    @foreach($cities as $city) @if($supplier->city_id == $city->id ) شهر :  {{$city->title}} @endif @endforeach

                                               </p>
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
    @endsection
@section('script')
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
