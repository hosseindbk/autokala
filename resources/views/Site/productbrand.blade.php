@extends('master')
@section('title')
    <title>@foreach($products as $product) {{$product->title_fa}} @endforeach در وبسایت اتوکالا </title>

    <link rel="stylesheet" href="{{asset('site/css/vendor/noUISlider.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/vendor/bootstrap-slider.min.css')}}">

@endsection
@section('top-header')
    @include('sweet::alert')

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
        <div class="overlay-search-box"></div>
    </section>
@endsection
@section('main')
<div class="nav-categories-overlay"></div>
<div class="container-main">
    <div class="d-block">
        <div class="page-content page-row">
            <div class="main-row">
                <div id="breadcrumb">
                    <i class="mdi mdi-home"></i>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('product')}}">کالا</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@foreach($products as $product) {{$product->title_fa}} @endforeach  </li>
                        </ol>
                    </nav>
                </div>
                @foreach($productbrandvarieties as $product_brand_variety)
                    <div class="col-lg">
                    <div class="product type-product">
                        <section class="product-gallery">
                            <div class="gallery">
                                <div class="gallery-item">
                                    <div>
                                        <ul class="" style="float: left;">
                                            <li class="unic_code">
                                                <a href="#" class="btn btn-outline-success">
                                                    <span> یونیکد :  @foreach($products as $product) {{$product->unicode}} @endforeach </span>
                                                </a>
                                            </li>
                                            <li class="option-alarm mt-2">
                                                <a href="{{route('offer-product' , $product->id)}}" target="_blank">
                                                    <button type="button" class="btn btn-outline-danger">  ثبت آگهی فروش  </button>
                                                </a>
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
                                                <?php $x = number_format(($commentratequality + $commentratevalue + $commentrateinnovation + $commentrateability + $commentratedesign) /6 , 1) ?>
                                                @if($x == 0)
                                                    <p> هنوز امتیازی ثبت نشده است.</p>
                                                @else
                                                    <h5> امتیاز کاربران : {{number_format(($commentratequality + $commentratevalue + $commentrateinnovation + $commentrateability + $commentratedesign) / 6 , 1)}} از 5</h5>
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
                                                @foreach($productbrandvarieties as $Product_brand_variety)
                                                <a href="#">
                                                    @if(! $Product_brand_variety->image1)
                                                        <img class="zoom-img" id="img-product-zoom" src="{{asset('images/supplier_defult.png')}}" data-zoom-image="{{asset('images/supplier_defult.png')}}" width="411" />
                                                    @else
                                                        <img class="zoom-img" id="img-product-zoom" src="{{asset($Product_brand_variety->image1)}}" data-zoom-image="{{asset($Product_brand_variety->image1)}}" width="411" />
                                                    @endif
                                                    <div id="gallery_01f" style="width:420px;float:right;">
                                                </a>
                                                <ul class="gallery-items owl-carousel owl-theme" id="gallery-slider">
                                                    @if($Product_brand_variety->image1)
                                                        <li class="item">
                                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($Product_brand_variety->image1)}}" data-zoom-image="{{asset($Product_brand_variety->image1)}}">
                                                                <img src="{{asset($Product_brand_variety->image1)}}" width="100" /></a>
                                                        </li>
                                                    @endif
                                                    @if($Product_brand_variety->image2)
                                                        <li class="item">
                                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($Product_brand_variety->image2)}}" data-zoom-image="{{asset($Product_brand_variety->image2)}}">
                                                                <img src="{{asset($Product_brand_variety->image2)}}" width="100" /></a>
                                                        </li>
                                                        @endif
                                                    @if($Product_brand_variety->image3)
                                                        <li class="item">
                                                            <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($Product_brand_variety->image3)}}" data-zoom-image="{{asset($Product_brand_variety->image3)}}">
                                                                <img src="{{asset($Product_brand_variety->image3)}}" width="100" />
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                            </section>
                        </div>

                        <div class="col-lg-7 col-xs-12 pl mt-5 d-block">
                                <section class="product-info">
                                <div class="product-headline">
                                    <div class="col-md-6">
                                        <div style="background-color: #0ab2e699;border-radius: 15px;padding: 20px;font-size: 18px;margin: 20px 0px 40px 0px;line-height: 30px;">
                                            <ul>
                                                <li><strong>نام کالا :</strong>  {{$product->title_fa}}</li>
                                                <li><strong>دسته :</strong>  @foreach($productgroups as $Product_group) {{$Product_group->title_fa}} @endforeach </li>
                                                <li><strong>عنوان رایج در بازار :</strong>  {{$product->title_bazar_fa}}</li>
                                                <li><strong>نام لاتین :</strong> {{$product->title_en}} </li>
                                                <li><strong>کد فنی کارخانه :</strong> {{$product->code_fani_company}}</li>
                                                <li><strong>کد HS(شناسه گمرک) :</strong> </li>
                                                <li><strong>کد OEM (شناسه بین المللی) :</strong> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-config-wrapper">
                                    <div class="col-lg-12 col-md-12 col-xs-12 pr">
                                        <div class="product-params pt-3">
                                            <div  class="product-headline">
                                                <span class="product-title" style="color: #ff3d00;"> مشخصات تنوع </span>
                                            </div>
                                            <ul>
                                                <li>
                                                    <span>   نام برند :</span>
                                                    <span>    @foreach($brandproducts as $brand)  {{$brand->title_fa}}  @endforeach </span>
                                                </li>
                                                @foreach($productbrandvarieties as $Product_brand_variety)
                                                    @if(! $Product_brand_variety->item1 == null)
                                                    <li>
                                                        <span>{{$Product_brand_variety->item1}}</span>
                                                        <span>{{$Product_brand_variety->value_item1}}</span>
                                                    </li>
                                                    @endif
                                                        @if(! $Product_brand_variety->item2 == null)
                                                    <li>
                                                        <span>{{$Product_brand_variety->item2}}</span>
                                                        <span>{{$Product_brand_variety->value_item2}}</span>
                                                    </li>
                                                        @endif
                                                        @if(! $Product_brand_variety->item3 == null)
                                                    <li>
                                                        <span>{{$Product_brand_variety->item3}}</span>
                                                        <span>{{$Product_brand_variety->value_item3}}</span>
                                                    </li>
                                                        @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-xs-12 pr">
                                        <div class="positive" style="float: right;width: 50%;">
                                            <span class="plus" style="color: #ff3d00;">نقاط قوت</span>
                                            <ul>
                                                @foreach($productbrandvarieties as $Product_brand_variety)
                                                    @if(! $Product_brand_variety->strength1 == null)
                                                    <li>
                                                        <i class="fa fa-plus-circle"></i>
                                                        {{$Product_brand_variety->strength1}}
                                                    </li>
                                                    @endif
                                                        @if(! $Product_brand_variety->strength2 == null)
                                                    <li>
                                                        <i class="fa fa-plus-circle"></i>
                                                        {{$Product_brand_variety->strength2}}
                                                    </li>
                                                        @endif
                                                        @if(! $Product_brand_variety->strength3 == null)
                                                    <li>
                                                        <i class="fa fa-plus-circle"></i>
                                                        {{$Product_brand_variety->strength3}}
                                                    </li>
                                                        @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="negative" style="float: left;width: 50%;">
                                            <span class="neg" style="color: #ff3d00;">نقاط ضعف</span>
                                            <ul>
                                                @foreach($productbrandvarieties as $Product_brand_variety)
                                                    @if(! $Product_brand_variety->weakness1 == null)
                                                    <li>
                                                        <i class="fa fa-minus-circle"></i>
                                                        {{$Product_brand_variety->weakness1}}
                                                    </li>
                                                    @endif
                                                    @if(! $Product_brand_variety->weakness2 == null)
                                                    <li>
                                                        <i class="fa fa-minus-circle"></i>
                                                        {{$Product_brand_variety->weakness2}}
                                                    </li>
                                                    @endif
                                                    @if(! $Product_brand_variety->weakness3 == null)
                                                    <li>
                                                        <i class="fa fa-minus-circle"></i>
                                                        {{$Product_brand_variety->weakness3}}
                                                    </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div  class="product-headline">
                                        <span class="product-title" style="color: #ff3d00;"> توضیحات تکمیلی : </span>
                                    </div>
                                    @foreach($productbrandvarieties as $Product_brand_variety)
                                        @if(! $Product_brand_variety->description == null)
                                            <div class="product-price-survey-question">
                                                {!! $Product_brand_variety->description !!}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </section>
                        </div>
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
                                        <div class="mask-text"><p></p> </div>
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
                                        <h2 class="params-headline"> امتیاز کاربران به {{$product->title}} </h2>
                                        <h2>{{number_format(($commentratequality + $commentratevalue + $commentrateinnovation + $commentrateability + $commentratedesign) / 6 , 1)}} از 5</h2>
                                        <div class="product-config">
                                            <div class="product-rate">
                                                <?php $x = number_format(($commentratequality + $commentratevalue + $commentrateinnovation + $commentrateability + $commentratedesign) /6 , 1) ?>
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
                                                        <span class="cell-title">کیفیت کالا:</span>
                                                        <span class="cell-value">
                                                            @if($commentratequality * 100 / 5 <= 20)
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
                                                        <span class="cell-title">موجود بودن در بازار:</span>
                                                        <span class="cell-value">
                                                            @if($commentratevalue * 100 / 5 <= 20)
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
                                                            @if($commentrateinnovation * 100 / 5 <= 20)
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
                                                            @if($commentrateability * 100 / 5 <= 20)
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
                                                        <span class="cell-title">کیفیت بسته بندی:</span>
                                                        <span class="cell-value">
                                                            @if($commentratedesign * 100 / 5 <= 20)
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
                                                        <span class="cell-title">ملحقات شامل (واشر، بروشور، راهنما و...):</span>
                                                        <span class="cell-value">
                                                            @if($commentratecomfort * 100 / 5 <= 20)
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

                                                                <input type="hidden" name="commentable_id" value="{{$product_brand_variety->id}}">
                                                                <input type="hidden" name="commentable_type" value="{{get_class($product_brand_variety)}}">
                                                                <div class="modal-body">
                                                                    <div class="comments-product-attributes px-3">
                                                                        <div class="row">
                                                                            <div class="col-sm-6 col-12 mb-3">
                                                                                <div class="comments-product-attributes-title">کیفیت کالا</div>
                                                                                <input id="ex19" name="quality" type="text" data-provide="slider"
                                                                                       data-slider-ticks="[1, 2, 3, 4, 5]"
                                                                                       data-slider-ticks-labels='["خیلی بد", "بد", "معمولی","خوب","عالی"]'
                                                                                       data-slider-min="1" data-slider-max="5" data-slider-step="1"
                                                                                       data-slider-value="3" data-slider-tooltip="hide" />
                                                                            </div>
                                                                            <div class="col-sm-6 col-12 mb-3">
                                                                                <div class="comments-product-attributes-title">موجود بودن در بازار</div>
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
                                                                                <div class="comments-product-attributes-title">کیفیت بسته بندی</div>
                                                                                <input id="ex19" name="comfort" type="text" data-provide="slider"
                                                                                       data-slider-ticks="[1, 2, 3, 4, 5]"
                                                                                       data-slider-ticks-labels='["خیلی بد", "بد", "معمولی","خوب","عالی"]'
                                                                                       data-slider-min="1" data-slider-max="5" data-slider-step="1"
                                                                                       data-slider-value="3" data-slider-tooltip="hide" />
                                                                            </div>
                                                                            <div class="col-sm-6 col-12 mb-3">
                                                                                <div class="comments-product-attributes-title">ملحقات شامل (واشر، بروشور، راهنما و...)</div>
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

                                        <input type="hidden" name="commentable_id" value="{{$product_brand_variety->id}}">
                                        <input type="hidden" name="commentable_type" value="{{get_class($product_brand_variety)}}">
                                        <input type="hidden" name="parent_id" value="0">
                                        <div class="form-checkout-row">
                                            <div class="col-lg-4 col-md-4 col-xs-12 fc-direction-rtl">
                                                <label for="phone-number">شماره موبایل
                                                    <abbr class="required" title="ضروری" style="color:red;">*</abbr>
                                                </label>
                                                <input type="text" required name="phone" value="@if(Auth::check()){{Auth::user()->phone}}@endif" class="form-control text-left">
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
                                                                <input type="hidden" name="commentable_id" value="{{$product_brand_variety->id}}">
                                                                <input type="hidden" name="commentable_type" value="{{get_class($product_brand_variety)}}">
                                                                <input type="hidden" name="parent_id" value="{{$comment->id}}">
                                                                <div class="form-checkout-row">
                                                                    <div class="col-lg-12 col-md-12 col-xs-12 fc-direction-rtl">
                                                                        <label for="phone-number">شماره موبایل
                                                                            <abbr class="required" title="ضروری" style="color:red;">*</abbr>
                                                                        </label>
                                                                        <input type="text" required name="phone" value="@if(Auth::check()){{Auth::user()->phone}}@endif" class="form-control text-left">
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
@endsection
