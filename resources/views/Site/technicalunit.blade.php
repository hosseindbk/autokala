@extends('master')
@section('title')
    <title>لیست واحد های خدمات فنی در وبسایت اتوکالا</title>
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('top-header')
    <section class="h-main-row">
        <div class="col-lg-12 col-md-12 col-xs-12 pr">
            <div class="header-right">
                <div class="col-lg-4 pr">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('technicalsearch')}}" method="get" class="form-search">
                                <input type="text" class="header-search-input" name="technicalsearch" value="{{request('technicalsearch')}}" placeholder="نام تعمیرگاه یا واحد خدمات فنی جستجو کنید…">
                                <div class="action-btns">
                                    <button class="btn btn-search" type="submit">
                                        <img src="{{asset('site/images/search.png')}}" alt="search">
                                    </button>
                                    <div class="search-filter">
                                        <div class="form-ui">
                                            <div class="custom-select-ui">
                                                <select class="right" name="category_id">
                                                    <option value="all">همه دسته ها</option>
                                                    <option value="title">نام تعمیرگاه یا واحد خدماتی</option>
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
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">استان مورد نظر خود را انتخاب نمایید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('technicalfilterstate')}}" method="get" class="form-search">

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="text-center">
                                <label for="select-all" class="btn btn-outline-secondary" style="width: 80%;margin: 10px 25px">
                                    انتخاب همه
                                    @if($countState && count($countState) == 31)
                                        <input type="checkbox"  name="select-all" id="select-all" checked/>
                                    @else
                                        <input type="checkbox"  name="select-all" id="select-all" />
                                    @endif
                                </label>
                            </div>
                        </div>
                        @foreach($states as $state)
                            <div class="col-md-4 col-sm-12">
                                <button type="button" for="radio{{$state->id}}" class="btn btn-outline-secondary" style="width: 80%;margin: 10px 25px">
                                    {{$state->title}}
                                    <input type="checkbox" multiple="multiple" name="state_id[]" id="radio{{$state->id}}" value="{{$state->id}}" @if($countState) @foreach($countState as $stateselect) {{$state->id == $stateselect->id ? 'checked' : ''}} @endforeach @endif class="btn btn-outline-secondary">
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer" style=" align-items: center !important; justify-content: center; ">
                        <button type="submit" class="btn btn-primary" style="margin: 0 20px">تایید استان</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin: 0 20px">بازگشت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-main">
        <div class="d-block">
            <div class="page-content page-row">
                <div class="main-row">
                    <div id="breadcrumb">
                        <i class="mdi mdi-home"></i>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> واحد های خدمات فنی</li>
                            </ol>
                        </nav>
                    </div>
                    <form action="{{route('technicalfilter')}}" method="get">
                    <div class="col-lg-3 col-md-3 col-xs-12 pr sticky-sidebar">
                        <div class="shop-archive-sidebar">
                            <div class="sidebar-archive mb-3">
                                    <section class="widget-product-categories">
                                        <header class="cat-header">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right" type="button" data-toggle="collapse"
                                                        href="#headingOne" role="button" aria-expanded="false"
                                                        aria-controls="headingOne">
                                                    دسته بندی قطعات خودرو
                                                    {{$technicals->count()}}
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
                                                                    <input type="checkbox" name="productgroup_id[]" id="{{$product_group->id}}"  @if($filter == 1 && $productgroup_id != null) @foreach($productgroup_id as $p) {{$product_group->id == $p->id ? 'checked' : ''}} @endforeach @endif value="{{$product_group->id}}"   >
                                                                    <span class="ui-checkbox-check"></span>
                                                                </label>
                                                                <label for="{{$product_group->id}}"  class="remember-me">{{$product_group->related_service}}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="mt-2 ">
                                                        <button class="btn btn-range pr">
                                                            اعمال فیلتر
                                                        </button>

                                                        @if($filter == 1)
                                                            <a href="{{url('technical')}}" class="btn btn-range pl">
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
                                                        <a href="{{url('technical')}}" class="btn btn-range pl">
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
                                    <div class="product-filter mt-3">
                                        <div class="card">
                                            <div class="collapse show" id="headingTwo">
                                                    <div class="card-main mb-lg-4">
                                                        <div class="mb-lg-4 mg-lg-4">
                                                            <select name="car_brand_id" class="form-control select-lg select2" id="car_brand_id">
                                                                <option value="">انتخاب برند خودرو</option>
                                                                @foreach($carbrands as $car_brand)
                                                                    <option value="{{$car_brand->id}}" {{request('car_brand_id') == $car_brand->id ? 'selected' : '' }} >{{$car_brand->title_fa}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-lg-4 mg-lg-4">
                                                            <select multiple="multiple" name="car_model_id[]" id="car_model_id" class="form-control select2">
                                                                @if($filter == 1)
                                                                    @foreach($carmodels as $car_model)
                                                                        <option value="{{$car_model->id}}" @if($filter == 1 && $carmodel_id != null) @foreach($carmodel_id as $c) {{$car_model->id == $c->id ? 'selected' : ''}} @endforeach @endif>{{$car_model->title_fa}}</option>
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
                                                        <a href="{{url('technical')}}" class="btn btn-range pl">
                                                            پاک کردن فیلتر
                                                        </a>
                                                        @endif
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
                                        <h4> مرتب ‌سازی {{$technicals->count()}}  تعمیرگاه بر اساس  : </h4>
                                </div>
                                <div class="nav-sort-tabs-res">
                                    <ul class="nav sort-tabs-options" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="product-new-tab" data-toggle="tab" href="#product-new" role="tab" aria-controls="newest" aria-selected="true">بالا ترین امتیاز کاربران</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="oldproduct-tab" data-toggle="tab" href="#oldproduct" role="tab" aria-controls="oldproduct" aria-selected="true">بالاترین امتیاز نشان اعتبار اتوکالا</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="Most-visited-tab" data-toggle="tab" href="#Most-visited" role="tab" aria-controls="Most-visited" aria-selected="true">نزدیکترین</a>
                                        </li>
                                    </ul>
                                    <div class="float-left">
                                        @if(! Auth::check())
                                            <a href="{{url('login')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="در صورت تمایل به درج اطلاعات تعمیرگاه / واحد خدمات فنی خود در این صفحه با کلیک روی این کلید اطلاعات تعمیرگاه / واحد خدمات فنی را ثبت نمایید">پیوستن به ما</a>
                                        @elseif(Auth::check() && Auth::user()->type_id == 3)
                                            <a href="{{url('profile-business')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="کاربر گرامی چنانچه هنوز اطلاعات تعمیرگاه خود را ثبت نکرده اید می توان با کلیک روی این کلید اطلاعات کسب و کار خود را وارد نمایید">حساب کسب و کار</a>
                                        @elseif(Auth::check() && Auth::user()->type_id == 4)
                                            <a href="{{route('technicalunit-business')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="در صورت تمایل به درج اطلاعات تعمیرگاه / واحد خدمات فنی خود در این صفحه با کلیک روی این کلید اطلاعات تعمیرگاه / واحد خدمات فنی خود را ثبت نمایید ">پیوستن به ما</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="product-items">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="product-new">
                                        <div class="row">
                                            @foreach($newtechnicals as $technical_unit)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('technical/sub/'.$technical_unit->slug)}}" target="_blank" class="d-block text-center">
                                                                @if(! $technical_unit->image )
                                                                    <img src="{{asset('images/techndical_defult.png')}}" style="height: 235px;" alt="{{$technical_unit->title}}">
                                                                @else
                                                                    <img src="{{asset($technical_unit->image)}}" style="height: 235px;" alt="{{$technical_unit->title}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('technical/sub/'.$technical_unit->slug)}}" target="_blank">{{$technical_unit->title}}</a>
                                                        </div>
                                                        <div class="price">
                                                            @if($technical_unit->manager)
                                                                <span class="amount"> مدیریت : {{$technical_unit->manager}} </span>
                                                            @else
                                                                <b style="color: #fff;">.</b>
                                                                @endif
                                                        </div>
                                                        <div class="title">
                                                            <p>@foreach($cities as $city)
                                                                    @if($city->id == $technical_unit->city_id)
                                                                        {{$city->title}} :
                                                                        {{ \Illuminate\Support\Str::limit($technical_unit->address, 25, $end='...') }}
                                                                    @endif
                                                                @endforeach
                                                                <b style="color: #fff;">.</b>
                                                            </p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$newtechnicals->appends(request()->all())->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="oldproduct" role="tabpanel" aria-labelledby="oldproduct-tab">
                                        <div class="row">
                                            @foreach($oldtechnicals as $technical_unit)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('technical/sub/'.$technical_unit->slug)}}" target="_blank" class="d-block text-center">
                                                                @if(! $technical_unit->image )
                                                                    <img src="{{asset('images/techndical_defult.png')}}" style="height: 235px;" alt="{{$technical_unit->title}}">
                                                                @else
                                                                    <img src="{{asset($technical_unit->image)}}" style="height: 235px;" alt="{{$technical_unit->title}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('technical/sub/'.$technical_unit->slug)}}" target="_blank">{{$technical_unit->title}}</a>
                                                        </div>
                                                        <div class="price">
                                                            @if($technical_unit->manager)
                                                                <span class="amount"> مدیریت : {{$technical_unit->manager}} </span>
                                                            @endif
                                                        </div>
                                                        <div class="title">
                                                            <p>@foreach($cities as $city) @if($city->id == $technical_unit->city_id) {{$city->title}} : {{ \Illuminate\Support\Str::limit($technical_unit->address, 25, $end='...') }} @endif @endforeach</p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$oldtechnicals->appends(request()->all())->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Most-visited" role="tabpanel" aria-labelledby="Most-visited-tab">
                                        <div class="row">
                                            @foreach($clicktechnicals as $technical_unit)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('technical/sub/'.$technical_unit->slug)}}" class="d-block text-center" target="_blank">
                                                                @if(! $technical_unit->image )
                                                                    <img src="{{asset('images/techndical_defult.png')}}" style="height: 235px;" alt="{{$technical_unit->title}}">
                                                                @else
                                                                    <img src="{{asset($technical_unit->image)}}" style="height: 235px;" alt="{{$technical_unit->title}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('technical/sub/'.$technical_unit->slug)}}" target="_blank">{{$technical_unit->title}}</a>
                                                        </div>
                                                        <div class="price">
                                                            @if($technical_unit->manager)
                                                                <span class="amount"> مدیریت : {{$technical_unit->manager}} </span>
                                                            @endif
                                                        </div>
                                                        <div class="title">
                                                            <p>@foreach($cities as $city) @if($city->id == $technical_unit->city_id) {{$city->title}} : {{ \Illuminate\Support\Str::limit($technical_unit->address, 25, $end='...') }} @endif @endforeach</p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$clicktechnicals->appends(request()->all())->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
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
            $("#newproduct").click(function(){
                $("#product-new").remove();
                $.ajax({
                    url : '{{ route( 'option' ) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": 10
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function( result )
                    {
                        $.each( result, function(k, v) {
                            $('#product-new').append($('#product-new', {value:k, text:v}));
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
        $('#select-all').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
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
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
