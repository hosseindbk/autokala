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
                                                <a href="{{url('profile-info')}}" class=""><i class="mdi mdi-tooltip-text-outline"></i>
                                                    اطلاعات حساب
                                                </a>
                                            </li>
                                            <li class="profile-account-nav-item navigation-link-dashboard">
                                                <a href="{{url('profile-myoffer')}}" class="active"><i class="mdi mdi-account-outline"></i>
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
                                        <div class="text-center"><h3 class="main-content-label text-center text-info">نمایش اطلاعات آگهی ها</h3></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-xs-12 pl">
                            <div class="shop-archive-content mt-3">
                                <h3 class="text-center text-dark">آگهی های ثبت شده</h3>
                                <div class="product-items">
                                    <div class="row">
                            @foreach($offers as $offer)
                                    @if($offer->user_id == Auth::user()->id)

                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-3">
                                                    <section class="product-box product product-type-simple" style="border: 1px solid #3fcee0;">
                                                        <div style="float: right">
                                                            @if($offer->status == 1)
                                                                <button class="btn btn-warning">درحال بررسی </button>
                                                            @elseif($offer->status == 4)
                                                                <button class="btn btn-success">تایید مدیر</button>
                                                            @endif

                                                        </div>
                                                        <div style="float: left">
                                                            <a href="{{route('offer-edit' , $offer->id)}}" class="btn btn-info">ویرایش</a>
                                                        </div>
                                                        <div class="thumb ">
                                                            @if($offer->status == 4)
                                                            <a href="{{url('market'.'/'.$offer->slug)}}" target="_blank" class="d-block">
                                                                <img src="{{asset($offer->image1)}}" class="mt-3" style="height: 235px;" alt="{{$offer->title_offer}}">
                                                            </a>
                                                            @else
                                                                <img src="{{asset($offer->image1)}}" class="mt-3" style="height: 235px;" alt="{{$offer->title_offer}}">
                                                            @endif
                                                        </div>
                                                        <div class="title">
                                                            <h3>{{ \Illuminate\Support\Str::limit($offer->title_offer, 21, $end='...') }}</h3>
                                                        </div>
                                                        <div class="title">
                                                                <span class="amount">{{number_format($offer->single_price)}}
                                                                    <span>تومان</span>
                                                                </span>
                                                        </div>
                                                        <div class="title">
                                                            @if($offer->brand_id != null)
                                                                @foreach($brandnames as $brandname)
                                                                    @if($offer->id == $brandname->offer_id)
                                                                        {{$brandname->title_fa}}
                                                                    @endif
                                                                @endforeach
                                                            @elseif($offer->brand_id == null)
                                                                {{$offer->brand_name}}
                                                            @endif
                                                        </div>
                                                        <div class="price">
                                                            <span class="amount">{{jdate($offer->created_at)->ago()}}</span>
                                                        </div>
                                                    </section>
                                                </div>
                                            @endif
                                        @endforeach
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
