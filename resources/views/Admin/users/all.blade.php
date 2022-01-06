@extends('Admin.admin')
@section('title')
    <title> مدیریت کاربران داشبورد </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کاربران داشبورد</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت کاربران داشبورد</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست کاربران داشبورد</h6>
                                    <a href="{{url('admin/users/create')}}" class="btn btn-primary btn-xs">افزودن کاربران داشبورد</a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> نام و نام خانوادگی </th>
                                            <th class="wd-10p"> نام کاربری </th>
                                            <th class="wd-10p"> آدرس ایمیل </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> تغییر </th>
                                            <th class="wd-10p"> حذف </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr class="odd gradeX">

                                                <td>{{$user->id}}</td>

                                                <td>{{$user->name}}</td>
                                                <td>{{$user->username}}</td>
                                                <td>{{$user->email}}</td>

                                                <td>
                                                    @if($user->status == 0)
                                                        <button class="btn ripple btn-outline-danger">عدم نمایش</button>
                                                    @elseif($user->status == 1)
                                                        <button class="btn ripple btn-outline-success">درحال نمایش</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-icon-list">
                                                        <a href="{{ route('users.edit' , $user->id ) }}" class="btn ripple btn-outline-info btn-icon">
                                                            <i class="fe fe-edit-2"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <form action="{{ route('users.destroy' , $user->id) }}" method="post">
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
