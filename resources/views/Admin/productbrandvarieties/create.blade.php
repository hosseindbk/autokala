@extends('Admin.admin')
@section('title')
    <title> ایجاد کالا برند تنوع</title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کالا برند تنوع </h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/products')}}"> مدیریت کالا </a></li>
                            <li class="breadcrumb-item active" aria-current="page">ایجاد کالا برند تنوع</li>
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
                                        <div>
                                            <h6 class="main-content-label text-center mb-5">ورود اطلاعات کالا برند تنوع </h6>
                                        </div>
                                        <form action="{{ route('productbrandvarieties.store')}}" method="POST" enctype="multipart/form-data">
                                            <div class="row row-sm">
                                                {{csrf_field()}}
                                                <div class="col-md-12">
                                                    @include('error')
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">انتخاب برند قطعات</p>
                                                        <select name="brand_id" class="form-control select-lg select2" id="brand_id">
                                                            @foreach($brands as $brand)
                                                                <option value="{{$brand->id}}">{{$brand->title_fa}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">عنوان عامل1</p>
                                                        <input type="text" name="item1" data-required="1" placeholder="عنوان عامل1 را وارد کنید" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">مقدار عامل1</p>
                                                        <input type="text" name="value_item1" data-required="1" placeholder="مقدار عامل1 را وارد کنید" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نام کالا</p>
                                                        <select name="product_id" class="form-control select-lg select2" id="">
                                                            @foreach($products as $product)
                                                            <option value="{{$product->id}}">{{$product->title_fa}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">عنوان عامل2</p>
                                                        <input type="text" name="item2" data-required="1" placeholder="عنوان عامل2 را وارد کنید" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">مقدار عامل2</p>
                                                        <input type="text" name="value_item2" data-required="1" placeholder="مقدار عامل2 را وارد کنید" class="form-control" />
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">انتخاب وضعیت ضمانت و گارانتی</p>
                                                        <select name="guarantee" class="form-control select-lg select2" id="guarantee">

                                                            <option value="0">ندارد</option>
                                                            <option value="1">دارد</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">عنوان عامل3</p>
                                                        <input type="text" name="item3" data-required="1" placeholder="عنوان عامل3 را وارد کنید" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">مقدار عامل3</p>
                                                        <input type="text" name="value_item3" data-required="1" placeholder="مقدار عامل3 را وارد کنید" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه قوت1</p>
                                                        <input type="text" name="strength1" data-required="1" placeholder="نقطه قوت1 را وارد کنید" class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه ضعف1</p>
                                                        <input type="text" name="weakness1" data-required="1" placeholder="نقطه ضعف1 را وارد کنید" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">تصویر اصلی کالا</p>
                                                        <input type="file" name="image1" class="dropify" data-height="200">
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه قوت2</p>
                                                        <input type="text" name="strength2" data-required="1" placeholder="نقطه قوت2 را وارد کنید" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه ضعف2</p>
                                                        <input type="text" name="weakness2" data-required="1" placeholder="نقطه ضعف2 را وارد کنید" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">تصویر کالا</p>
                                                        <input type="file" name="image2" class="dropify" data-height="200">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه قوت3</p>
                                                        <input type="text" name="strength3" data-required="1" placeholder="نقطه قوت3 را وارد کنید" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه ضعف3</p>
                                                        <input type="text" name="weakness3" data-required="1" placeholder="نقطه ضعف3 را وارد کنید" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">تصویر کالا</p>
                                                        <input type="file" name="image3" class="dropify" data-height="200">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">توضیحات</p>
                                                        <textarea name="description" id="editor2" cols="30" data-required="1" rows="5" class="form-control" ></textarea>
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
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h3 class="text-center mb-5"><span class="badge badge-light">   @foreach($products as $product) انتخاب خودرو مناسب  {{$product->title_fa}} @endforeach</span></h3>
                                </div>
                                <form action="{{ route('carproducts.store')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="row row-sm">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" value="@foreach($products as $product) {{$product->id}} @endforeach" name="product_id">
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
                                                <select name="car_model_id" class="form-control select2" id="car_model_id">
                                                    <option value="">انتخاب مدل خودرو</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب تیپ و تریم خودرو</p>
                                                <select multiple="multiple" name="car_type_id[]" id="car_type_id" class="form-control select2">
                                                    <option value="">انتخاب تیپ و تریم خودرو</option>
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
                                            <th class="wd-10p"> نام خودرو </th>
                                            <th class="wd-10p"> مدل خودرو </th>
                                            <th class="wd-10p"> تیپ خودرو </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($carproducts as $Car_product)
                                            <tr class="odd gradeX">
                                                <td>{{$s++}}</td>
                                                <td>
                                                    @foreach($carbrands as $Car_brand)
                                                        @if($Car_brand->id == $Car_product->car_brand_id)
                                                            {{$Car_brand->title_fa}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($carmodels as $Car_model)
                                                        @if($Car_product->car_model_id == $Car_model->id)
                                                            {{$Car_model->title_fa}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($cartypes as $Car_type)
                                                        @if($Car_product->car_type_id == $Car_type->id)
                                                            {{$Car_type->title_fa}}
                                                        @elseif($Car_product->car_type_id == $Car_type->id)
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <form action="{{ route('carproducts.destroy' , $Car_product->id) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="btn-group btn-group-xs">
                                                            <button type="submit" class="btn btn-danger btn-xs">
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
