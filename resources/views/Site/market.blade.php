@extends('master')
@section('title')
    <title>بازارچه مجازی وبسایت اتوکالا</title>
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('site/css/vendor/noUISlider.min.css')}}">

@endsection
@section('top-header')
    <section class="h-main-row">
        <div class="col-lg-12 col-md-12 col-xs-12 pr">
            <div class="header-right">
                <div class="col-lg-4 pr">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            @if($sell == 1)
                                <form action="{{route('offer-search-sell')}}" method="get" class="form-search">
                                    @elseif($buy == 1)
                                        <form action="{{route('offer-search-buy')}}" method="get" class="form-search">
                                            @endif

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
        <div class="overlay-search-box"></div>
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
                @if($sell == 1)
                    <form action="{{route('sellfilterstate')}}" method="get" class="form-search">
                @elseif($buy == 1)
                    <form action="{{route('buyfilterstate')}}" method="get" class="form-search">
               @endif
                    <div class="row">
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
        <div class="d-block">
            <div class="page-content page-row">
                <div class="main-row">
                    <div id="breadcrumb">
                        <i class="mdi mdi-home"></i>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> بازارچه مجازی</li>

                            </ol>
                        </nav>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xs-12 pr sticky-sidebar">
                        <div class="shop-archive-sidebar">
                            <div class="sidebar-archive mb-3">
                                @if($sell == 1)
                                <form action="{{route('market-sell-filter')}}" method="get">
                                    @elseif($buy == 1)
                                        <form action="{{route('market-buy-filter')}}" method="get">
                                        @endif
                                    <section class="widget-product-categories">
                                        <header class="cat-header">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right" type="button" data-toggle="collapse"
                                                        href="#headingOne" role="button" aria-expanded="false"
                                                        aria-controls="headingOne">
                                                    نوع آگهی دهنده
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </header>
                                        <div class="product-filter">
                                            <div class="card">
                                                <div class="collapse show" id="headingOne">
                                                    <div class="card-main mb-0" style="overflow: auto;">
                                                        <div class="form-auth-row">
                                                            <label for="all" class="ui-checkbox">
                                                                <input type="radio" name="type" id="all" {{request('type') == 'all' ? 'checked' : '' }} value="all"   >
                                                                <span class="outline-radio-check"></span>
                                                            </label>
                                                            <label for="all"  class="remember-me">همه</label>
                                                        </div>
                                                        <div class="form-auth-row">
                                                            <label for="personal" class="ui-checkbox">
                                                                <input type="radio" name="type" id="personal" {{request('type') == '4' ? 'checked' : '' }} value="4"   >
                                                                <span class="outline-radio-check"></span>
                                                            </label>
                                                            <label for="personal"  class="remember-me">شخصی</label>
                                                        </div>
                                                        <div class="form-auth-row">
                                                            <label for="supandshop" class="ui-checkbox">
                                                                <input type="radio" name="type" id="supandshop" {{request('type') == '13' ? 'checked' : '' }} value="13"   >
                                                                <span class="outline-radio-check"></span>
                                                            </label>
                                                            <label for="supandshop"  class="remember-me">فروشگاه / تامین کننده</label>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 ">
                                                        <button class="btn btn-range pr">
                                                            اعمال فیلتر
                                                        </button>
                                                        @if($filter == 1)
                                                            @if($sell == 1)
                                                                <a href="{{url('market/sell')}}" class="btn btn-range pl">
                                                                    پاک کردن فیلتر
                                                                </a>
                                                                @elseif($buy == 1)
                                                                <a href="{{url('market/buy')}}" class="btn btn-range pl">
                                                                    پاک کردن فیلتر
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="widget-product-categories">
                                        <header class="cat-header">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right" type="button" data-toggle="collapse" href="#headingfor" role="button" aria-expanded="false" aria-controls="headingOne">
                                                    استان و شهرستان
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </header>
                                        <div class="product-filter mt-3">
                                            <div class="card">
                                                <div class="collapse show" id="headingfor">
                                                    <div class="card-main mb-lg-4">
                                                        <div class="mb-lg-4 mg-lg-4">
                                                            <select name="state_id" class="form-control select-lg select2" id="state_id">
                                                                <option value="">انتخاب استان</option>
                                                                @foreach($states as $state)
                                                                    <option value="{{$state->id}}" {{request('state_id') == $state->id ? 'selected' : '' }}>{{$state->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-lg-4 mg-lg-4">
                                                            <select multiple="multiple" name="city_id[]" id="city_id" class="form-control select2">
                                                                @if($filter == 1)
                                                                    @foreach($cities as $city)
                                                                        <option value="{{$city->id}}" @if($filter == 1 && $city_id != null) @foreach($city_id as $y) {{$city->id == $y->id ? 'selected' : ''}} @endforeach @endif>{{$city->title}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 ">
                                                        <button class="btn btn-range pr">
                                                            اعمال فیلتر
                                                        </button>
                                                        @if($filter == 1)
                                                            @if($sell == 1)
                                                                <a href="{{url('market/sell')}}" class="btn btn-range pl">
                                                                    پاک کردن فیلتر
                                                                </a>
                                                            @elseif($buy == 1)
                                                                <a href="{{url('market/buy')}}" class="btn btn-range pl">
                                                                    پاک کردن فیلتر
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
{{--                                    <section class="widget-product-categories">--}}
{{--                                        <header class="cat-header">--}}
{{--                                            <h2 class="mb-0">--}}
{{--                                                <button class="btn btn-block text-right collapsed" type="button" data-toggle="collapse"--}}
{{--                                                        href="#headingfor" role="button" aria-expanded="false"--}}
{{--                                                        aria-controls="headingfor">--}}
{{--                                                    محدوده قیمت--}}
{{--                                                    <i class="mdi mdi-chevron-down"></i>--}}
{{--                                                </button>--}}
{{--                                            </h2>--}}
{{--                                        </header>--}}
{{--                                        <div class="product-filter">--}}
{{--                                            <div class="card">--}}
{{--                                                <div class="collapse show" id="headingfor">--}}
{{--                                                    <div class="card-main mb-0">--}}
{{--                                                        <div class="box-data">--}}
{{--                                                            <div class="mt-5 mb-4" id="slider"></div>--}}

{{--                                                            <div class="filter-range mt-2 mb-2 pr">--}}
{{--                                                                <span>قیمت: </span>--}}
{{--                                                                <span class="example-val" id="limitedPrice"></span> تومان--}}
{{--                                                            </div>--}}
{{--                                                            <div class="mt-2 pl ">--}}
{{--                                                                <button class="btn btn-range pr" type="submit">--}}
{{--                                                                    اعمال فیلتر--}}
{{--                                                                </button>--}}
{{--                                                                @if($filter == 1)--}}
{{--                                                                    @if($sell == 1)--}}
{{--                                                                        <a href="{{url('market/sell')}}" class="btn btn-range pl">--}}
{{--                                                                            پاک کردن فیلتر--}}
{{--                                                                        </a>--}}
{{--                                                                    @elseif($buy == 1)--}}
{{--                                                                        <a href="{{url('market/buy')}}" class="btn btn-range pl">--}}
{{--                                                                            پاک کردن فیلتر--}}
{{--                                                                        </a>--}}
{{--                                                                    @endif--}}
{{--                                                                @endif--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </section>--}}
                                    <section class="widget-product-categories">
                                        <header class="cat-header">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right" type="button" data-toggle="collapse"
                                                        href="#headingOne" role="button" aria-expanded="false"
                                                        aria-controls="headingOne">
                                                    دسته بندی قطعات خودرو
                                                    @if($filter == 1)({{$count}} کالا )@endif
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </header>
                                        <div class="product-filter">
                                            <div class="card">
                                                <div class="collapse show" id="headingOne">
                                                    <div class="card-main mb-0" style="height: 220px;overflow: auto;">
                                                        @foreach($productgroups as $product_group)
                                                            <div class="form-auth-row">
                                                                <label for="{{$product_group->id}}" class="ui-checkbox">
                                                                    <input type="checkbox" name="productgroup_id[]" id="{{$product_group->id}}"  @if($filter == 1 && $productgroup_id != null) @foreach($productgroup_id as $p) {{$product_group->id == $p->id ? 'checked' : ''}} @endforeach @endif value="{{$product_group->id}}"   >
                                                                    <span class="ui-checkbox-check"></span>
                                                                </label>
                                                                <label for="{{$product_group->id}}"  class="remember-me">{{$product_group->title_fa}}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="mt-2 ">
                                                        <button class="btn btn-range pr">
                                                            اعمال فیلتر
                                                        </button>
                                                        @if($filter == 1)
                                                            @if($sell == 1)
                                                                <a href="{{url('market/sell')}}" class="btn btn-range pl">
                                                                    پاک کردن فیلتر
                                                                </a>
                                                            @elseif($buy == 1)
                                                                <a href="{{url('market/buy')}}" class="btn btn-range pl">
                                                                    پاک کردن فیلتر
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="widget-product-categories">
                                        <header class="cat-header">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right" type="button" data-toggle="collapse" href="#headingTwo" role="button" aria-expanded="false" aria-controls="headingOne">
                                                    برند و مدل خودرو
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </header>
                                        <div class="product-filter">
                                            <div class="card">
                                                <div class="collapse show" id="headingTwo">
                                                    <div class="card-main mb-lg-4">
                                                        <div class="mb-lg-4 mg-lg-4">
                                                            <select name="car_brand_id" class="form-control select-lg select2" id="car_brand_id">
                                                                <option value="">انتخاب برند خودرو</option>
                                                                @foreach($carbrands as $car_brand)
                                                                    <option value="{{$car_brand->id}}" {{request('car_brand_id') == $car_brand->id ? 'selected' : '' }} >{{$car_brand->title_fa}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-lg-4 mg-lg-4">
                                                            <select multiple="multiple" name="car_model_id[]" id="car_model_id" class="form-control select2">
                                                                @if($filter == 1)
                                                                    @foreach($carmodels as $car_model)
                                                                        <option value="{{$car_model->id}}" @if($filter == 1 && $carmodel_id != null) @foreach($carmodel_id as $c) {{$car_model->id == $c->id ? 'selected' : ''}} @endforeach @endif>{{$car_model->title_fa}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 ">
                                                        <button class="btn btn-range pr">
                                                            اعمال فیلتر
                                                        </button>
                                                        @if($filter == 1)
                                                            @if($sell == 1)
                                                                <a href="{{url('market/sell')}}" class="btn btn-range pl">
                                                                    پاک کردن فیلتر
                                                                </a>
                                                            @elseif($buy == 1)
                                                                <a href="{{url('market/buy')}}" class="btn btn-range pl">
                                                                    پاک کردن فیلتر
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="widget-product-categories">
                                        <header class="cat-header">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right" type="button" data-toggle="collapse" href="#headingThree" role="button" aria-expanded="false"  aria-controls="headingTwo">
                                                    برند قطعات خودرو
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </header>
                                        <div class="product-filter">
                                            <div class="card">
                                                <div class="collapse show" id="headingThree">
                                                    <div class="card-main mb-0" style="height: 220px;overflow: auto;">
                                                        @foreach($brands as $brand)
                                                            <div class="form-auth-row">
                                                                <label for="{{$brand->id *999999}}" class="ui-checkbox">
                                                                    <input type="checkbox" value="{{$brand->id}}" name="brand_id[]"  @if($filter == 1 && $brand_id != null) @foreach($brand_id as $b)  {{$brand->id == $b->id ? 'checked' : ''}} @endforeach @endif   id="{{$brand->id *999999}}">
                                                                    <span class="ui-checkbox-check"></span>
                                                                </label>
                                                                <label for="{{$brand->id * 999999}}"  class="remember-me">{{$brand->title_fa}}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="mt-2 ">
                                                        <button class="btn btn-range pr">
                                                            اعمال فیلتر
                                                        </button>
                                                        @if($filter == 1)
                                                            @if($sell == 1)
                                                                <a href="{{url('market/sell')}}" class="btn btn-range pl">
                                                                    پاک کردن فیلتر
                                                                </a>
                                                            @elseif($buy == 1)
                                                                <a href="{{url('market/buy')}}" class="btn btn-range pl">
                                                                    پاک کردن فیلتر
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-xs-12 pl">
                        <div class="shop-archive-content mt-3 d-block">
                            <div class="archive-header">
                                <div class="nav-sort-tabs-res text-center">
                                    <ul class="nav sort-tabs-options" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link @if($sell == 1) active @endif" href="{{route('sell')}}">پیشنهادات فروش</a>
                                        </li>
                                        <li class="nav-item">
                                            |
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link @if($buy == 1) active @endif" href="{{route('buy')}}">پیشنهادات خرید</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="archive-header">
                                <div class="sort-tabs mt-0 d-inline-block pr">
                                    <h4>مرتب ‌سازی بر اساس :</h4>
                                </div>
                                <div class="nav-sort-tabs-res">
                                    <ul class="nav sort-tabs-options" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="newoffer-tab" data-toggle="tab" href="#newoffer"
                                               role="tab" aria-controls="newest" aria-selected="true">جدیدترین</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="location-tab" data-toggle="tab"
                                               href="#location" role="tab" aria-controls="location"
                                               aria-selected="false">نزدیک ترین</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="top-visited-tab" data-toggle="tab"
                                               href="#top-visited" role="tab" aria-controls="top-visited"
                                               aria-selected="false">پربازدیدترین</a>
                                        </li>
                                    </ul>
                                    <div class="float-left">
                                            <a href="{{url('offer')}}" class="btn btn-outline-danger" target="_blank" data-toggle="tooltip" data-placement="right" title="در صورت تمایل به درج آگهی کالای خود با کلیک روی این کلید ابتدا ثبت نام و سپس آگهی خود را تکمیل نمایید">ثبت آگهی</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-items">
                                <div class="tab-content" id="myTabContent">
                                    @if($sell == 1)
                                        <div class="tab-pane fade  show active" id="newoffer" role="tabpanel" aria-labelledby="newoffer-tab">
                                        <div class="row">
                                            @foreach($selloffers as $offer)
                                                @if(Auth::check() && Auth::user()->type_id == 1)
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
                                                        <span class="amount">{{number_format($offer->single_price)}}
                                                            <span>تومان</span>
                                                        </span>
                                                        </div>
                                                        <div class="title">
                                                            @if($offer->brand_id == null)
                                                                {{$offer->brand_name}}
                                                            @elseif($offer->brand_id != null)
                                                                @foreach($brands as $brand)
                                                                    @if($offer->brand_id == $brand->id)
                                                                        {{$brand->title_fa}}
                                                                    @endif
                                                                @endforeach
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
                                                            <div class="title">
                                                        <span class="amount">{{number_format($offer->single_price)}}
                                                            <span>تومان</span>
                                                        </span>
                                                            </div>
                                                            <div class="title">
                                                                @if($offer->brand_id == null)
                                                                    {{$offer->brand_name}}
                                                                @elseif($offer->brand_id != null)
                                                                    @foreach($brands as $brand)
                                                                        @if($offer->brand_id == $brand->id)
                                                                            {{$brand->title_fa}}
                                                                        @endif
                                                                    @endforeach
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
                                                            <span class="amount">{{number_format($offer->single_price)}}
                                                                <span>تومان</span>
                                                            </span>
                                                                </div>
                                                                <div class="title">
                                                                    @if($offer->brand_id == null)
                                                                        {{$offer->brand_name}}
                                                                    @elseif($offer->brand_id != null)
                                                                        @foreach($brands as $brand)
                                                                            @if($offer->brand_id == $brand->id)
                                                                                {{$brand->title_fa}}
                                                                            @endif
                                                                        @endforeach
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
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$selloffers->appends(
                                                ['productgroup_id' => request('productgroup_id')
                                                , 'car_brand_id' => request('car_brand_id')
                                                , 'car_model_id' => request('car_model_id')
                                                , 'type' => request('type')
                                                , 'state_id' => request('state_id')
                                                , 'city_id' => request('city_id')
                                                , 'range' => request('range')
                                                , 'brand_id' => request('brand_id')])->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    @elseif($buy == 1)
                                        <div class="tab-pane fade show active" id="newoffer" role="tabpanel" aria-labelledby="newoffer-tab">
                                        <div class="row">
                                            @foreach($buyoffers as $offer)
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
                                                        <span class="amount">{{number_format($offer->single_price)}}
                                                            <span>تومان</span>
                                                        </span>
                                                        </div>
                                                        <div class="title">
                                                            @if($offer->brand_id == null)
                                                                {{$offer->brand_name}}
                                                            @elseif($offer->brand_id != null)
                                                                @foreach($brands as $brand)
                                                                    @if($offer->brand_id == $brand->id)
                                                                        {{$brand->title_fa}}
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="price">
                                                            <span class="amount">{{jdate($offer->created_at)->ago()}}</span>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$buyoffers->appends(
                                                ['productgroup_id' => request('productgroup_id')
                                                , 'car_brand_id' => request('car_brand_id')
                                                , 'car_model_id' => request('car_model_id')
                                                , 'type' => request('type')
                                                , 'state_id' => request('state_id')
                                                , 'city_id' => request('city_id')
                                                , 'range' => request('range')
                                                , 'brand_id' => request('brand_id')])->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    @endif
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
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('site/js/popper.min.js')}}"></script>
    <script src="{{asset('site/js/bootstrap.min.js')}}"></script>
    <script>
        $(function(){
            $('#car_brand_id').change(function(){
                $("#car_model_id option").remove();
                var id = $('#car_brand_id').val();
                $.ajax({
                    url : '{{ route( 'modeloption' ) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function( result )
                    {
                        $.each( result, function(k, v) {
                            $('#car_model_id').append($('<option>', {value:k, text:v}));
                        });
                    },
                    error: function()
                    {
                        alert('error...');
                    }
                });
            });
        });
    </script>
    <script>
        $(function(){
            $('#state_id').change(function(){
                $("#city_id option").remove();
                var id = $('#state_id').val();

                $.ajax({
                    url : '{{ route( 'marketoption' ) }}',
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
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        var slider = document.getElementById('slider');
        var limitedPrices = document.getElementById('limitedPrice');

        noUiSlider.create(slider, {
            start: [0, {{$max_price}}],
            connect: true,
            range: {
               'min': 0,
               'max': {{$max_price}}
            },

            step: 1000,
            direction: 'rtl',
            behaviour: 'tap-drag',
            tooltips: [true, wNumb({decimals: 0})],

        });
        slider.noUiSlider.on('update', function (values) {
            limitedPrices.innerHTML = values.join(' - ');
        });

    </script>

@endsection
