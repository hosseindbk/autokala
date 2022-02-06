@extends('master-main')
@section('title')
<title>ویرایش آگهی فروش</title>
<link rel="stylesheet" href="{{asset('site/css/mapp.min.css')}}">
<link rel="stylesheet" href="{{asset('site/css/fa/style.css')}}" data-locale="true">
<link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('main')
    @include('sweet::alert')
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
                                        <div>
                                            <h3 class="text-center mb-1">
                                                <span class="btn-outline-info">ویرایش آگهی فروش</span>
                                            </h3>
                                        </div>
                                        @foreach($offers as $offer)
                                            @if($offer->user_id == Auth::user()->id)
                                                <form action="{{route('offer-update' , $offer->id)}}" method="post" class="form-checkout" enctype="multipart/form-data">
                                                    {{method_field('PATCH')}}
                                                    @csrf
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
                                                                            <input class="form-check-input" type="radio" name="buyorsell" {{$offer->buyorsell == 'sell' ? 'checked' : ''}}  id="buyorsell1" value="sell">
                                                                            <label class="form-check-label" style="margin-right: 5px;" for="buyorsell1">  فروش </label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="buyorsell" {{$offer->buyorsell == 'buy' ? 'checked' : ''}} id="buyorsell2" value="buy">
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
                                                                        @if($offer->unicode_product != null)
                                                                            <select name="unicode_product" class="form-control select2">
                                                                                @foreach($products as $product)
                                                                                    <option value="{{$product->unicode}}" {{$offer->unicode_product == $product->unicode ? 'selected' : ''}}>{{$product->unicode}} - {{$product->title_fa}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        @elseif($offer->product_name != null)
                                                                            <input type="text" name="product_name" value="{{$product_name}}" class="form-control">
                                                                            @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">برند قطعه</p>
                                                                        @if($offer->brand_id != null)
                                                                        <select name="brand_id" class="form-control select2" id="brand_id_select">
                                                                            <option value="">انتخاب برند</option>
                                                                            @foreach($brands as $brand)
                                                                                <option value="{{$brand->id}}" {{$offer->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->title_fa}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @elseif($offer->brand_name != null)
                                                                            <input type="text" name="brand_name" value="{{$offer->brand_name}}" class="form-control">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">دسته بندی گروه قطعات</p>
                                                                        <select name="product_group" class="form-control select2" id="product_group">
                                                                            <option value="">انتخاب گروه</option>
                                                                            @foreach($productgroups as $product_group)
                                                                                <option value="{{$product_group->id}}" {{$product_group->id == $offer->product_group ? 'selected' : ''}}>{{$product_group->title_fa}}</option>
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
                                                                        <input type="text" name="title_offer" value="{{$offer->title_offer}}" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">تامین کننده دائمی </p>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" {{$offer->permanent_supplier == 1 ? 'checked' : ''}} name="permanent_supplier" id="permanent_supplier1" value="1">
                                                                            <label class="form-check-label" style="margin-right: 5px;" for="buyorsell1"> هستم </label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" {{$offer->permanent_supplier == 0 ? 'checked' : ''}} name="permanent_supplier" id="permanent_supplier2" value="0">
                                                                            <label class="form-check-label" style="margin-right: 5px;" for="buyorsell2">  نیستم </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">شرح آگهی</p>
                                                                        <textarea name="description" id="editor1">{{$offer->description}}</textarea>
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
                                                                        <input type="file" name="image1" @if($offer->image1) data-default-file="{{url($offer->image1)}}" @endif  class="dropify" data-height="200">

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">تصویر دوم قطعه </p>
                                                                        <input type="file" name="image2" @if($offer->image2) data-default-file="{{url($offer->image2)}}" @endif  class="dropify" data-height="200">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">تصویر سوم قطعه </p>
                                                                        <input type="file" name="image3" @if($offer->image3)  data-default-file="{{url($offer->image3)}}" @endif  class="dropify" data-height="200">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">خرده فروشی</p>

                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" {{$offer->single == 1 ? 'checked' : ''}} name="single" id="single1" value="1">
                                                                            <label class="form-check-label" style="margin-right: 5px;" for="single1">  داریم </label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" {{$offer->single == 2 ? 'checked' : ''}} name="single" id="single2" value="2">
                                                                            <label class="form-check-label" style="margin-right: 5px;" for="single2"> نداریم </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">قیمت خرده فروشی (تومان)</p>
                                                                        <input type="text"  name="single_price" id="number single_price" value="{{$offer->single_price}}" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">قیمت عمده فروشی (تومان)</p>
                                                                        <input type="text" name="price" id="number2" value="{{$offer->price}}" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">حداقل تعداد عمده فروشی</p>
                                                                        <input type="text" name="total" value="{{$offer->total}}" class="form-control" />
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
                                                                        <input type="text" disabled value="{{Auth::user()->phone}}" class="form-control" />
                                                                        <input type="hidden" name="mobile" value="{{Auth::user()->phone}}" class="form-control" />
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
                                                                        <textarea name="address" cols="30" rows="1" class="form-control" placeholder="آدرس را وارد کنید">{{$offer->address}}</textarea>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="supplier_id" @foreach($suppliers as $supplier) @if($supplier->user_id == Auth::user()->id) value="{{$supplier->id}}" @endif @endforeach >

                                                            @else
                                                                <div class="col-md-12">
                                                                    <h3>نوع آگهی</h3>
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10"> </p>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="buyorsell" {{$offer->buyorsell == 'sell' ? 'checked' : ''}} id="buyorsell1" value="sell">
                                                                            <label class="form-check-label" style="margin-right: 5px;" for="buyorsell1">  فروش </label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" name="buyorsell" {{$offer->buyorsell == 'buy' ? 'checked' : ''}} id="buyorsell2" value="buy">
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
                                                                        @if($offer->unicode_product != null)
                                                                            <select name="unicode_product" class="form-control select2">
                                                                                @foreach($products as $product)
                                                                                    <option value="{{$product->unicode}}" {{$offer->unicode_product == $product->unicode ? 'selected' : ''}}>{{$product->unicode}} - {{$product->title_fa}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        @elseif($offer->product_name != null)
                                                                            <input type="text" name="product_name" value="{{$offer->product_name}}" class="form-control">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">برند قطعه</p>
                                                                        @if($offer->brand_id != null)
                                                                        <select name="brand_id" class="form-control select2" id="brand_id_select">
                                                                            <option value="">انتخاب برند</option>
                                                                            @foreach($brands as $brand)
                                                                                <option value="{{$brand->id}}" {{$offer->brand_id == $brand->id ? 'selected' : '' }}>{{$brand->title_fa}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @elseif($offer->brand_name != null)
                                                                            <input type="text" name="brand_name" value="{{$offer->brand_name}}" class="form-control">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">دسته بندی گروه قطعات</p>
                                                                        <select name="product_group" class="form-control select2" id="product_group">
                                                                            <option value="">انتخاب گروه</option>
                                                                            @foreach($productgroups as $product_group)
                                                                                <option value="{{$product_group->id}}" {{$offer->product_group == $product_group->id ? 'selected' : ''}}>{{$product_group->title_fa}}</option>
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
                                                                        <input type="text" name="title_offer"value="{{$offer->title_offer}}" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">وضعیت قطعه </p>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"  type="radio" {{$offer->noe == 'new' ? 'checked' : ''}} name="noe" id="noe" value="new">
                                                                            <label class="form-check-label" style="margin-right: 5px;" for="noe">  نو </label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio" {{$offer->noe == 'old' ? 'checked' : ''}} name="noe" id="old" value="old">
                                                                            <label class="form-check-label" style="margin-right: 5px;" for="old">  کارکرده </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">شرح آگهی</p>
                                                                        <textarea name="description" id="editor2">{{$offer->description}}</textarea>
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
                                                                        <input type="file" name="image1" @if($offer->image1)  data-default-file="{{url($offer->image1)}}" @endif  class="dropify" data-height="200">

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">تصویر دوم قطعه</p>
                                                                        <input type="file" name="image2" @if($offer->image2)  data-default-file="{{url($offer->image2)}}" @endif  class="dropify" data-height="200">

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">تصویر سوم قطعه</p>
                                                                        <input type="file" name="image3" @if($offer->image3)  data-default-file="{{url($offer->image3)}}" @endif  class="dropify" data-height="200">

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <p class="mg-b-10">قیمت (تومان)</p>
                                                                        <input type="text"  name="single_price" id="number single_price" value="{{$offer->single_price}}"  class="form-control" />
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
                                                                        <input type="text" disabled value="{{Auth::user()->phone}}" class="form-control" />
                                                                        <input type="hidden" name="mobile" value="{{Auth::user()->phone}}" class="form-control" />
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
                                                                    <button type="submit" class="btn btn-info  btn-lg m-r-20">ثبت ویرایش اطلاعات</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-xs-12 pl" >
                        <div class="profile-content">
                            <div class="profile-stats">
                                <div class="profile-address">
                                    <div class="middle-container">

                                        <div class="col-md-12" >
                                            <h5 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 450px;margin-top: 20px;">حوزه فعالیت (انواع خودرو)</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <div style="background-color: #0ab2e699; border-radius: 15px; padding: 20px; margin: 20px 0px 40px 0px;">
                                                <ul>
                                                    <li><p>* ابتدا خودرو و مدل آن را انتخاب نمایید و در انتها بر روی کلید ثبت خودرو کلیک نمایید </p></li>
                                                    <li><p>* چنانچه روی خودروهای متعدد فعالیت دارید می توانید ردیف های بیشتری به جدول زیر اضافه نمایید.</p></li>
                                                    <li><p>* پس از اطمینان از صحت اطلاعات درج شده جهت نهایی کردن پروفایل روی کلید سبز رنگ ثبت نهایی کلیک نمایید.</p></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <form action="{{ route('carofferstore')}}" method="POST">
                                            {{csrf_field()}}
                                            <input type="hidden" name="offer_id" value="{{$offer->id}}">
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
                                                        <select name="car_model_id[]" class="form-control select2" multiple="multiple" id="car_model_id">
                                                            <option value="">انتخاب مدل خودرو</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-info m-r-20 text-center">ثبت خودرو</button>
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
                                                @foreach($car_offers as $car_offer)
                                                    @if($car_offer->offer_id == $offer->id)
                                                        <tr class="odd gradeX">
                                                            <td>{{$s++}}</td>

                                                            <td>
                                                                @foreach($carbrands as $Car_brand)
                                                                    @if($Car_brand->id == $car_offer->car_brand_id)
                                                                        {{$Car_brand->title_fa}}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach($carmodels as $Car_model)
                                                                    @if($car_offer->car_model_id == $Car_model->id)
                                                                        {{$Car_model->title_fa}}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach($cartypes as $car_type)
                                                                    @if($car_type->id == $car_offer->car_type_id)
                                                                        {{$car_type->title_fa}}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('carofferdelete', $car_offer->id) }}" method="post">
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
                                                        @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group text-center">
                                                <a href="{{route('profile-info')}}" class="btn btn-success m-r-20 text-center">ثبت نهایی اطلاعات</a>
                                            </div>
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
    <script  src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/ckeditor/ckeditor.js')}}"></script>
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
                @if($offer->lat != null && $offer->lng != null)
                presets: {
                    latlng: {
                        lat: {{$offer->lat}},
                        lng: {{$offer->lng}},
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
                @elseif(Auth::user()->lat != null && Auth::user()->lng != null)
                presets: {
                    latlng: {
                        lat: {{Auth::user()->lat}},
                        lng: {{Auth::user()->lng}},
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

            @if($offer->lat != null && $offer->lng != null)

            app.markReverseGeocode({
                state: {
                    latlng: {
                        lat: {{$offer->lat}},
                        lng: {{$offer->lng}},
                    },
                    zoom: 14,
                    icon: crosshairIcon,
                },
            });
            @elseif(Auth::user()->lat != null && Auth::user()->lng != null)
            app.markReverseGeocode({
                state: {
                    latlng: {
                        lat: {{Auth::user()->lat}},
                        lng: {{Auth::user()->lng}},
                    },
                    zoom: 14,
                    icon: crosshairIcon,
                },
            });
            @endif
            app.map.on('click', function (e) {

                var marker = app.addMarker({
                    name: 'advanced-marker',
                    latlng: {
                        lat: e.latlng.lat,
                        lng: e.latlng.lng,
                    },
                    icon: crosshairIcon,
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
                });
                $.ajax({
                    url: '{{ route( 'offermap' ) }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        "_token": "{{ csrf_token() }}",
                        lat     : e.latlng.lat,
                        lng     : e.latlng.lng,
                        'id'    :{{$offer->id}},
                    },
                    type: 'patch',
                    dataType: 'json',
                }).done(function (data) {
                    console.log(data);
                });
            })
        });
    </script>
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
@endsection
