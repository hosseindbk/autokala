@extends('Admin.admin')
@section('title')
    <title> ایجاد کالا </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کالا</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/products')}}">مدیریت  کالا</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ایجاد کالا</li>
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
                                    <h6 class="main-content-label text-center mb-5">ورود اطلاعات کالا</h6>
                                </div>
                                <form action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
                                    <div class="row row-sm">
                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                            @include('error')
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">یونیکد</p>
                                                <input type="text" name="unicode" data-required="1" value=" @foreach($products as $product) {{$product->unicode + 1}} @endforeach " class="form-control input-height" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">نام کالا فارسی</p>
                                                <input type="text" name="title_fa" data-required="1" placeholder="نام کالا فارسی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">نام  کالا انگلیسی</p>
                                                <input type="text" name="title_en" data-required="1" placeholder="نام کالا انگلیسی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">عنوان بازار فارسی</p>
                                                <input type="text" name="title_bazar_fa" data-required="1" placeholder="عنوان بازار فارسی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">عنوان بازار انگلیسی</p>
                                                <input type="text" name="title_bazar_en" data-required="1" placeholder="عنوان بازار انگلیسی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">کد فنی کارخانه</p>
                                                <input type="text" name="code_fani_company" data-required="1" placeholder="کد فنی کارخانه را وارد کنید" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">عنوان مشخصه فنی 1</p>
                                                <input type="text" name="title_specific1" data-required="1" placeholder="عنوان مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">عنوان مشخصه فنی 2</p>
                                                <input type="text" name="title_specific2" data-required="1" placeholder="عنوان مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">عنوان مشخصه فنی 3</p>
                                                <input type="text" name="title_specific3" data-required="1" placeholder="عنوان مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">عنوان مشخصه فنی 4</p>
                                                <input type="text" name="title_specific4" data-required="1" placeholder="عنوان مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">عنوان مشخصه فنی 5</p>
                                                <input type="text" name="title_specific5" data-required="1" placeholder="عنوان مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">عنوان مشخصه فنی 6</p>
                                                <input type="text" name="title_specific6" data-required="1" placeholder="عنوان مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10"> مشخصه فنی 1</p>
                                                <input type="text" name="specific1" data-required="1" placeholder=" مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10"> مشخصه فنی 2</p>
                                                <input type="text" name="specific2" data-required="1" placeholder=" مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10"> مشخصه فنی 3</p>
                                                <input type="text" name="specific3" data-required="1" placeholder=" مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10"> مشخصه فنی 4</p>
                                                <input type="text" name="specific4" data-required="1" placeholder=" مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10"> مشخصه فنی 5</p>
                                                <input type="text" name="specific5" data-required="1" placeholder=" مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10"> مشخصه فنی 6</p>
                                                <input type="text" name="specific6" data-required="1" placeholder=" مشخصه فنی را وارد کنید" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب گروه کالا</p>
                                                <select name="kala_group_id" class="form-control select2">
                                                    <option value="">انتخاب گروه کالا</option>
                                                    @foreach($productgroups as $product_group)
                                                        <option value="{{$product_group->id}}">{{$product_group->title_fa}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <p class="mg-b-10">تصویر اصلی کالا</p>
                                                <input type="file" name="image" class="dropify" data-height="200">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <p class="mg-b-10">توضیحات</p>
                                                <textarea name="description" id="editor" cols="30" data-required="1" rows="5" class="form-control" placeholder="توضیحات کالا را وارد کنید"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mg-b-10 text-center">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info m-r-20">ذخیره اطلاعات</button>
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
@endsection
@endsection
