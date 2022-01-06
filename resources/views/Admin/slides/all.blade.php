@extends('Admin.admin')
@section('title')
    <title> مدیریت اسلایدها </title>
    <link href="{{asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min-rtl.css')}} " rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
@endsection
@section('main')

    @include('sweet::alert')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت اسلایدها</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت اسلایدها</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست اسلایدها</h6>
                                    <a href="{{url('admin/slides/create')}}" class="btn btn-primary btn-xs float-left">افزودن اسلاید جدید</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> سریال </th>
                                            <th class="wd-10p"> تصویر </th>
                                            <th class="wd-10p"> موقعیت </th>
                                            <th class="wd-10p"> نام </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> ویرایش </th>
                                            <th class="wd-10p"> حذف </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($slides as $slide)
                                            <tr class="odd gradeX">
                                                <td>{{$slide->id}}</td>
                                                <td>
                                                    <img src="{{asset($slide->image)}}" class="img-responsive" style="display: block" width="30" alt="">
                                                </td>
                                                <td>
                                                    @if($slide->position == 1)
                                                        اسلاید اصلی
                                                    @elseif($slide->position == 2)
                                                        اسلاید چپ بالا
                                                    @elseif($slide->position == 3)
                                                        اسلاید چپ پایین
                                                    @endif
                                                </td>
                                                <td>{{$slide->title}} </td>

                                                <td>
                                                    @if($slide->status == 0)
                                                        <button class="btn ripple btn-outline-danger">عدم نمایش</button>
                                                    @elseif($slide->status == 1)
                                                        <button class="btn ripple btn-outline-success">در حال نمایش</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('slides.edit' , $slide->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('slides.destroy'  , $slide->id) }}" method="post">
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
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
@endsection
@endsection
