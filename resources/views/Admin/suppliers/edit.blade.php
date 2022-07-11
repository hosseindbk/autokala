@extends('Admin.admin')
@section('title')
    <title> ویرایش  تامین کننده </title>
    <link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/sumoselect/sumoselect-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css-rtl/colors/default.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت  تامین کننده</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/suppliers')}}">مدیریت تامین کننده</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش تامین کننده</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="row row-sm">
                                    @foreach($suppliers as $supplier)
                                        <div class="col-md-6">
                                            <p> نام تامین کننده : {{$supplier->title}} </p>
                                            <p> نام مدیر : {{$supplier->manager }}</p>
                                            <p> شماره تماس : {{$supplier->phone}}</p>
                                            <p> موبایل : {{$supplier->mobile}}</p>
                                            <p> ایمیل : {{$supplier->email}}</p>
                                            <p> وبسایت : <a href="{{$supplier->website}}">لینک وبسایت</a> </p>
                                        </div>
                                        <div class="col-md-6" style="display: inline-flex">
                                            <div class="col-md-4">
                                                <div style="width: 250px;float: left;border: 2px solid #4ec7c7;border-radius: 15px;">
                                                    <img src="{{asset($supplier->image)}}" class="img-responsive" style="padding: 20px;" alt="">
                                                    @if($supplier->image != null)
                                                        <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                            <div class="col-3 d-inline-flex">
                                                            <form action="{{ route('updatesupimg', $supplier->id)}}" method="post">
                                                                {{ method_field('patch') }}
                                                                {{csrf_field()}}
                                                                <input type="hidden" value="0" name="image">
                                                                <div class="btn-group btn-group-xs">
                                                                    <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                        <i class="fe fe-trash-2 "></i>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                            </div>
                                                            <div class="col-5 d-inline-flex">
                                                                <p>تصویر اصلی</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div style="width: 250px;float: left;border: 2px solid #dad8d8;border-radius: 15px;">
                                                    <img src="{{asset($supplier->image2)}}" class="img-responsive" style="padding: 20px;" alt="">
                                                    @if($supplier->image2 != null)
                                                        <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                            <form action="{{ route('updatesupimg', $supplier->id)}}" method="post">
                                                                {{ method_field('patch') }}
                                                                {{csrf_field()}}
                                                                <input type="hidden" value="0" name="image2">
                                                                <div class="btn-group btn-group-xs">
                                                                    <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                        <i class="fe fe-trash-2 "></i>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div style="width: 250px;float: left;border: 2px solid #dad8d8;border-radius: 15px;">
                                                    <img src="{{asset($supplier->image3)}}" class="img-responsive" style="padding: 20px;" alt="">
                                                    @if($supplier->image3 != null)
                                                        <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                            <form action="{{ route('updatesupimg', $supplier->id)}}" method="post">
                                                                {{ method_field('patch') }}
                                                                {{csrf_field()}}
                                                                <input type="hidden" value="0" name="image3">
                                                                <div class="btn-group btn-group-xs">
                                                                    <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                        <i class="fe fe-trash-2 "></i>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-toggle="collapse" href="#supplier" role="button"> ویرایش اطلاعات  تامین کننده </a>
                                <div class="collapse mg-t-5" id="supplier">
                                <div>
                                    <h3 class="text-center mb-5"><span class="badge badge-light">ویرایش اطلاعات  تامین کننده</span></h3>
                                </div>
                                @foreach($suppliers as $Supplier)
                                    <form action="{{route('suppliers.update', $Supplier->id)}}" method="POST" enctype="multipart/form-data">
                                        <div class="row row-sm">
                                            {{csrf_field()}}
                                            {{ method_field('PATCH') }}

                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام تامین کننده</p>
                                                    <input type="text" name="title" data-required="1" value="{{$Supplier->title}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام مدیر</p>
                                                    <input type="text" name="manager" data-required="1" value="{{$Supplier->manager}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">ایمیل</p>
                                                    <input type="text" name="email" data-required="1" value="{{$Supplier->email}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب استان</p>
                                                    <select name="state_id" class="form-control select2">
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}" {{$Supplier->state_id == $state->id ? 'selected' : ''}}>{{$state->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب شهرستان</p>
                                                    <select name="city_id" id="city_id" class="form-control select-lg select2">
                                                        @foreach($cities as $city)
                                                                <option value="{{$city->id}}" {{$Supplier->city_id == $city->id ? 'selected' : ''}}>{{$city->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">کاربر فروشگاه</p>
                                                    <select name="user_id" class="form-control select2">
                                                        <option value="">انتخاب کاربر</option>
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}" {{$user->id == $Supplier->user_id ? 'selected' : ''}}>{{$user->name}} - {{$user->phone}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نام صفحه فروشگاه</p>
                                                        <input type="text" name="pageurl" value="{{$Supplier->pageurl}}"  class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تلفن ثابت</p>
                                                    <input type="text" name="phone" data-required="1" value="{{$Supplier->phone}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">موبایل</p>
                                                    <input type="text" name="mobile" data-required="1" value="{{$Supplier->mobile}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">واتس اپ</p>
                                                    <input type="text" name="whatsapp" data-required="1" value="{{$Supplier->whatsapp}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">وبسایت</p>
                                                    <input type="text" name="website" data-required="1" value="{{$Supplier->website}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب وضعیت نمایش</p>
                                                    <select name="status_id" class="form-control select2">
                                                        @foreach($statuses as $status)
                                                                <option value="{{$status->id}}" {{$Supplier->status == $status->id ? 'selected' : ''}}>{{$status->title}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">نشان اتوکالا</p>
                                                    <select name="autokala" class="form-control select-lg select2">
                                                        <option value="">انتخاب نشان اتوکالا</option>
                                                        <option value="0" {{$Supplier->autokala == 0 ? 'selected' : ''}}>فاقد نشان </option>
                                                        <option value="3" {{$Supplier->autokala == 3 ? 'selected' : ''}}>نشان طلایی اتوکالا</option>
                                                        <option value="2" {{$Supplier->autokala == 2 ? 'selected' : ''}}>نشان نقره ای اتوکالا</option>
                                                        <option value="1" {{$Supplier->autokala == 1 ? 'selected' : ''}}>نشان برنزی اتوکالا</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">کلمات کلیدی</p>
                                                    <textarea name="supplier_keyword" cols="30" rows="2" class="form-control">@if(!$Supplier->supplier_keyword) کلمه کلیدی 1 ، کلمه کلیدی 2 ، کلمه کلیدی 3 و... @else  {{$Supplier->supplier_keyword}}@endif</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label class="ckbox">
                                                            @if($Supplier->manufacturer == 0)
                                                                <input type="checkbox" name="manufacturer">
                                                            @else
                                                                <input type="checkbox" name="manufacturer" checked>
                                                            @endif
                                                            <span>تولید کننده</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label class="ckbox">
                                                            @if($Supplier->importer == 0)
                                                                <input type="checkbox" name="importer">
                                                            @else
                                                                <input type="checkbox" name="importer" checked>
                                                            @endif
                                                            <span>وارد کننده</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label class="ckbox">
                                                            @if($Supplier->whole_seller == 0)
                                                                <input type="checkbox" name="whole_seller">
                                                            @else
                                                                <input type="checkbox" name="whole_seller" checked>
                                                            @endif
                                                            <span>عمده فروش</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <label class="ckbox">
                                                            @if($Supplier->retail_seller == 0)
                                                                <input type="checkbox" name="retail_seller">
                                                            @else
                                                                <input type="checkbox" name="retail_seller" checked>
                                                            @endif
                                                            <span>خرده فروش</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">لوگو فروشگاه</p>
                                                    <input type="file" name="logo" class="dropify" data-height="200">
                                                </div>
                                                @if($supplier->logo)
                                                    <div class="form-group">
                                                        <img src="{{asset($supplier->logo)}}" height="200px" alt="">
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <p class="mg-b-10">بنر فروشگاه</p>
                                                    <input type="file" name="banner" class="dropify" data-height="200">
                                                </div>
                                                @if($supplier->banner)
                                                    <div class="form-group">
                                                        <img src="{{asset($supplier->banner)}}" height="200px" alt="">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر اصلی فروشگاه</p>
                                                    <input type="file" name="image" class="dropify" data-height="200">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر دوم فروشگاه</p>
                                                    <input type="file" name="image2" class="dropify" data-height="200">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر سوم فروشگاه</p>
                                                    <input type="file" name="image3" class="dropify" data-height="200">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر اصلی اسلاید</p>
                                                    <input type="file" name="slide1" class="dropify" data-height="200">
                                                </div>
                                                @if($supplier->slide1)
                                                    <div class="form-group">
                                                        <img src="{{asset($supplier->slide1)}}" height="200px" alt="">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر دوم اسلاید</p>
                                                    <input type="file" name="slide2" class="dropify" data-height="200">
                                                </div>
                                                @if($supplier->slide2)
                                                    <div class="form-group">
                                                        <img src="{{asset($supplier->slide2)}}" height="200px" alt="">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر سوم اسلاید</p>
                                                    <input type="file" name="slide3" class="dropify" data-height="200">
                                                </div>
                                                @if($supplier->slide3)
                                                    <div class="form-group">
                                                        <img src="{{asset($supplier->slide3)}}" height="200px" alt="">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">ادرس</p>
                                                    <textarea name="address" id="" cols="30" data-required="1" rows="5" class="form-control" >{{$Supplier->address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">توضیحات</p>
                                                    <textarea name="description" id="editor" cols="30" data-required="1" rows="5" class="form-control" >{{$Supplier->description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mg-b-10 text-center">
                                                <div class="form-group">
                                                    <button type="submit"  class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label text-center mb-5">ایجاد تامین کننده گروه کالا</h6>
                                </div>
                                <form action="{{ route('supplierproductgroups.store')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="supplier_id" value="@foreach($suppliers as $supplier) {{$supplier->id}} @endforeach">
                                    <div class="row row-sm">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب گروه کالا</p>
                                                <select name="product_group_id" class="form-control select2">
                                                    <option value="">انتخاب گروه کالا</option>
                                                    @foreach($productgroups as $Product_group)
                                                        <option value="{{$Product_group->id}}">{{$Product_group->title_fa}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
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
                                        <div class="col-md-12">
                                            <div class="form-group">
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
                                            <th class="wd-10p"> گروه کالا </th>
                                            <th class="wd-10p"> برند خودرو </th>
                                            <th class="wd-10p"> مدل خودرو </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($supplierproductgroups as $Supplier_product_group)
                                            <tr class="odd gradeX">
                                                <td>{{$s++}}</td>
                                                <td>
                                                    @foreach($productgroups as $Product_group)
                                                        @if($Supplier_product_group->kala_group_id == $Product_group->id)
                                                            {{$Product_group->title_fa}}
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td>
                                                    @foreach($carbrands as $Car_brand)
                                                        @if($Car_brand->id == $Supplier_product_group->car_brand_id)
                                                            {{$Car_brand->title_fa}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($carmodels as $Car_model)
                                                        @if($Supplier_product_group->car_model_id == $Car_model->id)
                                                            {{$Car_model->title_fa}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <form action="{{ route('supplierproductgroups.destroy' , $Supplier_product_group->id) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="btn-group btn-group-xs">
                                                            <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                <i class="fe fe-trash-2 "></i>
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
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label text-center mb-5">@foreach($suppliers as $supplier) ایجاد نمایندگی برای {{$supplier->title}} @endforeach</h6>
                                </div>
                                <form action="{{ route('representatives.store')}}" method="POST">
                                    <div class="row row-sm">
                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                            @include('error')
                                        </div>
                                        <input type="hidden" name="supplier_id" value="@foreach($suppliers as $supplier) {{$supplier->id}} @endforeach">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب برند قطعات </p>
                                                <select multiple="multiple" name="brand_id[]" onchange="console.log($(this).children(':selected').length)" class="selectsum2">
                                                    @foreach($brands as $brand)
                                                        <option value="{{$brand->id}}">{{$brand->title_fa}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mg-b-10 text-center">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> برند قطعات </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($representatives as $Representative)
                                            <tr class="odd gradeX">

                                                <td>{{$s++}}</td>

                                                @foreach($brands as $Brand)
                                                    @if($Brand->id == $Representative->brand_id)
                                                        <td>{{$Brand->title_fa}}</td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    <form action="{{ route('representatives.destroy' , $Representative->id) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="btn-group btn-group-xs">
                                                            <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                <i class="fe fe-trash-2 "></i>
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
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h3 class="text-center mb-5"><span class="badge badge-light">افزودن کلمات کلیدی</span></h3>
                                </div>
                                <form action="{{route('supplierkeyword', $Supplier->id)}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    {{ method_field('PATCH') }}
                                    <div class="row row-sm">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <p class="mg-b-10">کلمات کلیدی</p>
                                                <textarea name="keyword" cols="30" rows="2" class="form-control">@if(!$Supplier->keyword) کلمه کلیدی 1 ، کلمه کلیدی 2 ، کلمه کلیدی 3 و... @else  {{$Supplier->keyword}}@endif</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info m-r-20 text-center">ذخیره اطلاعات</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('end')
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
            .create( document.querySelector( '#editor' ) )
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
                    url : '{{ route( 'option' ) }}',
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        (function($) {
            //fancyfileuplod
            $('#demo').FancyFileUpload({
                params : {
                    action : 'fileuploader',
                    id:"{{$supplier->id}}",
                    table:"supplier_id",
                },
                maxfilesize : 1000000
            });
        })(jQuery);

    </script>
@endsection
@endsection
