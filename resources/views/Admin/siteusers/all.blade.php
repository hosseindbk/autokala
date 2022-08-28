@extends('Admin.admin')
@section('title')
    <title> مدیریت کاربران وبسایت </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                                            width: 100% !important;
                                            clear: both;
                                            border-collapse: collapse;
                                            table-layout: fixed;
                                            word-wrap:break-word;
                                        }
                                        td{
                                            overflow-x:auto;
                                        }
                                    </style>
                                    <table id="sample1" class="table table-striped table-bordered yajra-datatable">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> نام و نام خانوادگی </th>
                                            <th class="wd-10p"> شماره موبایل </th>
                                            <th class="wd-10p"> تاریخ ایجاد حساب </th>
                                            <th class="wd-10p"> نوع همکاری </th>
                                            <th class="wd-10p"> وضعیت شماره </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> استان </th>
                                            <th class="wd-10p"> شهرستان </th>
                                            <th class="wd-10p">ویرایش / حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('siteusers.index') }}",
                columns: [
                    {data: 'userid'             , name: 'userid'},
                    {data: 'username'           , name: 'username'},
                    {data: 'userphone'          , name: 'userphone'},
                    {data: 'usercreated'        , name: 'usercreated'},
                    {data: 'typetitle'          , name: 'typetitle'},
                    {data: 'userphoneverify'    , name: 'userphoneverify'},
                    {data: 'userstatus'         , name: 'userstatus'},
                    {data: 'cityname'           , name: 'cityname'},
                    {data: 'statename'          , name: 'statename'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>
@endsection

