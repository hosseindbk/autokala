@extends('master')
@section('title')
    <title>
        اتوکالا - حریم خصوصی
    </title>
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
    </section>
@endsection

@section('main')
    <div class="container">
            <div class="main-row">
                <section class="cart-home">
                    <div class="post-item-cart d-block order-2">
                        <div class="content-page text-center">
                            <div class="col-lg-12 col-md-12 col-xs-12 col-lg-offset-3">
                            <div class="cart-form" style=" padding: 50px;">
                                <div class="cart-empty text-justify d-block">
                                    <h3>حریم خصوصی در وبسایت اتوکالا </h3>
                                    <p class="cart-empty-title">
                                        با ورود و یا ثبت نام در سایت اتوکالا شما شرایط و قوانین استفاده از سرویس های سایت یا اپلکیشن اتوکالا و قوانین حریم خصوصی را می‌پذیرید
                                    </p>

                                    <p class="cart-empty-title">
                                        کاربر گرامی لطفاً موارد زیر را جهت استفاده بهینه از خدمات و برنامه های کاربردی و اطلاعات موجود در وبسایت اتوکالا به دقت ملاحظه فرمایید.
                                    </p>

                                    <p class="cart-empty-title">
                                        •	این سند مطابق با آخرین تغییرات قوانین و مقررات موضوعه کشور تدوین شده و شامل کلیه حقوق شما بر اساس قانون تجارت الکترونیکی مصوب ۱۳۸۲، قانون دسترسی و انتشار آزاد به اطلاعات مصوب ۱۳۸۷ و اسناد بین‌المللی ذی ربط است.
                                    </p>

                                    <p class="cart-empty-title">
                                        •	در صورتی که شما مایل نیستید اطلاعات شخصی شما در اختیار اتوکالا قرار گیرد، لطفاً از ثبت نام و درج آگهی در سایت و اپلیکیشن اتوکالا خودداری نمایید.                                    </p>


                                    <p class="cart-empty-title">
                                        •	تاکید می شود سایت و اپلیکیشن اتوکالا یک ارائه دهنده ی سرویس فروش اینترنتی نیست . این سایت صرفا به منظور فراهم آوردن اطلاعات فنی قطعات خودرو ،تامین کنندگان (بنا به اظهارخودشان) و همچنین ارائه دهندگان خدمات فنی به صورت متمرکز ،برای مصرف کنندگان و همینطور خرده فروشان در دسترس قرارگرفته است . لذا مسئولیت هرگونه خرید و فروش خلاف مقررات جاری کشور اعم از عرضه کالای قاچاق،تقلبی،بی کیفیت و نظایر آن صرفا بعهده فروشنده بوده و اتوکالا در این خصوص هیچگونه نظارت و مسئولیتی ندارد .
                                    </p>

                                    <p class="cart-empty-title">
                                        •	احراز هویت آگهی دهنگان در وبسایت صرفا از طریق شماره تلفن همراه صورت گرفته و صحت سایر اطلاعات مرتبط با هر آگهی بر عهده آگهی دهنده می باشد .                                     </p>

                                    <p class="cart-empty-title">
                                        •	کاربران تحت عنوان "فروشگاه و تامین کننده" لازم است مدارک لازم جهت احراز هویت به عنوان فروشگاه و تامین کننده را به ادمین ارائه نمایند  .
                                    </p>


                                    <p class="cart-empty-title">
                                        •	رتبه بندی ،امتیازات کاربران و سایر اطلاعات جمع آوری شده در خصوص فروشگاهها ،تامین کنندگان،تعمیرگاهها و واحدهای خدمات فنی و برندهای مختلف از کالاها بر اساس اظهارات شخصی و همینطور اطلاعات تجمیع شده از نظرات و امتیازات کاربران بوده و هیچگونه مسئولیت حقوقی را متوجه اتوکالا نمی نماید .                                    </p>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
                </section>
            </div>
    </div>
@endsection
