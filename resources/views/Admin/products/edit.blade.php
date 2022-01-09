@extends('Admin.admin')
@section('title')
    <title> ویرایش کالا </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">ویرایش کالا</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/products')}}">مدیریت  کالا</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش کالا</li>
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
                                    <h3 class="text-center mb-5"><span class="badge badge-light">   @foreach($products as $product)  {{$product->title_fa}} @endforeach</span></h3>
                                </div>
                                <div class="row row-sm">
                                    @foreach($products as $product)
                                    <div class="col-md-6">
                                        <p> یونیکد : {{$product->unicode}} </p>
                                        <p> نام فارسی : {{$product->title_fa}}</p>
                                        <p> نام انگلیسی : {{$product->title_en}}</p>
                                        <p> عنوان بازار فارسی : {{$product->title_bazar_fa}}</p>
                                        <p> عنوان بازار انگلیسی : {{$product->title_bazar_en}}</p>
                                        <p> کد فنی کارخانه : {{$product->code_fani_company}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="width: 250px;float: left;border: 2px solid #dad8d8;border-radius: 15px;">
                                                <img src="{{asset($product->image)}}" class="img-responsive" style="padding: 20px;" alt="">
                                            @if($product->image != null)
                                                <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                    <form action="{{ route('updateproimg', $product->id)}}" method="post">
                                                        {{ method_field('patch') }}
                                                        {{csrf_field()}}
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
                                    <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-toggle="collapse" href="#collapseExample" role="button">@foreach($products as $product) ویرایش اطلاعات {{$product->title_fa}} @endforeach</a>
                                    <div class="collapse mg-t-5" id="collapseExample">
                                        <div>
                                            <h3 class="text-center mb-5"><span class="badge badge-light">   @foreach($products as $product) ویرایش اطلاعات {{$product->title_fa}} @endforeach</span></h3>
                                        </div>
                                            @foreach($products as $product)
                                            <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                                                <div class="row row-sm">
                                                    {{csrf_field()}}
                                                    {{ method_field('PATCH') }}
                                                    <div class="col-md-12">
                                                        @include('error')
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">یونیکد</p>
                                                            <input type="text" name="unicode" data-required="1" value=" {{$product->unicode}} " class="form-control input-height" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">نام کالا فارسی</p>
                                                            <input type="text" name="title_fa" data-required="1" value="{{$product->title_fa}}"  class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">نام  کالا انگلیسی</p>
                                                            <input type="text" name="title_en" data-required="1" value="{{$product->title_en}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">عنوان بازار فارسی</p>
                                                            <input type="text" name="title_bazar_fa" data-required="1" value="{{$product->title_bazar_fa}}"  class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">عنوان بازار انگلیسی</p>
                                                            <input type="text" name="title_bazar_en" data-required="1" value="{{$product->title_bazar_en}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">کد فنی کارخانه</p>
                                                            <input type="text" name="code_fani_company" data-required="1" value="{{$product->code_fani_company}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">انتخاب گروه کالا</p>
                                                            <select name="kala_group_id" class="form-control select2">
                                                                @foreach($productgroups as $product_group)
                                                                    @if($product->kala_group_id == $product_group->id)
                                                                        <option value="{{$product_group->id}}">{{$product_group->title_fa}}</option>
                                                                    @endif
                                                                @endforeach
                                                                @foreach($productgroups as $product_group)
                                                                    <option value="{{$product_group->id}}">{{$product_group->title_fa}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">عنوان مشخصه فنی 1</p>
                                                            <input type="text" name="title_specific1"  value="{{$product->title_specific1}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">عنوان مشخصه فنی 2</p>
                                                            <input type="text" name="title_specific2"  value="{{$product->title_specific2}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">عنوان مشخصه فنی 3</p>
                                                            <input type="text" name="title_specific3"  value="{{$product->title_specific3}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">عنوان مشخصه فنی 4</p>
                                                            <input type="text" name="title_specific4"  value="{{$product->title_specific4}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">عنوان مشخصه فنی 5</p>
                                                            <input type="text" name="title_specific5"  value="{{$product->title_specific5}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">عنوان مشخصه فنی 6</p>
                                                            <input type="text" name="title_specific6"  value="{{$product->title_specific6}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10">انتخاب وضعیت نمایش</p>
                                                            <select name="status_id" class="form-control select-lg select2">
                                                                @foreach($statuses as $status)
                                                                    <option value="{{$status->id}}" {{$product->status == $status->id ? 'selected' : ''}}>{{$status->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10"> مشخصه فنی 1</p>
                                                            <input type="text" name="specific1"  value="{{$product->specific1}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10"> مشخصه فنی 2</p>
                                                            <input type="text" name="specific2"  value="{{$product->specific2}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10"> مشخصه فنی 3</p>
                                                            <input type="text" name="specific3" value="{{$product->specific3}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10"> مشخصه فنی 4</p>
                                                            <input type="text" name="specific4"  value="{{$product->specific4}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10"> مشخصه فنی 5</p>
                                                            <input type="text" name="specific5"  value="{{$product->specific5}}" class="form-control" />
                                                        </div>
                                                        <div class="form-group">
                                                            <p class="mg-b-10"> مشخصه فنی 6</p>
                                                            <input type="text" name="specific6"  value="{{$product->specific6}}" class="form-control" />
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
                                                            <textarea name="description" id="editor" cols="30" data-required="1" rows="5" class="form-control" >{{$product->description}}</textarea>
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
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h3 class="text-center mb-5"><span class="badge badge-light">   @foreach($products as $product) بارگذاری تصاویر {{$product->title_fa}} @endforeach</span></h3>
                                </div>
                                <div class="mg-t-10">
                                    <input id="demo" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png," multiple="">
                                </div>
                                <div class="mg-t-10">
                                <ul id="lightgallery" class="list-unstyled row mb-0">
                                    @foreach($medias as $media)
                                        <li class="col-xs-4 col-sm-3 col-md-3 col-xl-3 mb-3" data-responsive="{{asset($media->image)}}" data-src="{{asset($media->image)}}" >
                                            <div style="position: relative;">
                                                <img class="img-responsive" height="150" src="{{asset($media->image)}}">
                                            </div>
                                            <div style="position: absolute;bottom: 0px;margin: 0 40%;">
                                                <form action="{{ route('medias.destroy', $media->id)}}" method="post">
                                                    {{ method_field('delete') }}
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
        ClassicEditor
            .create( document.querySelector( '#editor2' ) )
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
            $('#car_model_id').change(function(){
                $("#car_type_id option").remove();
                var id = $('#car_model_id').val();
                $.ajax({
                    url : '{{ route( 'typeoption' ) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function( result )
                    {
                        $.each( result, function(k, v) {
                            $('#car_type_id').append($('<option>', {value:k, text:v}));
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
                    id:"{{$product->id}}",
                    table:"product_id",
                },
                maxfilesize : 1000000
            });
        })(jQuery);

    </script>
@endsection
@endsection
