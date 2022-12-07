@extends('master-main')
@section('title')
    <title>پروفایل اطلاعات کاربر
        @foreach($types as $typeuser)
            @if($typeuser->id == Auth::user()->type_id)
                {{$typeuser->title}}
            @endif
        @endforeach
    </title>
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
                                        <span class="profile-box-registery-date">عضویت به عنوان  @foreach($types as $typeuser)
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
                                                <a href="{{url('profile-info')}}" class=""><i class="mdi mdi-tooltip-text-outline"></i>
                                                    اطلاعات حساب
                                                </a>
                                            </li>
                                            @if(Auth::user()->phone_verify == 1 && Auth::user()->type_id != 4)
                                                <li class="profile-account-nav-item navigation-link-dashboard">
                                                    <a href="{{url('profile-myoffer')}}" class=""><i class="mdi mdi-account-outline"></i>
                                                        آگهی های من
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
                        <div class="profile-stats">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <span class="btn-lg btn-outline-info">نمایش اطلاعات </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-lg-9 col-md-9 col-xs-12 pl">
                        <div class="profile-content">
                            <div class="profile-stats">
                                <span class="btn-lg btn-outline-info">اطلاعات کاربری</span>
                                <table class="table table-profile">
                                    <tbody>
                                    <tr>
                                        <td class="w-50">
                                            <div class="title">نام و نام خانوادگی:</div>
                                            <div class="value">{{Auth::user()->name}}</div>
                                        </td>
                                        <td>
                                            <div class="title">پست الکترونیک :</div>
                                            <div class="value">{{Auth::user()->email}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="title">شماره تلفن همراه:</div>
                                            <div class="value">{{Auth::user()->phone}}</div>
                                        </td>
                                        <td>
                                            <div class="title">نوع عضویت:</div>
                                            <div class="value">
                                                @foreach($types as $typeuser)
                                                    @if($typeuser->id == auth::user()->type_id)
                                                    {{$typeuser->title}}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="title"> استان :</div>
                                            <div class="value">
                                                @foreach($states as $state)
                                                    @if(Auth::user()->state_id == $state->id)
                                                        {{$state->title}}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div class="title"> شهرستان :</div>
                                            <div class="value">
                                                @foreach($cities as $city)
                                                    @if(Auth::user()->city_id == $city->id)
                                                    {{$city->title}}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
