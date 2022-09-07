@extends('master-main')
@section('title')
<title>فرم افزودن برند تنوع </title>
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
<div class="nav-categories-overlay"></div>
<div class="container-main">
    @include('sweet::alert')
    <div class="d-block">
        <section class="profile-home">
            <div class="col-lg">
                <div class="post-item-profile order-1 d-block">
                    <div class="col-lg-3 col-md-3 col-xs-12 pr">
                        <div class="sidebar-profile sidebar-navigation">
                            <section class="profile-box">
                                <header class="profile-box-header-inline">
                                    <div class="profile-avatar user-avatar profile-img">

                                        @if(! Auth::user()->image)
                                        <img src="{{asset('site/images/man.png')}}">
                                        @else
                                            <img src="{{Auth::user()->image}}" alt="">
                                        @endif
                                    </div>
                                </header>
                                <footer class="profile-box-content-footer">
                                    <span class="profile-box-nameuser">{{Auth::user()->name}}</span>
                                    <span class="profile-box-registery-date">به وبسایت اتوکالا خوش آمدید </span>
                                    <span class="profile-box-phone">شماره همراه : {{Auth::user()->phone}}</span>
                                    <div class="profile-box-tabs">
                                        <a href="{{url('logout')}}" class="profile-box-tab-sign-out"><i class="mdi mdi-logout-variant"></i>خروج از حساب</a>
                                    </div>
                                </footer>
                            </section>
                                <section class="profile-box">
                                    <ul class="profile-account-navs">
                                        @if(Auth::user()->phone_verify == 1)
                                        <li class="profile-account-nav-item navigation-link-dashboard">
                                            <a href="{{url('profile-user')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                حساب کاربری
                                            </a>
                                        </li>
                                        @if(Auth::user()->type_id == 1 || Auth::user()->type_id == 3 )
                                        <li class="profile-account-nav-item navigation-link-dashboard">
                                            <a href="{{url('profile-business')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                حساب کسب و کار
                                            </a>
                                        </li>
                                        @endif
                                        <li class="profile-account-nav-item navigation-link-dashboard">
                                            <a href="{{url('profile-info')}}" class=""><i class="mdi mdi-tooltip-text-outline"></i>
                                                اطلاعات حساب
                                            </a>
                                        </li>
                                        @if(Auth::user()->phone_verify == 1 && Auth::user()->type_id != 4)
                                        <li class="profile-account-nav-item navigation-link-dashboard">
                                            <a href="{{url('offer')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                فرم آگهی
                                            </a>
                                        </li>
                                        <li class="profile-account-nav-item navigation-link-dashboard">
                                            <a href="{{url('brand-create')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                فرم برند قطعات
                                            </a>
                                        </li>
                                        <li class="profile-account-nav-item navigation-link-dashboard">
                                            <a href="{{url('brand-variety')}}" class="active"><i class="mdi mdi-account-outline"></i>
                                            فرم برند تنوع
                                            </a>
                                        </li>
                                        @endif
                                        @endif
                                    </ul>
                                </section>
                            </div>
                        </div>
                    <div class="col-lg-9 col-md-9 col-xs-12 pl">
                        <div class="profile-content">
                            <div class="profile-stats">
                                <div class="profile-address">
                                    <div class="middle-container">
                                        <div class="row row-sm">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="card custom-card">
                                                    <div class="card-body">
                                                        <div>
                                                            <h3 class="text-center mb-5"><span class="badge badge-light">   @foreach($products as $product)  {{$product->title_fa}} @endforeach</span></h3>
                                                        </div>
                                                        <div class="row row-sm">
                                                            @foreach($products as $product)
                                                                <div class="col-md-4">
                                                                    <p> نام کالا : {{$product->title_fa}}</p>
                                                                    <p> نام لاتین : {{$product->title_en}}</p>
                                                                    <p> عنوان رایج در بازار : {{$product->title_bazar_fa}}</p>
                                                                    <p> دسته : @foreach($productgroups as $Product_group) {{$Product_group->title_fa}} @endforeach</p>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <p> کد فنی کارخانه : {{$product->code_fani_company}}</p>
                                                                    <p>HS کد (شناسه گمرک) :</p>
                                                                    <p>OEM کد (شناسه بین المللی) :</p>
                                                                </div>
                                                                <div class="col-md-4 text-left" >
                                                                    <a href="#" class="btn btn-outline-success">
                                                                        <span> یونیکد : {{$product->unicode}} </span>
                                                                    </a>
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
                                                            <div class="card-body">
                                                                <div class="text-center"><h3 class="main-content-label text-center text-info">ثبت برند تنوع برای {{$product->title_fa}}  </h3></div>
                                                            </div>
                                                            <form action="{{ route('brand-variety-create')}}" method="POST" enctype="multipart/form-data">
                                                                <div class="row row-sm">
                                                                    {{csrf_field()}}
                                                                    <div class="col-md-12">
                                                                        @include('error')
                                                                    </div>
                                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                    <div class="col-md-12" >
                                                                        <h4 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin: 20px 0px;">مشخصات برند</h4>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">برند قطعه</p>
                                                                            <select name="brand_id" class="form-control select2" id="brand_id">
                                                                                <option value="">انتخاب برند</option>
                                                                                @foreach($brands as $brand)
                                                                                    <option value="{{$brand->id}}">{{$brand->title_fa}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <style>
                                                                                .select2-container--default {
                                                                                    width: 90% !important;
                                                                                    margin-left: 5px;
                                                                                }
                                                                                .form-control {
                                                                                    width: 90% !important;
                                                                                    margin-left: 5px;
                                                                                }
                                                                            </style>
                                                                            <button type="button" style="position: absolute;" class="btn btn-warning" id="" data-toggle="modal" title="چنانچه برند مورد نظر در سیستم موجود نمی باشد کلیک نموده و نام برند مورد نظر را تایپ نمایید." data-target="#exampleModal" data-whatever="@mdo">+</button>
                                                                        </div>
                                                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">افزودن برند </h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="form-group">
                                                                                           <p class="text-danger">در صورتی که برند مورد نظر شما در وبسایت موجود نمی باشد می توانی نخست برند را ثبت نموده و سپس برای کالا تنوع آن اقدام نمایید.</p>
                                                                                        </div>
                                                                                        <div class="text-center">
                                                                                            <a href="{{route('brand-create')}}" class="btn btn-warning">فرم ثبت برند جدید</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">انتخاب وضعیت ضمانت و گارانتی</p>
                                                                                <select name="guarantee" class="form-control select-lg select2" id="guarantee">

                                                                                    <option value="0">ندارد</option>
                                                                                    <option value="1">دارد</option>

                                                                                </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12" >
                                                                        <h4 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">نقاط قوت و ضعف</h4>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">نقطه قوت1</p>
                                                                            <input type="text" name="strength1" value="{{ old('strength1') }}"  placeholder="نقطه قوت1 را وارد کنید" class="form-control" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">نقطه ضعف1</p>
                                                                            <input type="text" name="weakness1" value="{{ old('weakness1') }}" placeholder="نقطه ضعف1 را وارد کنید" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">نقطه قوت2</p>
                                                                            <input type="text" name="strength2" value="{{ old('strength2') }}" placeholder="نقطه قوت2 را وارد کنید" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">نقطه ضعف2</p>
                                                                            <input type="text" name="weakness2" value="{{ old('weakness2') }}" placeholder="نقطه ضعف2 را وارد کنید" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">نقطه قوت3</p>
                                                                            <input type="text" name="strength3" value="{{ old('strength3') }}" placeholder="نقطه قوت3 را وارد کنید" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">نقطه ضعف3</p>
                                                                            <input type="text" name="weakness3" value="{{ old('weakness3') }}" placeholder="نقطه ضعف3 را وارد کنید" class="form-control" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12" >
                                                                        <h4 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">ویژگی های خاص این تنوع</h4>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">عنوان عامل1</p>
                                                                            <input type="text" name="item1" id="text-input1"   onkeyup="fn1();" placeholder="عنوان عامل1 را وارد کنید" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10" id="inner-text1">مقدار عامل1</p>
                                                                            <input type="text" name="value_item1" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">عنوان عامل2</p>
                                                                            <input type="text" name="item2" id="text-input2"  onkeyup="fn2();" placeholder="عنوان عامل2 را وارد کنید" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10" id="inner-text2">مقدار عامل2</p>
                                                                            <input type="text" name="value_item2" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">عنوان عامل3</p>
                                                                            <input type="text" name="item3" id="text-input3"  onkeyup="fn3();" placeholder="عنوان عامل3 را وارد کنید" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10" id="inner-text3">مقدار عامل3</p>
                                                                            <input type="text" name="value_item3" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <script type="text/javascript">
                                                                        function fn1(){
                                                                            var element = document.getElementById('text-input1');
                                                                            var value = element.value;
                                                                            document.getElementById('inner-text1').innerHTML = value;
                                                                        }
                                                                        function fn2(){
                                                                            var element = document.getElementById('text-input2');
                                                                            var value = element.value;
                                                                            document.getElementById('inner-text2').innerHTML = value;
                                                                        }
                                                                        function fn3(){
                                                                            var element = document.getElementById('text-input3');
                                                                            var value = element.value;
                                                                            document.getElementById('inner-text3').innerHTML = value;
                                                                        }
                                                                    </script>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">توضیحات تکمیلی</p>
                                                                            <textarea name="description" id="editor" placeholder="توضیحات تکمیلی خود را تایپ نمایید"></textarea>
                                                                            <style>
                                                                                .ck-editor{
                                                                                    direction: rtl;
                                                                                    text-align: right;
                                                                                }
                                                                            </style>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12" >
                                                                        <h4 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 350px;margin-top: 20px;">تصاویر کالا و بسته بندی</h4>
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
                                                                            <input type="file" name="image2" class="dropify" data-height="200">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">تصویر کالا</p>
                                                                            <input type="file" name="image3" class="dropify" data-height="200">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 mg-b-10 text-center">
                                                                        <div class="form-group">
                                                                            <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
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
                    url : '{{ route( 'state' ) }}',
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
@endsection
