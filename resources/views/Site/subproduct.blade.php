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
                @foreach($products as $product)
                    <div class="col-lg">
                    <div class="product type-product">
                        <section class="product-gallery">
                            <div class="gallery">
                                <div class="gallery-item">
                                    <div>
                                        <ul class="" style="float: left;">
                                            <li class="unic_code">
                                                <a href="#" class="btn btn-outline-success">
                                                    <span> یونیکد : {{$product->unicode}} </span>
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

                                                <li class="option-alarm">
                                                    <a href="{{route('offer-product' , $product->id)}}" target="_blank">
                                                        <button type="button" class="btn btn-outline-danger">  ثبت آگهی فروش  </button>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="gallery-item">
                                        <div class="gallery-img">
                                            <a href="#">
                                                @if(! $product->image)
                                                    <img class="zoom-img" id="img-product-zoom" src="{{asset('images/supplier_defult.png')}}" data-zoom-image="{{asset('images/supplier_defult.png')}}" width="411" />
                                                @else
                                                    <img class="zoom-img" id="img-product-zoom" src="{{asset($product->image)}}" data-zoom-image="{{asset($product->image)}}" width="411" />
                                                @endif
                                                <div id="gallery_01f" style="width:420px;float:right;">
                                            </a>
                                            <ul class="gallery-items owl-carousel owl-theme" id="gallery-slider">
                                                <li class="item">
                                                    <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($product->image)}}" data-zoom-image="{{asset($product->image)}}">
                                                        <img src="{{asset($product->image)}}" width="100" /></a>
                                                </li>
                                                @foreach($medias as $media)
                                                    <li class="item">
                                                        <a href="#" class="elevatezoom-gallery active" data-update="" data-image="{{asset($media->image)}}" data-zoom-image="{{asset($media->image)}}">
                                                            <img src="{{asset($media->image)}}" width="100" /></a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-7 col-xs-12 pl mt-5 d-block">
                                <section class="product-info">
                                <div class="product-headline">
                                    <h1 class="product-title"> نام کالا :  {{$product->title_fa}}  </h1>
                                </div>
                                <div class="product-config-wrapper">
                                    <div class="col=lg-6 col-md-6 col-xs-12 pr">
                                        <div class="product-params pt-3">
                                            <div class="product-headline">
                                                <span class="product-title" style="color: #ff3d00;"> مشخصات کالا </span>
                                            </div>
                                            <ul>
                                                <li>
                                                <span>  <i class="fa fa-archive"></i> دسته: </span>
                                                 <span>   @foreach($productgroups as $Product_group) {{$Product_group->title_fa}} @endforeach </span>
                                                </li>
                                                <li>
                                                <span> عنوان رایج در بازار : </span>
                                                    <span>{{$product->title_bazar_fa}}</span>
                                                </li>
                                                <li>
                                                <span> نام کالا لاتین : </span>
                                                    <span>{{$product->title_en}}</span>
                                                </li>
                                                <li>
                                                    <span> کد فنی کارخانه : </span>
                                                    <span>{{$product->code_fani_company}}</span>
                                                </li>
                                                <li>
                                                    <span>  HS کد (شناسه گمرک) :  </span>
                                                    <span></span>
                                                </li>
                                                <li>
                                                    <span>  OEM کد (شناسه بین المللی) :   </span>
                                                    <span></span>
                                                </li>
                                            </ul>
                                            <div class="product-headline">
                                                <span class="product-title" style="color: #ff3d00;"> ویژگی های کالا </span>
                                            </div>
                                            <ul>
                                                @if(! $product->title_specific1 == null)
                                                <li>
                                                    <span>{{$product->title_specific1}}</span>
                                                    :
                                                    <span>{{$product->specific1}}</span>
                                                </li>
                                                @endif
                                                @if(! $product->title_specific1 == null)
                                                <li>
                                                    <span>{{$product->title_specific2}}</span>
                                                    :
                                                    <span>{{$product->specific2}}</span>
                                                </li>
                                                @endif
                                                @if(! $product->title_specific1 == null)
                                                <li>
                                                    <span>{{$product->title_specific3}}</span>
                                                    :
                                                    <span>{{$product->specific3}}</span>
                                                </li>
                                                @endif
                                                @if(! $product->title_specific1 == null)
                                                <li>
                                                    <span>{{$product->title_specific4}}</span>
                                                    :
                                                    <span>{{$product->specific4}}</span>
                                                </li>
                                                @endif
                                                @if(! $product->title_specific1 == null)
                                                <li>
                                                    <span>{{$product->title_specific5}}</span>
                                                    :
                                                    <span>{{$product->specific5}}</span>
                                                </li>
                                                @endif
                                                @if(! $product->title_specific1 == null)
                                                <li>
                                                    <span>{{$product->title_specific6}}</span>
                                                    :
                                                    <span>{{$product->specific6}}</span>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="product-headline">
                                            <!--strip_tags-->
                                            <span class="product-title" style="color: #ff3d00;"> اطلاعات تکمیلی </span>

                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                    <div class="col=lg-6 col-md-6 col-xs-12 pr">
                                        <div class="product-seller-info-overal">
                                            <div class="seller-info-changable">
                                                <table class="table table-borderless table-profile-comment">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">نام خودرو</th>
                                                        <th scope="col">مدل </th>
                                                        <th scope="col">تیپ و تریم</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($carproducts as $carproduct)
                                                            <tr>
                                                                <td>
                                                                    @if(isset($carproduct->car_brand))
                                                                        {{$carproduct->car_brand}}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if(isset($carproduct->car_model))
                                                                        {{$carproduct->car_model}}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                @if(isset($carproduct->car_type))
                                                                    {{$carproduct->car_type}}
                                                                @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="post-item-profile order-1 d-block">
                        <div class="col-lg-12 col-md-12 col-xs-12 pl">
                            <div class="profile-content">
                                <div class="profile-stats">
                                    <div class="profile-comment">
                                        @if(Auth::check() && Auth::user()->type_id == 1)

                                        <ul class="" style="float: left;">
                                            <li class="unic_code">
                                                <a href="{{route('brand-variety' , $product->unicode)}}" target="_blank" class="btn btn-outline-primary">
                                                    ثبت برند - تنوع
                                                </a>
                                            </li>
                                        </ul>
                                        @endif
                                        <h4 style="color: #7a7675;margin: 10px 50px;padding:20px ;text-align:center;border-bottom:1px solid #ef394e "> برند / تنوع های کالا </h4>

                                        <table class="table table-borderless table-profile-comment text-center">
                                            <thead>
                                            <tr>
                                                <th scope="col">تصویر برند</th>
                                                <th scope="col">نام برند</th>
                                                <th scope="col">عنوان اختصار</th>
                                                <th scope="col">نام لاتین برند</th>
                                                <th scope="col">کشور سازنده</th>
                                                <th scope="col">ویژگی ها 1</th>
                                                <th scope="col">ویژگی ها 2</th>
                                                <th scope="col">ویژگی ها 3</th>
                                                <th scope="col">ضمانت و گارانتی</th>
                                                <th scope="col">امتیاز کاربران</th>
                                                <th scope="col">مشاهده</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($productvarieties as $productbrandvariety)
                                                    @if($productbrandvariety->product_id == $product->id)
                                                        @foreach($brands as $brand)
                                                            @if($brand->id == $productbrandvariety->brand_id)
                                                        <tr>
                                                            <th scope="row" class="th-img">
                                                                <div class="thumb-img">
                                                                    <a href="{{url('productbrand'.'/'.$product->slug.'/'.$brand->id)}}">
                                                                        @if(! $brand->image == null)
                                                                        <img src="{{asset($brand->image)}}" alt="{{$brand->title_fa}}">
                                                                        @else
                                                                        <img src="{{asset('images/supplier_defult.png')}}" alt="{{$brand->title_fa}}">
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                            </th>
                                                            <td> {{$brand->title_fa}} </td>
                                                            <td> {{$brand->abstract_title}} </td>
                                                            <td> {{$brand->title_en}} </td>
                                                            <td>@foreach($countries as $country) @if($country->id == $brand->country_id) {{$country->name}} @endif @endforeach</td>
                                                            <td>
                                                                    @if($productbrandvariety->item1 != null)
                                                                        @if($brand->id == $productbrandvariety->brand_id)
                                                                        <span>{{$productbrandvariety->item1}}</span>
                                                                        <span>{{$productbrandvariety->value_item1}}</span>
                                                                        @endif
                                                                    @endif
                                                                    <br>
                                                            </td>
                                                            <td>
                                                                    @if($productbrandvariety->item2 != null)
                                                                        @if($brand->id == $productbrandvariety->brand_id)
                                                                        <span>{{$productbrandvariety->item2}}</span>
                                                                            <span>{{$productbrandvariety->value_item2}}</span>
                                                                    @endif
                                                                    @endif

                                                                    <br>
                                                            </td>
                                                            <td>
                                                                    @if($productbrandvariety->item3 != null)
                                                                        @if($brand->id == $productbrandvariety->brand_id)
                                                                            <span>{{$productbrandvariety->item3}}</span>
                                                                            <span>{{$productbrandvariety->value_item3}}</span>
                                                                    @endif
                                                                    @endif

                                                                    <br>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <a href="{{url('productbrand'.'/'.$product->slug.'/'.$productbrandvariety->id)}}" class="btn btn-default"><i class="fa fa-eye"></i> </a>
                                                            </td>
                                                        </tr>
                                                                @endif
                                                        @endforeach
                                                        @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="tabs">
                <div class="tab-box">
                    <ul class="tab nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="Review-tab" data-toggle="tab" href="#Review" role="tab"
                               aria-controls="Review" aria-selected="true">
                                <i class="mdi mdi-glasses"></i>
                                نقد و بررسی
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
                            <div class="tab-pane fade show active" id="Review" role="tabpanel"
                                 aria-labelledby="Review-tab">
                                <h2 class="params-headline">نقد و بررسی </h2>
                                <section class="content-expert-summary">
                                    <div class="mask pm-3">
                                        <div class="mask-text"> <p></p></div>
                                        <a href="#" class="mask-handler">
                                            <span class="show-more">+ ادامه مطلب</span>
                                            <span class="show-less">- بستن</span>
                                        </a>
                                        <div class="shadow-box"></div>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="question-and-answer" role="tabpanel" aria-labelledby="question-and-answer-tab">
                                <div class="faq">
                                    <h2 class="params-headline">پرسش و پاسخ
                                        <span>پرسش خود را در مورد محصول مطرح نمایید</span>
                                    </h2>

                                    <form action="{{route('send-comment')}}" class="form-faq" method="post">
                                        @csrf

                                        <input type="hidden" name="commentable_id" value="{{$product->id}}">
                                        <input type="hidden" name="commentable_type" value="{{get_class($product)}}">
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
                                                                    <input type="hidden" name="commentable_id" value="{{$product->id}}">
                                                                    <input type="hidden" name="commentable_type" value="{{get_class($product)}}">
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
