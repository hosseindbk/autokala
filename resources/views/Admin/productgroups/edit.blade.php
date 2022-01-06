@extends('Admin.admin')
@section('title')
    <title> ویرایش  گروه کالا </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت گروه کالا</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/productgroups')}}"> مدیریت گروه کالا</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش گروه کالا</li>
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
                                @foreach($productgroups as $Product_group)
                                    <form action="{{route('productgroups.update', $Product_group->id)}}" method="POST" enctype="multipart/form-data">
                                        <div class="row row-sm">
                                            {{csrf_field()}}
                                            {{ method_field('PATCH') }}

                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">عنوان گروه کالا</p>
                                                    <input type="text" name="title_fa" data-required="1" value="{{$Product_group->title_fa}}"  class="form-control" />
                                                </div>

                                                <div class="form-group">
                                                    <p class="mg-b-10">خدمات مرتبط</p>
                                                    <input type="text" name="related_service" data-required="1" value="{{$Product_group->related_service}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">کد گروه کالا</p>
                                                    <input type="text" name="code" data-required="1" value="{{$Product_group->code}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">عنوان خدمات</p>
                                                    <input type="text" name="service_title" data-required="1" value="{{$Product_group->service_title}}"  class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب وضعیت نمایش</p>
                                                    <select name="status_id" class="form-control select-lg select2">
                                                        @foreach($statuses as $status)
                                                            @if($Product_group->status == $status->id)
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
                                                    <p class="mg-b-10">توضیحات قطعه</p>
                                                    <textarea name="part_description" id="" cols="30" data-required="1" rows="10" class="form-control" >{{$Product_group->part_description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <p class="mg-b-10">توضیحات خدمات</p>
                                                    <textarea name="service_description" id="" cols="30" data-required="1" rows="10" class="form-control" >{{$Product_group->service_description}}</textarea>
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
