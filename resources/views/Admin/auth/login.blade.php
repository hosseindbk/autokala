@extends('layouts.admin')

@section('main')
<body class="main-body leftmenu">
    <div class="page main-signin-wrapper">
        <div class="row signpages text-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row row-sm">
                    <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
                        <div class="mt-5 pt-4 p-2 pos-absolute">
                            <div class="clearfix"></div>
                            <img src="{{asset('admin/assets/img/svgs/user.svg')}}" class="ht-100 mb-0" alt="user">
                            <h5 class="mt-4 text-white">داشبورد مدیریتی اتوکالا</h5>
                            <span class="tx-white-6 tx-13 mb-5 mt-xl-0">برای ورود به داشبورد باید نام کاربری و رمز عبور دریافت نمایید</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
                        <div class="container-fluid">
                            <div class="row row-sm">
                                <div class="card-body mt-2 mb-2">
                                    <div class="clearfix"></div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <h5 class="text-right mb-2">ورود به حساب مدیریتی</h5>
                                        <div class="form-group text-right">
                                            <label>ایمیل</label>
                                            <input type="email" name="email" class="text-left form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                                        </div>
                                        <div class="form-group text-right">
                                            <label>رمز عبور</label>
                                            <input type="password" id="pass" required name="password" class="form-control @error('password') is-invalid @enderror" />
                                            <i class="fa fa-eye-slash" style="float: left;margin-top: -25px;margin-left: 15px;" onclick="togglePassword()"></i>
                                        </div>
                                        <button class="btn ripple btn-main-primary btn-block">ورود</button>
                                    </form>
                                    <div class="text-right mt-5 ml-0">
                                        <div class="mb-1"><a href="#">رمز عبور خود را فراموش کرده اید؟</a></div>
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
    <script type="text/javascript">
        function togglePassword(){
            x = document.getElementById("togglePassword")
            y = document.getElementById("pass")

            if (y.type ==="password") {
                y.type = 'text';
            } else{
                y.type="password";
                y.innerHTML = "Show"
            }
        }
    </script>
@endsection
