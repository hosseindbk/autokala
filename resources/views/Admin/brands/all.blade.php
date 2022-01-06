@extends('Admin.admin')
@section('title')
    <title> مدیریت برند قطعات </title>
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
                    <h2 class="main-content-title tx-24 mg-b-5">مدیریت برند قطعات</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                        <li class="breadcrumb-item active" aria-current="page">مدیریت برند قطعات</li>
                    </ol>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">لیست برند قطعات</h6>
                                <a href="{{url('admin/brands/create')}}" class="btn btn-primary btn-xs float-left">افزودن برند قطعات جدید</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="example1">
                                    <thead>
                                    <tr>
                                        <th class="wd-2p"> ردیف </th>
                                        <th class="wd-10p"> تصویر برند قطعه </th>
                                        <th class="wd-10p"> نام قطعه فارسی </th>
                                        <th class="wd-10p"> نام قطعه انگلیسی </th>
                                        <th class="wd-10p"> نام اختصار </th>
                                        <th class="wd-10p"> شماره تماس </th>
                                        <th class="wd-10p"> کشور سازنده </th>
                                        <th class="wd-10p"> آدرس ایمیل </th>
                                        <th class="wd-10p"> نمایش صفحه اصلی </th>
                                        <th class="wd-10p"> آدرس </th>
                                        <th class="wd-5p"> وضعیت </th>
                                        <th class="wd-5p"> تغییر </th>
                                        <th class="wd-5p"> حذف </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $s = 1; ?>
                                    @foreach($brands as $brand)
                                        <tr>
                                            <td>{{$s++}}</td>
                                            <td>
                                                <img src="{{asset($brand->image)}}" class="img-responsive" style="display: block" width="30" alt="">
                                            </td>
                                            <td>{{$brand->title_fa}}</td>
                                            <td>{{$brand->title_en}}</td>
                                            <td>{{$brand->abstract_title}}</td>
                                            <td>
                                                {{$brand->phone}}

                                                {{$brand->mobile}}

                                                {{$brand->whatsapp}}
                                            <td>
                                            @foreach($countries as $country)
                                                @if($country->id == $brand->country_id)
                                                    {{$country->name}}
                                                @endif
                                            @endforeach
                                            </td>
                                            <td>{{$brand->email}}</td>
                                            <td style="text-align: center;">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="homeshow" class="custom-switch-input" id="{{$brand->id}}" {{$brand->homeshow == 1 ? 'checked' : ''}}>
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                            <td>{{$brand->address}}</td>
                                            <td>
                                                @foreach($statuses as $status)
                                                    @if($status->id == $brand->status)
                                                        @if($status->id == 1)
                                                            <button class="btn ripple btn-outline-warning">{{$status->title}}</button>
                                                        @elseif($status->id == 2)
                                                            <button class="btn ripple btn-outline-primary">{{$status->title}}</button>
                                                        @elseif($status->id == 3)
                                                            <button class="btn ripple btn-outline-info">{{$status->title}}</button>
                                                        @elseif($status->id == 4)
                                                            <button class="btn ripple btn-outline-success">{{$status->title}}</button>
                                                        @elseif($status->id == 5)
                                                            <button class="btn ripple btn-outline-light">{{$status->title}}</button>
                                                        @elseif($status->id == 6)
                                                            <button class="btn ripple btn-outline-danger">{{$status->title}}</button>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('brands.edit' , $brand->id) }}"  class="btn btn-outline-primary btn-xs">
                                                    <i class="fe fe-edit-2"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('brands.destroy' , $brand->id) }}" method="post">
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
<script>
    $('input:checkbox').change(function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url : '{{ route( 'brandhomeshow' ) }}',
            data: {"_token": "{{ csrf_token() }}", id:id }
        });
    });
</script>
@endsection
@endsection
