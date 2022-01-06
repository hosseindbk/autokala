@extends('Admin.admin')
@section('title')
    <title> تغییر اطلاعات تیپ و تریم </title>
    <link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت اطلاعات تیپ و تریم</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/cartypes')}}"> مدیریت تیپ و تریم خودرو</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش تیپ و تریم خودرو</li>
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
                                    <h6 class="main-content-label text-center mb-5">تغییر اطلاعات اطلاعات تیپ و تریم</h6>
                                </div>
                                @foreach($cartypes as $Car_type)
                                    <form action="{{route('cartypes.update', $Car_type->id)}}" method="POST" enctype="multipart/form-data">
                                        <div class="row row-sm">
                                            {{csrf_field()}}
                                            {{ method_field('PATCH') }}

                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام تیپ و تریم فارسی</p>
                                                    <input type="text" name="title_fa" data-required="1" value="{{$Car_type->title_fa}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام تیپ و تریم انگلیسی</p>
                                                    <input type="text" name="title_en" data-required="1" value="{{$Car_type->title_en}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب مدل خودرو</p>
                                                    <select name="car_model_id" class="form-control select-lg select2">
                                                        @foreach($carmodels as $Car_model)
                                                            @if($Car_model->id == $Car_type->car_model_id)
                                                                <option value="{{$Car_model->id}}">{{$Car_model->title_fa}}</option>
                                                            @else
                                                                <option value="{{$Car_model->id}}">{{$Car_model->title_fa}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب وضعیت نمایش</p>
                                                    <select name="status_id" class="form-control select-lg select2">
                                                        @foreach($statuses as $status)
                                                            @if($Car_type->status == $status->id)
                                                                <option value="{{$status->id}}">{{$status->title}}</option>
                                                            @endif
                                                        @endforeach
                                                        @foreach($statuses as $status)
                                                            <option value="{{$status->id}}">{{$status->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <p class="mg-b-10">توضیحات</p>
                                                    <textarea name="description" id="" cols="30" data-required="1" rows="10" class="form-control" >{{$Car_type->description}}</textarea>
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
    <script src="{{asset('admin/assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>

@endsection
@endsection
