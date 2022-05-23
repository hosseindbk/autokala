@extends('Admin.admin')
@section('title')
    <title> ویرایش برند قطعات </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت برند قطعات</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/brands')}}"> مدیریت برند ها</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش برند قطعات</li>
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
                                    @foreach($brands as $brand)
                                        <div class="col-md-6">
                                            <p> برند قطعه فارسی : {{$brand->title_fa}} </p>
                                            <p> برند قطعه انگلیسی : {{$brand->title_en }}</p>
                                            <p> شماره تماس : {{$brand->phone}}</p>
                                            <p> موبایل : {{$brand->mobile}}</p>
                                            <p> ایمیل : {{$brand->email}}</p>
                                            <p> وبسایت : {{$brand->website}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="{{asset($brand->image)}}" class="img-responsive" alt="">
                                        </div>
                                        @if($brand->image != null)
                                            <div style="position: absolute;bottom: 0px;margin: 0 40%;">
                                                <form action="{{ route('updatebrandimg', $brand->id)}}" method="post">
                                                    {{ method_field('patch') }}
                                                    {{csrf_field()}}
                                                    <div class="btn-group btn-group-xs">
                                                        <button type="submit" class="btn btn-danger btn-xs">
                                                            <i class="fe fe-trash-2 "></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
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
                                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-toggle="collapse" href="#editbrand" role="button">@foreach($brands as $brand) ویرایش اطلاعات برند {{$brand->title_fa}} @endforeach</a>
                                <div class="collapse mg-t-5" id="editbrand">
                                    <div>
                                        <h3 class="text-center mb-5"><span class="badge badge-light">   @foreach($brands as $brand) ویرایش اطلاعات برند {{$brand->title_fa}} @endforeach</span></h3>
                                    </div>
                                <div>
                                    <h6 class="main-content-label text-center mb-5">ورود اطلاعات برند قطعات</h6>
                                </div>
                                @foreach($brands as $brand)
                                    <form action="{{route('brands.update', $brand->id)}}" method="POST" enctype="multipart/form-data">
                                        <div class="row row-sm">
                                            {{csrf_field()}}
                                            {{ method_field('PATCH') }}

                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام برند قطعه فارسی</p>
                                                    <input type="text" name="title_fa" data-required="1" value="{{$brand->title_fa}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام برند قطعه انگلیسی</p>
                                                    <input type="text" name="title_en" data-required="1" value="{{$brand->title_en}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">عنوان اختصار</p>
                                                    <input type="text" name="abstract_title" data-required="1" value="{{$brand->abstract_title}}"  class="form-control" />
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تلفن ثابت</p>
                                                    <input type="text" name="phone" data-required="1" value="{{$brand->phone}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">موبایل</p>
                                                    <input type="text" name="mobile" data-required="1" value="{{$brand->mobile}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">واتس اپ</p>
                                                    <input type="text" name="whatsapp" data-required="1" value="{{$brand->whatsapp}}"  class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">ایمیل</p>
                                                    <input type="text" name="email" data-required="1" value="{{$brand->email}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">وبسایت</p>
                                                    <input type="text" name="website" data-required="1" value="{{$brand->website}}" class="form-control" />
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب وضعیت نمایش</p>
                                                    <select name="status_id" class="form-control select-lg select2">
                                                        @foreach($statuses as $status)
                                                            <option value="{{$status->id}}" {{$status->id == $brand->status ? 'selected' : '' }}>{{$status->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب کشور سازنده</p>
                                                    <select name="country_id" class="form-control select-lg select2">
                                                        <option value="">انتخاب کشور سازنده</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id}}" {{$country->id == $brand->country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر اصلی قطعه</p>
                                                    <input type="file" name="image" class="dropify" data-height="200">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">ادرس</p>
                                                    <textarea name="address" id="" cols="30" data-required="1" rows="5" class="form-control" >{{$brand->address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">توضیحات</p>
                                                    <textarea name="description" id="" cols="30" data-required="1" rows="5" class="form-control" >{{$brand->description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mg-b-10 text-center">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
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
                                    <h6 class="main-content-label text-center mb-5">ایجاد نمایندگی برند قطعات</h6>
                                </div>
                                <form action="{{ route('representetivesuppliers.store')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="brand_id" value="@foreach($brands as $brand) {{$brand->id}} @endforeach">
                                    <div class="row row-sm">
                                        <div class="col-md-4">
{{--                                            <div class="form-group">--}}
{{--                                                <p class="mg-b-10">انتخاب تامین کننده</p>--}}
{{--                                                <select multiple="multiple" name="supplier_id[]" onchange="console.log($(this).children(':selected').length)" class="selectsum2">--}}
{{--                                                    @foreach($suppliers as $supplier)--}}
{{--                                                        <option value="{{$supplier->id}}">{{$supplier->title}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}

                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب تامین کننده</p>
                                                <select name="supplier_id[]" multiple="multiple" class="form-control select-lg select2">
                                                    <option value="">انتخاب تامین کننده</option>
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{$supplier->id}}">{{$supplier->title}}</option>
                                                    @endforeach
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
                                            <th class="wd-10p"> تامین کنندگان </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($representetivesuppliers as $Representetive_supplier)
                                            <tr class="odd gradeX">
                                                <td>{{$s++}}</td>
                                                <td>
                                                    @foreach($suppliers as $supplier)
                                                        @if($supplier->id == $Representetive_supplier->supplier_id)
                                                            {{$supplier->title}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($statuses as $status)
                                                        @if($status->id == $Representetive_supplier->status)
                                                            @if($status->id == 1)
                                                                <button class="btn ripple btn-outline-warning">{{$status->title}}</button>
                                                            @elseif($status->id == 2)
                                                                <button class="btn ripple btn-outline-primary">{{$status->title}}</button>
                                                            @elseif($status->id == 3)
                                                                <button class="btn ripple btn-outline-info">{{$status->title}}</button>
                                                            @elseif($status->id == 4)
                                                                <button class="btn ripple btn-outline-success">{{$status->title}}</button>
                                                            @elseif($status->id == 5)
                                                                <button class="btn ripple btn-outline-light">{{$status->title}}</button>
                                                            @elseif($status->id == 6)
                                                                <button class="btn ripple btn-outline-danger">{{$status->title}}</button>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <form action="{{ route('representetivesuppliers.destroy' , $Representetive_supplier->id) }}" method="post">
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
@endsection
@endsection
