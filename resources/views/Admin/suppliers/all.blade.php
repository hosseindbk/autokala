@extends('Admin.admin')
@section('title')
    <title> مدیریت تامین کننده </title>
    <link href="{{asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min-rtl.css')}} " rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> سریال </th>
                                            <th class="wd-10p"> تصویر </th>
                                            <th class="wd-10p"> مشخصات تامین کننده </th>
                                            <th class="wd-10p"> نوع </th>
                                            <th class="wd-10p"> شمارهای تماس </th>
                                            <th class="wd-10p"> استان </th>
                                            <th class="wd-10p"> شهرستان </th>
                                            <th class="wd-10p"> ایمیل </th>
                                            <th class="wd-10p"> نمایش صفحه اصلی </th>
                                            <th class="wd-10p"> ثبت آدرس </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> ویرایش </th>
                                            <th class="wd-10p"> حذف </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($suppliers as $supplier)
                                            <tr class="odd gradeX">
                                                <td>{{$supplier->id}}</td>
                                                <td>
                                                    <img src="{{asset($supplier->image)}}" class="img-responsive" style="display: block" width="30" alt="">
                                                </td>
                                                <td>{{$supplier->title}} با مدیریت {{$supplier->manager}}</td>

                                                <td>
                                                    @if($supplier->manufacturer == 1)
                                                        <botton class="btn ripple btn-outline-light">تولید کنندی</botton>
                                                    @endif
                                                    @if($supplier->importer == 1)
                                                        <botton class="btn ripple btn-outline-light">وارد کنندی</botton>
                                                    @endif
                                                    @if($supplier->whole_seller == 1)
                                                       <botton class="btn ripple btn-outline-light">عمده فروش</botton>
                                                    @endif
                                                    @if($supplier->retail_seller == 1)
                                                       <botton class="btn ripple btn-outline-light">خرده فروش</botton>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($supplier->phone != null) {{$supplier->phone}}
                                                    @elseif($supplier->mobile != null)  {{$supplier->mobile}}
                                                    @elseif($supplier->whatsapp != null)  {{$supplier->whatsapp}}  @endif
                                                </td>
                                                <td>
                                                    @foreach($states as $state)
                                                        @if($state->id == $supplier->state_id)
                                                            {{$state->title}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($cities as $city)
                                                        @if($city->id == $supplier->city_id)
                                                            {{$city->title}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{$supplier->email}}</td>
                                                <td style="text-align: center;">
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="homeshow" class="custom-switch-input" id="{{$supplier->id}}" {{$supplier->homeshow == 1 ? 'checked' : ''}}>
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="{{ route('suppliers.address' , $supplier->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-map-pin"></i>
                                                    </a>
                                                </td>

                                                <td>
                                                    @foreach($statuses as $status)
                                                        @if($status->id == $supplier->status)
                                                            @if($status->id == 1)
                                                                <button class="btn ripple btn-outline-primary">{{$status->title}}</button>
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
                                                    <a href="{{ route('suppliers.edit' , $supplier->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('suppliers.destroy'  , $supplier->id) }}" method="post">
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
