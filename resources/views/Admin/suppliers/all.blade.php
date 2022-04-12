@extends('Admin.admin')
@section('title')
    <title> مدیریت تامین کننده </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection
@section('main')

    @include('sweet::alert')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت تامین کننده</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت تامین کننده</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست کالا ها</h6>
                                    <a href="{{url('admin/suppliers/create')}}" class="btn btn-primary btn-xs float-left">افزودن تامین کننده جدید</a>
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
                                            <th class="wd-5p"> سریال </th>
                                            <th class="wd-10p"> تصویر </th>
                                            <th class="wd-10p"> نام تامین کننده </th>
                                            <th class="wd-10p"> مدیریت </th>
                                            <th class="wd-10p"> نوع </th>
                                            <th class="wd-20p"> شمارهای تماس </th>
                                            <th class="wd-5p"> استان </th>
                                            <th class="wd-5p"> شهرستان </th>
                                            <th class="wd-5p"> نمایش صفحه اصلی </th>
                                            <th class="wd-5p"> ثبت آدرس </th>
                                            <th class="wd-10p"> وضعیت </th>
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
@section('end')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('suppliers.index') }}",
                columns: [
                    {data: 'sid'       , name: 'sid'},
                    {data: 'image'     , name: 'image'},
                    {data: 'stitle'    , name: 'stitle'},
                    {data: 'manager'   , name: 'manager'},
                    {data: 'noe'        , name: 'noe'},
                    {data: 'phone'     , name: 'phone'},
                    {data: 'statetitle'    , name: 'statetitle'},
                    {data: 'ctitle'    , name: 'ctitle'},
                    {data: 'homeshow'  , name: 'homeshow'},
                    {data: 'location'  , name: 'location'},
                    {data: 'status'   , name: 'status'},

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
    <script>
        $('input:checkbox').change(function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url : '{{ route( 'supplierhomeshow' ) }}',
                data: {"_token": "{{ csrf_token() }}", id:id }
            });
        });
    </script>
@endsection
@endsection


