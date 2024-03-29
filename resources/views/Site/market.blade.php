@extends('master')
@section('title')
    <title>بازارچه قطعات و لوازم یدکی خودرو</title>
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

                                <form  @if($sell == 1) action="{{route('market-sell-filter')}}" @elseif($buy == 1) action="{{route('market-sell-filter')}}"  @endif method="get" class="form-search">

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
                    <h2 style="padding: 2px 0 0 0;font-size: 12px;">اتوکالا بازار مجازی قطعات خودرو و ماشین آلات</h2>
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
    @include('sweet::alert')
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

                    <div class="col-lg-3 col-md-3 col-xs-12 pr">
                        <div class="shop-archive-sidebar">
                            <div class="sidebar-archive mb-3">

                                <form @if($sell == 1) action="{{route('market-sell-filter')}}" id="filter_sell_state"  @elseif($buy == 1) action="{{route('market-buy-filter')}}" id="filter_buy_state" @endif method="get" >
                                    <input type="hidden" id="state_id_filter" name="state_id" size="5" value="">

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
                                                                <input type="radio" name="type" id="supandshop" {{request('type') == '1' ? 'checked' : '' }} value="1"   >
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
                                    <section class="widget-product-categories">
                                        <header class="cat-header">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right" type="button" data-toggle="collapse" href="#headingTwo" role="button" aria-expanded="false" aria-controls="headingOne">
                                                    شهرستان
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </header>
                                        <div class="product-filter mt-3">
                                            <div class="card">
                                                <div class="collapse show" id="headingTwo">
                                                    <div class="card-main mb-lg-4">
                                                        <div class="mb-lg-4 mg-lg-4">
                                                            <select name="city_id" class="form-control select-lg select2" id="city_id">
                                                                <option value="">شهرستان</option>
                                                                @foreach($cities as $city)
                                                                    <option value="{{$city->id}}" {{request('city_id') == $city->id ? 'selected' : '' }} >{{$city->title}}</option>
                                                                @endforeach
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
                                    @if(!Auth::check())
                                    <div class="float-left">
                                            <a href="{{url('offer')}}" class="btn btn-outline-danger" target="_blank" data-toggle="tooltip" data-placement="right" title="در صورت تمایل به درج آگهی ابتدا وارد حساب کاربری خود شوید">ثبت آگهی</a>
                                    </div>
                                    @elseif(Auth::check())
                                        <div class="float-left">
                                            <a href="{{url('offer')}}" class="btn btn-outline-danger" target="_blank" >ثبت آگهی</a>
                                        </div>
                                    @endif
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
                                                            <div class="title">
                                                        <span class="amount">
                                                            @if($offer->single_price == 0)
                                                                <span>توافقی</span>
                                                            @else
                                                                {{number_format($offer->single_price)}}
                                                                <span>تومان</span>
                                                            @endif
                                                        </span>
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
                                                            <span class="amount">
                                                            @if($offer->single_price == 0)
                                                                    <span>توافقی</span>
                                                                @else
                                                                    {{number_format($offer->single_price)}}
                                                                    <span>تومان</span>
                                                                @endif
                                                        </span>
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
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$selloffers->appends(request()->all())->links()}}
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
                                                        <span class="amount">
                                                            @if($offer->single_price == 0)
                                                                <span>توافقی</span>
                                                            @else
                                                                {{number_format($offer->single_price)}}
                                                                <span>تومان</span>
                                                            @endif
                                                        </span>
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
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$buyoffers->appends(request()->all())->links()}}
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
        $('#state_filter').change(function(){
            var id = $('#state_filter').val();
            document.getElementById("state_id_filter").value = id;
            @if($sell == 1) $('#filter_sell_state').closest('form').submit();  @elseif($buy == 1) $('#filter_buy_state').closest('form').submit();  @endif
        })
    </script>
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
{{--    <script>--}}
{{--        $(function(){--}}
{{--            $('#state_id').change(function(){--}}
{{--                $("#city_id option").remove();--}}
{{--                var id = $('#state_id').val();--}}

{{--                $.ajax({--}}
{{--                    url : '{{ route( 'marketoption' ) }}',--}}
{{--                    data: {--}}
{{--                        "_token": "{{ csrf_token() }}",--}}
{{--                        "id": id--}}
{{--                    },--}}
{{--                    type: 'post',--}}
{{--                    dataType: 'json',--}}
{{--                    success: function( result )--}}
{{--                    {--}}
{{--                        $.each( result, function(k, v) {--}}
{{--                            $('#city_id').append($('<option>', {value:k, text:v}));--}}
{{--                        });--}}
{{--                    },--}}
{{--                    error: function()--}}
{{--                    {--}}
{{--                        //handle errors--}}
{{--                        alert('error...');--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
{{--    <script>--}}
{{--        var slider = document.getElementById('slider');--}}
{{--        var limitedPrices = document.getElementById('limitedPrice');--}}

{{--        noUiSlider.create(slider, {--}}
{{--            start: [0, {{$max_price}}],--}}
{{--            connect: true,--}}
{{--            range: {--}}
{{--               'min': 0,--}}
{{--               'max': {{$max_price}},--}}
{{--            },--}}

{{--            step: 1000,--}}
{{--            direction: 'rtl',--}}
{{--            behaviour: 'tap-drag',--}}
{{--            tooltips: [true, wNumb({decimals: 0})],--}}

{{--        });--}}
{{--        slider.noUiSlider.on('update', function (values) {--}}
{{--            limitedPrices.innerHTML = values.join(' - ');--}}
{{--        });--}}

{{--    </script>--}}

@endsection
