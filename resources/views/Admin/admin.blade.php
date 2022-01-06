<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    @yield('title')
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/web-fonts/icons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/web-fonts/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/web-fonts/plugin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/sweet-alert/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css-rtl/style/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css-rtl/skins.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css-rtl/colors/color.css')}}" id="theme" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('admin/assets/css-rtl/sidemenu/sidemenu.css')}}">
{{--    <link rel="stylesheet" href="{{asset('admin/assets/css-rtl/dark-style.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('admin/assets/css-rtl/colors/default.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}">--}}


        @yield('first')
    </head>

<body class="main-body leftmenu">

<!-- Loader -->

<div id="global-loader">
    <div class="spinner-border text-primary" style="margin-top: 300px" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- End Loader -->

<!-- Page -->
<div class="page">

    <!-- Sidemenu -->
    <div class="main-sidebar main-sidebar-sticky side-menu">
        <div class="sidemenu-logo">
            <a class="main-logo" href="{{url('admin/panel')}}">
                <img src="{{asset('admin/assets/img/brand/logo-light.png')}}" class="header-brand-img desktop-logo" alt="بستا">
                <img src="{{asset('admin/assets/img/brand/icon-light.png')}}" class="header-brand-img icon-logo" alt="بستا">
                <img src="{{asset('admin/assets/img/brand/logo.png')}}" class="header-brand-img desktop-logo theme-logo" alt="بستا">
                <img src="{{asset('admin/assets/img/brand/icon.png')}}" class="header-brand-img icon-logo theme-logo" alt="بستا">
            </a>
        </div>
        <div class="main-sidebar-body">
            <ul class="nav">
                    @foreach($menudashboards as $menudashboard)
                        @if($menudashboard->submenu == 0)

                            <li class="nav-item">
                                <a class="nav-link" href="{{url($menudashboard->slug)}}">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="{{$menudashboard->icon}} sidemenu-icon"></i>
                                    <span class="sidemenu-label">{{$menudashboard->title}}</span>
                                </a>
                            </li>
                        @endif

                            @if($menudashboard->submenu == 1)
                                <li class="nav-item">
                                    @can($menudashboard->namayesh)
                                    <a class="nav-link with-sub" href="">
                                        <span class="shape1"></span>
                                        <span class="shape2"></span>
                                        <i class="{{$menudashboard->icon}} sidemenu-icon"></i>
                                        <span class="sidemenu-label">{{$menudashboard->title}}</span>
                                        <i class="angle fe fe-chevron-left"></i>
                                    </a>
                                    @endcan
                                    <ul class="nav-sub">
                                        @foreach($submenudashboards as $submenudashboard)
                                            @if($submenudashboard->menu_id == $menudashboard->id)
                                                @can($submenudashboard->namayesh)
                                                    <li class="nav-sub-item">
                                                        <a class="nav-sub-link" href="{{url('admin/'.$submenudashboard->slug)}}">{{$submenudashboard->name}}</a>
                                                    </li>
                                                @endcan
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                        @endif
                @endforeach
            </ul>
        </div>
    </div>
    <!-- End Sidemenu -->		<!-- Main Header-->
    <div class="main-header side-header sticky">
        <div class="container-fluid">
            <div class="main-header-right">
                <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
            </div>
            <div class="main-header-center">
                <div class="responsive-logo">
                    <a href="{{url('admin/panel')}}"><img src="{{asset('admin/assets/img/brand/logo.png')}}" class="mobile-logo" alt="بستا"></a>
                    <a href="{{url('admin/panel')}}"><img src="{{asset('admin/assets/img/brand/logo-light.png')}}" class="mobile-logo-dark" alt="بستا"></a>
                </div>
            </div>
            <div class="main-header-right">
                <div class="dropdown header-search">
                    <a class="nav-link icon header-search">
                        <i class="fe fe-search header-icons"></i>
                    </a>
                </div>

                <div class="dropdown d-md-flex">
                    <a class="nav-link icon full-screen-link" href="#">
                        <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                        <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                    </a>
                </div>
                <div class="dropdown main-header-notification">
                    <a class="nav-link icon" href="#">
                        <i class="fe fe-bell header-icons"></i>
                        <span class="badge badge-danger nav-link-badge">4</span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading">
                            <p class="main-notification-text">{{Request::segment(2)}} <span class="badge badge-pill badge-primary mr-3">مشاهده همه</span></p>
                        </div>
                        <div class="main-notification-list">
                        </div>
                        <div class="dropdown-footer">
                            <a href="#">مشاهده همه اعلان ها</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown main-profile-menu">
                    <a class="d-flex" href="#">
                        <span class="main-img-user"><img alt="{{Auth::user()->name}}" src="{{asset('admin/assets/img/users/1.jpg')}}"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading">
                            <h6 class="main-notification-title">{{Auth::user()->name}}</h6>
                            <p class="main-notification-text">{{Auth::user()->level}}</p>
                        </div>
                        <a class="dropdown-item border-top" href="{{url('admin/profile')}}">
                            <i class="fe fe-user"></i> پروفایل من
                        </a>
                        <a class="dropdown-item" href="{{route('logout')}}">
                            <i class="fe fe-power"></i> خروج از سیستم
                        </a>
                    </div>
                </div>
                <button class="navbar-toggler navresponsive-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="تغییر پیمایش">
                    <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                </button><!-- Navresponsive closed -->
            </div>
        </div>
    </div>
    <!-- End Main Header-->		<!-- Mobile-header -->
    <div class="mobile-main-header">
        <div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <div class="d-flex order-lg-2 mr-auto">
                    <div class="dropdown header-search">
                        <a class="nav-link icon header-search">
                            <i class="fe fe-search header-icons"></i>
                        </a>
                    </div>
                    <div class="dropdown ">
                        <a class="nav-link icon full-screen-link">
                            <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                            <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                        </a>
                    </div>
                    <div class="dropdown main-header-notification">
                        <a class="nav-link icon" href="#">
                            <i class="fe fe-bell header-icons"></i>
                            <span class="badge badge-danger nav-link-badge">4</span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="header-navheading">
                                <p class="main-notification-text">شما 1 اعلان خوانده نشده <span class="badge badge-pill badge-primary mr-3">مشاهده همه</span></p>
                            </div>
                            <div class="main-notification-list">
                            </div>
                            <div class="dropdown-footer">
                                <a href="#">مشاهده همه اعلان ها</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown main-profile-menu">
                        <a class="d-flex" href="#">
                            <span class="main-img-user"><img alt="آواتار" src="{{asset('admin/assets/img/users/1.jpg')}}"></span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="header-navheading">
                                <h6 class="main-notification-title">{{Auth::user()->name}}</h6>
                                <p class="main-notification-text">{{Auth::user()->level}}</p>
                            </div>
                            <a class="dropdown-item border-top" href="profile.html">
                                <i class="fe fe-user"></i> پروفایل من
                            </a>
                            <a class="dropdown-item" href="profile.html">
                                <i class="fe fe-edit"></i> ویرایش نمایه
                            </a>
                            <a class="dropdown-item" href="profile.html">
                                <i class="fe fe-settings"></i> تنظیمات حساب
                            </a>
                            <a class="dropdown-item" href="profile.html">
                                <i class="fe fe-settings"></i> پشتیبانی
                            </a>
                            <a class="dropdown-item" href="profile.html">
                                <i class="fe fe-compass"></i> فعالیت
                            </a>
                            <a class="dropdown-item" href="signin.html">
                                <i class="fe fe-power"></i> خروج از سیستم
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile-header closed -->
                @yield('main')

    <div class="main-footer text-center">
        <div class="container">
            <div class="row row-sm">
                <div class="col-md-12">
                    <span>کپی رایت © 1400  . طراحی شده توسط <a href="http://bestagroup.ir">Bestagroup</a> کلیه حقوق محفوظ است.</span>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

<script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap-rtl.js')}}"></script>
<script src="{{asset('admin/assets/plugins/sidemenu/sidemenu-rtl.js')}}"></script>
<script src="{{asset('admin/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{asset('admin/assets/js/custom.js')}}"></script>
<script src="{{asset('admin/assets/js/sticky.js')}}"></script>


{{--<script src="{{asset('admin/assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>--}}
{{--<script src="{{asset('admin/assets/plugins/sidebar/sidebar-rtl.js')}}"></script>--}}
{{--<script src="{{asset('admin/assets/plugins/select2/js/select2.min.js')}}"></script>--}}

@yield('end')
</body>
</html>




