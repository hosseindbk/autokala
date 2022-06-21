@extends('master')
@section('title')
    <title>لیست قطعات خودرو در وبسایت اتوکالا</title>
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('top-header')
    <section class="h-main-row">
        <div class="col-lg-12 col-md-12 col-xs-12 pr">
            <div class="header-right">
                <div class="col-lg-4 pr">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('productsearchandfilter')}}" method="get" class="form-search">
                                <input type="search" class="header-search-input" name="productsearch" value="{{request('productsearch')}}" placeholder="نام کالا، برند و یا دسته مورد نظر خود را جستجو کنید…">
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
                    <a href="{{url('/')}}" target="_blank"> <img src="{{asset('site/images/logo.png')}}" alt="اتوکالا"> </a>
                    <h2 style="padding: 2px 0px 0px 0px;font-size: 12px;">اتوکالا سامانه جامع قطعات و خدمات خودرو</h2>
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
                                <li class="breadcrumb-item active" aria-current="page"> کالا</li>

                            </ol>
                        </nav>
                    </div>
                    @include('sweet::alert')
                    <div class="col-lg-3 col-md-3 col-xs-12 pr sticky-sidebar">
                        <div class="shop-archive-sidebar">
                            <div class="sidebar-archive mb-3">
                                <form action="{{route('productsearchandfilter')}}" method="get">
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
                                                            <input type="checkbox" name="productgroup_id[]" id="{{$product_group->id}}"  @if($productgroup_id != null) @foreach($productgroup_id as $p) {{$product_group->id == $p->id ? 'checked' : ''}} @endforeach @endif value="{{$product_group->id}}"   >
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label for="{{$product_group->id}}"  class="remember-me">{{$product_group->title_fa}}</label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <div class="mt-2 ">
                                                    <button class="btn btn-range pr">اعمال فیلتر</button>

                                                    @if($filter == 1)
                                                        <a href="{{url('product')}}" class="btn btn-range pl">
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
                                            <button class="btn btn-block text-right" type="button" data-toggle="collapse" href="#headingTwo" role="button" aria-expanded="false" aria-controls="headingOne">
                                                نام برند و مدل خودرو
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </header>
                                    <div class="product-filter mb-3">
                                        <div class="card">
                                            <div class="collapse show" id="headingTwo">
                                                <div class="card-main mb-lg-4">
                                                    <div class="mb-lg-4 mg-lg-4">
                                                        <select name="car_brand_id" class="form-control select-lg select2" id="car_brand_id">
                                                            <option value="">انتخاب برند خودرو</option>
                                                            @foreach($carbrands as $car_brand)
                                                                <option value="{{$car_brand->id}}" {{request('car_brand_id') == $car_brand->id ? 'selected' : '' }}>{{$car_brand->title_fa}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-lg-4 mg-lg-4">
                                                        <select multiple="multiple" name="car_model_id[]" id="car_model_id" class="form-control select2">
                                                            @if($filter == 1)
                                                                @foreach($carmodels as $car_model)
                                                                    <option value="{{$car_model->id}}" @if($carmodel_id != null) @foreach($carmodel_id as $c) {{$car_model->id == $c->id ? 'selected' : ''}} @endforeach @endif>{{$car_model->title_fa}}</option>
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
                                                        <a href="{{url('product')}}" class="btn btn-range pl">
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
                                                                    <input type="checkbox" value="{{$brand->id}}" name="brand_id[]"  @if($brand_id != null) @foreach($brand_id as $b)  {{$brand->id == $b->id ? 'checked' : ''}} @endforeach @endif   id="{{$brand->id *999999}}">
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
                                                        <a href="{{url('product')}}" class="btn btn-range pl">
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
                                               aria-selected="false">بیشترین تنوع برند</a>
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
                                            @foreach($newproducts as $product)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('product'.'/'.$product->slug)}}" class="d-block" target="_blank">
                                                                @if(! $product->image )
                                                                    <img src="{{asset('images/supplier_defult.png')}}" style="height: 235px;" alt="{{$product->title_fa}}">
                                                                @else
                                                                    <img src="{{asset($product->image)}}" style="height: 235px;" alt="{{$product->title_fa}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('product'.'/'.$product->slug)}}" target="_blank">{{$product->title_fa}}</a>
                                                        </div>
                                                        <div class="price">
                                                        <span class="amount"> برند :  {{$Product_brand_variety = \App\Product_brand_variety::whereStatus(4)->whereProduct_id($product->id)->count()}}</span>
                                                        </div>
                                                        <div class="title">
                                                            <p><a href="">مناسب برای :
                                                                    @foreach($carproducts as $car_product)
                                                                        @if($car_product->product_id == $product->id)
                                                                            {{$car_product->brand_title}} {{$car_product->model_title}}
                                                                        @endif
                                                                    @endforeach
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$newproducts->appends(request()->all())->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="oldproduct" role="tabpanel" aria-labelledby="oldproduct-tab">
                                        <div class="row">
                                            @foreach($productvars as $product)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('product'.'/'.$product->slug)}}" target="_blank" class="d-block">
                                                                @if(! $product->image )
                                                                    <img src="{{asset('images/supplier_defult.png')}}" style="height: 235px;" alt="{{$product->title_fa}}">
                                                                @else
                                                                    <img src="{{asset($product->image)}}" style="height: 235px;" alt="{{$product->title_fa}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('product'.'/'.$product->slug)}}" target="_blank">{{$product->title_fa}}</a>
                                                        </div>
                                                        <div class="price">
                                                            <span class="amount"> برند :  {{$Product_brand_variety = \App\Product_brand_variety::whereStatus(4)->whereProduct_id($product->id)->count()}}</span>
                                                        </div>
                                                        <div class="title">
                                                            <p><a href="">مناسب برای :
                                                                    @foreach($carproducts as $car_product)
                                                                        @if($car_product->product_id == $product->id)
                                                                            {{$car_product->brand_title}} {{$car_product->model_title}}
                                                                        @endif
                                                                    @endforeach
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$productvars->appends(request()->all())->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Most-visited" role="tabpanel" aria-labelledby="Most-visited-tab">
                                        <div class="row">
                                            @foreach($clickproducts as $product)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('product'.'/'.$product->slug)}}" class="d-block" target="_blank">
                                                                @if(! $product->image )
                                                                    <img src="{{asset('images/supplier_defult.png')}}" style="height: 235px;" alt="{{$product->title_fa}}">
                                                                @else
                                                                    <img src="{{asset($product->image)}}" style="height: 235px;" alt="{{$product->title_fa}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('product'.'/'.$product->slug)}}" target="_blank">{{$product->title_fa}}</a>
                                                        </div>
                                                        <div class="price">
                                                            <span class="amount"> برند :  {{$Product_brand_variety = \App\Product_brand_variety::whereStatus(4)->whereProduct_id($product->id)->count()}}</span>
                                                        </div>
                                                        <div class="title">
                                                            <p><a href="">مناسب برای :
                                                                    @foreach($carproducts as $car_product)
                                                                        @if($car_product->product_id == $product->id)
                                                                            {{$car_product->brand_title}} {{$car_product->model_title}}
                                                                        @endif
                                                                    @endforeach
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$clickproducts->appends(request()->all())->links()}}
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
@endsection
