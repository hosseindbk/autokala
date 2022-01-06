@extends('Admin.admin')
@section('title')
    <title> ایجاد پیشنهاد خرید/فروش </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت پیشنهاد خرید/فروش</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/offers')}}">مدیریت پیشنهاد خرید/فروش</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ایجاد پیشنهاد خرید/فروش</li>
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
                                    <h6 class="main-content-label text-center mb-5">ورود اطلاعات پیشنهاد خرید/فروش</h6>
                                </div>
                                <form action="{{ route('offers.store')}}" method="POST" enctype="multipart/form-data">
                                    <div class="row row-sm">
                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                            @include('error')
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">نام کالا</p>
                                                <input type="text" name="title" placeholder="نام کالا را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">خرده فروشی داریم؟ (ویژه تامین کننده)</p>
                                                <select name="single" id="" class="form-control select-lg select2">
                                                    <option value="">انتخاب کنید</option>
                                                    <option value="1">بلی</option>
                                                    <option value="0">خیر</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب خودرو</p>
                                                <select name="car_brand_id" class="form-control select2" id="car_brand_id">
                                                    <option value="">انتخاب خودرو</option>
                                                    @foreach($carbrands as $car_brand)
                                                        <option value="{{$car_brand->id}}">{{$car_brand->title_fa}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب استان</p>
                                                <select name="state_id" class="form-control select-lg select2" id="state_id">
                                                    <option value="">انتخاب استان</option>
                                                    @foreach($states as $state)
                                                        <option value="{{$state->id}}" {{Auth::user()->state_id == $state->id ? 'selected' : ''}}>{{$state->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">جهت فروش / خرید</p>
                                                <select name="buyorsell" class="form-control select-lg select2" id="buyorsell">
                                                    <option value="">انتخاب کنید</option>
                                                    <option value="sell">پیشنهاد فروش</option>
                                                    <option value="buy">پیشنهاد خرید</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">تامین کننده کالا (ویژه تامین کننده)</p>
                                                <select name="supplier_id" class="form-control select2" id="supplier_id">
                                                    <option value="">انتخاب تامین کننده</option>
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{$supplier->id}}">{{$supplier->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">قیمت کالا خرده فروشی</p>
                                                <input type="text" name="single_price" placeholder="قیمت کالا خرده فروشی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب مدل خودرو</p>
                                                <select name="car_model_id[]" multiple="multiple" class="form-control select2" id="car_model_id">
                                                    <option value="">انتخاب مدل خودرو</option>
                                                </select>
                                            </div>
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
                                            <div class="form-group">
                                                <p class="mg-b-10">تامین کننده دائمی هستم؟ (ویژه تامین کننده)</p>
                                                <select name="permanent_supplier" class="form-control select2" id="permanent_supplier">
                                                    <option value="">انتخاب کنید</option>
                                                    <option value="1">بله</option>
                                                    <option value="0">خیر</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">برند کالا</p>
                                                <select name="brand_id" class="form-control select2" id="brand_id">
                                                    <option value="">انتخاب برند</option>
                                                    @foreach($brands as $brand)
                                                        <option value="{{$brand->id}}">{{$brand->title_fa}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">قیمت کالا عمده فروشی (ویژه تامین کننده)</p>
                                                <input type="text" name="price" data-required="1" placeholder="قیمت کالا عمده فروشی را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">تعداد کالا موجود</p>
                                                <input type="text" name="total" placeholder="تعداد موجودی کالا را وارد کنید" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">تلفن موبایل</p>
                                                <input type="text" name="mobile" value="{{Auth::user()->phone}}" class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <p class="mg-b-10">دسته بندی گروه کالا</p>
                                                <select name="product_group" class="form-control select2" id="product_group">
                                                    <option value="">انتخاب برند</option>
                                                    @foreach($productgroups as $product_group)
                                                        <option value="{{$product_group->id}}">{{$product_group->title_fa}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">تصویر اصلی کالا</p>
                                                <input type="file" name="image1" class="dropify" data-height="200">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">تصویر کالا</p>
                                                <input type="file" name="image2" class="dropify" data-height="200">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">تصویر  کالا</p>
                                                <input type="file" name="image3" class="dropify" data-height="200">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="mg-b-10">ادرس</p>
                                                <textarea name="address" id="" cols="30" rows="5" class="form-control" placeholder="ادرس را وارد کنید"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p class="mg-b-10">توضیحات</p>
                                                <textarea name="description" id="editor" cols="30" data-required="1" rows="5" class="form-control" placeholder="توضیحات را وارد کنید"></textarea>
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
@endsection
@endsection
