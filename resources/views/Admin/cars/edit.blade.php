@extends('Admin.admin')
@section('title')
    <title> ویرایش خودرو </title>
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <li class="breadcrumb-item"><a href="{{url('admin/cars')}}"> مدیریت  خودرو</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش خودرو</li>
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
                                    <h6 class="main-content-label text-center mb-5">ویرایش اطلاعات خودرو</h6>
                                </div>
                                @foreach($carmodels as $Car_model)
                                    <form action="{{route('caredit', $Car_model->id)}}" method="POST">
                                        <div class="row row-sm">
                                            {{csrf_field()}}
                                            {{ method_field('PATCH') }}

                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10"> مدل خودرو فارسی</p>
                                                    <input type="text" name="title_fa" data-required="1" value="{{$Car_model->title_fa}}"  class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10"> مدل خودرو لاتین</p>
                                                    <input type="text" name="title_en" data-required="1" value="{{$Car_model->title_en}}"  class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب برند خودرو</p>
                                                    <select name="vehicle_brand_id" class="form-control select2">
                                                        @foreach($carbrands as $Car_brand)
                                                            <option value="{{$Car_brand->id}}" {{$Car_brand->id == $Car_model->vehicle_brand_id ? 'selected' : ''}}>{{$Car_brand->title_fa}}</option>
                                                        @endforeach
                                                    </select>
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


@section('end')
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
@endsection
@endsection
