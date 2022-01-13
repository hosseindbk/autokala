@extends('master')
@section('title')
    <title>بازارچه مجازی وبسایت اتوکالا</title>
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('top-header')
    <section class="h-main-row">
        <div class="col-lg-12 col-md-12 col-xs-12 pr">
            <div class="header-right">
                <div class="col-lg-4 pr">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('offersearch')}}" method="get" class="form-search">
                                <input type="text" class="header-search-input" name="offersearch" value="{{request('offersearch')}}" placeholder="نام کالای مورد نظر خود را جستجو کنید…">
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
                                <form action="{{route('marketfilter')}}" method="get">
                                    <section class="widget-product-categories">
                                        <header class="cat-header">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right" type="button" data-toggle="collapse"
                                                        href="#headingOne" role="button" aria-expanded="false"
                                                        aria-controls="headingOne">
                                                    دسته بندی قطعات خودرو
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
                                                            <a href="{{url('market')}}" class="btn btn-range pl">
                                                                پاک کردن فیلتر
                                                            </a>
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
                                                            <a href="{{url('market')}}" class="btn btn-range pl">
                                                                پاک کردن فیلتر
                                                            </a>
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
                                                    محدوده قیمت
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </header>
                                        <div class="product-filter mt-3">
                                            <div class="card">
                                                <div class="collapse show" id="headingfor">
                                                    <div class="card custom-card">
                                                        <div class="card-body">
                                                            <div class="row row-sm mg-t-40">
                                                                <div class="col-lg-12">
                                                                    <div class="range-slider">
                                                                        <input class="range-slider__range" type="range" name="range" style="width: 100%;direction: ltr;" value="{{$max_price}}" min="{{$min_price}}" max="{{$max_price}}" step="{{$max_price / 100}}">

                                                                        <span class="range-slider__value"></span>
                                                                        <b>تومان</b>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="mt-2 ">
                                                        <button class="btn btn-range pr">
                                                            اعمال فیلتر
                                                        </button>
                                                        @if($filter == 1)
                                                            <a href="{{url('market')}}" class="btn btn-range pl">
                                                                پاک کردن فیلتر
                                                            </a>
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
                                    <ul class="nav sort-tabs-options" id="myTab" role="tablist" >
                                        <li class="nav-item">
                                            <a class="nav-link active" style="font-size: 18px;" id="sale-offer-tab" data-toggle="tab" href="#sale-offer"
                                               role="tab" aria-controls="newest" aria-selected="true">پیشهادات فروش </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " style="font-size: 18px;" id="Most-visited-tab" data-toggle="tab"
                                               href="#buy-offer" role="tab" aria-controls="buy-offer"
                                               aria-selected="false">پیشنهادات خرید </a>
                                        </li>
                                    </ul>
                                    <div class="float-left">
                                        <a href="{{url('offer')}}" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="right" title="در صورت تمایل به درج آگهی کالای خود با کلیک روی این کلید ابتدا ثبت نام و سپس آگهی خود را تکمیل نمایید">ثبت آگهی</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-items">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade  show active" id="sale-offer" role="tabpanel" aria-labelledby="sale-offer-tab">
                                        <div class="row">
                                            @foreach($selloffers as $offer)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div style="float: right">
                                                            @foreach($users as $user)
                                                                @if($offer->user_id == $user->id)
                                                                    @if($user->type_id == 1 || $user->type_id == 3)
                                                                        <button class="btn btn-danger">فروشگاه</button>
                                                                    @elseif($user->type_id == 4)
                                                                        <button class="btn btn-success">شخصی</button>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="thumb">
                                                            <a href="{{url('market'.'/'.$offer->slug)}}" target="_blank" class="d-block">
                                                                <img src="{{asset($offer->image1)}}" style="height: 235px;" alt="{{$offer->title}}">
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('market'.'/'.$offer->slug)}}" target="_blank">{{$offer->title}}</a>
                                                        </div>
                                                        <div class="price">
                                                    <span class="amount">{{number_format($offer->single_price)}}
                                                        <span>تومان</span>
                                                    </span>
                                                        </div>
                                                        <div class="title">
                                                            @foreach($brands as $brand)
                                                                @if($offer->brand_id == $brand->id)
                                                                    {{$brand->title_fa}}
                                                                @elseif($offer->brand_id == null)
                                                                    {{$offer->brand_name}}
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$selloffers->appends(
                                                ['productgroup_id' => request('productgroup_id')
                                                , 'car_brand_id' => request('car_brand_id')
                                                , 'car_model_id' => request('car_model_id')
                                                , 'brand_id' => request('brand_id')])->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="buy-offer" role="tabpanel" aria-labelledby="buy-offer-tab">
                                        <div class="row">
                                            @foreach($buyoffers as $offer)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div style="float: right">
                                                            @foreach($users as $user)
                                                                @if($offer->user_id == $user->id)
                                                                    @if($user->type_id == 1 || $user->type_id == 3)
                                                                        <button class="btn btn-danger">فروشگاه</button>
                                                                    @elseif($user->type_id == 4)
                                                                        <button class="btn btn-success">شخصی</button>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="thumb">
                                                            <a href="{{url('market'.'/'.$offer->slug)}}" class="d-block" target="_blank">
                                                                <img src="{{asset($offer->image1)}}" style="height: 235px;" alt="{{$offer->title}}">
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('market'.'/'.$offer->slug)}}" target="_blank">{{$offer->title}}</a>
                                                        </div>
                                                        <div class="price">
                                                    <span class="amount">{{number_format($offer->single_price)}}
                                                        <span>تومان</span>
                                                    </span>
                                                        </div>
                                                        <div class="title">
                                                            @foreach($brands as $brand)
                                                                @if($offer->brand_id == $brand->id)
                                                                    {{$brand->title_fa}}
                                                                @elseif($offer->brand_id == null)
                                                                    {{$offer->brand_name}}
                                                                @endif
                                                            @endforeach
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
                                                , 'brand_id' => request('brand_id')])->links()}}
                                            </nav>
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
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('site/js/popper.min.js')}}"></script>
    <script src="{{asset('site/js/bootstrap.min.js')}}"></script>

    <script>
        $(function(){
            $('#state_id').change(function(){
                $("#city_id option").remove();
                var id = $('#state_id').val();

                $.ajax({
                    url : '{{ route( 'state' ) }}',
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
        var rangeSlider = function(){
            var slider = $('.range-slider'),
                range = $('.range-slider__range'),
                value = $('.range-slider__value');

            slider.each(function(){

                value.each(function(){
                    var value = $(this).prev().attr('value');
                    $(this).html(value);
                });

                range.on('input', function(){
                    $(this).next(value).html(this.value);
                });
            });
        };

        rangeSlider();
    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
