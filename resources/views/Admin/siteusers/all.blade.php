@extends('Admin.admin')
@section('title')
    <title> مدیریت کاربران وبسایت </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت کاربران وبسایت</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت کاربران وبسایت</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست کاربران وبسایت</h6>
                                    <a href="{{url('admin/users/create')}}" class="btn btn-primary btn-xs">افزودن کاربران وبسایت</a>
                                </div>

                                <div class="table-responsive">
                                    <style>
                                        table{
                                            margin: 0 auto;
                                            width: 100%;
                                            clear: both;
                                            border-collapse: collapse;
                                            table-layout: fixed;
                                            word-wrap:break-word;
                                        }
                                        .search-title{
                                            width:-webkit-fill-available;
                                        }
                                    </style>
                                    <table id="sample1" class="table table-striped table-bordered data-table">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> نام و نام خانوادگی </th>
                                            <th class="wd-10p"> شماره موبایل </th>
                                            <th class="wd-10p"> تاریخ ایجاد حساب </th>
                                            <th class="wd-10p"> نوع همکاری </th>
                                            <th class="wd-10p"> وضعیت شماره </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> ویرایش </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>

                                </div>

{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table" id="example1">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th class="wd-10p"> ردیف </th>--}}
{{--                                            <th class="wd-10p"> نام و نام خانوادگی </th>--}}
{{--                                            <th class="wd-10p"> شماره موبایل </th>--}}
{{--                                            <th class="wd-10p"> تاریخ ایجاد حساب </th>--}}
{{--                                            <th class="wd-10p"> نوع همکاری </th>--}}
{{--                                            <th class="wd-10p"> وضعیت شماره </th>--}}
{{--                                            <th class="wd-10p"> وضعیت </th>--}}
{{--                                            <th class="wd-10p"> ویرایش </th>--}}
{{--                                            <th class="wd-10p"> حذف </th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        <?php $s = 1; ?>--}}
{{--                                        @foreach($users as $user)--}}
{{--                                            <tr class="odd gradeX">--}}

{{--                                                <td>{{$s++}}</td>--}}

{{--                                                <td>{{$user->name}}</td>--}}
{{--                                                <td>{{$user->phone}}</td>--}}
{{--                                                <td>{{jdate($user->created_at)->format('%Y/%m/%d')}}</td>--}}
{{--                                                <td>--}}
{{--                                                    @foreach($typeusers as $type_user)--}}
{{--                                                        @if($type_user->id == $user->type_id)--}}
{{--                                                            {{$type_user->title}}--}}
{{--                                                        @endif--}}
{{--                                                    @endforeach--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    @if($user->phone_verify == 0)--}}
{{--                                                        <button class="btn ripple btn-outline-info">تایید نشده</button>--}}
{{--                                                    @elseif($user->phone_verify == 1)--}}
{{--                                                        <button class="btn ripple btn-outline-success">تایید شده</button>--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    @if($user->status == 1)--}}
{{--                                                        <button class="btn ripple btn-outline-info">ثبت نام اولیه</button>--}}
{{--                                                    @elseif($user->status == 2)--}}
{{--                                                        <button class="btn ripple btn-outline-success">تایید مدیر</button>--}}
{{--                                                    @elseif($user->status == 0)--}}
{{--                                                        <button class="btn ripple btn-outline-warning">غیر فعال</button>--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="btn-icon-list">--}}
{{--                                                        <a href="{{ route('siteusers.edit' , $user->id ) }}" class="btn ripple btn-outline-info btn-icon">--}}
{{--                                                            <i class="fe fe-edit-2"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    <form action="{{ route('siteusers.destroy' , $user->id) }}" method="post">--}}
{{--                                                        {{ method_field('delete') }}--}}
{{--                                                        {{ csrf_field() }}--}}
{{--                                                        <div class="btn-icon-list">--}}
{{--                                                            <button type="submit" class="btn ripple btn-outline-danger btn-icon">--}}
{{--                                                                <i class="fe fe-trash-2 "></i>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </form>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
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
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatable/fileexport/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/table-data.js')}}"></script>
    <script>
        // Setup - add a text input to each footer cell
        $('#sample1 thead tr').clone(true).appendTo('#sample1 thead');
        $('#sample1 thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            $(this).html('<input class="search-title" type="text" placeholder="جستجو " />');

            $('input', this).on('change change', function () {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        $('#sample1').on('processing.dt', function (e, settings, processing) {
            if (processing) {
                $('.preloader').show();
            } else {
                $('.preloader').hide();
            }
        });
        var table = $('#sample1').DataTable({
            "order": [0, 'desc'],
            orderCellsTop: true,
            serverSide: true,
            scrollx: true,
            "scrollY": "555px",
            "scrollX": false,
            "paging": false,
            "ordering": false,
            "autoWidth": false,
            "fixedHeader": {
                "header": false,
                "footer": false
            },
            ajax: "{{ route('siteusers.index') }}",
            columns: [
                {data: 'userid'             , name: 'userid'},
                {data: 'username'           , name: 'username'},
                {data: 'userphone'          , name: 'userphone'},
                {data: 'typetitle'          , name: 'typetitle'},
                {data: 'usercreated'        , name: 'usercreated'},
                {data: 'userphoneverify'    , name: 'userphoneverify'},
                {data: 'userstatus'         , name: 'userstatus'},
            ],
            "columnDefs": [
                { "width": "10px", "targets": 0 },
                { "width": "70px", "targets": 1 },
                { "width": "70px", "targets": 2 },
                { "width": "70px", "targets": 3 },
                { "width": "70px", "targets": 4 },
                { "width": "50px", "targets": 5 },
                { "width": "70px", "targets": 6 },
                { "width": "70px", "targets": 7 },
                { "width": "70px", "targets": 8 },
            ]

        });


    </script>
@endsection

