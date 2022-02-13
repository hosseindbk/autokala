@extends('Admin.admin')
@section('title')
    <title> ویرایش  آگهی </title>
    <link href="{{asset('admin/assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/sumoselect/sumoselect-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css-rtl/colors/default.css')}}" rel="stylesheet">
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت  آگهی</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/offers')}}">مدیریت آگهی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش آگهی</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="row row-sm">
                                    @foreach($offers as $offer)

                                        <div class="col-md-4">
                                            @if($offer->image1 != null)
                                                <div style="width: 250px;float: right;border: 2px solid #dad8d8;border-radius: 15px;">
                                                    <img src="{{asset($offer->image1)}}" class="img-responsive" style="padding: 20px;" alt="">
                                                    <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                        <form action="{{ route('imgoffer1update', $offer->id)}}" method="post">
                                                            {{csrf_field()}}
                                                            <div class="btn-group btn-group-xs">
                                                                <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                    <i class="fe fe-trash-2 "></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if($offer->image2 != null)
                                                <div style="width: 250px;margin: 0 auto;border: 2px solid #dad8d8;border-radius: 15px;">
                                                    <img src="{{asset($offer->image2)}}" class="img-responsive" style="padding: 20px;" alt="">
                                                    <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                        <form action="{{ route('imgoffer2update', $offer->id)}}" method="post">
                                                            {{csrf_field()}}
                                                            <div class="btn-group btn-group-xs">
                                                                <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                    <i class="fe fe-trash-2 "></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4">
                                            @if($offer->image3 != null)
                                                <div style="width: 250px;float: left;border: 2px solid #dad8d8;border-radius: 15px;">
                                                    <img src="{{asset($offer->image3)}}" class="img-responsive" style="padding: 20px;" alt="">
                                                    <div style="background: #efefef;text-align: center;padding: 5px;border-radius: 0px 0px 15px 15px;">
                                                        <form action="{{ route('imgoffer3update', $offer->id)}}" method="post">
                                                            {{csrf_field()}}
                                                            <div class="btn-group btn-group-xs">
                                                                <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                    <i class="fe fe-trash-2 "></i>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h3 class="text-center mb-5"><span class="badge badge-light">ویرایش اطلاعات آگهی</span></h3>
                                </div>
                                @foreach($offers as $offer)
                                    <form action="{{route('offers.update', $offer->id)}}" method="POST" enctype="multipart/form-data">
                                        <div class="row row-sm">
                                            {{csrf_field()}}
                                            {{ method_field('PATCH') }}

                                            <div class="col-md-12">
                                                @include('error')
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">نام قطعه</p>
                                                    @if($offer->product_name != null)
                                                        <input type="text" name="product_name" value="{{$offer->product_name}}" class="form-control">
                                                    @else
                                                        <select name="unicode_product" class="form-control select2">
                                                            <option value="">انتخاب قطعه</option>
                                                        @foreach($products as $product)
                                                                <option value="{{$product->unicode}}" {{$offer->unicode_product == $product->unicode ? 'selected' : ''}}>{{$product->unicode}} - {{$product->title_fa}}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">عنوان آگهی</p>
                                                    <input type="text" name="title_offer" value="{{$offer->title_offer}}"  class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">خرده فروشی داریم؟</p>
                                                    <select name="single" id="" class="form-control select-lg select2">
                                                        <option value="1" {{$offer->single == 1 ? 'selected' : ''}}>بلی</option>
                                                        <option value="0" {{$offer->single == 0 ? 'selected' : ''}}>خیر</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب استان</p>
                                                    <select name="state_id" class="form-control select-lg select2" id="state_id">
                                                        <option value="">انتخاب استان</option>
                                                        @foreach($states as $state)
                                                            <option value="{{$state->id}}" {{$offer->state_id == $state->id ? 'selected' : ''}}>{{$state->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">تامین کننده دائمی </p>
                                                    <select name="permanent_supplier" id="" class="form-control select-lg select2">
                                                        <option value="1" {{$offer->permanent_supplier == 1 ? 'selected' : ''}}>هست</option>
                                                        <option value="0" {{$offer->permanent_supplier == 0 ? 'selected' : ''}}>نیست</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">جهت فروش / خرید</p>
                                                    <select name="buyorsell" class="form-control select-lg select2" id="buyorsell">
                                                        <option value="sell" {{$offer->buyorsell == 'sell' ? 'selected' : ''}}>پیشنهاد فروش</option>
                                                        <option value="buy"  {{$offer->buyorsell == 'buy' ? 'selected' : ''}}>پیشنهاد خرید</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">برند قطعه</p>

                                                    @if($offer->brand_name != null)
                                                        <input type="text" name="brand_name" value="{{$offer->brand_name}}" class="form-control">
                                                    @else
                                                        <select name="brand_id" class="form-control select2" id="brand_id_select">
                                                            <option value="">انتخاب برند</option>
                                                            @foreach($brand_varietis as $Product_brand_variety)
                                                                @if($offer->brand_id == $Product_brand_variety->id)
                                                                    @foreach($brands as $brand)
                                                                            <option value="{{$Product_brand_variety->id}}" {{$brand->id == $Product_brand_variety->brand_id ? 'selected' : ''}}>{{$brand->title_fa}}
                                                                                @if($Product_brand_variety->item1 != null)
                                                                                    -
                                                                                    <li>
                                                                                        <span>{{$Product_brand_variety->item1}}</span>
                                                                                        <span>{{$Product_brand_variety->value_item1}}</span>
                                                                                    </li>

                                                                                @endif
                                                                                @if($Product_brand_variety->item2 != null)
                                                                                    ,
                                                                                    <li>
                                                                                        <span>{{$Product_brand_variety->item2}}</span>
                                                                                        <span>{{$Product_brand_variety->value_item2}}</span>
                                                                                    </li>

                                                                                @endif
                                                                                @if($Product_brand_variety->item3 != null)
                                                                                    ,
                                                                                    <li>
                                                                                        <span>{{$Product_brand_variety->item3}}</span>
                                                                                        <span>{{$Product_brand_variety->value_item3}}</span>
                                                                                    </li>
                                                                                @endif
                                                                            </option>
                                                                @endforeach
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">قیمت کالا خرده فروشی</p>
                                                    <input type="text" name="single_price" value="{{number_format($offer->single_price)}}" class="form-control" />
                                                </div>

                                                <div class="form-group">
                                                    <p class="mg-b-10">کاربر ثبت کننده</p>
                                                    <input type="text" disabled @foreach($users as $user) @if($user->id == $offer->user_id) value="{{$user->name}}" @endif @endforeach class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب شهرستان</p>
                                                    <select name="city_id" id="city_id" class="form-control select-lg select2">
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}" {{$city->id == $offer->city_id ? 'selected' : ''}}>{{$city->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">انتخاب وضعیت نمایش</p>
                                                    <select name="status_id" class="form-control select-lg select2">
                                                        @foreach($statuses as $status)
                                                                <option value="{{$status->id}}" {{$status->id == $offer->status ? 'selected' : ''}}>{{$status->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">دسته بندی گروه قطعات</p>
                                                        <select name="product_group" class="form-control select2" id="product_group">
                                                            <option value="">انتخاب گروه</option>
                                                            @foreach($productgroups as $product_group)
                                                                <option value="{{$product_group->id}}" {{$product_group->id == $offer->product_group ? 'selected' : ''}}>{{$product_group->title_fa}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">قیمت کالا عمده فروشی</p>
                                                    <input type="text" name="price" value="{{number_format($offer->price)}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">تعداد کالا</p>
                                                    <input type="text" name="total" value="{{$offer->total}}" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">تلفن موبایل</p>
                                                    <input type="text" disabled @foreach($users as $user) @if($user->id == $offer->user_id) value="{{$user->phone}}" @endif @endforeach class="form-control" />
                                                    <input type="hidden"  name="mobile" @foreach($users as $user) @if($user->id == $offer->user_id) value="{{$user->phone}}" @endif @endforeach class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                    <p class="mg-b-10">تلفن ثابت</p>
                                                    <input type="text" disabled @foreach($users as $user) @if($user->id == $offer->user_id) value="{{$user->phone_number}}" @endif @endforeach class="form-control" />
                                                    <input type="hidden" name="phone" @foreach($users as $user) @if($user->id == $offer->user_id) value="{{$user->phone_number}}" @endif @endforeach class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر اصلی کالا</p>
                                                    <input type="file" name="image1" class="dropify" data-height="200">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر کالا</p>
                                                    <input  type="file" name="image2" class="dropify" data-height="200">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p class="mg-b-10">تصویر  کالا</p>
                                                    <input type="file" name="image3" class="dropify" data-height="200">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">ادرس</p>
                                                    <textarea name="address" id="" cols="30" rows="5" class="form-control" placeholder="ادرس را وارد کنید">{{$offer->address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="mg-b-10">توضیحات</p>
                                                    <textarea name="description" id="editor" cols="30" data-required="1" rows="5" class="form-control" placeholder="توضیحات را وارد کنید">{{$offer->description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mg-b-10 text-center">
                                                <div class="form-group">
                                                    <button type="submit"  class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h3 class="text-center mb-5"><span class="badge badge-light">   @foreach($offers as $offer) انتخاب خودرو مناسب  {{$offer->title}} @endforeach</span></h3>
                                </div>
                                <form action="{{ route('caroffers-create')}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="row row-sm">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" value="@foreach($offers as $offer) {{$offer->id}} @endforeach" name="offer_id">
                                                <p class="mg-b-10">انتخاب خودرو</p>
                                                <select name="car_brand_id" class="form-control select2" id="car_brand_id">
                                                    <option value="">انتخاب خودرو</option>
                                                    @foreach($carbrands as $car_brand)
                                                        <option value="{{$car_brand->id}}">{{$car_brand->title_fa}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <p class="mg-b-10">انتخاب مدل خودرو</p>
                                                <select name="car_model_id[]" multiple="multiple" class="form-control select2" id="car_model_id">
                                                    <option value="">انتخاب مدل خودرو</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info m-r-20 text-center">ذخیره اطلاعات</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p"> ردیف </th>
                                            <th class="wd-10p"> نام خودرو </th>
                                            <th class="wd-10p"> مدل خودرو </th>
                                            <th class="wd-10p"> حذف </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $s = 1; ?>
                                        @foreach($caroffers as $Car_offer)
                                            <tr class="odd gradeX">
                                                <td>{{$s++}}</td>
                                                @foreach($carbrands as $Car_brand)
                                                    @if($Car_brand->id == $Car_offer->car_brand_id)
                                                        <td>  {{$Car_brand->title_fa}}  </td>
                                                    @endif
                                                @endforeach
                                                @foreach($carmodels as $Car_model)
                                                    @if($Car_offer->car_model_id == $Car_model->id)
                                                        <td>  {{$Car_model->title_fa}}  </td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    <form action="{{ route('caroffers-delete' , $Car_offer->id) }}" method="post">
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
</div>


@section('end')
    <script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <script>
        $(function(){
            $('#state_id').change(function(){
                $("#city_id option").remove();
                var id = $('#state_id').val();

                $.ajax({
                    url : '{{ route( 'option' ) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function( result )
                    {
                        $.each( result, function(k, v) {
                            $('#city_id').append($('<option>', {value:k, text:v}));
                        });
                    },
                    error: function()
                    {
                        //handle errors
                        alert('error...');
                    }
                });
            });
        });
    </script>
    <script>
        $(function(){
            $('#car_brand_id').change(function(){
                $("#car_model_id option").remove();
                var id = $('#car_brand_id').val();
                $.ajax({
                    url : '{{ route( 'modeloption' ) }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function( result )
                    {
                        $.each( result, function(k, v) {
                            $('#car_model_id').append($('<option>', {value:k, text:v}));
                        });
                    },
                    error: function()
                    {
                        alert('error...');
                    }
                });
            });
        });
    </script>
@endsection
@endsection
