@extends('master')
@section('title')
    <title>ارتباط با اتوکالا بازار مجازی قطعات خودرو و ماشین آلات</title>
    <link rel="stylesheet" href="{{asset('site/css/vendor/lightgallery.css')}}">

@endsection
@section('top-header')
    <section class="h-main-row">
        <div class="col-lg-12 col-md-12 col-xs-12 pr">
            <div class="header-right">
                <div class="col-lg-4 pr">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('productsearchandfilter')}}" method="get" class="form-search">
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
                    <h2 style="padding: 2px 0px 0px 0px;font-size: 12px;">اتوکالا بازار مجازی قطعات خودرو و ماشین آلات</h2>
                </div>
            </div>
            <div class="header-left">
                <div class="col-lg-4 pl">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('productsearchandfilter')}}" value="{{request('unicode')}}" method="get" class="form-search">
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
                    <div class="col-lg-2 col-md-2 pr"></div>
                    <div class="col-lg-3 col-md-3 col-xs-12 pr">
                            <div class="adplacement-container-row mt-4">
                                <a href="#" class="adplacement-item">
                                    <div class="adplacement-sponsored_box">
                                        <img src="{{asset('site/images/logo_load.png')}}" alt="اتوکالا سامانه جامع قطعات و خدمات خودرو">
                                    </div>
                                </a>
                            </div>
                        </div>
                    <div class="col-lg-5 col-md-5 col-xs-12 pr">
                        <div class="adplacement-container-row mt-4">
                            <a href="#" class="adplacement-item">
                                <div class="adplacement-sponsored_box">
                                    <img src="{{asset('site/images/contact.jpg')}}" alt="اتوکالا سامانه جامع قطعات و خدمات خودرو">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 pr"></div>
                </div>
                <div class="main-row">
                    <div class="col-md-10" style="margin: 100px auto;color: #716f6f;font-size: 30px;line-height: 60px;">
            <div class="title">
                <h2> دفتر مرکزی </h2>
            </div>
            <br>
            <div class="post-content" style="">
                <i class="fa fa-phone" style="color: #0cc745" ></i>
                <a href="Tel:02177956875" style="color: #716f6f;font-size: 20px" target="_blank">02177956875</a> - <a href="Tel:02177903628" target="_blank" style="color: #716f6f;font-size: 20px">02177903628</a>
            </div>
            <div class="post-content">
                <i class="fa fa-instagram" style="color: #e81a1a"></i>
                <a href="https://instagram.com/autokalaa" style="color: #716f6f;font-size: 20px" target="_blank">  autokalaa  </a>
            </div>
            <div class="post-content">
                <i class="fa fa-telegram" style="color: #0ab2e6"></i>
                <a href="telegram:+989919636099" style="color: #716f6f;font-size: 20px" target="_blank"> 09919636099 </a>
            </div>
            <div class="post-content">
                <i class="fa fa-whatsapp" style="color: #0cc745">  </i>
                <a href="whatsapp:+989919636099" style="color: #716f6f;font-size: 20px" target="_blank"> 09919636099 </a>
            </div>
            <div class="post-content">
                <i class="fa fa-map-pin" style="color: #ff3d00"></i>
                <a href="" style="color: #716f6f;font-size: 20px"> نارمک - خیابان دردشت - بالاتر از میدان شقایق - پلاک 55 </a>
            </div>
        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
