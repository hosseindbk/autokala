@extends('master-main')
@section('title')
    <title>فرم پیشنهاد فروش قطعه</title>
    <link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/sumoselect/sumoselect-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css-rtl/colors/default.css')}}" rel="stylesheet">

@endsection
@section('main')
    <div class="nav-categories-overlay"></div>
    <div class="container-main">
        <div class="d-block">
            <section class="profile-home">
                <div class="col-lg">
                    <div class="post-item-profile order-1 d-block">
                        <div class="col-lg-3 col-md-3 col-xs-12 pr">
                            <div class="sidebar-profile sidebar-navigation">
                                <section class="profile-box">
                                    <header class="profile-box-header-inline">
                                        <div class="profile-avatar user-avatar profile-img">

                                            @if(! Auth::user()->image)
                                                <img src="{{asset('site/images/man.png')}}">
                                            @else
                                                <img src="{{Auth::user()->image}}" alt="">
                                            @endif
                                        </div>
                                    </header>
                                    <footer class="profile-box-content-footer">
                                        <span class="profile-box-nameuser">{{Auth::user()->name}}</span>
                                        <span class="profile-box-registery-date">به وبسایت اتوکالا خوش آمدید </span>
                                        <span class="profile-box-phone">شماره همراه : {{Auth::user()->phone}}</span>
                                        <div class="profile-box-tabs">
                                            <a href="{{url('logout')}}" class="profile-box-tab-sign-out"><i class="mdi mdi-logout-variant"></i>خروج از حساب</a>
                                        </div>
                                    </footer>
                                </section>
                                <section class="profile-box">
                                    <ul class="profile-account-navs">
                                        @if(Auth::user()->phone_verify == 1)
                                            <li class="profile-account-nav-item navigation-link-dashboard">
                                                <a href="{{url('profile-user')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                    حساب کاربری
                                                </a>
                                            </li>
                                            @if(Auth::user()->type_id == 1 || Auth::user()->type_id == 3 )
                                                <li class="profile-account-nav-item navigation-link-dashboard">
                                                    <a href="{{url('profile-business')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                        حساب کسب و کار
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="profile-account-nav-item navigation-link-dashboard">
                                                <a href="{{url('profile-info')}}" class=""><i class="mdi mdi-tooltip-text-outline"></i>
                                                    اطلاعات حساب
                                                </a>
                                            </li>
                                            @if(Auth::user()->phone_verify == 1 && Auth::user()->type_id != 4)
                                                <li class="profile-account-nav-item navigation-link-dashboard">
                                                    <a href="{{url('offer')}}" class="active"><i class="mdi mdi-account-outline"></i>
                                                        فرم آگهی
                                                    </a>
                                                </li>
                                                <li class="profile-account-nav-item navigation-link-dashboard">
                                                    <a href="{{url('brand-create')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                        فرم برند قطعات
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                </section>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-xs-12 pl">
                            <div class="profile-content">
                                <div class="profile-stats">
                                    <div class="profile-address">
                                        <div class="middle-container">
                                            <div class="card-body">
                                                <div class="text-center"><h3 class="main-content-label text-center text-info">ورود اطلاعات آگهی</h3></div>
                                                <div class="float-left btn btn-outline-dark" style="margin-top: -45px;"><strong style="font-size: 12px;"> تاریخ ثبت آگهی </strong> {{jdate()->format('%Y/%m/%d')}} </div>
                                            </div>
                                            <form action="{{ route('offer-create')}}" method="POST" enctype="multipart/form-data">
                                                <div class="row row-sm">
                                                    {{csrf_field()}}
                                                    <div class="col-md-12">
                                                        @include('error')
                                                    </div>
                                                    @if(Auth::user()->type_id == 1)
                                                        <div class="col-md-12">
                                                            <h3>نوع آگهی</h3>
                                                            <div class="form-group">
                                                                <p class="mg-b-10"> </p>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="buyorsell" checked id="buyorsell1" value="sell">
                                                                    <label class="form-check-label" style="margin-right: 5px;" for="buyorsell1">  فروش </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="buyorsell" id="buyorsell2" value="buy">
                                                                    <label class="form-check-label" style="margin-right: 5px;" for="buyorsell2">  خرید </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" >
                                                            <h3 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">مشخصات کالا</h3>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="hidden" name="title" @foreach($products as $product) value="{{$product->title_fa}}"  @endforeach class="form-control" />
                                                                <p class="mg-b-10">نام قطعه</p>
                                                                <select name="unicode_product" class="form-control select2">
                                                                    @foreach($products as $product)
                                                                        <option value="{{$product->unicode}}" selected>{{$product->unicode}} - {{$product->title_fa}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">برند قطعه</p>
                                                                <select name="brand_id" class="form-control select2" id="brand_id_select">
                                                                    <option value="">انتخاب برند</option>
                                                                    @foreach($brands as $brand)
                                                                        <option value="{{$brand->id}}">{{$brand->title_fa}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <style>
                                                                    .select2-container--default {
                                                                        width: 90% !important;
                                                                        margin-left: 5px;
                                                                    }
                                                                    .form-control {
                                                                        width: 90% !important;
                                                                        margin-left: 5px;
                                                                    }
                                                                </style>
                                                                <button type="button" style="position: absolute;" class="btn btn-info" id="" data-toggle="modal" title="چنانچه برند مورد نظر در سیستم موجود نمی باشد کلیک نموده و نام برند مورد نظر را تایپ نمایید." data-target="#exampleModal" data-whatever="@mdo">+</button>
                                                            </div>
                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">افزودن برند </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="col-form-label">نام برند فارسی:</label>


                                                                                <input type="text" class="form-control" name="brand_name" id="brand_name"  onkeyup="fn1();">
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" data-dismiss="modal" class="btn btn-primary">تایید برند</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <script type="text/javascript">
                                                                function fn1(){
                                                                    var element = document.getElementById('brand_name');
                                                                    var value = element.value;
                                                                    $('#brand_id_select').attr('disabled', true);
                                                                    document.getElementById('inner-text').innerHTML = value;
                                                                }
                                                            </script>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">دسته بندی گروه قطعات</p>
                                                                <select name="product_group" class="form-control select2" id="product_group">
                                                                    @foreach($productgroups as $product_group)
                                                                        <option value="{{$product_group->id}}">{{$product_group->title_fa}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">
                                                                    @foreach($products as $product)
                                                                         {{$product->title_fa}}
                                                                    @endforeach
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10" id="inner-text"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">
                                                                    @foreach($productgroups as $product_group)
                                                                        {{$product_group->title_fa}}
                                                                    @endforeach
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12" >
                                                            <h3 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">مشخصات آگهی</h3>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">عنوان آگهی</p>
                                                                <input type="text" name="title_offer" value="{{$product->title_fa}}"  class="form-control" />
                                                                <input type="hidden" name="product_group" value="{{$product_group->id}}"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تامین کننده دائمی </p>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" checked name="permanent_supplier" id="permanent_supplier1" value="1">
                                                                    <label class="form-check-label" style="margin-right: 5px;" for="permanent_supplier1"> هستم </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="permanent_supplier" id="permanent_supplier2" value="0">
                                                                    <label class="form-check-label" style="margin-right: 5px;" for="permanent_supplier2">  نیستم </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">شرح آگهی</p>
                                                                <textarea name="description" id="editor1" placeholder=" شرح آگهی را وارد کنید"></textarea>
                                                                <style>
                                                                    .ck-editor{
                                                                        direction: rtl;
                                                                        text-align: right;
                                                                    }
                                                                </style>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تصویر اصلی قطعه</p>
                                                                <input type="file" name="image1" @foreach($products as $product)  @if($product->image)  value="{{$product->image}}"  data-default-file="{{url($product->image)}}" @endif @endforeach class="dropify" data-height="200">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تصویر دوم قطعه </p>
                                                                <input type="file" name="image2" class="dropify" data-height="200">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تصویر سوم قطعه </p>
                                                                <input type="file" name="image3" class="dropify" data-height="200">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">خرده فروشی</p>

                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" checked name="single" id="single1" value="1">
                                                                    <label class="form-check-label" style="margin-right: 5px;" for="single1">  داریم </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="single" id="single2" value="2">
                                                                    <label class="form-check-label" style="margin-right: 5px;" for="single2"> نداریم </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">قیمت خرده فروشی (تومان)</p>
                                                                <input type="text"  name="single_price" id="single_price" placeholder="قیمت خرده فروشی را وارد کنید" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">قیمت عمده فروشی (تومان)</p>
                                                                <input type="text" name="price" id="number2" placeholder="قیمت عمده فروشی را وارد کنید" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">حداقل تعداد عمده فروشی</p>
                                                                <input type="text" name="total" placeholder="حداقل تعداد عمده فروشی را وارد کنید" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" >
                                                            <h3 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">مشخصات تماس</h3>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">انتخاب استان</p>
                                                                <select name="state_id" class="form-control select-lg select2" id="state_id">
                                                                    <option value="">انتخاب استان</option>
                                                                    @foreach($states as $state)
                                                                        <option value="{{$state->id}}" {{Auth::user()->state_id == $state->id ? 'selected' : ''}}>{{$state->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">انتخاب شهرستان</p>
                                                                <select name="city_id" id="city_id" class="form-control select-lg select2">
                                                                    <option value="">انتخاب شهرستان</option>
                                                                    @foreach($cities as $city)
                                                                        <option value="">انتخاب شهرستان</option>
                                                                        <option value="{{$city->id}}" {{Auth::user()->city_id == $city->id ? 'selected' : ''}}>{{$city->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تلفن موبایل</p>
                                                                <input type="text" name="mobile" value="{{Auth::user()->phone}}" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تلفن ثابت</p>
                                                                <input type="text" name="phone" value="{{Auth::user()->phone_number}}" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">آدرس</p>
                                                                <textarea name="address" cols="30" rows="1" class="form-control" placeholder="آدرس را وارد کنید">{{Auth::user()->address}}</textarea>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="supplier_id" @foreach($suppliers as $supplier) @if($supplier->user_id == Auth::user()->id) value="{{$supplier->id}}" @endif @endforeach >

                                                    @else

                                                        <div class="col-md-12">
                                                            <h3>نوع آگهی</h3>
                                                            <div class="form-group">
                                                                <p class="mg-b-10"> </p>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="buyorsell" checked id="buyorsell1" value="sell">
                                                                    <label class="form-check-label" style="margin-right: 5px;" for="buyorsell1">  فروش </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="buyorsell" id="buyorsell2" value="buy">
                                                                    <label class="form-check-label" style="margin-right: 5px;" for="buyorsell2">  خرید </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" >
                                                            <h3 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">مشخصات کالا</h3>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">نام قطعه</p>
                                                                <select name="unicode_product" class="form-control select2">
                                                                    <option value="">انتخاب قطعه</option>
                                                                    @foreach($products as $product)
                                                                        <option value="{{$product->unicode}}" selected>{{$product->unicode}} - {{$product->title_fa}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">برند قطعه</p>
                                                                <select name="brand_id" class="form-control select2" id="titlebrand">
                                                                    <option value="">انتخاب برند</option>
                                                                    @foreach($brands as $brand)
                                                                        <option value="{{$brand->id}}">{{$brand->title_fa}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <style>
                                                                    .select2-container--default {
                                                                        width: 90% !important;
                                                                        margin-left: 5px;
                                                                    }
                                                                    .form-control {
                                                                        width: 90% !important;
                                                                        margin-left: 5px;
                                                                    }
                                                                </style>
                                                                <button type="button" style="position: absolute;" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">+</button>
                                                            </div>
                                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">افزودن برند </h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="recipient-name" class="col-form-label">نام برند فارسی:</label>
                                                                                <input type="text" class="form-control" name="brand_name" id="brand_name">
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" data-dismiss="modal" class="btn btn-primary">ثبت برند</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">دسته بندی گروه قطعات</p>
                                                                <select name="product_group" class="form-control select2" id="product_group">
                                                                    @foreach($productgroups as $product_group)
                                                                        <option value="{{$product_group->id}}">{{$product_group->title_fa}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" >
                                                            <h3 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">مشخصات آگهی</h3>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">عنوان آگهی</p>
                                                                <input type="text" name="title_offer" value="{{$product->title_fa}}"  class="form-control" />
                                                                <input type="hidden" name="product_group" value="{{$product_group->id}}"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">نوع قطعه </p>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input"  type="radio" checked name="noe" id="noe" value="new">
                                                                    <label class="form-check-label" style="margin-right: 5px;" for="buyorsell1">  نو </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="noe" id="noe" value="old">
                                                                    <label class="form-check-label" style="margin-right: 5px;" for="buyorsell2">  کارکرده </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">شرح آگهی</p>
                                                                <textarea name="description" id="editor2" placeholder=" شرح آگهی را وارد کنید"></textarea>
                                                                <style>
                                                                    .ck-editor{
                                                                        direction: rtl;
                                                                        text-align: right;
                                                                    }
                                                                </style>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تصویر اصلی قطعه</p>
                                                                <input type="text" name="image1" @foreach($products as $product)  @if($product->image)  value="{{$product->image}}"  data-default-file="{{url($product->image)}}" @endif @endforeach class="dropify" data-height="200">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تصویر دوم قطعه</p>
                                                                <input type="file" name="image2" class="dropify" data-height="200">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تصویر سوم قطعه</p>
                                                                <input type="file" name="image3" class="dropify" data-height="200">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">قیمت (تومان)</p>
                                                                <input type="text"  name="single_price" id="number single_price" placeholder="قیمت را وارد کنید" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" >
                                                            <h3 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">مشخصات تماس</h3>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">انتخاب استان</p>
                                                                <select name="state_id" class="form-control select-lg select2" id="state_id">
                                                                    <option value="">انتخاب استان</option>
                                                                    @foreach($states as $state)
                                                                        <option value="{{$state->id}}" {{Auth::user()->state_id == $state->id ? 'selected' : ''}}>{{$state->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">انتخاب شهرستان</p>
                                                                <select name="city_id" id="city_id" class="form-control select-lg select2">
                                                                    <option value="">انتخاب شهرستان</option>
                                                                    @foreach($cities as $city)
                                                                        <option value="">انتخاب شهرستان</option>
                                                                        <option value="{{$city->id}}" {{Auth::user()->city_id == $city->id ? 'selected' : ''}}>{{$city->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تلفن موبایل</p>
                                                                <input type="text" name="mobile" value="{{Auth::user()->phone}}" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">تلفن ثابت</p>
                                                                <input type="text" name="phone" value="{{Auth::user()->phone_number}}" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <p class="mg-b-10">آدرس</p>
                                                                <textarea name="address" cols="30" rows="1" class="form-control" placeholder="آدرس را وارد کنید">{{Auth::user()->address}}</textarea>
                                                            </div>
                                                        </div>

                                                    @endif
                                                    <div class="col-lg-12 mg-b-10 text-center">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-xs-12 pl">
                            <div class="profile-content">
                                <div class="profile-stats">
                                    <div class="profile-address">
                                        <div class="middle-container">

                                        <div class="col-md-12" >
                                            <h4 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">قطعه مناسب برای خودرو (ها) :</h4>
                                        </div>
                                        <div class="col-md-12">
                                             <div style="background-color: #0ab2e699; border-radius: 15px; padding: 20px; margin: 20px 0px 40px 0px;">
                                                <ul>
                                                    <li><p>چنانچه خودرو مورد نظر شما قبلا در جدول زیر ثبت شده است ، کافیست روی دکمه ثبت نهایی کلیک نمایید.</p></li>
                                                    <li><p>چنانچه خودرو مورد نظر شما در لیست زیر وجود ندارد، پس از انتخاب خودرو روی کلید ثبت خودرو انتخابی کلیک نمایید، خودرو ثبت شده به جدول اضافه می گردد.</p></li>
                                                    <li><p>پس از اطمینان از صحت اطلاعات درج شده جهت نهایی کردن آگهی روی کلید سبز رنگ کلیک نمایید.</p></li>
                                                </ul>
                                             </div>
                                        </div>

                                        <form action="{{ route('cartechnichalgroups.store')}}" method="POST">
                                            {{csrf_field()}}
                                            <input type="hidden" name="product_id" value="@foreach($products as $product) {{$product->id}} @endforeach">
                                            <div class="row row-sm">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">انتخاب خودرو</p>
                                                        <select name="car_brand_id" class="form-control select2" id="car_brand_id">
                                                            <option value="">انتخاب خودرو</option>
                                                            @foreach($carbrands as $car_brand)
                                                                <option value="{{$car_brand->id}}">{{$car_brand->title_fa}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">انتخاب مدل خودرو</p>
                                                        <select multiple="multiple" name="car_model_id[]" id="car_model_id" class="form-control select2">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">افزودن خودرو</p>
                                                        <button type="submit" class="btn btn-info m-r-20 text-center">ذخیره اطلاعات</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table" id="example1">
                                                <thead>
                                                <tr>
                                                    <th class="wd-10p"> ردیف </th>
                                                    <th class="wd-10p"> برند خودرو </th>
                                                    <th class="wd-10p"> مدل خودرو </th>
                                                    <th class="wd-10p"> حذف </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $s = 1; ?>
                                                @foreach($carproducts as $car_product)
                                                    <tr class="odd gradeX">
                                                        <td>{{$s++}}</td>

                                                        <td>
                                                            @foreach($carbrands as $Car_brand)
                                                                @if($Car_brand->id == $car_product->car_brand_id)
                                                                    {{$Car_brand->title_fa}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($carmodels as $Car_model)
                                                                @if($car_product->car_model_id == $Car_model->id)
                                                                    {{$Car_model->title_fa}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('cartechnichalgroups.destroy', $car_product->id) }}" method="post">
                                                                {{ method_field('delete') }}
                                                                {{ csrf_field() }}
                                                                <div class="btn-group btn-group-xs">
                                                                    <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                        <i class="fa fa-trash "></i>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor1' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor2' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        $(function () { $('#number').change(function () { var x = $('#number').val(); $('#number').val(addCommas(x)); }); });
        $(function () { $('#number2').change(function () { var y = $('#number2').val(); $('#number2').val(addCommas(y)); }); });
        $(function () { $('#number3').change(function () { var z = $('#number3').val(); $('#number3').val(addCommas(z)); }); });

        function addCommas(z) { return z.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","); }
        function addCommas(y) { return y.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","); }
        function addCommas(x) { return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ","); }
    </script>
    <script type="text/javascript">
        $(function(){
            $('#single1').click(function() {
                $('#single_price').attr("disabled", false);
            })
            });
        $(function(){
            $('#single2').click(function() {
                $('#single_price').attr("disabled", true);
            })
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
@endsection
