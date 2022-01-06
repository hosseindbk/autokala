@extends('Admin.admin')
@section('title')
    <title> مدیریت زیر منو داشبورد </title>
    <link href="{{asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min-rtl.css')}} " rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت زیر منو داشبورد</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت زیر منو داشبورد</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست زیر منوهای داشبورد</h6>
                                    <a href="{{url('admin/submenudashboards/create')}}" class="btn btn-primary btn-xs">افزودن زیر منو داشبورد</a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> عنوان صفحه </th>
                                            <th class="wd-10p"> نام صفحه </th>
                                            <th class="wd-10p"> آدرس صفحه </th>
                                            <th class="wd-10p"> لیبل صفحه </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> تغییر </th>
                                            <th class="wd-10p"> حذف </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($submenudashs as $submenudashboard)
                                            <tr class="odd gradeX">

                                                <td>{{$submenudashboard->id}}</td>

                                                <td>{{$submenudashboard->title}}</td>

                                                <td>{{$submenudashboard->name}}</td>

                                                <td>
                                                    <a href="{{url($submenudashboard->slug)}}">{{$submenudashboard->slug}}</a>
                                                </td>

                                                <td>{{$submenudashboard->namayesh}}</td>

                                                <td>
                                                    @if($submenudashboard->status == 0)
                                                        <button class="btn ripple btn-outline-danger">عدم نمایش</button>
                                                    @elseif($submenudashboard->status == 1)
                                                        <button class="btn ripple btn-outline-success">درحال نمایش</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-icon-list">
                                                        <a href="{{ route('submenudashboards.edit' , $submenudashboard->id ) }}" class="btn ripple btn-outline-info btn-icon">
                                                            <i class="fe fe-edit-2"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('submenudashboards.destroy' , $submenudashboard->id) }}" method="post">
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
    <script src="{{asset('admin/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/table-data.js')}}"></script>
@endsection
@endsection
