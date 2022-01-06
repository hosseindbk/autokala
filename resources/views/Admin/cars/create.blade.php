@extends('Admin.admin')
@section('title')
    <title> ایجاد خودرو </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت خودرو</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/carmodels')}}"> مدیریت خودرو</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ایجاد خودرو</li>
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
                                    <h3 class="text-center mb-5"><span class="badge badge-light">ورود اطلاعات برند خودرو</span></h3>
                                </div>

                                <form action="{{ route('storecarbrand')}}" method="POST" enctype="multipart/form-data">
                                    <div class="row row-sm">
                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                            @include('error')
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10"> برند خودرو فارسی</p>
                                                <input type="text" name="title_fa" data-required="1" placeholder="نام برند فارسی را وارد کنید" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                                <p class="mg-b-10"> برند خودرو انگلیسی</p>
                                                <input type="text" name="title_en" data-required="1" placeholder="نام برند انگلیسی را وارد کنید" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mg-b-10 text-center">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-toggle="collapse" href="#carbrand" role="button">جدول اطلاعات خودرو </a>
                                <div class="collapse mg-t-5" id="carbrand">
                                    <div class="table-responsive">
                                        <table class="table" id="example1">
                                            <thead>
                                            <tr>
                                                <th class="wd-10p"> ردیف </th>
                                                <th class="wd-10p"> برند خودرو فارسی </th>
                                                <th class="wd-10p"> برند خودرو انگلیسی </th>
                                                <th class="wd-10p"> وضعیت </th>
                                                <th class="wd-10p"> تغییر </th>
                                                <th class="wd-10p"> حذف </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $s = 1; ?>
                                            @foreach($carbrands as $Car_brand)
                                                <tr class="odd gradeX">
                                                    <td>{{$s++}}</td>
                                                    <td>{{$Car_brand->title_fa}}</td>
                                                    <td>{{$Car_brand->title_en}}</td>
                                                    <td>
                                                        @foreach($statuses as $status)
                                                            @if($status->id == $Car_brand->status)
                                                                @if($status->id == 1)
                                                                    <button class="btn ripple btn-outline-warning">{{$status->title}}</button>
                                                                @elseif($status->id == 2)
                                                                    <button class="btn ripple btn-outline-primary">{{$status->title}}</button>
                                                                @elseif($status->id == 3)
                                                                    <button class="btn ripple btn-outline-info">{{$status->title}}</button>
                                                                @elseif($status->id == 4)
                                                                    <button class="btn ripple btn-outline-success">{{$status->title}}</button>
                                                                @elseif($status->id == 5)
                                                                    <button class="btn ripple btn-outline-light">{{$status->title}}</button>
                                                                @elseif($status->id == 6)
                                                                    <button class="btn ripple btn-outline-danger">{{$status->title}}</button>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('carbrands.edit' , $Car_brand->id) }}"  class="btn btn-outline-primary btn-xs">
                                                            <i class="fe fe-edit-2"></i>                                                    </a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('destroycarbrand' , $Car_brand->id) }}" method="post">
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
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h3 class="text-center mb-5"><span class="badge badge-light">ورود اطلاعات مدل خودرو</span></h3>
                                </div>
                                <form action="{{ route('storecarmodel')}}" method="POST">
                                    <div class="row row-sm">
                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                            @include('error')
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب برند خودرو</p>
                                                <select name="vehicle_brand_id" class="form-control select-lg select2">
                                                    <option value="">انتخاب برند خودرو</option>
                                                    @foreach($carbrands as $Car_brand)
                                                        <option value="{{$Car_brand->id}}">{{$Car_brand->title_fa}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">مدل خودرو فارسی</p>
                                                <input type="text" name="title_fa" data-required="1" placeholder="مدل خودرو فارسی را وارد کنید" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">مدل خودرو انگلیسی</p>
                                                <input type="text" name="title_en" data-required="1" placeholder="مدل خودرو انگلیسی را وارد کنید" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mg-b-10 text-center">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-toggle="collapse" href="#carmodel" role="button">جدول اطلاعات مدل های خودرو </a>
                                <div class="collapse mg-t-5" id="carmodel">
                                    <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> نام خودرو فارسی </th>
                                            <th class="wd-10p"> مدل خودرو انگلیسی</th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> ویرایش </th>
                                            <th class="wd-10p"> حذف </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($carmodels as $Car_model)
                                            <tr class="odd gradeX">
                                                <td>{{$s++}}</td>

                                                <td>{{$Car_model->title_fa}}</td>

                                                <td>{{$Car_model->title_en}}</td>

                                                <td>
                                                    @foreach($statuses as $status)
                                                        @if($status->id == $Car_model->status)
                                                            @if($status->id == 1)
                                                                <button class="btn ripple btn-outline-warning">{{$status->title}}</button>
                                                            @elseif($status->id == 2)
                                                                <button class="btn ripple btn-outline-primary">{{$status->title}}</button>
                                                            @elseif($status->id == 3)
                                                                <button class="btn ripple btn-outline-info">{{$status->title}}</button>
                                                            @elseif($status->id == 4)
                                                                <button class="btn ripple btn-outline-success">{{$status->title}}</button>
                                                            @elseif($status->id == 5)
                                                                <button class="btn ripple btn-outline-light">{{$status->title}}</button>
                                                            @elseif($status->id == 6)
                                                                <button class="btn ripple btn-outline-danger">{{$status->title}}</button>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('carmodels.edit' , $Car_model->id) }}"  class="btn btn-outline-info btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('destroycarmodel'  , $Car_model->id) }}" method="post">
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
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h3 class="text-center mb-5"><span class="badge badge-light">ورود اطلاعات تیپ و تریم</span></h3>
                                </div>
                                <form action="{{ route('storecartype')}}" method="POST" >
                                    <div class="row row-sm">
                                        {{csrf_field()}}
                                        <div class="col-md-12">
                                            @include('error')
                                        </div>
                                        <div class="col-md-3">
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب مدل خودرو</p>
                                                <select name="car_model_id" id="car_model_id" class="form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">نام  تیپ و تریم فارسی</p>
                                                <input type="text" name="title_fa" data-required="1" placeholder="نام  تیپ و تریم فارسی را وارد کنید" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <p class="mg-b-10">نام  تیپ و تریم انگلیسی</p>
                                                <input type="text" name="title_en" data-required="1" placeholder="نام  تیپ و تریم انگلیسی را وارد کنید" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mg-b-10 text-center">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <a aria-controls="collapseExample" aria-expanded="false" class="btn ripple btn-primary" data-toggle="collapse" href="#cartype" role="button">جدول اطلاعات تیپ و تریم </a>
                                <div class="collapse mg-t-5" id="cartype">
                                    <div class="table-responsive">
                                        <table class="table" id="example1">
                                            <thead>
                                            <tr>
                                                <th class="wd-10p"> ردیف </th>
                                                <th class="wd-10p">  تیپ وتریم فارسی </th>
                                                <th class="wd-10p"> تیپ وتریم انگلیسی </th>
                                                <th class="wd-10p"> وضعیت </th>
                                                <th class="wd-10p"> ویرایش </th>
                                                <th class="wd-10p"> حذف </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $s = 1; ?>
                                            @foreach($cartypes as $Car_type)
                                                <tr class="odd gradeX">
                                                    <td>{{$s++}}</td>
                                                    <td>{{$Car_type->title_fa}}</td>
                                                    <td>{{$Car_type->title_en}}</td>
                                                    <td>
                                                        @foreach($statuses as $status)
                                                            @if($status->id == $Car_type->status)
                                                                @if($status->id == 1)
                                                                    <button class="btn ripple btn-outline-warning">{{$status->title}}</button>
                                                                @elseif($status->id == 2)
                                                                    <button class="btn ripple btn-outline-primary">{{$status->title}}</button>
                                                                @elseif($status->id == 3)
                                                                    <button class="btn ripple btn-outline-info">{{$status->title}}</button>
                                                                @elseif($status->id == 4)
                                                                    <button class="btn ripple btn-outline-success">{{$status->title}}</button>
                                                                @elseif($status->id == 5)
                                                                    <button class="btn ripple btn-outline-light">{{$status->title}}</button>
                                                                @elseif($status->id == 6)
                                                                    <button class="btn ripple btn-outline-danger">{{$status->title}}</button>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('cartypes.edit' , $Car_type->id) }}"  class="btn btn-outline-primary btn-xs">
                                                            <i class="fe fe-edit-2"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('destroycartype' , $Car_type->id) }}" method="post">
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
@endsection
@endsection

