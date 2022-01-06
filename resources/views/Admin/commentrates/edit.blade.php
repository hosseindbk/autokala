@extends('Admin.admin')
@section('title')
    <title> ویرایش نظر </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">ویرایش نظر</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/commentrates')}}">مدیریت  نظر</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش نظر</li>
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
                                            <h3 class="text-center mb-5"><span class="badge badge-light"> ویرایش نظر </span></h3>
                                        </div>
                                            @foreach($commentrates as $commentrate)
                                            <form action="{{route('commentrates.update', $commentrate->id)}}" method="POST" enctype="multipart/form-data">
                                                <div class="row row-sm">
                                                    {{csrf_field()}}
                                                    {{ method_field('PATCH') }}
                                                    <div class="col-md-12">
                                                        @include('error')
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">انتخاب وضعیت نمایش</p>
                                                            <select name="approved" class="form-control select-lg select2">
                                                                    <option value="0" @foreach($commentrates as $commentrate) {{$commentrate->approved == 0 ? 'selected' : ''}} @endforeach>عدم نمایش پیام</option>
                                                                    <option value="1"  @foreach($commentrates as $commentrate) {{$commentrate->approved == 1 ? 'selected' : ''}} @endforeach>نمایش پیام</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <p class="mg-b-10">متن پیام</p>
                                                            <textarea name="comment" id="" cols="30" data-required="1" rows="5" class="form-control" >{{$commentrate->comment}}</textarea>
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

@endsection
@endsection
