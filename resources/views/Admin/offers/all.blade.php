@extends('Admin.admin')
@section('title')
    <title> مدیریت آگهی ها </title>
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
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت آگهی ها</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت آگهی ها</li>
                        </ol>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">لیست  آگهی ها</h6>
                                    <a href="{{url('admin/offers/create')}}" class="btn btn-primary btn-xs float-left">افزودن  آگهی ها جدید</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> تصویر </th>
                                            <th class="wd-10p"> نام کالا </th>
                                            <th class="wd-10p"> عنوان آگهی </th>
                                            <th class="wd-10p"> نوع آگهی </th>
                                            <th class="wd-10p"> استان </th>
                                            <th class="wd-10p"> شهرستان </th>
                                            <th class="wd-10p"> تعداد موجود </th>
                                            <th class="wd-10p"> قیمت تکی </th>
                                            <th class="wd-10p"> قیمت عمده </th>
                                            <th class="wd-10p"> نمایش صفحه اصلی </th>
                                            <th class="wd-10p"> وضعیت </th>
                                            <th class="wd-10p"> ویرایش </th>
                                            <th class="wd-10p"> حذف </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($offers as $offer)
                                            <tr class="odd gradeX">
                                                <td>{{$i++}}</td>
                                                <td>
                                                    <img src="{{asset($offer->image1)}}" class="img-responsive" style="display: block" width="30" alt="">
                                                </td>
                                                <td>{{$offer->title}}</td>
                                                <td>{{$offer->title_offer}}</td>
                                                <td>
                                                    @if($offer->buyorsell == 'buy')
                                                        پیشنهاد خرید
                                                    @elseif($offer->buyorsell == 'sell')
                                                        پیشنهاد فروش
                                                    @endif
                                                </td>

                                                <td>
                                                    @foreach($states as $state)
                                                        @if($state->id == $offer->state_id)
                                                            {{$state->title}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($cities as $city)
                                                        @if($city->id == $offer->city_id)
                                                            {{$city->title}}
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td>{{$offer->total}}</td>
                                                <td>{{number_format($offer->single_price)}}</td>
                                                <td>{{number_format($offer->price)}}</td>
                                                <td style="text-align: center;">
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="homeshow" class="custom-switch-input" id="{{$offer->id}}" {{$offer->homeshow == 1 ? 'checked' : ''}}>
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    @foreach($statuses as $status)
                                                        @if($status->id == $offer->status)
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
                                                    <a href="{{ route('offers.edit' , $offer->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('offers.destroy'  , $offer->id) }}" method="post">
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
                url : '{{ route( 'offerhomeshow' ) }}',
                data: {"_token": "{{ csrf_token() }}", id:id }
            });
        });
    </script>
@endsection
@endsection
