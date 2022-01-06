@extends('Admin.admin')
@section('title')
    <title> ایجاد کالا </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کالا</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/products')}}">مدیریت  کالا</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تصاویر کالا</li>
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
                                    <h6 class="main-content-label mb-1">بارگذاری تصاویر</h6>
                                </div>
                                @foreach($products as $product)
                                    <div class="row row-sm">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="mg-b-10">یونیکد</p>
                                           <p>{{$product->unicode}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="mg-b-10">نام کالا فارسی</p>
                                           <p>{{$product->title_fa}}</p>
                                        </div>
                                    </div>
                                    </div>
                                @endforeach
                                <div class="mg-t-10">
                                    <input id="demo" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png, html, zip, css,js" multiple="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <ul id="lightgallery" class="list-unstyled row mb-0">
                                    @foreach($medias as $media)
                                    <li class="col-xs-4 col-sm-3 col-md-3 col-xl-3 mb-3" data-responsive="{{asset($media->image)}}" data-src="{{asset($media->image)}}" >
                                        <div style="position: relative;">
                                        <img class="img-responsive" height="300" src="{{asset($media->image)}}">
                                        </div>
                                        <div style="position: absolute;bottom: 0px;margin: 0 40%;">
                                        <form action="{{ route('deleteimage' , $media->id) }}" method="post">
                                            {{method_field('DELETE')}}
                                            {{csrf_field()}}
                                            <div class="btn-group btn-group-xs">
                                                <button type="submit" class="btn btn-danger btn-xs">
                                                    <i class="fe fe-trash-2 "></i>
                                                </button>
                                            </div>
                                        </form>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
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
                    id:"{{$product->id}}",
                    table:"product_id",
                },
                maxfilesize : 1000000
            });
        })(jQuery);

    </script>
@endsection
@endsection
