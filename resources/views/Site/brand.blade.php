@extends('master')
@section('title')
    <title> برند قطعات خودرو در وبسایت اتوکالا</title>
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('top-header')
    <section class="h-main-row">
        <div class="col-lg-12 col-md-12 col-xs-12 pr">
            <div class="header-right">
                <div class="col-lg-4 pr">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('brandsearchandfilter')}}" method="get" class="form-search">
                                <input type="search" class="header-search-input" value="{{request('brandsearch')}}" name="brandsearch" placeholder="نام برند قطعات مورد نظر خود را جستجو کنید…">
                                <div class="action-btns">
                                    <button class="btn btn-search" type="submit">
                                        <img src="{{asset('site/images/search.png')}}" alt="search">
                                    </button>
                                    <div class="search-filter">
                                        <div class="form-ui">
                                            <div class="custom-select-ui">
                                                <select class="right" name="category_id">
                                                    <option value="all">همه دسته ها</option>
                                                    <option value="title_fa">نام فارسی برند</option>
                                                    <option value="title_en">نام لاتین برند</option>
                                                    <option value="abstract_title">نام اختصار برند</option>
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
                    <h2 style="padding: 2px 0px 0px 0px;font-size: 12px;">اتوکالا بازار مجازی قطعات خودرو و ماشین آلات</h2>
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
                                <li class="breadcrumb-item active" aria-current="page">برند قطعات خودرو</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xs-12 pr">
                        <div class="shop-archive-sidebar">
                            <div class="sidebar-archive mb-3">
                                <section class="widget-product-categories">
                                    <header class="cat-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block text-right" data-toggle="collapse"
                                                href="#headingOne" role="button" aria-expanded="false"
                                                aria-controls="headingOne">
                                                کشور سازنده برند
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </header>
                                    <div class="product-filter">
                                        <div class="card">
                                            <div class="collapse show" id="headingOne">
                                                <form action="{{route('brandsearchandfilter')}}" method="get">
                                                <div class="card-main mb-0" style="height: 100px;overflow: auto;">
                                                    <div class="mb-lg-4 mg-lg-4 mt-4">
                                                        <select multiple="multiple" name="country_id[]" id="country_id" class="form-control select2">
                                                                @foreach($countries as $country)
                                                                <option value="{{$country->id}}" {{request('country_id') == $country->id ? 'selected' : '' }}>{{$country->name}} - {{$country->name_fa}}</option>
                                                             @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mt-2 pl">
                                                    <button class="btn btn-range">
                                                        اعمال فیلتر
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-xs-12 pl">
                        <div class="shop-archive-content mt-3 d-block">
                            <div class="archive-header">
                                <div class="sort-tabs mt-0 d-inline-block pr">
                                    <h4>مرتب ‌سازی بر اساس :</h4>
                                </div>
                                <div class="nav-sort-tabs-res">
                                    <ul class="nav sort-tabs-options" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="newbrand-tab" data-toggle="tab" href="#newbrand"
                                               role="tab" aria-controls="newest" aria-selected="true">جدیدترین</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="oldbrand-tab" data-toggle="tab"
                                               href="#oldbrand" role="tab" aria-controls="oldbrand"
                                               aria-selected="false">قدیمی ترین</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="Most-visited-tab" data-toggle="tab"
                                               href="#Most-visited" role="tab" aria-controls="Most-visited"
                                               aria-selected="false">بالاترین امتیاز</a>
                                        </li>
                                    </ul>
                                    <div class="float-left">
                                        @if(Auth::check() && Auth::user()->type_id == 1)
                                            <a href="{{url('brand-create')}}" class="btn btn-outline-primary" >افزودن برند جدید</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="product-items">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade  show active" id="newbrand" role="tabpanel" aria-labelledby="newbrand-tab">
                                        <div class="row">
                                            @foreach($newbrands as $brand)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('brand'.'/'.$brand->slug)}}" class="d-block">
                                                                @if(! $brand->image )
                                                                    <img src="{{asset('images/techndical_defult.png')}}" style="height: 235px;" alt="{{$brand->title_fa}}">
                                                                @else
                                                                    <img src="{{asset($brand->image)}}" style="height: 235px;" alt="{{$brand->title_fa}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('brand'.'/'.$brand->slug)}}">{{$brand->title_fa}}</a>
                                                        </div>
                                                        <div class="title">
                                                            <p><b style="color: #fff;">.</b><a href="{{'https://'.$brand->website}}" target="_blank">{{$brand->website}}</a></p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$newbrands->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade " id="oldbrand" role="tabpanel" aria-labelledby="oldbrand-tab">
                                        <div class="row">
                                            @foreach($oldbrands as $brand)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('brand'.'/'.$brand->slug)}}" class="d-block">
                                                                @if(! $brand->image )
                                                                    <img src="{{asset('images/techndical_defult.png')}}" style="height: 235px;" alt="{{$brand->title_fa}}">
                                                                @else
                                                                    <img src="{{asset($brand->image)}}" style="height: 235px;" alt="{{$brand->title_fa}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('brand'.'/'.$brand->slug)}}">{{$brand->title_fa}}</a>
                                                        </div>
                                                        <div class="title">
                                                            <p><b style="color: #fff;">.</b><a href="{{'https://'.$brand->website}}" target="_blank">{{$brand->website}}</a></p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$oldbrands->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade " id="Most-visited" role="tabpanel" aria-labelledby="Most-visited-tab">
                                        <div class="row">
                                            @foreach($clickbrands as $brand)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('brand'.'/'.$brand->slug)}}" class="d-block">
                                                                @if(! $brand->image )
                                                                    <img src="{{asset('images/techndical_defult.png')}}" style="height: 235px;" alt="{{$brand->title_fa}}">
                                                                @else
                                                                    <img src="{{asset($brand->image)}}" style="height: 235px;" alt="{{$brand->title_fa}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('brand'.'/'.$brand->slug)}}">{{$brand->title_fa}}</a>
                                                        </div>
                                                        <div class="title">
                                                            <p><b style="color: #fff;">.</b><a href="{{'https://'.$brand->website}}" target="_blank">{{$brand->website}}</a></p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$clickbrands->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabs m-0">
                        <div class="col-lg">
                            <div class="tabs-content">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="Review" role="tabpanel" aria-labelledby="Review-tab">
                                        <section class="content-expert-summary">
                                            <div class="mask pm-3">
                                                <div class="mask-text">@foreach($menus as $menu) @if($menu->id == 6) {!! $menu->textpage !!} @endif @endforeach</div>
                                                <a href="#" class="mask-handler">
                                                    <span class="show-more">+ ادامه مطلب</span>
                                                    <span class="show-less">- بستن</span>
                                                </a>
                                                <div class="shadow-box"></div>
                                            </div>
                                        </section>
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
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection

