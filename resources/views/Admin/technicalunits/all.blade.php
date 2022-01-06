@extends('Admin.admin')
@section('title')
    <title> مدیریت مراکز خدمات فنی </title>
    <link href="{{asset('admin/assets/plugins/datatable/dataTables.bootstrap4.min-rtl.css')}} " rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    @include('sweet::alert')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت مراکز خدمات فنی</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت مراکز خدمات فنی</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست مراکز خدمات فنی</h6>
                                    <a href="{{url('admin/technicalunits/create')}}" class="btn btn-primary btn-xs float-left">افزودن مرکز خدمات فنی جدید</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> سریال </th>
                                            <th class="wd-10p"> تصویر </th>
                                            <th class="wd-10p"> مشخصات واحد خدمات فنی </th>
                                            <th class="wd-10p"> شماره های تماس </th>
                                            <th class="wd-10p"> استان </th>
                                            <th class="wd-10p"> شهرستان </th>
                                            <th class="wd-10p"> نمایش صفحه اصلی </th>
                                            <th class="wd-10p"> ثبت آدرس </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> ویرایش </th>
                                            <th class="wd-10p"> حذف </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($technicalunits as $technicalunit)
                                            <tr class="odd gradeX">
                                                <td>{{$technicalunit->id}}</td>
                                                <td>
                                                    <img src="{{asset($technicalunit->image)}}" class="img-responsive" style="display: block" width="30" alt="">
                                                </td>
                                                <td>{{$technicalunit->title}} با مدیریت {{$technicalunit->manager}}</td>
                                                <td>
                                                    @if($technicalunit->phone != null) {{$technicalunit->phone}}
                                                    @elseif($technicalunit->phone2 != null) - {{$technicalunit->phone2}} -
                                                    @elseif($technicalunit->phone3 != null) {{$technicalunit->phone3}} -
                                                    @elseif($technicalunit->mobile != null) {{$technicalunit->mobile}} -
                                                    @elseif($technicalunit->mobile2 != null) {{$technicalunit->mobile2}} -
                                                    @elseif($technicalunit->whatsapp != null) {{$technicalunit->whatsapp}} @endif
                                                </td>
                                                <td>
                                                @foreach($states as $state)
                                                    @if($state->id == $technicalunit->state_id)
                                                        {{$state->title}}
                                                    @endif
                                                @endforeach
                                                </td>
                                                <td>
                                                @foreach($cities as $city)
                                                    @if($city->id == $technicalunit->city_id)
                                                      {{$city->title}}
                                                    @endif
                                                @endforeach
                                                </td>
                                                <td style="text-align: center;">
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="homeshow" class="custom-switch-input" id="{{$technicalunit->id}}" {{$technicalunit->homeshow == 1 ? 'checked' : ''}}>
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="{{ route('technicalunits.address' , $technicalunit->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-map-pin"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    @foreach($statuses as $status)
                                                        @if($status->id == $technicalunit->status)
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
                                                    <a href="{{ route('technicalunits.edit' , $technicalunit->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('technicalunits.destroy'  , $technicalunit->id) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="btn-group btn-group-xs">
                                                            <button type="submit" class="btn btn-danger btn-xs">
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
                url : '{{ route( 'technicalhomeshow' ) }}',
                data: {"_token": "{{ csrf_token() }}", id:id }
            });
        });
    </script>
@endsection
@endsection
