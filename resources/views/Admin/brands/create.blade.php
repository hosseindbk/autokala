@extends('Admin.admin')
@section('title')
    <title> ایجاد برند قطعات</title>
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
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت برند قطعات</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/brands')}}"> مدیریت برند قطعات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ایجاد برند قطعات</li>
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
                                <div>
                                    <h6 class="main-content-label text-center mb-5">ورود اطلاعات برند قطعات</h6>
                                </div>
                                <form action="{{ route('brands.store')}}" method="POST" enctype="multipart/form-data">
                                    <div class="row row-sm">
                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                        @include('error')
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">نام قطعه فارسی</p>
                                                <input type="text" name="title_fa" data-required="1" placeholder="نام برند فارسی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">نام قطعه انگلیسی</p>
                                                <input type="text" name="title_en" data-required="1" placeholder="نام برند انگلیسی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">نام اختصار</p>
                                                <input type="text" name="abstract_title" data-required="1" placeholder="نام اختصار را وارد کنید" class="form-control" />
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">تلفن</p>
                                                <input type="text" name="phone" data-required="1" placeholder="تلفن را وارد کنید" class="form-control input-height" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">واتس اپ</p>
                                                <input type="text" name="whatsapp" data-required="1" placeholder="واتس اپ را وارد کنید" class="form-control input-height" />
                                            </div>
                                            <div class="form-group m-0">
                                                <p class="mg-b-10">موبایل</p>
                                                <input type="text" name="mobile" data-required="1" placeholder="موبایل را وارد کنید" class="form-control input-height" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">ایمیل</p>
                                                <input type="text" name="email" data-required="1" placeholder="ایمیل را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">وبسایت</p>
                                                <input type="text" name="website" data-required="1" placeholder="وبسایت را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب کشور سازنده</p>
                                                <select name="country_id" class="form-control select-lg select2">
                                                    <option value="">انتخاب کشور سازنده</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
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
                                                <p class="mg-b-10">توضیحات</p>
                                                <textarea name="description" id="" cols="30" data-required="1" rows="5" class="form-control" placeholder="توضیحات برند را وارد کنید"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="mg-b-10">آدرس</p>
                                                <textarea name="address" id="" cols="30" data-required="1" rows="5" class="form-control" placeholder="آدرس را وارد کنید"></textarea>
                                            </div>
                                        </div>
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
