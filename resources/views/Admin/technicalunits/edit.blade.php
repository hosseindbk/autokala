@extends('Admin.admin')
@section('title')
    <title> ویرایش واحدهای خدمات فنی </title>
    <link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/sumoselect/sumoselect-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css-rtl/colors/default.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('site/css/mapp.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/fa/style.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت واحدهای خدمات فنی</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/technicalunits')}}">مدیریت واحد خدمات فنی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش واحد خدمات فنی</li>
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
                                    @foreach($technicalunits as $technical_unit)
                                        <div class="col-md-6">
                                            <p> عنوان : {{$technical_unit->title}} </p>
                                            <p> مدیر : {{$technical_unit->manager}}</p>
                                            <p> شماره تماس : {{$technical_unit->phone}}</p>
                                            <p> موبایل : {{$technical_unit->mobile}}</p>
                                            <p> ایمیل : {{$technical_unit->email}}</p>
                                            <p> وبسایت : {{$technical_unit->website}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div style="width: 250px;float: left;border: 2px solid #dad8d8;border-radius: 15px;">
                                                <img src="{{asset($technical_unit->image)}}" class="img-responsive" style="padding: 20px;" alt="">
                                                @if($technical_unit->image != null)
                                                    <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                        <form action="{{ route('updatetechimg', $technical_unit->id)}}" method="post">
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
                                    <h3 class="text-center mb-5"><span class="badge badge-light">ویرایش اطلاعات واحد خدمات فنی</span></h3>
                                </div>
                                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-toggle="collapse" href="#edittechnical" role="button"> ویرایش اطلاعات خدمات فنی </a>
                                <div class="collapse mg-t-5" id="edittechnical">
                                @foreach($technicalunits as $Technical_unit)
                                    <form action="{{route('technicalunits.update', $Technical_unit->id)}}" method="POST" enctype="multipart/form-data">
                                        <div class="row row-sm">
                                            {{csrf_field()}}
                                            {{ method_field('PATCH') }}
                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10"> نام واحد خدمات فنی</p>
                                                    <input type="text" name="title" data-required="1" value="{{$Technical_unit->title}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام مدیر</p>
                                                    <input type="text" name="manager" data-required="1" value="{{$Technical_unit->manager}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">ایمیل</p>
                                                    <input type="text" name="email" data-required="1" value="{{$Technical_unit->email}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">وبسایت</p>
                                                    <input type="text" name="website" data-required="1" value="{{$Technical_unit->website}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب وضعیت نمایش</p>
                                                    <select name="status_id" class="form-control select-lg select2">
                                                        @foreach($statuses as $status)
                                                            @if($Technical_unit->status == $status->id)
                                                                <option value="{{$status->id}}">{{$status->title}}</option>
                                                            @endif
                                                        @endforeach
                                                        @foreach($statuses as $status)<option value="{{$status->id}}">{{$status->title}}</option>@endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">موبایل</p>
                                                    <input type="text" name="mobile" data-required="1" value="{{$Technical_unit->mobile}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">موبایل2</p>
                                                    <input type="text" name="mobile2" data-required="1" value="{{$Technical_unit->mobile2}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب استان</p>
                                                    <select name="state_id" class="form-control select-lg select2">
                                                        <option value="">انتخاب استان</option>
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}" {{$state->id == $Technical_unit->state_id ? 'selected' : ''}}>{{$state->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب شهرستان</p>
                                                    <select name="city_id" id="city_id" class="form-control select-lg select2">
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}" {{$city->id == $Technical_unit->city_id ? 'selected' : ''}}>{{$city->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">کاربر واحد خدمات فنی</p>
                                                    <select name="user_id" class="form-control select-lg select2" >
                                                        <option value="">انتخاب کاربر</option>
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}" {{$user->id == $Technical_unit->user_id ? 'selected' : ''}}>{{$user->name}} - {{$user->phone}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تلفن ثابت</p>
                                                    <input type="text" name="phone" data-required="1" value="{{$Technical_unit->phone}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">تلفن ثابت2</p>
                                                    <input type="text" name="phone2" data-required="1" value="{{$Technical_unit->phone2}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">تلفن ثابت3</p>
                                                    <input type="text" name="phone3" data-required="1" value="{{$Technical_unit->phone3}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">واتس اپ</p>
                                                    <input type="text" name="whatsapp" data-required="1" value="{{$Technical_unit->whatsapp}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">نشان اتوکالا</p>
                                                    <select name="autokala" class="form-control select-lg select2">
                                                        <option value="">انتخاب نشان اتوکالا</option>
                                                        <option value="1">نشان طلایی اتوکالا</option>
                                                        <option value="2">نشان نقره ای اتوکالا</option>
                                                        <option value="3">نشان برنزی اتوکالا</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر اصلی واحد خدمات فنی</p>
                                                    <input type="file" name="image" class="dropify" data-height="200">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر دوم واحد خدمات فنی</p>
                                                    <input type="file" name="image2" class="dropify" data-height="200">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر سوم واحد خدمات فنی</p>
                                                    <input type="file" name="image3" class="dropify" data-height="200">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">ادرس</p>
                                                    <textarea name="address" id="" cols="30" data-required="1" rows="5" class="form-control" >{{$Technical_unit->address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">توضیحات</p>
                                                    <textarea name="description" id="editor" cols="30" data-required="1" rows="5" class="form-control" >{{$Technical_unit->description}}</textarea>
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
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h3 class="text-center mb-5"><span class="badge badge-light">افزودن اطلاعات خودرو گروه کالا</span></h3>
                                </div>
                                <form action="{{ route('cartechnichalgroups.store')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="technical_id" value="@foreach($technicalunits as $technical_unit) {{$technical_unit->id}} @endforeach">
                                    <div class="row row-sm">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب گروه خدمات</p>
                                                <select name="product_group_id" class="form-control select2">
                                                    <option value="">انتخاب گروه خدمات</option>
                                                    @foreach($productgroups as $Product_group)
                                                        <option value="{{$Product_group->id}}">{{$Product_group->related_service}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
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
                                                <select multiple="multiple" name="car_model_id[]" id="car_model_id" class="form-control select2">

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
                                            <th class="wd-10p"> گروه کالا </th>
                                            <th class="wd-10p"> برند خودرو </th>
                                            <th class="wd-10p"> مدل خودرو </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($cartechnicalgroups as $Car_technical_group)
                                            <tr class="odd gradeX">
                                                <td>{{$s++}}</td>
                                                <td>
                                                    @foreach($productgroups as $Product_group)
                                                        @if($Car_technical_group->kala_group_id == $Product_group->id)
                                                            {{$Product_group->related_service}}
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td>
                                                @foreach($carbrands as $Car_brand)
                                                    @if($Car_brand->id == $Car_technical_group->car_brand_id)
                                                         {{$Car_brand->title_fa}}
                                                    @endif
                                                @endforeach
                                                        </td>
                                                <td>
                                                @foreach($carmodels as $Car_model)
                                                    @if($Car_technical_group->car_model_id == $Car_model->id)
                                                          {{$Car_model->title_fa}}
                                                    @endif
                                                @endforeach
                                                    </td>
                                                <td>
                                                    <form action="{{ route('cartechnichalgroups.destroy', $Car_technical_group->id) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="btn-group btn-group-xs">
                                                            <button type="submit" class="btn btn-outline-danger btn-xs">
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
                                    <h3 class="text-center mb-5"><span class="badge badge-light">   @foreach($technicalunits as $Technical_unit) بارگذاری تصاویر {{$Technical_unit->title}} @endforeach</span></h3>
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
                    id:"{{$Technical_unit->id}}",
                    table:"technical_id",
                },
                maxfilesize : 1000000
            });
        })(jQuery);

    </script>
@endsection
@endsection
