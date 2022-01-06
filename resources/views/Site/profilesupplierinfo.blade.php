@extends('master-main')
@section('title')
    <title>پروفایل اطلاعات تامین کنندگان</title>
    <link rel="stylesheet" href="{{asset('site/css/mapp.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/fa/style.css')}}" data-locale="true">
    <link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('main')
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
                                <div class="profile-comment">
                                    <table class="table table-borderless table-profile-comment">
                                        <thead>
                                        <tr>
                                            <th scope="col">تصویر فروشگاه</th>
                                            <th scope="col">نام فروشگاه</th>
                                            <th scope="col">مدیریت</th>
                                            <th scope="col">وضعیت</th>
                                            <th scope="col">ویرایش</th>
                                            <th scope="col">حذف</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($suppliers as $supplier)
                                        <tr>
                                            <th scope="row" class="th-img">
                                                <div class="thumb-img">
                                                        <img src="{{asset($supplier->image)}}" alt="{{$supplier->title}}">
{{--                                                    <div class="product-rate">--}}
{{--                                                        <i class="fa fa-star active"></i>--}}
{{--                                                        <i class="fa fa-star active"></i>--}}
{{--                                                        <i class="fa fa-star active"></i>--}}
{{--                                                        <i class="fa fa-star active"></i>--}}
{{--                                                        <i class="fa fa-star"></i>--}}
{{--                                                    </div>--}}
                                                </div>
                                            </th>
                                            <td>{{$supplier->title}}</td>
                                            <td>{{$supplier->manager}}</td>
                                            <td> <span class="text-success">تایید شده</span> </td>
                                            <td>  <a href="" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a> </td>
                                            <td>  <a href="" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a> </td>
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
        </section>
    </div>
</div>
@endsection
