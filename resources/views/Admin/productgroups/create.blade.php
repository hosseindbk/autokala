@extends('Admin.admin')
@section('title')
    <title> ایجاد گروه کالا </title>
    <link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت گروه کالا</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/productgroups')}}"> مدیریت گروه کالا</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ایجاد گروه کالا</li>
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
                                    <h6 class="main-content-label text-center mb-5">ورود اطلاعات گروه کالا</h6>
                                </div>
                                <form action="{{ route('productgroups.store')}}" method="POST" enctype="multipart/form-data">
                                    <div class="row row-sm">
                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                            @include('error')
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="mg-b-10">عنوان گروه کالا</p>
                                                <input type="text" name="title_fa" data-required="1" placeholder="عنوان گروه کالا را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">خدمات مرتبط</p>
                                                <input type="text" name="related_service" data-required="1" placeholder="خدمات مرتبط را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">کد گروه کالا</p>
                                                <input type="text" name="code" data-required="1" placeholder="کد گروه کالا را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">عنوان خدمات</p>
                                                <input type="text" name="service_title" data-required="1" placeholder="عنوان خدمات را وارد کنید" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <p class="mg-b-10">توضیحات قطعه</p>
                                                <textarea name="part_description" id="" cols="30" data-required="1" rows="10" class="form-control" placeholder="توضیحات قطعه را وارد کنید"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <p class="mg-b-10">توضیحات خدمات</p>
                                                <textarea name="service_description" id="" cols="30" data-required="1" rows="10" class="form-control" placeholder="توضیحات خدمات را وارد کنید"></textarea>
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
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/form-elements.js')}}"></script>
@endsection
@endsection
