@extends('Admin.admin')
@section('title')
    <title> مدیریت کالا </title>
    <link href="{{asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min-rtl.css')}} " rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />

@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کالا</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت کالا</li>
                        </ol>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست کالا ها</h6>
                                    <a href="{{url('admin/products/create')}}" class="btn btn-primary btn-xs">افزودن کالا جدید</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> سریال </th>
                                            <th class="wd-10p"> تصویر </th>
                                            <th class="wd-10p"> گروه کالا </th>
                                            <th class="wd-10p"> مشخصات کالا </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> برند-تنوع </th>
                                            <th class="wd-10p"> تغییر </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>
                                                <img src="{{asset($product->image)}}" class="img-responsive lazy" style="display: block" width="30" alt="">
                                            </td>
                                            <td>
                                                @foreach($productgroups as $product_group)
                                                    @if($product_group->id == $product->kala_group_id)
                                                        {{$product_group->title_fa}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                {{$product->title_fa}} با یونیکد <button type="button" class="btn ripple btn-light">{{$product->unicode}}</button>  و کد فنی   {{$product->code_fani_company}}
                                            </td>
                                            <td>
                                                @if($product->status == 1)
                                                    <button class="btn ripple btn-outline-warning">پیش نویس</button>
                                                @elseif($product->status == 2)
                                                    <button class="btn ripple btn-outline-primary">درحال بررسی</button>
                                                @elseif($product->status == 3)
                                                    <button class="btn ripple btn-outline-info">تایید مدیر</button>
                                                @elseif($product->status == 4)
                                                    <button class="btn ripple btn-outline-success">درحال نمایش</button>
                                                @elseif($product->status == 5)
                                                    <button class="btn ripple btn-outline-light">معلق شده</button>
                                                @elseif($product->status == 6)
                                                    <button class="btn ripple btn-outline-danger">حذف شده</button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-icon-list">
                                                    <a href="{{ route('product-brand-variety' , $product->id ) }}" class="btn ripple btn-outline-info btn-icon">
                                                        <i class="fe fe-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-icon-list">
                                                    <a href="{{ route('products.edit' , $product->id ) }}" class="btn ripple btn-outline-info btn-icon">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <form action="{{ route('products.destroy' , $product->id) }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="btn-icon-list">
                                                        <button type="submit" class="btn ripple btn-outline-danger btn-icon">
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
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/table-data.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>

@endsection
@endsection
