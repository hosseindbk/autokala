@extends('master-main')
@section('title')
    <title>پروفایل اطلاعات تامین کنندگان</title>
    <link rel="stylesheet" href="{{asset('site/css/mapp.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/fa/style.css')}}" data-locale="true">
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
    @include('sweet::alert')
<div class="container-main">
    <div class="d-block">
        <section class="profile-home">
            <div class="col-lg">
                <div class="post-item-profile order-1 d-block">
                    <div class="col-lg-3 col-md-3 col-xs-12 pr">
                        <div class="sidebar-profile sidebar-navigation">
                            <section class="profile-box">
                                <header class="profile-box-header-inline">
                                    <div class="profile-avatar user-avatar profile-img">
                                        <img src="{{asset('site/images/man.png')}}">
                                    </div>
                                </header>
                                <footer class="profile-box-content-footer">
                                    <span class="profile-box-nameuser">{{Auth::user()->name}}</span>
                                    <span class="profile-box-registery-date">عضویت به عنوان تامین کننده </span>
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
                                                <a href="{{url('profile-business')}}" class="active"><i class="mdi mdi-account-outline"></i>
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

                                        <div class="col-md-12" >
                                            <h5 style="border-bottom: 2px solid #ff3d00;padding: 10px;width: 450px;margin-top: 20px;">حوزه فعالیت (انواع خودرو و دسته های کالایی)</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <div style="background-color: #0ab2e699; border-radius: 15px; padding: 20px; margin: 20px 0px 40px 0px;">
                                                <ul>
                                                    <li><p>* ابتدا خودرو و مدل آن را انتخاب و سپس گروه کالایی از آن خودرو که روی آن فعالیت دارید را انتخاب نمایید و در انتها بر روی کلید ثبت خودرو کلیک نمایید </p></li>
                                                    <li><p>* چنانچه روی خودروهای متعدد و یا گروه های مختلف کالایی از یک خودرو فعالیت دارید می توانید ردیف های بیشتری به جدول زیر اضافه نمایید.</p></li>
                                                    <li><p>* اطلاعات وارد شده در این قسمت ، در جستجوی کاربران و دسترسی به فروشگاه شما تاثیر زیادی دارد، در ورود اطلاعات و اطمینان از صحت آن دقت نمایید.</p></li>
                                                    <li><p>* پس از اطمینان از صحت اطلاعات درج شده جهت نهایی کردن پروفایل روی کلید سبز رنگ ثبت نهایی کلیک نمایید.</p></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <form action="{{ route('cartechnichalgroups.store')}}" method="POST">
                                            {{csrf_field()}}
                                            <div class="row row-sm">
                                                <div class="col-md-4">
                                                    <div class="form-group">
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
                                                        <select multiple="multiple" name="car_model_id[]" id="car_model_id" class="form-control select2">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <p class="mg-b-10">انتخاب گروه کالا</p>
                                                        <select name="product_group_id" class="form-control select2" id="product_group_id">
                                                            <option value="">انتخاب گروه کالا</option>
                                                            @foreach($productgroups as $product_group)
                                                                <option value="{{$product_group->id}}">{{$product_group->title_fa}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-info m-r-20 text-center">ثبت خودرو و گروه کالای انتخابی</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table" id="example1">
                                                <thead>
                                                <tr>
                                                    <th class="wd-10p"> ردیف </th>
                                                    <th class="wd-10p"> برند خودرو </th>
                                                    <th class="wd-10p"> مدل خودرو </th>
                                                    <th class="wd-10p"> گروه کالا </th>
                                                    <th class="wd-10p"> حذف </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $s = 1; ?>
                                                @foreach($supplierproductgroups as $supplier_product_group)
                                                    <tr class="odd gradeX">
                                                        <td>{{$s++}}</td>

                                                        <td>
                                                            @foreach($carbrands as $Car_brand)
                                                                @if($Car_brand->id == $supplier_product_group->car_brand_id)
                                                                    {{$Car_brand->title_fa}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($carmodels as $Car_model)
                                                                @if($supplier_product_group->car_model_id == $Car_model->id)
                                                                    {{$Car_model->title_fa}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($productgroups as $product_group)
                                                                @if($supplier_product_group->kala_group_id == $product_group->id)
                                                                    {{$product_group->title_fa}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <form action="{{ route('cartechnichalgroups.destroy', $supplier_product_group->id) }}" method="post">
                                                                {{ method_field('delete') }}
                                                                {{ csrf_field() }}
                                                                <div class="btn-group btn-group-xs">
                                                                    <button type="submit" class="btn btn-outline-danger btn-xs">
                                                                        <i class="fa fa-trash "></i>
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
        </section>
    </div>
</div>
@endsection
@section('script')
<script  src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin/assets/js/select2.js')}}"></script>
<script src="{{asset('admin/assets/js/advanced-form-elements.js')}}"></script>
<script src="{{asset('site/js/mapp.env.js')}}"></script>
<script src="{{asset('site/js/mapp.min.js')}}"></script>
<script>
    $(document).ready(function () {
        var crosshairIcon = {
            iconUrl: '{{asset('site/assets/images/icon-marker.svg')}}',
            iconSize:     [40, 50], // size of the icon
            iconAnchor:   [20, 55], // point of the icon which will correspond to marker's location
        };
        var app = new Mapp({
            element: '#app',
            @if($supplier->lat != null && $supplier->lng != null)
                presets: {
                    latlng: {
                        lat: {{$supplier->lat}},
                        lng: {{$supplier->lng}},
                    },
                    icon: crosshairIcon,
                    zoom: 20,
                    popup: {
                        title: {
                            i18n: 'موقعیت مکانی',
                        },
                        description: {
                            i18n: 'توضیحات',
                        },
                        class: 'marker-class',
                        open: false,
                    },
                },
            @elseif(Auth::user()->lat != null && Auth::user()->lng != null)
            presets: {
                latlng: {
                    lat: {{Auth::user()->lat}},
                    lng: {{Auth::user()->lng}},
                },
                icon: crosshairIcon,
                zoom: 20,
                popup: {
                    title: {
                        i18n: 'موقعیت مکانی',
                    },
                    description: {
                        i18n: 'توضیحات',
                    },
                    class: 'marker-class',
                    open: false,

                },
            },
            @endif
            apiKey: "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI0OTE4ZjYzNjQ0ZmUxNTNjMWNiY2Y1NzcyNTJlOTkzNGNkZWZhMmQyM2ZhZjBjMzdkOWViNmUzZDgyYjJmMGQ4ZjU1MDY1ZjgyY2EyNWE2In0.eyJhdWQiOiIxNTQ5NCIsImp0aSI6IjI0OTE4ZjYzNjQ0ZmUxNTNjMWNiY2Y1NzcyNTJlOTkzNGNkZWZhMmQyM2ZhZjBjMzdkOWViNmUzZDgyYjJmMGQ4ZjU1MDY1ZjgyY2EyNWE2IiwiaWF0IjoxNjMxNzc5MjQ0LCJuYmYiOjE2MzE3NzkyNDQsImV4cCI6MTYzNDQ2MTI0NCwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.VsRI2wiG_IvFVkVKXt_XnOBpzyjMIygnv6s_s81u9WVC_Z-stANinKYH_6iJPuJ3lRdAX8SdtHwYCr2DZVF2hi6WiTu-BSvMuXPb6sg0iYXgYREKQjzsWU4NPf2kOwd4q6aj1R6UOT_EA7GIrJQ5FPYDceAmeT8va1VdK6xYp-Ypstja-clURippQKEk0mDe9Z_ABYWQNAWfqUt_ubYEZrETjnDoSQHbJxJc46vxWvYmwoK1sIZ4NoXaQbRrAb0QKZ_7Lnh3H3_vHqQGMB0vJELzwSJEmiNxr_h7uIvugtRAUneAa878lOJuv03976YNjIoepK_aWhxzrP-RmE4O5A",
        });
        app.addLayers();
        app.addZoomControls();
        app.addGeolocation({
            history: false,
            onLoad: false,
            onLoadCallback: function(){
                console.log(app.states.user.latlng);
            },
        });
        app.addLogo({
            url: '{{asset('site/images/maplogo.png')}}',
        });

        @if($supplier->lat != null && $supplier->lng != null)

        app.markReverseGeocode({
            state: {
                latlng: {
                    lat: {{$supplier->lat}},
                    lng: {{$supplier->lng}},
                },
                zoom: 14,
                icon: crosshairIcon,
            },
        });
        @elseif(Auth::user()->lat != null && Auth::user()->lng != null)
        app.markReverseGeocode({
            state: {
                latlng: {
                    lat: {{Auth::user()->lat}},
                    lng: {{Auth::user()->lng}},
                },
                zoom: 14,
                icon: crosshairIcon,
            },
        });
        @endif
        app.map.on('click', function (e) {

            var marker = app.addMarker({
                name: 'advanced-marker',
                latlng: {
                    lat: e.latlng.lat,
                    lng: e.latlng.lng,
                },
                icon: crosshairIcon,
                popup: {
                    title: {
                        i18n: 'موقعیت مکانی',
                    },
                    description: {
                        i18n: 'توضیحات',
                    },
                    class: 'marker-class',
                    open: false,
                },
            });
            $.ajax({
                url: '{{ route( 'suppliermap' ) }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "_token": "{{ csrf_token() }}",
                    lat     : e.latlng.lat,
                    lng     : e.latlng.lng,
                    'id'    :{{$supplier->id}},
                },
                type: 'patch',
                dataType: 'json',
            }).done(function (data) {
                console.log(data);
            });
        })
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
