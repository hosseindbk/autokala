@extends('master-main')
@section('title')
    <title>پروفایل اطلاعات @foreach($typeusers as $typeuser)
            {{$typeuser->title}}
        @endforeach</title>
@endsection
@section('main')
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
                                        <span class="profile-box-registery-date">عضویت به عنوان  @foreach($typeusers as $typeuser)
                                                {{$typeuser->title}}
                                            @endforeach </span>
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
                                                <a href="{{url('profile-info')}}" class="active"><i class="mdi mdi-tooltip-text-outline"></i>
                                                    اطلاعات حساب
                                                </a>
                                            </li>
                                            <li class="profile-account-nav-item navigation-link-dashboard">
                                                <a href="{{url('profile-myoffer')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                    آگهی های من
                                                </a>
                                            </li>
                                            @if(Auth::user()->type_id != 4)

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
                        <div class="profile-stats">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="text-center"><h3 class="main-content-label text-center text-info">نمایش اطلاعات حساب</h3></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-9 col-md-9 col-xs-12 pl">
                        <div class="profile-content">
                            <div class="profile-stats">
                                <table class="table table-profile">
                                    <tbody>
                                    <tr>
                                        <div class="m-3">

                                            <h3 class="text-center text-dark">اطلاعات کاربری</h3>

                                        </div>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="value"> نام و نام خانوادگی: {{Auth::user()->name}}</div>
                                        </td>
                                        <td>
                                            <div class="value"> پست الکترونیک : {{Auth::user()->email}}</div>
                                        </td>
                                        <td>
                                            <div class="value"> شماره تلفن همراه: {{Auth::user()->phone}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="value">نوع عضویت:
                                                @foreach($typeusers as $typeuser)
                                                    {{$typeuser->title}}
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div class="value">  استان :
                                                @foreach($states as $state)
                                                    @if(Auth::user()->state_id == $state->id)
                                                        {{$state->title}}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div class="value"> شهرستان :
                                                @foreach($cities as $city)
                                                    @if(Auth::user()->city_id == $city->id)
                                                    {{$city->title}}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>

                                                @if(Auth::user()->status == 1)
                                                    <span class="btn-lg text-warning"> در حال بررسی مدیر سیستم </span>
                                                @elseif(Auth::user()->status == 2)
                                                    <span class="btn-lg text-success">تایید مدیر سیستم</span>
                                                @endif

                                        </td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            @if(Auth::user()->type_id == 3)
                                @foreach($technicalunits as $technical_unit)
                                <div class="profile-stats">
                                <table class="table table-profile">
                                    <tbody>
                                    <tr>
                                        <div class="m-3">
                                            <h3 class="text-center text-dark">اطلاعات واحد خدمات فنی</h3>
                                        </div>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="value">نام واحد خدمات فنی: {{$technical_unit->title}}</div>
                                        </td>
                                        <td>
                                            <div class="value">مدیر : {{$technical_unit->manager}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="value">شماره همراه: {{$technical_unit->mobile}}</div>
                                        </td>
                                        <td>
                                            <div class="value">شماره ثابت : {{$technical_unit->phone_number}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="value">ایمیل: {{$technical_unit->email}}</div>
                                        </td>
                                        <td>
                                            <div class="value">وبسایت: {{$technical_unit->website}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="value">  استان :
                                                @foreach($states as $state)
                                                    @if($technical_unit->state_id == $state->id)
                                                        {{$state->title}}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div class="value"> شهرستان :

                                                @foreach($cities as $city)
                                                    @if($technical_unit->city_id == $city->id)
                                                    {{$city->title}}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="value">  آدرس :  {{$technical_unit->address}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="value"> توضیحات : {!! $technical_unit->description !!}</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="profile-edit-action">
                                    <a href="#" class="link-spoiler-edit btn btn-primary">ویرایش اطلاعات</a>
                                </div>
                            </div>
                                @endforeach
                            @elseif(Auth::user()->type_id == 1)
                                @foreach($suppliers as $supplier)
                                    <div class="profile-stats mt-4">
                                    <table class="table table-profile">
                                        <tbody>
                                        <tr>
                                            <div class="m-3">
                                                <h3 class="text-center text-dark">اطلاعات تامین کننده</h3>
                                            </div>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="value"> نام واحد خدمات فنی: {{$supplier->title}} </div>
                                            </td>
                                            <td>
                                                <div class="value"> مدیر : {{$supplier->manager}}</div>
                                            </td>
                                            <td>
                                                <div class="value"> شماره همراه: {{$supplier->mobile}}</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="value">شماره ثابت : {{$supplier->phone_number}}</div>
                                            </td>
                                            <td>
                                                <div class="value">ایمیل: {{$supplier->email}}</div>
                                            </td>
                                            <td>
                                                <div class="value"> وبسایت: {{$supplier->website}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="value"> استان :
                                                    @foreach($states as $state)
                                                        @if($supplier->state_id == $state->id)
                                                            {{$state->title}}
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <div class="value"> شهرستان :
                                                    @foreach($cities as $city)
                                                        @if($supplier->city_id == $city->id)
                                                            {{$city->title}}
                                                        @endif
                                                    @endforeach
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="value"> آدرس : {{$supplier->address}}</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="value"> توضیحات : {{$supplier->description}} </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <div class="profile-edit-action">
                                        <a href="#" class="link-spoiler-edit btn btn-primary">ویرایش اطلاعات</a>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection
