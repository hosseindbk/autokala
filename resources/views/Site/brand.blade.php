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
                            <form action="{{route('brandsearch')}}" method="get" class="form-search">
                                <input type="search" class="header-search-input" name="brandsearch" placeholder="نام برند قطعات مورد نظر خود را جستجو کنید…">
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
                                <li class="breadcrumb-item active" aria-current="page">برند قطعات خودرو</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xs-12 pr sticky-sidebar">
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
                                                <form action="{{route('brandfilter')}}" method="get">
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <footer class="footer-main-site">
        <section class="d-block d-xl-block d-lg-block d-md-block d-sm-block order-1">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="footer-middlebar">
                        <div class="col-lg-8 d-block pr">
                            <div class="footer-links">
                                <div class="col-lg-3 col-md-3 col-xs-12 pr">
                                    <div class="row">
                                        <section class="footer-links-col">
                                            <div class="headline-links">
                                                <a href="#">
                                                    با اتوکالا
                                                </a>
                                            </div>
                                            <ul class="footer-menu-ul">
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        اتاق خبر اتوکالا
                                                    </a>
                                                </li>
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        فروش در اتوکالا
                                                    </a>
                                                </li>
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        همکاری با سازمان‌ها
                                                    </a>
                                                </li>
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        فرصت‌های شغلی
                                                    </a>
                                                </li>
                                            </ul>
                                        </section>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 pr">
                                    <div class="row">
                                        <section class="footer-links-col">
                                            <div class="headline-links">
                                                <a href="#">
                                                    خدمات مشتریان
                                                </a>
                                            </div>
                                            <ul class="footer-menu-ul">
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        پاسخ به پرسش‌های متداول
                                                    </a>
                                                </li>
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        رویه‌های بازگرداندن کالا
                                                    </a>
                                                </li>
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        شرایط استفاده
                                                    </a>
                                                </li>
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        حریم خصوصی
                                                    </a>
                                                </li>
                                            </ul>
                                        </section>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 pr">
                                    <div class="row">
                                        <section class="footer-links-col">
                                            <div class="headline-links">
                                                <a href="#">
                                                    راهنمای خرید از اتوکالا
                                                </a>
                                            </div>
                                            <ul class="footer-menu-ul">
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        نحوه ثبت سفارش
                                                    </a>
                                                </li>
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        رویه ارسال سفارش
                                                    </a>
                                                </li>
                                                <li class="menu-item-type-custom">
                                                    <a href="#">
                                                        شیوه‌های پرداخت
                                                    </a>
                                                </li>
                                            </ul>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 d-block pl">
                            <div class="shortcode-widget-area">
                                <form action="#" class="form-newsletter">
                                    <fieldset>
                                        <span class="form-newsletter-title"> با عضویت در خبرنامه از آخرین اخبار و
                                            محصولات سایت مطلع شوید...</span>
                                        <div class="input-group-newsletter">
                                            <input type="email" class="input-field form-control"
                                                   placeholder="آدرس ایمیل خود را وارد کنید">
                                            <button class="btn btn-info btn-secondary" type="submit">ارسال</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <div class="footer-more-info">
                            <div class="col-lg-10 pr">
                                <div class="footer-content d-block">
                                    <div class="text pr-1">
                                        <h2 class="title">اتوکالا مرجع تخصصی لوازم و قطعات یدکی اصلی خودرو</h2>
                                        <p class="desc">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها اساسا مورد استفاده قرار گیرد.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 pl">
                                <div class="footer-safety-partner">
                                    <div class="widget widget-product card mb-0">
                                        <div class="product-carousel-symbol owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                                            <div class="owl-stage-outer">
                                                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                                                    <div class="owl-item active" style="width: 300.75px; margin-left: 10px;">
                                                        <div class="item">
                                                            <a href="#" class="d-block hover-img-link">
                                                                <img src="{{asset('site/images/footer/license/L-1.png')}} " style="width: 120px;" class="img-fluid img-brand" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="owl-item active" style="width: 300.75px; margin-left: 10px;">
                                                        <div class="item">
                                                            <a href="#" class="d-block hover-img-link mt-0">
                                                                <img src="{{asset('site/images/footer/license/L-2.png')}}" style="width: 120px;" class="img-fluid img-brand" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-copyright">
                                <div class="footer-copyright-text">
                                    <p>کلیه حقوق این وبسایت به اتوکالا نیک آراد (سامانه جامع قطعات و خدمات خودرو) تعلق دارد</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>
@endsection
@section('script')
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection

