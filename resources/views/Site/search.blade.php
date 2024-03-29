@extends('master')
@section('title')
    <title>لیست قطعات خودرو در وبسایت اتوکالا</title>
@endsection
@section('top-header')
    <section class="h-main-row">
        <div class="col-lg-12 col-md-12 col-xs-12 pr">
            <div class="header-right">
                <div class="col-lg-4 pr">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('productsearchandfilter')}}" method="get" class="form-search">
                                <input type="search" class="header-search-input" name="search" value="{{request('search')}}" placeholder="نام کالا، برند و یا دسته مورد نظر خود را جستجو کنید…">
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
                            <form action="#" class="form-search">
                                <input type="search" class="header-search-input-code green-place" name="search-input" placeholder="جستجوی یونیکد (شناسه 10 رقمی کالا)">
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
                                <li class="breadcrumb-item active" aria-current="page"> کالا</li>
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
                                                دسته بندی قطعات خودرو
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </header>
                                    <div class="product-filter">
                                        <div class="card">
                                            <div class="collapse show" id="headingOne">
                                                <div class="card-main mb-0" style="height: 220px;overflow: auto;">
                                                    <div class="form-auth-row">
                                                        <label class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="login" >
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label  class="remember-me">همه</label>
                                                    </div>
                                                    @foreach($productgroups as $product_group)
                                                        <div class="form-auth-row">
                                                            <label for="{{$product_group->id}}" class="ui-checkbox">
                                                                <input type="checkbox" value="1" name="login" id="{{$product_group->id}}">
                                                                <span class="ui-checkbox-check"></span>
                                                            </label>
                                                            <label for="{{$product_group->id}}"  class="remember-me">{{$product_group->title_fa}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="mt-2 pl">
                                                    <button class="btn btn-range">
                                                        اعمال فیلتر
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="widget-product-categories">
                                    <header class="cat-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block text-right" data-toggle="collapse" href="#headingTwo" role="button" aria-expanded="false" aria-controls="headingOne">
                                                نام برند خودرو
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </header>
                                    <div class="product-filter">
                                        <div class="card">
                                            <div class="collapse show" id="headingTwo">
                                                <div class="card-main mb-0" style="height: 220px;overflow: auto;">
                                                    <div class="form-auth-row">
                                                        <label class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="login" >
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label  class="remember-me">همه</label>
                                                    </div>
                                                    @foreach($carbrands as $car_brand)
                                                        <div class="form-auth-row">
                                                            <label for="{{$car_brand->id}}" class="ui-checkbox">
                                                                <input type="checkbox" value="1" name="login" id="{{$car_brand->id}}" >
                                                                <span class="ui-checkbox-check"></span>
                                                            </label>
                                                            <label  class="remember-me">{{$car_brand->title_fa}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="mt-2 pl">
                                                    <button class="btn btn-range">
                                                        اعمال فیلتر
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="widget-product-categories">
                                    <header class="cat-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block text-right" data-toggle="collapse" href="#headingThree" role="button" aria-expanded="false"  aria-controls="headingTwo">
                                                برند قطعات خودرو
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </header>
                                    <div class="product-filter">
                                        <div class="card">
                                            <div class="collapse show" id="headingThree">
                                                <div class="card-main mb-0" style="height: 220px;overflow: auto;">
                                                    <div class="form-auth-row">
                                                        <label class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="login" >
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label  class="remember-me">همه</label>
                                                    </div>
                                                    @foreach($brands as $brand)
                                                        <div class="form-auth-row">
                                                            <label for="{{$brand->id}}" class="ui-checkbox">
                                                                <input type="checkbox" value="1" name="login" id="{{$brand->id}}">
                                                                <span class="ui-checkbox-check"></span>
                                                            </label>
                                                            <label  class="remember-me">{{$brand->title_fa}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="mt-2 pl">
                                                    <button class="btn btn-range">
                                                        اعمال فیلتر
                                                    </button>
                                                </div>
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
                                            <a class="nav-link active" id="newproduct-tab" data-toggle="tab" href="#newproduct"
                                               role="tab" aria-controls="newest" aria-selected="true">جدیدترین</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="oldproduct-tab" data-toggle="tab"
                                               href="#oldproduct" role="tab" aria-controls="oldproduct"
                                               aria-selected="false">قدیمی ترین</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="Most-visited-tab" data-toggle="tab"
                                               href="#Most-visited" role="tab" aria-controls="Most-visited"
                                               aria-selected="false">پربازدیدترین</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-items">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade  show active" id="newproduct" role="tabpanel" aria-labelledby="newproduct-tab">
                                        <div class="row">
                                            @foreach($products as $product)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('product'.'/'.$product->slug)}}" class="d-block" target="_blank">
                                                                @if(! $product->image )
                                                                    <img src="{{asset('images/supplier_defult.png')}}" style="height: 235px;" alt="{{$product->title}}">
                                                                @else
                                                                    <img src="{{asset($product->image)}}" style="height: 235px;" alt="{{$product->title}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('product'.'/'.$product->slug)}}" target="_blank">{{$product->title_fa}} {{$product->title_en}}</a>
                                                        </div>
                                                        <div class="price">
                                                            <span class="amount"> برند :  {{$Product_brand_variety = \App\Product_brand_variety::whereProduct_id($product->id)->count()}}</span>
                                                        </div>
                                                        <div class="title">
                                                            <p><a href="">مناسب برای :
                                                                        @foreach($carproducts as $car_product)
                                                                            @if($car_product->product_id == $product->id)
                                                                                {{$car_product->brand_title}} {{$car_product->model_title}}
                                                                            @endif
                                                                        @endforeach
                                                                </a></p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$products->appends(request()->all())->links()}}
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

