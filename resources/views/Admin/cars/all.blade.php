@extends('Admin.admin')
@section('title')
    <title> مدیریت خودرو </title>
    <link href="{{asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min-rtl.css')}} " rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('main')
    @include('sweet::alert')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت خودرو</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت خودرو</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست خودرو ها</h6>
                                    <a href="{{url('admin/cars/create')}}" class="btn btn-primary btn-xs float-left">افزودن خودرو جدید</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> نام خودرو </th>
                                            <th class="wd-10p"> مدل خودرو </th>
                                            <th class="wd-10p"> تیپ و تریم خودرو </th>
                                            <th class="wd-10p"> تغییرات </th>
                                            <th class="wd-10p"> حذف </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                            @foreach($carmodels as $Car_model)
                                                <tr class="odd gradeX">
                                                    <td>{{$s++}}</td>

                                                    <td>
                                                        @foreach($carbrands as $Car_brand)
                                                            @if($Car_brand->id == $Car_model->vehicle_brand_id)
                                                                {{$Car_brand->title_fa}}
                                                            @endif
                                                        @endforeach
                                                    </td>

                                                    <td>{{$Car_model->title_fa}}</td>

                                                    <td>
                                                        @foreach($cartypes as $Car_type)
                                                            @if($Car_type->car_model_id == $Car_model->id)
                                                                {{$Car_type->title_fa}}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('cars.edit' , $Car_model->id) }}"  class="btn btn-outline-primary btn-xs">
                                                            <i class="fe fe-edit-2"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('cars.destroy'  , $Car_model->id) }}" method="post">
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
@section('end')
    <script src="{{asset('admin/assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/table-data.js')}}"></script>
@endsection
@endsection
