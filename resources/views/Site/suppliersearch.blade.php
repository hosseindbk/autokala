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
                            <form action="{{route('suppliersearch')}}" method="get" class="form-search">
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
                <form action="{{route('supplierfilterstate')}}" method="get" class="form-search">

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
                                <li class="breadcrumb-item active" aria-current="page"> تامین کنندگان قطعات خودرو</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xs-12 pr sticky-sidebar">
                        <div class="shop-archive-sidebar">
                            <div class="sidebar-archive mb-3">
                                <section class="widget-product-categories">
                                    <header class="cat-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block text-right" data-toggle="collapse" href="#headingfor" role="button" aria-expanded="false" aria-controls="headingOne">
                                                استان و شهرستان
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </header>
                                    <div class="product-filter">
                                        <div class="card">
                                            <div class="collapse show" id="headingfor">
                                                <form action="{{route('supplierfilter')}}" method="get">
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
                                                            <select name="city_id" id="city_id" class="form-control select-lg select2">
                                                                <option value="">انتخاب شهرستان</option>
                                                                @foreach($cities as $city)
                                                                    <option value="{{$city->id}}" {{request('city_id') == $city->id ? 'selected' : '' }}>{{$city->title}}</option>
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
                                <section class="widget-product-categories">
                                    <header class="cat-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block text-right" data-toggle="collapse"
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
                                                <form action="{{route('supplierfilter')}}" method="get">
                                                <div class="card-main mb-0">
                                                    <div class="form-auth-row">
                                                        <label for="1" class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="whole_seller" {{request('whole_seller') == 1 ? 'checked' : '' }} id="1">
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label for="1"  class="remember-me">عمده فروش</label>
                                                    </div>
                                                    <div class="form-auth-row">
                                                        <label for="2" class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="retail_seller" {{request('retail_seller') == 1 ? 'checked' : '' }} id="2">
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label for="2"  class="remember-me">خرده فروش</label>
                                                    </div>
                                                    <div class="form-auth-row">
                                                        <label for="3" class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="manufacturer" {{request('manufacturer') == 1 ? 'checked' : '' }} id="3">
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label for="3"  class="remember-me">تولید کننده</label>
                                                    </div>
                                                    <div class="form-auth-row">
                                                        <label for="4" class="ui-checkbox">
                                                            <input type="checkbox" value="1" name="importer" {{request('importer') == 1 ? 'checked' : '' }} id="4">
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <label for="4"  class="remember-me">وارد کننده</label>
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
                                <section class="widget-product-categories">
                                    <header class="cat-header">
                                        <h2 class="mb-0">
                                            <button class="btn btn-block text-right" data-toggle="collapse" href="#headingTwo" role="button" aria-expanded="false" aria-controls="headingOne">
                                                نام برند و مدل خودرو
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                        </h2>
                                    </header>
                                    <div class="product-filter">
                                        <div class="card">
                                            <div class="collapse show" id="headingTwo">
                                                <form action="{{route('supplierfilter')}}" method="get">
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
                                                            <select name="car_model_id" id="car_model_id" class="form-control select-lg select2">
                                                                <option value="">انتخاب مدل خودرو</option>
                                                                @foreach($carmodels as $car_model)
                                                                    <option value="{{$car_model->id}}" {{request('car_model_id') == $car_model->id ? 'selected' : '' }}>{{$car_model->title_fa}}</option>
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

                            <div class="product-items">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade  show active" id="newproduct" role="tabpanel" aria-labelledby="newproduct-tab">
                                        <div class="row">
                                            @foreach($suppliers as $supplier)
                                                <div class="col-lg-3 col-md-3 col-xs-12 order-1 d-block mb-3">
                                                    <section class="product-box product product-type-simple">
                                                        <div class="thumb">
                                                            <a href="{{'supplier/sub/'.$supplier->slug}}" target="_blank" class="d-block">
                                                                @if(! $supplier->image )
                                                                    <img src="{{asset('images/supplier_defult.png')}}" style="width: 235px;height: 235px;" alt="{{$supplier->title}}">
                                                                @else
                                                                    <img src="{{asset($supplier->image)}}" style="width: 235px;height: 235px;" alt="{{$supplier->title}}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="title">
                                                            <a href="#">{{$supplier->title}}</a>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="pagination-product">
                                            <nav aria-label="Page navigation example">
                                                {{$suppliers->appends(
                                                ['state_id'      => request('productgroup_id')
                                                , 'car_model_id' => request('car_model_id')
                                                ,'whole_seller'  => request('whole_seller')
                                                ,'retail_seller' => request('retail_seller')
                                                ,'manufacturer'  => request('manufacturer')
                                                ,'importer'      => request('importer')
                                                ,'suppliersearch'=> request('suppliersearch')
                                                ,'category_id'=> request('category_id')
                                                ,'brand_id'      => request('brand_id')])->links()}}
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
    @endsection
