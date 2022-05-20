@extends('master-company')
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
            <div class="col-lg-3 col-xs-6" style="margin: 0 auto;">
                <div class="slider-main-container d-block">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($suppliers as $supplier)
                                <div class="carousel-item active" style="text-align: center;">
                                    <a href="#" class="adplacement-item"  target="_blank">
                                        @if($supplier->image == null)
                                            <img src="{{asset('images/supplier_defult.png')}}" style="height: 235px;" alt="{{$supplier->title}}">
                                        @else
                                            <img src="{{asset($supplier->image)}}" class="d-block w-100" alt="{{$supplier->title}}">
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-block">
            <div class="col-lg-6 col-xs-6" style="margin: 0 auto;">
                <div class="slider-main-container d-block">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($suppliers as $supplier)
                                <div class="p-4" style="line-height: 40px;">{!! $supplier->description !!}</div>
                            @endforeach
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
