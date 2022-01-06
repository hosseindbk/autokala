@extends('Admin.admin')
@section('title')
    <title> داشبورد مدیریتی </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کالا خودرو</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت کالا خودرو</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست کالا خودروها</h6>
                                    <a href="{{url('admin/carproducts/create')}}" class="btn btn-primary btn-xs float-left">افزودن کالا خودرو جدید</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> نام کالا </th>
                                            <th class="wd-10p"> نام خودرو </th>
                                            <th class="wd-10p"> مدل خودرو </th>
                                            <th class="wd-10p"> تیپ خودرو </th>
                                            <th class="wd-10p"> توضیحات </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> تغییر </th>
                                            <th class="wd-10p"> حذف </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($carproducts as $Car_product)
                                            <tr class="odd gradeX">

                                                <td>{{$s++}}</td>

                                                @foreach($products as $product)
                                                    @if($Car_product->product_id == $product->id)
                                                        <td>  {{$product->title_fa}}  </td>
                                                    @endif
                                                @endforeach

                                                @foreach($cartypes as $Car_type)
                                                    @if($Car_product->car_type_id == $Car_type->id)
                                                        @foreach($carmodels as $Car_model)
                                                             @if($Car_type->car_model_id == $Car_model->id)
                                                                @foreach($carbrands as $Car_brand)
                                                                    @if($Car_brand->id == $Car_model->vehicle_brand_id)
                                                                        <td>  {{$Car_brand->title_fa}}  </td>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach

                                                @foreach($cartypes as $Car_type)
                                                    @if($Car_product->car_type_id == $Car_type->id)
                                                        @foreach($carmodels as $Car_model)
                                                             @if($Car_type->car_model_id == $Car_model->id)
                                                                    <td>  {{$Car_model->title_fa}}  </td>
                                                             @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach

                                                @foreach($cartypes as $Car_type)
                                                    @if($Car_product->car_type_id == $Car_type->id)
                                                        <td>  {{$Car_type->title_fa}}  </td>
                                                    @endif
                                                @endforeach

                                                <td class="left">{{$Car_product->description}}</td>

                                                <td>
                                                    @foreach($statuses as $status)
                                                        @if($status->id == $Car_product->status)
                                                            @if($status->id == 1)
                                                                <button class="btn ripple btn-warning">{{$status->title}}</button>
                                                            @elseif($status->id == 2)
                                                                <button class="btn ripple btn-primary">{{$status->title}}</button>
                                                            @elseif($status->id == 3)
                                                                <button class="btn ripple btn-info">{{$status->title}}</button>
                                                            @elseif($status->id == 4)
                                                                <button class="btn ripple btn-success">{{$status->title}}</button>
                                                            @elseif($status->id == 5)
                                                                <button class="btn ripple btn-light">{{$status->title}}</button>
                                                            @elseif($status->id == 6)
                                                                <button class="btn ripple btn-danger">{{$status->title}}</button>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('carproducts.edit' , $Car_product->id ) }}"  class="btn btn-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
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
                <!-- End Row -->
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
