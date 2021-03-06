@extends('master')
@section('title')
    <title>@foreach($suppliers as $supplier) {{$supplier->title}} @endforeach | فروشگاه لوازم یدکی در اتوکالا </title>
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
                            <form action="{{route('suppliersearchandfilter')}}" method="get" class="form-search">
                                <input type="search" class="header-search-input" value="{{request('suppliersearch')}}" name="suppliersearch" placeholder="نام فروشگاه یا تامین کننده مورد نظر خود را جستجو کنید…">
                                <div class="action-btns">
                                    <button class="btn btn-search" type="submit">
                                        <img src="{{asset('site/images/search.png')}}" alt="search">
                                    </button>
                                    <div class="search-filter">
                                        <div class="form-ui">
                                            <div class="custom-select-ui">
                                                <select class="right" name="category_id">
                                                    <option value="all">همه دسته ها</option>
                                                    <option value="title">نام فروشگاه یا تولید کننده</option>
                                                    <option value="manager">نام مدیر</option>
                                                    <option value="phone">شماره تماس</option>
                                                    <option value="mobile">شماره همراه</option>
                                                    <option value="address">آدرس</option>
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
                    <h2 style="padding: 2px 0px 0px 0px;font-size: 12px;">سامانه جامع قطعات خودرو و ماشین آلات</h2>
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
                                <li class="breadcrumb-item"><a href="{{url('supplier')}}">تامین کنندگان</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@foreach($suppliers as $supplier) {{$supplier->title}} @endforeach</li>
                            </ol>
                        </nav>
                    </div>
                    @foreach($suppliers as $supplier)
                        <div class="col-lg">
                            <div class="product type-product">
                                <section class="product-gallery">
                                    <div class="gallery">
                                        <div class="gallery-item">
                                            <div>
                                                <ul class="" style="float: left;">
                                                    <li class="unic_code">
                                                        <a href="#" class="btn btn-outline-success">
                                                            <span>سابقه عضویت {{jdate($supplier->created_at)->ago()}}</span>
                                                        </a>
                                                    </li>
                                                    <li class="unic_code">
                                                        @foreach($states as $state) @if($supplier->state_id == $state->id ) استان :  {{$state->title}} @endif @endforeach
                                                        |
                                                        @foreach($cities as $city) @if($supplier->city_id == $city->id ) شهر :  {{$city->title}} @endif @endforeach
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
                                                        <?php $x = number_format(($commentratequality + $commentratevalue + $commentrateinnovation + $commentrateability + $commentratedesign + $commentratecomfort) /6 , 1) ?>
                                                        @if($x == 0)
                                                            <p> هنوز امتیازی ثبت نشده است.</p>
                                                        @else
                                                            <h5> امتیاز کاربران : {{number_format(($commentratequality + $commentratevalue + $commentrateinnovation + $commentrateability + $commentratedesign + $commentratecomfort) / 6 , 1)}} از 5</h5>
                                                        @endif

                                                        <div class="product-rate">

                                                            <i class="fa fa-star @if($x > 0) active @endif"></i>
                                                            <i class="fa fa-star @if($x >= 1) active @endif"></i>
                                                            <i class="fa fa-star @if($x >= 2) active @endif"></i>
                                                            <i class="fa fa-star @if($x >= 3) active @endif"></i>
                                                            <i class="fa fa-star @if($x >= 4) active @endif"></i>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="gallery-item">
                                                <div class="gallery-img">
                                                    <a href="#">
                                                        @if(! $supplier->image)
                                                            <img class="zoom-img" id="img-product-zoom" src="{{asset('images/supplier_defult.png')}}" data-zoom-image="{{asset('images/supplier_defult.png')}}" width="411" />
                                                        @else
                                                            <img class="zoom-img" id="img-product-zoom" src="{{asset($supplier->image)}}" data-zoom-image="{{asset($supplier->image)}}" width="411" />
                                                        @endif
                                                        <div id="gallery_01f" style="width:420px;float:right;">
                                                    </a>
                                                    <ul class="gallery-items owl-carousel owl-theme" id="gallery-slider">
                                                        @if($supplier->image)
                                                            <li class="item">
                                                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($supplier->image)}}" data-zoom-image="{{asset($supplier->image)}}">
                                                                    <img src="{{asset($supplier->image)}}" width="100" /></a>
                                                            </li>
                                                            @endif
                                                        @if($supplier->image2)
                                                            <li class="item">
                                                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($supplier->image2)}}" data-zoom-image="{{asset($supplier->image2)}}">
                                                                    <img src="{{asset($supplier->image2)}}" width="100" /></a>
                                                            </li>
                                                            @endif
                                                        @if($supplier->image3)
                                                            <li class="item">
                                                                <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($supplier->image3)}}" data-zoom-image="{{asset($supplier->image3)}}">
                                                                    <img src="{{asset($supplier->image3)}}" width="100" />
                                                                </a>
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
                                        <div class="col-lg-6 col-md-6 col-xs-12 pr">

                                        <div class="product-headline">
                                            <h1 class="product-title"> فروشگاه  {{$supplier->title}}  </h1>

                                            @if($supplier->pageurl)
                                                <a href="{{'https://my-autokala.ir/company/'.$supplier->pageurl}}" class="btn btn-success">
                                                    <span> سایت فروشگاه </span>
                                                </a>
                                            @endif

                                        </div>
                                        <div class="product-headline">
                                            <span class="product-title"> مدیریت :   {{$supplier->manager}}  </span>
                                        </div>
                                        <div class="product-config-wrapper">
                                                <div class="product-params pt-3">
                                                    <div  class="product-headline">
                                                        <span class="product-title" style="color: #ff3d00;"> اطلاعات فروشگاه </span>
                                                    </div>
                                                    <ul>
                                                        <li>
                                                            <span>نوع فعالیت : </span>
                                                            @if($supplier->manufacturer == 1)
                                                                <span style="margin: 5px;"><i class="fa fa-check-circle" style="margin:0 5px;"></i>تولید کننده </span>
                                                            @endif
                                                            @if($supplier->importer == 1)
                                                                <span style="margin: 5px;"><i class="fa fa-check-circle" style="margin:0 5px;"></i>وارد کننده </span>
                                                            @endif
                                                            @if($supplier->whole_seller == 1)
                                                                <span style="margin: 5px;"><i class="fa fa-check-circle" style="margin:0 5px;"></i>عمده فروش </span>
                                                            @endif
                                                            @if($supplier->retail_seller == 1)
                                                                <span style="margin: 5px;"><i class="fa fa-check-circle" style="margin:0 5px;"></i>خرده فروش </span>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-params pt-3">
                                                    <div class="product-headline">
                                                        <span class="product-title" style="color: #ff3d00;"> اطلاعات تماس </span>
                                                    </div>
                                                    <ul>
                                                        <li>
                                                            <span>کد فروشگاه : </span>
                                                            <span>{{$supplier->id}}</span>
                                                        </li>
                                                        <li>
                                                            <span>شماره ثابت : </span>
                                                            <span>{{$supplier->phone}}</span>
                                                        </li>
                                                        <li>
                                                            <span>شماره همراه : </span>
                                                            <span>{{$supplier->mobile}}</span>
                                                        </li>
                                                        <li>
                                                            <span>اینستاگرام : </span>
                                                            <span>@if($supplier->website) <a href="{{'https://'.$supplier->website}}" target="_blank">لینک </a> @endif</span>
                                                        </li>
                                                        <li>
                                                            <span>ایمیل : </span>
                                                            <span>{{$supplier->email}}</span>
                                                        </li>
                                                        <li>
                                                            <span>شماره پیام رسان (واتس آپ و..) : </span>
                                                            <span>{{$supplier->whatsapp}}</span>
                                                        </li>
                                                        <li>
                                                            <span>آدرس : </span>
                                                            <span>{{$supplier->address}}</span>
                                                        </li>
                                                        <li>
                                                            <span>توضیحات : </span>
                                                            <p>{!! $supplier->description !!}</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 pl text-center">
                                            @if($supplier->autokala == 3)
                                                <img src="{{asset('images/autokala1.jpg')}}" alt="نشان طلایی اتوکالا">
                                            @elseif($supplier->autokala == 2)
                                                <img src="{{asset('images/autokala2.jpg')}}" alt="نشان نقره ای توکالا">
                                            @elseif($supplier->autokala == 1)
                                                <img src="{{asset('images/autokala3.jpg')}}" alt="نشان برنزی اتوکالا">
                                            @endif
                                        </div>
                                            <div class="col=lg-6 col-md-6 col-xs-12 pr">
                                                <div class="product-seller-info-overal">
                                                    <div class="seller-info-changable">
                                                        <table class="table table-borderless table-profile-comment">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">نام خودرو</th>
                                                                <th scope="col">مدل خودرو</th>
                                                                <th scope="col">دسته بندی قطعات</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($suppliergroups as $suppliergroup)

                                                                <tr>
                                                                    <td>{{$suppliergroup->brand_title}}</td>

                                                                    <td> {{$suppliergroup->model_title}}</td>

                                                                    <td> {{$suppliergroup->product_group}}</td>
                                                                </tr>

                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12 pl" style="margin-top: 20px;">
                                                <div id="app" style="width: 100%; height: 400px;"></div>
                                            </div>
                                    </section>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="tabs">
                            <div class="tab-box">
                                <ul class="tab nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link " id="Review-tab" data-toggle="tab" href="#Review" role="tab"
                                           aria-controls="Review" aria-selected="true">
                                            <i class="mdi mdi-glasses"></i>
                                            نقد و بررسی
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="User-comments-tab" data-toggle="tab" href="#User-comments" role="tab" aria-controls="User-comments" aria-selected="false">
                                            <i  class="mdi mdi-comment-text-multiple-outline"></i>
                                            نظرات کاربران
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="question-and-answer-tab" data-toggle="tab"
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
                                        <div class="tab-pane fade" id="Review" role="tabpanel" aria-labelledby="Review-tab">
                                            <h2 class="params-headline">نقد و بررسی </h2>
                                            <section class="content-expert-summary">
                                                <div class="mask pm-3">
                                                    <div class="mask-text"><p> </p>  </div>
                                                    <a href="#" class="mask-handler">
                                                        <span class="show-more">+ ادامه مطلب</span>
                                                        <span class="show-less">- بستن</span>
                                                    </a>
                                                    <div class="shadow-box"></div>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="tab-pane fade  show active" id="User-comments" role="tabpanel"
                                             aria-labelledby="User-comments-tab">
                                            <div class="comments">
                                                <div>
                                                    <h2 class="params-headline"> امتیاز کاربران به {{$supplier->title}} </h2>
                                                    <h2>{{number_format(($commentratequality + $commentratevalue + $commentrateinnovation + $commentrateability + $commentratedesign + $commentratecomfort) / 6 , 1)}} از 5</h2>
                                                    <div class="product-config">
                                                        <div class="product-rate">
                                                            <?php $x = number_format(($commentratequality + $commentratevalue + $commentrateinnovation + $commentrateability + $commentratedesign + $commentratecomfort) /6 , 1) ?>
                                                            <i class="fa fa-star @if($x > 0) active @endif"></i>
                                                            <i class="fa fa-star @if($x >= 1) active @endif"></i>
                                                            <i class="fa fa-star @if($x >= 2) active @endif"></i>
                                                            <i class="fa fa-star @if($x >= 3) active @endif"></i>
                                                            <i class="fa fa-star @if($x >= 4) active @endif"></i>
                                                        </div>
                                                    </div>
                                                    <span style="float: right;margin-top: 10px;margin-right: 10px;">از مجموع {{$commentratecount}} امتیاز</span>
                                                </div>
                                                <div class="comments-summary">
                                                    <div class="col-lg-6 col-md-6 col-xs-12 pr">
                                                        <div class="comments-summary-box">
                                                            <ul class="comments-item-rating">
                                                                <li>
                                                                    <span class="cell-title">اصالت و کیفیت کالاها:</span>
                                                                    <span class="cell-value">

                                                                        @if($commentratequality * 100 / 5 == 0)
                                                                            فاقد امتیاز
                                                                        @elseif($commentratequality * 100 / 5 <= 20)
                                                                            خیلی بد
                                                                        @elseif($commentratequality * 100 / 5 <= 40 && $commentratequality * 100 / 5 > 20)
                                                                            بد
                                                                        @elseif($commentratequality * 100 / 5 <= 60 && $commentratequality * 100 / 5 > 40)
                                                                            متوسط
                                                                        @elseif($commentratequality * 100 / 5 <= 80 && $commentratequality * 100 / 5 > 60)
                                                                            خوب
                                                                        @elseif($commentratequality * 100 / 5 <= 100 && $commentratequality * 100 / 5 > 80)
                                                                            بسیار خوب
                                                                        @endif
                                                        </span>
                                                                    <div class="rating-general">
                                                                        <div class="rating-value" style="width: {{$commentratequality * 100 / 5}}%;"></div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="cell-title">تنوع کالاها و برندها:</span>
                                                                    <span class="cell-value">
                                                                        @if($commentratevalue * 100 / 5 == 0)
                                                                            فاقد امتیاز
                                                                        @elseif($commentratevalue * 100 / 5 <= 20)
                                                                            خیلی بد
                                                                        @elseif($commentratevalue * 100 / 5 <= 40 && $commentratevalue * 100 / 5 > 20)
                                                                            بد
                                                                        @elseif($commentratevalue * 100 / 5 <= 60 && $commentratevalue * 100 / 5 > 40)
                                                                            متوسط
                                                                        @elseif($commentratevalue * 100 / 5 <= 80 && $commentratevalue * 100 / 5 > 60)
                                                                            خوب
                                                                        @elseif($commentratevalue * 100 / 5 <= 100 && $commentratevalue * 100 / 5 > 80)
                                                                            بسیار خوب
                                                                        @endif
                                                        </span>
                                                                    <div class="rating-general">
                                                                        <div class="rating-value" style="width: {{$commentratevalue * 100 / 5}}%;"></div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="cell-title">گارانتی و ضمانت:</span>
                                                                    <span class="cell-value">
                                                                        @if($commentrateinnovation * 100 / 5 == 0)
                                                                            فاقد امتیاز
                                                                        @elseif($commentrateinnovation * 100 / 5 <= 20)
                                                                            خیلی بد
                                                                        @elseif($commentrateinnovation * 100 / 5 <= 40 && $commentrateinnovation * 100 / 5 > 20)
                                                                            بد
                                                                        @elseif($commentrateinnovation * 100 / 5 <= 60 && $commentrateinnovation * 100 / 5 > 40)
                                                                            متوسط
                                                                        @elseif($commentrateinnovation * 100 / 5 <= 80 && $commentrateinnovation * 100 / 5 > 60)
                                                                            خوب
                                                                        @elseif($commentrateinnovation * 100 / 5 <= 100 && $commentrateinnovation * 100 / 5 > 80)
                                                                            بسیار خوب
                                                                        @endif
                                                        </span>
                                                                    <div class="rating-general">
                                                                        <div class="rating-value" style="width: {{$commentrateinnovation * 100 / 5}}%;"></div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="cell-title">تناسب قیمت ها با کیفیت کالا:</span>
                                                                    <span class="cell-value">
                                                                        @if($commentrateability * 100 / 5 == 0)
                                                                            فاقد امتیاز
                                                                        @elseif($commentrateability * 100 / 5 <= 20)
                                                                            خیلی بد
                                                                        @elseif($commentrateability * 100 / 5 <= 40 && $commentrateability * 100 / 5 > 20)
                                                                            بد
                                                                        @elseif($commentrateability * 100 / 5 <= 60 && $commentrateability * 100 / 5 > 40)
                                                                            متوسط
                                                                        @elseif($commentrateability * 100 / 5 <= 80 && $commentrateability * 100 / 5 > 60)
                                                                            خوب
                                                                        @elseif($commentrateability * 100 / 5 <= 100 && $commentrateability * 100 / 5 > 80)
                                                                            بسیار خوب
                                                                        @endif
                                                        </span>
                                                                    <div class="rating-general">
                                                                        <div class="rating-value" style="width: {{$commentrateability * 100 / 5}}%;"></div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="cell-title">تسلط فروشنده به اطلاعات فنی:</span>
                                                                    <span class="cell-value">
                                                                        @if($commentratedesign * 100 / 5 == 0)
                                                                            فاقد امتیاز
                                                                        @elseif($commentratedesign * 100 / 5 <= 20)
                                                                            خیلی بد
                                                                        @elseif($commentratedesign * 100 / 5 <= 40 && $commentratedesign * 100 / 5 > 20)
                                                                            بد
                                                                        @elseif($commentratedesign * 100 / 5 <= 60 && $commentratedesign * 100 / 5 > 40)
                                                                            متوسط
                                                                        @elseif($commentratedesign * 100 / 5 <= 80 && $commentratedesign * 100 / 5 > 60)
                                                                            خوب
                                                                        @elseif($commentratedesign * 100 / 5 <= 100 && $commentratedesign * 100 / 5 > 80)
                                                                            بسیار خوب
                                                                        @endif
                                                        </span>
                                                                    <div class="rating-general">
                                                                        <div class="rating-value" style="width: {{$commentratedesign * 100 / 5}}%;"></div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <span class="cell-title">نحوه برخورد با مشتری:</span>
                                                                    <span class="cell-value">
                                                                        @if($commentratecomfort * 100 / 5 == 0)
                                                                            فاقد امتیاز
                                                                        @elseif($commentratecomfort * 100 / 5 <= 20)
                                                                            خیلی بد
                                                                        @elseif($commentratecomfort * 100 / 5 <= 40 && $commentratecomfort * 100 / 5 > 20)
                                                                            بد
                                                                        @elseif($commentratecomfort * 100 / 5 <= 60 && $commentratecomfort * 100 / 5 > 40)
                                                                            متوسط
                                                                        @elseif($commentratecomfort * 100 / 5 <= 80 && $commentratecomfort * 100 / 5 > 60)
                                                                            خوب
                                                                        @elseif($commentratecomfort * 100 / 5 <= 100 && $commentratecomfort * 100 / 5 > 80)
                                                                            بسیار خوب
                                                                        @endif
                                                        </span>
                                                                    <div class="rating-general">
                                                                        <div class="rating-value" style="width: {{$commentratecomfort * 100 / 5}}%;"></div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-xs-12 pr">
                                                        <div class="comments-summary-note">
                                                            <h6>شما هم می‌ توانید در مورد این کالا نظر دهید.</h6>
                                                            <p>
                                                                برای ثبت نظر، لازم است ابتدا شماره همراه خود را وارد نمایید.
                                                            </p>

                                                            <button type="button" class="btn-add-comment btn btn-secondary" data-toggle="modal" data-target="#commentrate">
                                                                افزودن نظر
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade bd-example-modal-xl" id="commentrate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" style="max-width: 50%;">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">افزودن نظر جدید</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form action="{{route('comment-rate')}}" class="form-faq" method="post">
                                                                            @csrf

                                                                            <input type="hidden" name="commentable_id" value="{{$supplier->id}}">
                                                                            <input type="hidden" name="commentable_type" value="{{get_class($supplier)}}">
                                                                            <div class="modal-body">
                                                                                <div class="comments-product-attributes px-3">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-6 col-12 mb-3">
                                                                                            <div class="comments-product-attributes-title">اصالت و کیفیت کالاها</div>
                                                                                            <input id="ex19" name="quality" type="text" data-provide="slider"
                                                                                                   data-slider-ticks="[1, 2, 3, 4, 5]"
                                                                                                   data-slider-ticks-labels='["خیلی بد", "بد", "معمولی","خوب","عالی"]'
                                                                                                   data-slider-min="1" data-slider-max="5" data-slider-step="1"
                                                                                                   data-slider-value="3" data-slider-tooltip="hide" />
                                                                                        </div>
                                                                                        <div class="col-sm-6 col-12 mb-3">
                                                                                            <div class="comments-product-attributes-title">تنوع کالاها و برندها</div>
                                                                                            <input id="ex19" name="value" type="text" data-provide="slider"
                                                                                                   data-slider-ticks="[1, 2, 3, 4, 5]"
                                                                                                   data-slider-ticks-labels='["خیلی بد", "بد", "معمولی","خوب","عالی"]'
                                                                                                   data-slider-min="1" data-slider-max="5" data-slider-step="1"
                                                                                                   data-slider-value="3" data-slider-tooltip="hide" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-6 col-12 mb-3">
                                                                                            <div class="comments-product-attributes-title">گارانتی و ضمانت</div>
                                                                                            <input id="ex19" name="innovation" type="text" data-provide="slider"
                                                                                                   data-slider-ticks="[1, 2, 3, 4, 5]"
                                                                                                   data-slider-ticks-labels='["خیلی بد", "بد", "معمولی","خوب","عالی"]'
                                                                                                   data-slider-min="1" data-slider-max="5" data-slider-step="1"
                                                                                                   data-slider-value="3" data-slider-tooltip="hide" />
                                                                                        </div>
                                                                                        <div class="col-sm-6 col-12 mb-3">
                                                                                            <div class="comments-product-attributes-title">تناسب قیمت ها با کیفیت کالا</div>
                                                                                            <input id="ex19" name="ability" type="text" data-provide="slider"
                                                                                                   data-slider-ticks="[1, 2, 3, 4, 5]"
                                                                                                   data-slider-ticks-labels='["خیلی بد", "بد", "معمولی","خوب","عالی"]'
                                                                                                   data-slider-min="1" data-slider-max="5" data-slider-step="1"
                                                                                                   data-slider-value="3" data-slider-tooltip="hide" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-6 col-12 mb-3">
                                                                                            <div class="comments-product-attributes-title">تسلط فروشنده به اطلاعات فنی</div>
                                                                                            <input id="ex19" name="comfort" type="text" data-provide="slider"
                                                                                                   data-slider-ticks="[1, 2, 3, 4, 5]"
                                                                                                   data-slider-ticks-labels='["خیلی بد", "بد", "معمولی","خوب","عالی"]'
                                                                                                   data-slider-min="1" data-slider-max="5" data-slider-step="1"
                                                                                                   data-slider-value="3" data-slider-tooltip="hide" />
                                                                                        </div>
                                                                                        <div class="col-sm-6 col-12 mb-3">
                                                                                            <div class="comments-product-attributes-title">نحوه برخورد با مشتری</div>
                                                                                            <input id="ex19" name="design" type="text" data-provide="slider"
                                                                                                   data-slider-ticks="[1, 2, 3, 4, 5]"
                                                                                                   data-slider-ticks-labels='["خیلی بد", "بد", "معمولی","خوب","عالی"]'
                                                                                                   data-slider-min="1" data-slider-max="5" data-slider-step="1"
                                                                                                   data-slider-value="3" data-slider-tooltip="hide" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="name" class="col-form-label">نام و نام خانوادگی</label>
                                                                                    <input type="text" name="name" class="form-control" id="name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="phone" class="col-form-label">شماره همراه</label>
                                                                                    <input type="text" name="phone" class="form-control" id="phone">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="comment" class="col-form-label">متن نظر:</label>
                                                                                    <textarea name="comment" class="form-control" placeholder="نظر خود را وارد نمایید" id="message-text"></textarea>
                                                                                </div>

                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-primary">ثبت نظر</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product-comment-list">
                                                        <ul class="comment-list">
                                                            @foreach($commentrates as $commentrate)
                                                                <li>
                                                                    <div class="col-lg-3 pr">
                                                                        <section>
                                                                            <div class="comments-user-shopping">{{$commentrate->name}}
                                                                                <div class="cell-date">
                                                                                    {{jdate($commentrate->created_at)->ago()}}
                                                                                </div>
                                                                            </div>
                                                                        </section>
                                                                    </div>
                                                                    <div class="col-lg-9 pl">
                                                                        <div class="article">
                                                                            <ul class="comment-text">
                                                                                <div class="header">
                                                                                    <p>{{$commentrate->comment}}</p>
                                                                                </div>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="question-and-answer" role="tabpanel" aria-labelledby="question-and-answer-tab">
                                            <div class="faq">
                                                <h2 class="params-headline">پرسش و پاسخ
                                                    <span>پرسش خود را در مورد محصول مطرح نمایید</span>
                                                </h2>


                                                <form action="{{route('send-comment')}}" class="form-faq" method="post">
                                                    @csrf

                                                    <input type="hidden" name="commentable_id" value="{{$supplier->id}}">
                                                    <input type="hidden" name="commentable_type" value="{{get_class($supplier)}}">
                                                    <input type="hidden" name="parent_id" value="0">
                                                    <div class="form-checkout-row">
                                                        <div class="col-lg-4 col-md-4 col-xs-12 fc-direction-rtl">
                                                            <label for="phone-number">شماره موبایل
                                                                <abbr class="required" title="ضروری" style="color:red;">*</abbr>
                                                            </label>
                                                            <input type="text" required name="phone" value="@if(Auth::check()){{Auth::user()->phone}}@endif" class="form-control text-left">
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-xs-12 fc-direction-rtl">
                                                            <label for="phone-number">نام و نام خانوادگی
                                                                <abbr class="required" title="ضروری" style="color:red;">*</abbr>
                                                            </label>
                                                            <input type="text" required name="name" value="@if(Auth::check()){{Auth::user()->name}}@endif" class="form-control text-left">
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
                                                                                <div class="faq-header">
                                                                        <span class="icon-faq"><i
                                                                                class="mdi mdi-storefront"></i></span>
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
                                                                            <input type="hidden" name="commentable_id" value="{{$supplier->id}}">
                                                                            <input type="hidden" name="commentable_type" value="{{get_class($supplier)}}">
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
                        @if($supplier->lat != null && $supplier->lng != null)
                        presets: {
                            latlng: {
                                lat: {{$supplier->lat}},
                                lng: {{$supplier->lng}},
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

                    @if($supplier->lat != null && $supplier->lng != null)

                    app.markReverseGeocode({
                        state: {
                            latlng: {
                                lat: {{$supplier->lat}},
                                lng: {{$supplier->lng}},
                            },
                            zoom: 14,
                            icon: crosshairIcon,
                        },
                    });
                    @endif
                });
            </script>

@endsection
