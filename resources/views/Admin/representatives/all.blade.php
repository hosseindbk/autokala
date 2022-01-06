@extends('Admin.admin')
@section('title')
    <title> داشبورد مدیریتی </title>
    <link href="{{asset('assets/plugins/datatable/dataTables.bootstrap4.min-rtl.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('main')
    @include('sweet::alert')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت نمایندگی</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت نمایندگی</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست نمایندگی ها</h6>
                                    <a href="{{url('admin/representatives/create')}}" class="btn btn-primary btn-xs float-left">افزودن نمایندگی جدید</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> تامین کننده </th>
                                            <th class="wd-10p"> برند </th>
                                            <th class="wd-10p"> تاریخ انقضا </th>
                                            <th class="wd-10p"> توضیحات </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> تغییر </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($representatives as $Representative)
                                            <tr class="odd gradeX">

                                                <td>{{$s++}}</td>

                                                  @foreach($suppliers as $Supplier)
                                                      @if($Supplier->id == $Representative->supplier_id)
                                                          <td>{{$Supplier->title}}</td>
                                                      @endif
                                                  @endforeach

                                                  @foreach($brands as $Brand)
                                                      @if($Brand->id == $Representative->brand_id)
                                                          <td>{{$Brand->title_fa}}</td>
                                                      @endif
                                                  @endforeach
                                                     <td>{{$Representative->exp_date}}</td>
                                                     <td>{{$Representative->description}}</td>
                                                <td>
                                                    @foreach($statuses as $status)
                                                        @if($status->id == $Representative->status)
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
                                                    <a href="{{ route('representatives.edit' , $product->unicode ) }}"  class="btn btn-primary btn-xs">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('representatives.destroy' , $product->unicode) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="btn-group btn-group-xs">
                                                            <button type="submit" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash-o "></i>
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
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/jszip.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/table-data.js')}}"></script>
@endsection
@endsection
