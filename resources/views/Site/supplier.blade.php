@extends('master')
@section('title')
    <title>لیست تامین کنندگان قطعات خودرو در وبسایت اتوکالا</title>
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('top-header')
    <section class="h-main-row">
        <div class="col-lg-12 col-md-12 col-xs-12 pr">
            <div class="header-right">
                <div class="col-lg-4 pr">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('suppliersearchandfilter')}}" method="get" class="form-search">
                                <input type="search" class="header-search-input" name="suppliersearch" value="{{request('suppliersearch')}}" placeholder="نام فروشگاه یا تامین کننده مورد نظر خود را جستجو کنید…">
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
                    <h2 style="padding: 2px 0px 0px 0px;font-size: 12px;">اتوکالا بازار مجازی قطعات خودرو و ماشین آلات</h2>
                </div>
            </div>
            <div class="header-left">
                <div class="col-lg-4 pl">
                    <div class="header-search row text-right">
                        <div class="header-search-box">
                            <form action="{{route('productsearchandfilter')}}" method="get" class="form-search">
                                <input type="search" class="header-search-input-code green-place"  value="{{request('unicode')}}" name="unicode" placeholder="جستجوی یونیکد (شناسه 10 رقمی کالا)">
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
                                <li class="breadcrumb-item active" aria-current="page"> تامین کنندگان قطعات خودرو</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xs-12 pr ">
                        <div class="shop-archive-sidebar">
                            <div class="sidebar-archive mb-3">
                                <form action="{{route('suppliersearchandfilter')}}" method="get" id="filter_state">
                                    <input type="hidden" id="state_id_filter" name="state_id" size="5" value="">
                                    <section class="widget-product-categories">
                                        <header class="cat-header">
                                            <h2 class="mb-0">
                                                <button class="btn btn-block text-right" type="button" data-toggle="collapse"
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
                                                        <button class="btn btn-range pr">
                                                            اعمال فیلتر
                                                        </button>

                                                        @if($filter == 1)
                                                            <a href="{{url('supplier')}}" class="btn btn-range pl">
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
                                            <button class="btn btn-block text-right" type="button" data-toggle="collapse"
                                                    href="#headingOne" role="button" aria-expanded="false"
                                                    aria-controls="headingOne">
                                                نوع تامین کننده قطعات خودرو
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </header>
                                    <div class="product-filter">
                                        <div class="card">
                                            <div class="collapse show" id="headingOne">
                                                <div class="card-main mb-0">
                                                    <div class="form-auth-row">
                                                        <label for="whole_seller" class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="whole_seller" {{request('whole_seller') == 1 ? 'checked' : '' }} id="whole_seller">
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label for="whole_seller"  class="remember-me">عمده فروش</label>
                                                    </div>
                                                    <div class="form-auth-row">
                                                        <label for="retail_seller" class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="retail_seller" {{request('retail_seller') == 1 ? 'checked' : '' }} id="retail_seller">
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label for="retail_seller"  class="remember-me">خرده فروش</label>
                                                    </div>
                                                    <div class="form-auth-row">
                                                        <label for="manufacturer" class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="manufacturer" {{request('manufacturer') == 1 ? 'checked' : '' }} id="manufacturer">
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label for="manufacturer"  class="remember-me">تولید کننده</label>
                                                    </div>
                                                    <div class="form-auth-row">
                                                        <label for="importer" class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="importer" {{request('importer') == 1 ? 'checked' : '' }} id="importer">
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label for="importer"  class="remember-me">وارد کننده</label>
                                                    </div>
                                                </div>
                                                <div class="mt-2 ">
                                                    <button class="btn btn-range pr">
                                                        اعمال فیلتر
                                                    </button>
                                                    @if($filter == 1)
                                                        <a href="{{url('supplier')}}" class="btn btn-range pl">
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
                                    <div class="product-filter">
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
                                                        <a href="{{url('supplier')}}" class="btn btn-range pl">
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
                                                    شهرستان
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                            </h2>
                                        </header>
                                        <div class="product-filter mt-3">
                                            <div class="card">
                                                <div class="collapse show" id="headingTwo">
                                                    <div class="card-main mb-lg-4">
                                                        <div class="mb-lg-4 mg-lg-4">
                                                            <select name="city_id" class="form-control select-lg select2" id="city_id">
                                                                <option value="">شهرستان</option>
                                                                @foreach($cities as $city)
                                                                    <option value="{{$city->id}}" {{request('city_id') == $city->id ? 'selected' : '' }} >{{$city->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 ">
                                                        <button class="btn btn-range pr">
                                                            اعمال فیلتر
                                                        </button>
                                                        @if($filter == 1)
                                                            <a href="{{url('supplier')}}" class="btn btn-range pl">
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
                                        <h4 style="color: #3bd571"> تعداد نتیجه  {{$suppliers->count()}}   فروشگاه </h4>
                                </div>
                                <div class="nav-sort-tabs-res">
                                    <ul class="nav sort-tabs-options" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="newproduct-tab" data-toggle="tab" href="#newproduct"
                                               role="tab" aria-controls="newest" aria-selected="true">بالاترین امتیاز کاربران</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link " id="oldproduct-tab" data-toggle="tab"
                                               href="#oldproduct" role="tab" aria-controls="oldproduct"
                                               aria-selected="false">بالاترین امتیاز نشان اعتبار اتوکالا</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="Most-visited-tab" data-toggle="tab"
                                               href="#Most-visited" role="tab" aria-controls="Most-visited"
                                               aria-selected="false">نزدیکترین</a>
                                        </li>
                                    </ul>
                                    <div class="float-left">
                                        @if(! Auth::check())
                                            <a href="{{url('login')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="در صورت تمایل به درج اطلاعات فروشگاه خود در این صفحه با کلیک روی این کلید ابتدا ثبت نام و سپس در قسمت حساب کسب و کار اطلاعات خود را تکمیل نمایید">پیوستن به ما</a>
                                        @elseif(Auth::check() && Auth::user()->type_id == 1)
                                            <a href="{{url('profile-business')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="کاربر گرامی چنانچه هنوز اطلاعات فروشگاه خود را ثبت نکرده اید و یا میخواهید آن را تغییر دهید می توان با کلیک روی این کلید اطلاعات کسب و کار خود را وارد نمایید"> حساب کسب و کار @foreach($newsuppliers as $supplier) @if(Auth::user()->id == $supplier->user_id)  {{$supplier->title}} @endif @endforeach</a>
                                        @elseif(Auth::check() && Auth::user()->type_id == 4)
                                            <a href="{{route('supplier-business')}}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="در صورت تمایل به درج اطلاعات فروشگاه خود در این صفحه با کلیک روی این کلید فروشگاه خود را ثبت نمایید ">پیوستن به ما</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="product-items">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade  show active" id="newproduct" role="tabpanel" aria-labelledby="newproduct-tab">
                                        <div class="row">
                                            @foreach($newsuppliers as $supplier)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('supplier/sub/'.$supplier->slug)}}" target="_blank" class="d-block">
                                                                @if(! $supplier->image )
                                                                    <img src="{{asset('images/supplier_defult.png')}}" style="height: 235px;" alt="{{$supplier->title}}">
                                                                @else
                                                                    <img src="{{asset($supplier->image)}}" style="height: 235px;" alt="{{$supplier->title}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('supplier/sub/'.$supplier->slug)}}" target="_blank">{{$supplier->title}}</a>
                                                        </div>
                                                        <div class="price">

                                                            <span class="amount"><b style="color: #fff;">.</b> @if($supplier->manager) مدیریت : {{$supplier->manager}} @endif</span>

                                                        </div>
                                                        <div class="title">
                                                            <p> {{$supplier->citytitle}} : {{ \Illuminate\Support\Str::limit($supplier->address, 25, $end='...') }}</p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$newsuppliers->appends(request()->all())->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="oldproduct" role="tabpanel" aria-labelledby="oldproduct-tab">
                                        <div class="row">
                                            @foreach($oldsuppliers as $supplier)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('supplier/sub/'.$supplier->slug)}}" target="_blank" class="d-block">
                                                                @if(! $supplier->image )
                                                                    <img src="{{asset('images/supplier_defult.png')}}" style="height: 235px;" alt="{{$supplier->title}}">
                                                                @else
                                                                    <img src="{{asset($supplier->image)}}" style="height: 235px;" alt="{{$supplier->title}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('supplier/sub/'.$supplier->slug)}}">{{$supplier->title}}</a>
                                                        </div>
                                                        <div class="price">
                                                            <span class="amount"><b style="color: #fff;">.</b> @if($supplier->manager) مدیریت : {{$supplier->manager}} @endif</span>
                                                        </div>
                                                        <div class="title">
                                                            <p> {{$supplier->citytitle}} : {{ \Illuminate\Support\Str::limit($supplier->address, 25, $end='...') }}</p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$oldsuppliers->appends(request()->all())->links()}}
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Most-visited" role="tabpanel" aria-labelledby="Most-visited-tab">
                                        <div class="row">
                                            @foreach($clicksuppliers as $supplier)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div class="thumb">
                                                            <a href="{{url('supplier/sub/'.$supplier->slug)}}" target="_blank" class="d-block">
                                                                @if(! $supplier->image )
                                                                    <img src="{{asset('images/supplier_defult.png')}}" style="height: 235px;" alt="{{$supplier->title}}">
                                                                @else
                                                                    <img src="{{asset($supplier->image)}}" style="height: 235px;" alt="{{$supplier->title}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="{{url('supplier/sub/'.$supplier->slug)}}">{{$supplier->title}}</a>
                                                        </div>
                                                        <div class="price">
                                                            <span class="amount"><b style="color: #fff;">.</b> @if($supplier->manager) مدیریت : {{$supplier->manager}} @endif</span>
                                                        </div>
                                                        <div class="title">
                                                            <p> {{$supplier->citytitle}} : {{ \Illuminate\Support\Str::limit($supplier->address, 25, $end='...') }}</p>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$clicksuppliers->appends(request()->all())->links()}}
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
                                                <div class="mask-text">@foreach($menus as $menu) @if($menu->id == 4) {!! $menu->textpage !!} @endif @endforeach</div>
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
        $('#state_filter').change(function(){
            var id = $('#state_filter').val();
            document.getElementById("state_id_filter").value = id;
            $('#filter_state').closest('form').submit();
        })
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
