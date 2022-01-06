@extends('master-main')
@section('title')
<title>فرم ویرایش برند قطعات</title>
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
                                                <a href="{{url('brand-create')}}" class="active"><i class="mdi mdi-account-outline"></i>
                                                    فرم برند قطعات
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
                                                            <h6 class="main-content-label text-center mb-5">ویرایش اطلاعات برند قطعات</h6>
                                                        </div>
                                                        @foreach($brandcreate as $brand)
                                                            <form action="{{route('brand-update' , $brand->id)}}" method="post" class="form-checkout" enctype="multipart/form-data">
                                                                {{method_field('PATCH')}}
                                                                @csrf
                                                                <div class="row row-sm">
                                                                    <div class="col-md-12">
                                                                        @include('error')
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">نام برند فارسی</p>
                                                                            <input type="text" name="title_fa" value="{{$brand->title_fa}}"  class="form-control" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">نام برند انگلیسی</p>
                                                                            <input type="text" name="title_en" value="{{$brand->title_en}}"  class="form-control" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">نام اختصار</p>
                                                                            <input type="text" name="abstract_title" value="{{$brand->abstract_title}}"  class="form-control" />
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">تلفن</p>
                                                                            <input type="text" name="phone" value="{{$brand->phone}}" class="form-control input-height" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">واتس اپ</p>
                                                                            <input type="text" name="whatsapp" value="{{$brand->whatsapp}}" class="form-control input-height" />
                                                                        </div>
                                                                        <div class="form-group m-0">
                                                                            <p class="mg-b-10">موبایل</p>
                                                                            <input type="text" name="mobile" value="{{$brand->mobile}}" class="form-control input-height" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">ایمیل</p>
                                                                            <input type="text" name="email" value="{{$brand->email}}" class="form-control" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">وبسایت</p>
                                                                            <input type="text" name="website" value="{{$brand->website}}" class="form-control" />
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">انتخاب کشور سازنده</p>
                                                                            <select name="country_id" class="form-control select-lg select2">
                                                                                @foreach($countries as $country)
                                                                                    <option value="{{$country->id}}" {{$brand->country_id == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">تصویر اصلی برند</p>
                                                                            <input type="file" name="image" class="dropify" data-height="200">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">توضیحات</p>
                                                                            <textarea name="description" id="editor" cols="30" rows="5" class="form-control" >{{$brand->description}}</textarea>
                                                                            <style>
                                                                                .ck-editor{
                                                                                    direction: rtl;
                                                                                    text-align: right;
                                                                                }
                                                                            </style>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <p class="mg-b-10">آدرس</p>
                                                                            <textarea name="address" id="" cols="30" rows="5" class="form-control">{{$brand->address}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 mg-b-10 text-center">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @endforeach
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
