@extends('Admin.admin')
@section('title')
    <title> پروفایل کاربری </title>
    <link href="" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/assets/plugins/gallery/gallery.css')}}" rel="stylesheet" />
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">مدیریت پروفایل کاربر</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/panel')}}">صفحه اصلی</a></li>
                            <li class="breadcrumb-item active" aria-current="page">مدیریت پروفایل کاربر</li>
                        </ol>
                    </div>
                </div>
                <div class="row square">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="profile-tab tab-menu-heading">
                                    <nav class="nav main-nav-line p-3 tabs-menu profile-nav-line bg-gray-100">
                                        <a class="nav-link active" data-toggle="tab" href="#edit">ویرایش اطلاعات </a>
                                        <a class="nav-link" data-toggle="tab" href="#user">کاربران </a>
                                        <a class="nav-link" data-toggle="tab" href="#usercreate">ایجاد حساب کاربری</a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card main-content-body-profile">
                            <div class="tab-content">
                                <div class="main-content-body tab-pane p-4 border-top-0 active" id="edit">
                                    <div class="card-body border">
                                        <div class="mb-4 main-content-label">اطلاعات شخصی</div>
                                        <form class="form-horizontal" method="post" action="{{route('profiles.update' , Auth::user()->id)}}">
                                            {{csrf_field()}}
                                            {{ method_field('PATCH') }}
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">نام کاربری</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="username" class="form-control" value="{{Auth::user()->username}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">نام و نام خانوادگی</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4 main-content-label">اطلاعات تماس</div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">ایمیل <i>(الزامی)</i></label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="email" class="form-control" value="{{Auth::user()->email}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">موبایل</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="mobile" class="form-control" value="{{Auth::user()->mobile}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4 main-content-label">اطلاعات شبکه اجتماعی</div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">واتس اپ</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="whatsapp" class="form-control" value="{{Auth::user()->whatsapp}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">اینستاگرام</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="instagram" class="form-control" value="{{Auth::user()->instagram}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">تلگرام</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="telegram" class="form-control" value="{{Auth::user()->telegram}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-4 main-content-label">سطح دسترسی و وضعیت</div>
                                            <div class="form-group mb-0">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">سطح دسترسی کاربر</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="custom-controls-stacked">
                                                            @if(Auth::user()->level == 'admin')
                                                                <button class="btn ripple btn-success" disabled>ادمین</button>
                                                            @elseif(Auth::user()->level == 'manager')
                                                                <button class="btn ripple btn-success" disabled>مدیر</button>
                                                            @elseif(Auth::user()->level == 'expert')
                                                                <button class="btn ripple btn-success" disabled>کارشناس </button>
                                                            @elseif(Auth::user()->level == 'user')
                                                                <button class="btn ripple btn-success" disabled>کاربر</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4 main-content-label"></div>
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">وضعیت کاربر</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="custom-controls-stacked">
                                                            @if(Auth::user()->status == 1)
                                                                <button class="btn ripple btn-warning" disabled>ثبت نام اولیه</button>
                                                            @elseif(Auth::user()->status == 2)
                                                                <button class="btn ripple btn-primary" disabled>در حال بررسی</button>
                                                            @elseif(Auth::user()->status == 3)
                                                                <button class="btn ripple btn-success" disabled>تایید مدیر </button>
                                                            @elseif(Auth::user()->status == 4)
                                                                <button class="btn ripple btn-light" disabled>معلق شده</button>
                                                            @elseif(Auth::user()->status == 5)
                                                                <button class="btn ripple btn-danger" disabled >غیر فعال شده</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row row-sm">
                                                    <div class="col-md-12">
                                                        <div class="custom-controls-stacked text-center">
                                                           <button class="btn btn-lg ripple btn-success">ثبت اطلاعات</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="main-content-body tab-pane border-top-0" id="user">
                                    <div class="card-body border pd-b-10">
                                        <div class="row row-sm">
                                            @foreach($users as $user)
                                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                                <div class="card custom-card border">
                                                    <div class="card-body text-center">
                                                        <div class="user-lock text-center">
                                                            <div class="dropdown text-left">
                                                                <a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fe fe-more-vertical"></i> </a>
                                                                <div class="dropdown-menu dropdown-menu-right shadow">
                                                                    <a class="dropdown-item" href="#"> <i class="fe fe-message-square ml-2"></i> پیام </a>
                                                                    <a class="dropdown-item" href="#"> <i class="fe fe-edit-2 ml-2"></i> ویرایش اطلاعات </a>
                                                                    <a class="dropdown-item" href="#"> <i class="fe fe-trash-2 ml-2"></i> حذف کاربر </a>
                                                                </div>
                                                            </div>
                                                            <img class="rounded-circle" src="{{asset($user->image)}}">
                                                        </div>
                                                        <h5 class=" mb-1 mt-3 main-content-label">{{$user->name}}</h5>
                                                        <p class="mb-2 mt-1 tx-inverse">{{$user->level}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="main-content-body tab-pane p-4 border-top-0" id="usercreate">
                                    <div class="card-body border">
                                        <form class="form-horizontal" action="{{ route('register') }}" method="POST">
                                            {{csrf_field()}}
                                            <div class="mb-4 main-content-label">ایجاد حساب</div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">نام و نام خانوادگی</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="name" class="form-control" placeholder="نام و نام خانوادگی"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">نام کاربری</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="username" class="form-control" placeholder="نام کاربری"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">پست الکترونیک</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" name="email" class="form-control" placeholder="پست الکترونیک" > </div>
                                                </div>
                                            </div>
                                            <div class="mb-4 main-content-label">سطح دسترسی</div>
                                            <div class="form-group ">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label class="form-label">انتخاب سطح دسترسی</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <select name="level" class="form-control select-lg select2">
                                                            <option value="">انتخاب سطح دسترسی</option>
                                                            @foreach($roles as $role)
                                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-lg ripple btn-success">ثبت اطلاعات</button>
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

<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<!-- Internal Gallery js-->
<script src="{{asset('admin/assets/plugins/gallery/picturefill.js')}}"></script>
<script src="{{asset('admin/assets/plugins/gallery/lightgallery.js')}}"></script>
<script src="{{asset('admin/assets/plugins/gallery/lightgallery-1.js')}}"></script>
<script src="{{asset('admin/assets/plugins/gallery/lg-pager.js')}}"></script>
<script src="{{asset('admin/assets/plugins/gallery/lg-autoplay.js')}}"></script>
<script src="{{asset('admin/assets/plugins/gallery/lg-fullscreen.js')}}"></script>
<script src="{{asset('admin/assets/plugins/gallery/lg-zoom.js')}}"></script>
<script src="{{asset('admin/assets/plugins/gallery/lg-hash.js')}}"></script>
<script src="{{asset('admin/assets/plugins/gallery/lg-share.js')}}"></script>
@endsection
