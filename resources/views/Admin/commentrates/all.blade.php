@extends('Admin.admin')
@section('title')
    <title> مدیریت نظرات </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت نظرات</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت  نظرات</li>
                        </ol>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-20p">ردیف</th>
                                            <th class="wd-lg-20p">شماره موبایل</th>
                                            <th class="wd-lg-20p">نام و نام خانوادگی</th>
                                            <th class="wd-lg-20p">متن پیام کاربر</th>
                                            <th class="wd-lg-20p">کیفیت</th>
                                            <th class="wd-lg-20p">ارزش</th>
                                            <th class="wd-lg-20p">نو آوری</th>
                                            <th class="wd-lg-20p">قابلیت ها</th>
                                            <th class="wd-lg-20p">طراحی</th>
                                            <th class="wd-lg-20p">دردسترس بودن</th>
                                            <th class="wd-lg-20p">صفحه پیام</th>
                                            <th class="wd-lg-20p">شماره سریال</th>
                                            <th class="wd-lg-20p">وضعیت</th>
                                            <th class="wd-lg-20p">ویرایش پیام</th>
                                            <th class="wd-lg-20p">حذف پیام</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1 ?>
                                        @foreach($commentrates as $commentrate)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td class="text-primary"> {{$commentrate->phone}}</td>
                                                <td class="text-primary"> {{$commentrate->name}}</td>
                                                <td class="text-primary" style="max-width: 300px;overflow: auto;">{{$commentrate->comment}}</td>
                                                <td class="text-nowrap">{{$commentrate->quality}}</td>
                                                <td class="text-nowrap">{{$commentrate->value}}</td>
                                                <td class="text-nowrap">{{$commentrate->innovation}}</td>
                                                <td class="text-nowrap">{{$commentrate->ability}}</td>
                                                <td class="text-nowrap">{{$commentrate->design}}</td>
                                                <td class="text-nowrap">{{$commentrate->comfort}}</td>
                                                <td class="text-nowrap">
                                                    @if($comment->commentable_type == 'App\Supplier')
                                                        تامین کنندگان
                                                    @elseif($comment->commentable_type == 'App\Technical_unit')
                                                        تعمیرگاه ها
                                                    @elseif($comment->commentable_type == 'App\Product_brand_variety')
                                                        برند تنوع
                                                    @elseif($comment->commentable_type == 'App\Product')
                                                        کالا یا قطعات
                                                    @endif
                                                </td>
                                                <td class="text-nowrap">{{$comment->commentable_id}}</td>
                                                <td>
                                                    @if($commentrate->approved == 0)
                                                        <button class="btn ripple btn-outline-warning">عدم نمایش پیام</button>
                                                    @elseif($commentrate->approved == 1)
                                                        <button class="btn ripple btn-outline-success"> نمایش پیام</button>
                                                    @endif

                                                </td>
                                                <td  class="text-nowrap">
                                                    <a href="{{ route('commentrates.edit' , $commentrate->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('commentrates.destroy' , $commentrate->id) }}" method="post">
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
    <script src="{{asset('admin/assets/js/table-data.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
@endsection
@endsection
