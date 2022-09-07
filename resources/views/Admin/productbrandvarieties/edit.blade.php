@extends('Admin.admin')
@section('title')
    <title> ویرایش کالا برند تنوع </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">ویرایش کالا برند تنوع</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش کالا برند تنوع</li>
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
                                    @foreach($productbrandvarieties as $Product_brand_variety)
                                        <div class="col-md-4">
                                            @if($Product_brand_variety->image1 != null)
                                            <div style="width: 250px;float: right;border: 2px solid #dad8d8;border-radius: 15px;">
                                                <img src="{{asset($Product_brand_variety->image1)}}" class="img-responsive" style="padding: 20px;" alt="">
                                                <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                    <form action="{{ route('img1update', $Product_brand_variety->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        <div class="btn-group btn-group-xs">
                                                            <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                <i class="fe fe-trash-2 "></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if($Product_brand_variety->image2 != null)
                                                <div style="width: 250px;margin: 0 auto;border: 2px solid #dad8d8;border-radius: 15px;">
                                                <img src="{{asset($Product_brand_variety->image2)}}" class="img-responsive" style="padding: 20px;" alt="">
                                                <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                    <form action="{{ route('img2update', $Product_brand_variety->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        <div class="btn-group btn-group-xs">
                                                            <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                <i class="fe fe-trash-2 "></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if($Product_brand_variety->image3 != null)
                                                <div style="width: 250px;float: left;border: 2px solid #dad8d8;border-radius: 15px;">
                                                    <img src="{{asset($Product_brand_variety->image3)}}" class="img-responsive" style="padding: 20px;" alt="">
                                                    <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                        <form action="{{ route('img3update', $Product_brand_variety->id)}}" method="post">
                                                            {{csrf_field()}}
                                                            <div class="btn-group btn-group-xs">
                                                                <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                    <i class="fe fe-trash-2 "></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
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
                                        <h3 class="text-center mb-5"><span class="badge badge-light">ویرایش اطلاعات کالا برند تنوع </span></h3>
                                    </div>
                                    @foreach($productbrandvarieties as $Product_brand_variety)
                                    <form action="{{route('pupdate', $Product_brand_variety->id)}}" method="POST" enctype="multipart/form-data">
                                            <div class="row row-sm">
                                                {{csrf_field()}}
                                                {{ method_field('PATCH') }}

                                                <div class="col-md-12">
                                                    @include('error')
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">انتخاب برند قطعات</p>
                                                        <select name="brand_id" class="form-control select-lg select2" id="brand_id">
                                                            @foreach($brands as $brand)
                                                                <option value="{{$brand->id}}" {{$Product_brand_variety->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->title_fa}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">عنوان عامل1</p>
                                                        <input type="text" name="item1" data-required="1" value="{{$Product_brand_variety->item1}}" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">مقدار عامل1</p>
                                                        <input type="text" name="value_item1" data-required="1" value="{{$Product_brand_variety->value_item1}}" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نام کالا</p>

                                                                @foreach($products as $product)
                                                                    @if($product->id == $Product_brand_variety->product_id)
                                                                        <input type="hidden" name="product_id"  value="{{$product->id}}" />
                                                                        <input type="text" name="" disabled value="{{$product->title_fa}}" class="form-control" />
                                                                    @endif
                                                                @endforeach
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">عنوان عامل2</p>
                                                        <input type="text" name="item2" data-required="1" value="{{$Product_brand_variety->item2}}" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">مقدار عامل2</p>
                                                        <input type="text" name="value_item2" data-required="1" value="{{$Product_brand_variety->value_item2}}" class="form-control"/>
                                                     </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">انتخاب وضعیت ضمانت و گارانتی</p>
                                                        <select name="guarantee" class="form-control select-lg select2" id="guarantee">
                                                                <option value="0" {{$Product_brand_variety->guarantee == 0 ? 'selected' : ''}}>ندارد</option>
                                                                <option value="1" {{$Product_brand_variety->guarantee == 1 ? 'selected' : ''}}>دارد</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">عنوان عامل3</p>
                                                        <input type="text" name="item3" data-required="1" value="{{$Product_brand_variety->item3}}" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">مقدار عامل3</p>
                                                        <input type="text" name="value_item3" data-required="1" value="{{$Product_brand_variety->value_item3}}" class="form-control" />
                                                     </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه قوت1</p>
                                                        <input type="text" name="strength1" data-required="1" value="{{$Product_brand_variety->strength1}}" class="form-control" />
                                                    </div>

                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه ضعف1</p>
                                                        <input type="text" name="weakness1" data-required="1" value="{{$Product_brand_variety->weakness1}}" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">انتخاب وضعیت نمایش</p>
                                                        <select name="status_id" class="form-control select-lg select2">
                                                            @foreach($statuses as $status)
                                                                <option value="{{$status->id}}" {{$Product_brand_variety->status == $status->id ? 'selected' : ''}}>{{$status->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه قوت2</p>
                                                        <input type="text" name="strength2" data-required="1" value="{{$Product_brand_variety->strength2}}" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه ضعف2</p>
                                                        <input type="text" name="weakness2" data-required="1" value="{{$Product_brand_variety->weakness2}}" class="form-control" />
                                                     </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه قوت3</p>
                                                        <input type="text" name="strength3" data-required="1" value="{{$Product_brand_variety->strength3}}" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقطه ضعف3</p>
                                                        <input type="text" name="weakness3" data-required="1" value="{{$Product_brand_variety->weakness3}}" class="form-control" />
                                                     </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">تصویر اصلی کالا</p>
                                                        <input type="file" name="image1"  class="dropify" data-height="200">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">تصویر کالا</p>
                                                        <input type="file" name="image2"  class="dropify" data-height="200">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">تصویر کالا</p>
                                                        <input type="file" name="image3"  class="dropify" data-height="200">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">توضیحات</p>
                                                        <textarea name="description" id="editor" cols="30" data-required="1" rows="5" class="form-control" >{{$Product_brand_variety->description}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">نقد و بررسی</p>
                                                        <textarea name="review" id="editor2" cols="30" data-required="1" rows="5" class="form-control" >{{$Product_brand_variety->review}}</textarea>
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
@endsection
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

@endsection
