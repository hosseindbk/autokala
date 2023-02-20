@extends('Admin.admin')
@section('title')
    <title> مدیریت کالا برند تنوع </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کالا برند تنوع</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت کالا برند تنوع</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست کالا برند تنوع</h6>
                                    <a href="{{url('admin/productbrandvarieties/create')}}" class="btn btn-primary btn-xs float-left">افزودن کالا برند تنوع</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> تصویر </th>
                                            <th class="wd-10p"> نام برند قطعه </th>
                                            <th class="wd-10p"> نام کالا </th>
                                            <th class="wd-10p"> یونیکد کالا </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> تغییر </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($productbrandvarieties as $Product_brand_variety)
                                            <tr class="odd gradeX">
                                                <td>{{$s++}}</td>
                                                <td>
                                                    @if($Product_brand_variety->image1)
                                                        <img src="{{asset($Product_brand_variety->image1)}}" width="70px" height="50px" alt="">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$Product_brand_variety->brand_title}}
                                                </td>
                                                <td>
                                                    {{$Product_brand_variety->product_title}}
                                                </td>

                                                <td>
                                                    <span class="btn btn-light">{{$Product_brand_variety->unicode}}</span>
                                                </td>

                                                <td>
                                                    <button class="btn ripple btn-outline-warning">{{$Product_brand_variety->status_title}}</button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('productbrandvarieties.edit' , $Product_brand_variety->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('productbrandvarieties.destroy' , $Product_brand_variety->id) }}" method="post">
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
@endsection
@section('end')
    <script src="{{asset('admin/assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
{{--    <script src="{{asset('admin/assets/plugins/datatable/fileexport/dataTables.buttons.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.html5.min.js')}}"></script>--}}
{{--    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.colVis.min.js')}}"></script>--}}
    <script src="{{asset('admin/assets/js/table-data.js')}}"></script>
@endsection
