@extends('Admin.admin')
@section('title')
    <title> داشبورد مدیریتی بستا</title>
@endsection
@section('main')
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="row row-sm">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="row row-sm  mt-lg-4">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="card bg-primary custom-card card-box">
                                    <div class="card-body p-4">
                                        <div class="row align-items-center">
                                            <div class="offset-xl-12 offset-sm-12 col-xl-12 col-sm-12 col-12 img-bg ">
                                                <h4 class="d-flex  mb-3">
                                                    <span class="font-weight-bold text-white ">پیام ادمین</span>
                                                </h4>
                                                <p class="tx-white-7 mb-1">شما در پنل باید اطلاعات خود را تکمیل نمایید تا اجازه دسترسی برای {{Auth::user()->name}}  عزیز فعال گردد.</p></div>
                                            <img src="{{asset('admin/assets/img/pngs/work3.png')}}" alt="user-img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-header border-bottom-0">
                                <div>
                                    <label class="main-content-label mb-2">نرخ بازدید وبسایت </label>
                                    <span class="d-block tx-12 mb-0 text-muted">نرخ بازدید وب سایت بصورت ماهانه می باشد</span>
                                </div>
                            </div>
                            <div class="card-body pl-0">
                                <div class="">
                                    <div class="container">
                                        <canvas id="chartLine" class="chart-dropshadow2 ht-250"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($submenudashboards as $submenudashboard)
                        @if($submenudashboard->title == 'users')
                            @can($submenudashboard->namayesh)
                                <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="card custom-card mg-b-20">
                            <div class="card-body" style="max-height: 500px; overflow: auto;">
                                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                                    <div>
                                        <label class="main-content-label mb-2">کاربران وبسایت </label>
                                    </div>
                                </div>
                                <div class="table-responsive tasks">
                                    <table class="table card-table table-vcenter text-nowrap mb-0  border">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-10p">نام و نام خانوادگی</th>
                                            <th class="wd-lg-20p">شماره موبایل</th>
                                            <th class="wd-lg-20p">ایمیل</th>
                                            <th class="wd-lg-20p">نوع همکاری</th>
                                            <th class="wd-lg-20p">زمان ثبت </th>
                                            <th class="wd-lg-20p">وضعیت</th>
                                            <th class="wd-lg-20p">ویرایش اطلاعات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td class="text-primary">{{$user->name}}</td>
                                                <td class="text-nowrap">{{$user->phone}}</td>
                                                <td class="text-nowrap">{{$user->email}}</td>
                                                <td class="text-nowrap">
                                                    @foreach($typeusers as $type_user)
                                                        @if($type_user->id == $user->type_id)
                                                            {{$type_user->title}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{jdate($user->created_at)->ago()}}</td>
                                                <td class="text-nowrap">
                                                    @if($user->status == 1)
                                                        <button class="btn ripple btn-outline-info">ثبت نام اولیه</button>
                                                    @elseif($user->status == 2)
                                                        <button class="btn ripple btn-outline-success">تایید مدیر</button>
                                                    @elseif($user->status == 0)
                                                        <button class="btn ripple btn-outline-warning">غیر فعال</button>
                                                    @endif
                                                </td>
                                                <td  class="text-nowrap">
                                                    <a href="{{ route('siteusers.edit' , $user->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                            @endcan
                        @endif
                            @if($submenudashboard->title == 'suppliers')
                                @can($submenudashboard->namayesh)
                                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="card custom-card mg-b-20">
                            <div class="card-body" style="max-height: 500px; overflow: auto;">
                                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                                    <div>
                                        <label class="main-content-label mb-2">تامین کنندگان جدید </label>
                                    </div>
                                </div>
                                <div class="table-responsive tasks">
                                    <table class="table card-table table-vcenter text-nowrap mb-0  border">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-20p">نام فروشگاه</th>
                                            <th class="wd-lg-10p">نام و نام خانوادگی مدیر</th>
                                            <th class="wd-lg-10p">وضعیت کاربر</th>
                                            <th class="wd-lg-20p">شماره موبایل</th>
                                            <th class="wd-lg-20p">ایمیل</th>
                                            <th class="wd-lg-20p">زمان ثبت</th>
                                            <th class="wd-lg-20p">وضعیت</th>
                                            <th class="wd-lg-20p">ویرایش اطلاعات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($suppliers as $supplier)
                                            <tr>
                                                <td class="text-primary">{{$supplier->title}}</td>
                                                <td class="text-primary">{{$supplier->manager}}</td>
                                                <td class="text-primary">
                                                    @foreach($users as $user)
                                                        @if($user->id == $technical_unit->user_id)
                                                            @if($user->type_id == 1)
                                                                <a href="{{ route('siteusers.edit' , $user->id ) }}">
                                                                <h6 class="text-success">کاربر فروشگاه</h6>
                                                                </a>
                                                            @elseif($user->type_id == 3)
                                                                <a href="{{ route('siteusers.edit' , $user->id ) }}">
                                                                <h6 class="text-warning">کاربر تعمیرگاه</h6>
                                                                </a>
                                                            @elseif($user->type_id == 4)
                                                                <a href="{{ route('siteusers.edit' , $user->id ) }}">
                                                                    <h6 class="text-danger">کاربر عادی</h6>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-nowrap">{{$supplier->mobile}}</td>
                                                <td class="text-nowrap">{{$supplier->email}}</td>
                                                <td>{{jdate($supplier->created_at)->ago()}}</td>
                                                <td>
                                                    @foreach($statuses as $status)
                                                        @if($status->id == $supplier->status)
                                                            @if($status->id == 1)
                                                                <button class="btn ripple btn-outline-warning">{{$status->title}}</button>
                                                            @elseif($status->id == 2)
                                                                <button class="btn ripple btn-outline-primary">{{$status->title}}</button>
                                                            @elseif($status->id == 3)
                                                                <button class="btn ripple btn-outline-info">{{$status->title}}</button>
                                                            @elseif($status->id == 4)
                                                                <button class="btn ripple btn-outline-success">{{$status->title}}</button>
                                                            @elseif($status->id == 5)
                                                                <button class="btn ripple btn-outline-light">{{$status->title}}</button>
                                                            @elseif($status->id == 6)
                                                                <button class="btn ripple btn-outline-danger">{{$status->title}}</button>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td  class="text-nowrap">
                                                    <a href="{{ route('suppliers.edit' , $supplier->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                                 @endcan
                            @endif
                            @if($submenudashboard->title == 'technicalunits')
                                @can($submenudashboard->namayesh)
                                    <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="card custom-card mg-b-20">
                            <div class="card-body" style="max-height: 500px; overflow: auto;">
                                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                                    <div>
                                        <label class="main-content-label mb-2">واحدهای خدمات فنی جدید </label>
                                    </div>
                                </div>
                                <div class="table-responsive tasks">
                                    <table class="table card-table table-vcenter text-nowrap mb-0  border">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-20p">نام واحد خدمات فنی</th>
                                            <th class="wd-lg-10p">نام و نام خانوادگی مدیر</th>
                                            <th class="wd-lg-10p">وضعیت کاربر</th>
                                            <th class="wd-lg-20p">شماره موبایل</th>
                                            <th class="wd-lg-20p">ایمیل</th>
                                            <th class="wd-lg-20p">زمان ثبت</th>
                                            <th class="wd-lg-20p">وضعیت</th>
                                            <th class="wd-lg-20p">ویرایش اطلاعات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($technicalunits as $technical_unit)
                                            <tr>
                                                <td class="text-primary">{{$technical_unit->title}}</td>
                                                <td class="text-primary">{{$technical_unit->manager}}</td>
                                                <td class="text-primary">
                                                @foreach($users as $user)
                                                    @if($user->id == $technical_unit->user_id)
                                                        @if($user->type_id == 1)
                                                                <a href="{{ route('siteusers.edit' , $user->id ) }}">
                                                                    <h6 class="text-warning">کاربر فروشگاه</h6>
                                                                </a>
                                                            @elseif($user->type_id == 3)
                                                                <a href="{{ route('siteusers.edit' , $user->id ) }}">
                                                                    <h6 class="text-success">کاربر تعمیرگاه</h6>
                                                                </a>
                                                            @elseif($user->type_id == 4)
                                                                <a href="{{ route('siteusers.edit' , $user->id ) }}">
                                                                    <h6 class="text-danger">کاربر عادی</h6>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-nowrap">{{$technical_unit->mobile}}</td>
                                                <td class="text-nowrap">{{$technical_unit->email}}</td>
                                                <td>{{jdate($technical_unit->created_at)->ago()}}</td>
                                                <td>
                                                    @foreach($statuses as $status)
                                                        @if($status->id == $technical_unit->status)
                                                            @if($status->id == 1)
                                                                <button class="btn ripple btn-outline-warning">{{$status->title}}</button>
                                                            @elseif($status->id == 2)
                                                                <button class="btn ripple btn-outline-primary">{{$status->title}}</button>
                                                            @elseif($status->id == 3)
                                                                <button class="btn ripple btn-outline-info">{{$status->title}}</button>
                                                            @elseif($status->id == 4)
                                                                <button class="btn ripple btn-outline-success">{{$status->title}}</button>
                                                            @elseif($status->id == 5)
                                                                <button class="btn ripple btn-outline-light">{{$status->title}}</button>
                                                            @elseif($status->id == 6)
                                                                <button class="btn ripple btn-outline-danger">{{$status->title}}</button>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td  class="text-nowrap">
                                                    <a href="{{ route('technicalunits.edit' , $technical_unit->id) }}"  class="btn btn-outline-primary btn-xs">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                                @endcan
                            @endif
                            @if($submenudashboard->title == 'comments')
                                @can($submenudashboard->namayesh)
                                    <div class="col-sm-12 col-lg-12 col-xl-12">
                                   <div class="card custom-card mg-b-20">
                                       <div class="card-body" style="max-height: 500px; overflow: auto;">
                                           <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                                               <div>
                                                   <label class="main-content-label mb-2">پرسش و پاسخ های جدید </label>
                                               </div>
                                           </div>
                                           <div class="table-responsive tasks">
                                               <table class="table card-table table-vcenter text-nowrap mb-0  border">
                                                   <thead>
                                                   <tr>
                                                       <th class="wd-lg-20p">ردیف</th>
                                                       <th class="wd-lg-20p">شماره موبایل</th>
                                                       <th class="wd-lg-20p">متن پیام کاربر</th>
                                                       <th class="wd-lg-20p">صفحه پیام</th>
                                                       <th class="wd-lg-20p">موضوع پیام</th>
                                                       <th class="wd-lg-20p">زمان ثبت</th>
                                                       <th class="wd-lg-20p">وضعیت</th>
                                                       <th class="wd-lg-20p">ویرایش پیام</th>
                                                   </tr>
                                                   </thead>
                                                   <tbody>
                                                   <?php $i = 1 ?>
                                                   @foreach($comments as $comment)
                                                       <tr>
                                                           <td>{{$i++}}</td>
                                                           <td class="text-primary">
                                                                  {{$comment->phone}}
                                                           </td>
                                                           <td class="text-primary" style="max-width: 300px;overflow: auto;">{{$comment->comment}}</td>
                                                           <td class="text-nowrap">{{$comment->commentable_type}}</td>
                                                           <td class="text-nowrap">{{$comment->commentable_id}}</td>
                                                           <td>{{jdate($comment->created_at)->ago()}}</td>

                                                           <td>
                                                               @if($comment->approved == 0)
                                                                   <button class="btn ripple btn-outline-warning">عدم نمایش پیام</button>
                                                               @elseif($comment->approved == 1)
                                                                   <button class="btn ripple btn-outline-success"> نمایش پیام</button>
                                                               @endif

                                                           </td>
                                                           <td  class="text-nowrap">
                                                               <a href="{{ route('comments.edit' , $comment->id) }}"  class="btn btn-outline-primary btn-xs">
                                                                   <i class="fe fe-edit-2"></i>
                                                               </a>
                                                           </td>
                                                       </tr>
                                                   @endforeach
                                                   </tbody>
                                               </table>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                                @endcan
                            @endif
                            @if($submenudashboard->title == 'commentrates')
                                @can($submenudashboard->namayesh)
                                    <div class="col-sm-12 col-lg-12 col-xl-12">
                                        <div class="card custom-card mg-b-20">
                                            <div class="card-body" style="max-height: 500px; overflow: auto;">
                                                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                                                    <div>
                                                        <label class="main-content-label mb-2">نظرات جدید </label>
                                                    </div>
                                                </div>
                                                <div class="table-responsive tasks">
                                                    <table class="table card-table table-vcenter text-nowrap mb-0  border">
                                                        <thead>
                                                        <tr>
                                                            <th class="wd-lg-20p">ردیف</th>
                                                            <th class="wd-lg-20p">شماره موبایل</th>
                                                            <th class="wd-lg-20p">نام و نام خانوادگی</th>
                                                            <th class="wd-lg-20p">متن پیام کاربر</th>
                                                            <th class="wd-lg-20p">صفحه پیام</th>
                                                            <th class="wd-lg-20p">موضوع پیام</th>
                                                            <th class="wd-lg-20p">زمان ثبت</th>
                                                            <th class="wd-lg-20p">وضعیت</th>
                                                            <th class="wd-lg-20p">ویرایش پیام</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $i = 1 ?>
                                                        @foreach($commentrates as $commentrate)
                                                            <tr>
                                                                <td>{{$i++}}</td>
                                                                <td class="text-primary">{{$commentrate->phone}}</td>
                                                                <td class="text-primary">{{$commentrate->name}}</td>
                                                                <td class="text-primary" style="max-width: 300px;overflow: auto;">{{$commentrate->comment}}</td>
                                                                <td class="text-nowrap">{{$commentrate->commentable_type}}</td>
                                                                <td class="text-nowrap">{{$commentrate->commentable_id}}</td>
                                                                <td>{{jdate($commentrate->created_at)->ago()}}</td>

                                                                <td>
                                                                    @if($commentrate->approved == 0)
                                                                        <button class="btn ripple btn-outline-warning">عدم نمایش پیام</button>
                                                                    @elseif($commentrate->approved == 1)
                                                                        <button class="btn ripple btn-outline-success"> نمایش پیام</button>
                                                                    @endif

                                                                </td>
                                                                <td  class="text-nowrap">
                                                                    <a href="{{ route('commentrates.edit' , $commentrate->id) }}"  class="btn btn-outline-primary btn-xs">
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            @endif
                            @if($submenudashboard->title == 'brands')
                                @can($submenudashboard->namayesh)
                                    <div class="col-sm-12 col-lg-12 col-xl-12">
                                        <div class="card custom-card mg-b-20">
                                            <div class="card-body" style="max-height: 500px; overflow: auto;">
                                                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                                                    <div>
                                                        <label class="main-content-label mb-2">برند جدید </label>
                                                    </div>
                                                </div>
                                                <div class="table-responsive tasks">
                                                    <table class="table card-table table-vcenter text-nowrap mb-0  border">
                                                        <thead>
                                                        <tr>
                                                            <th class="wd-lg-20p">ردیف</th>
                                                            <th class="wd-lg-20p">نام برند فارسی</th>
                                                            <th class="wd-lg-20p">نام برند لاتین</th>
                                                            <th class="wd-lg-20p">نام اختصار برند</th>
                                                            <th class="wd-lg-20p">شماره موبایل</th>
                                                            <th class="wd-lg-20p">زمان ثبت</th>
                                                            <th class="wd-lg-20p">وضعیت</th>
                                                            <th class="wd-lg-20p">ویرایش پیام</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $i = 1 ?>
                                                        @foreach($brands as $brand)
                                                            <tr>
                                                                <td>{{$i++}}</td>
                                                                <td class="text-primary">{{$brand->title_fa}}</td>
                                                                <td class="text-primary">{{$brand->title_en}}</td>
                                                                <td class="text-nowrap">{{$brand->abstract_title}}</td>
                                                                <td class="text-nowrap">{{$brand->mobile}}</td>
                                                                <td>{{jdate($brand->created_at)->ago()}}</td>

                                                                <td>
                                                                    @foreach($statuses as $status)
                                                                        @if($status->id == $brand->status)
                                                                            @if($status->id == 1)
                                                                                <button class="btn ripple btn-outline-warning">{{$status->title}}</button>
                                                                            @elseif($status->id == 2)
                                                                                <button class="btn ripple btn-outline-primary">{{$status->title}}</button>
                                                                            @elseif($status->id == 3)
                                                                                <button class="btn ripple btn-outline-info">{{$status->title}}</button>
                                                                            @elseif($status->id == 4)
                                                                                <button class="btn ripple btn-outline-success">{{$status->title}}</button>
                                                                            @elseif($status->id == 5)
                                                                                <button class="btn ripple btn-outline-light">{{$status->title}}</button>
                                                                            @elseif($status->id == 6)
                                                                                <button class="btn ripple btn-outline-danger">{{$status->title}}</button>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td  class="text-nowrap">
                                                                    <a href="{{ route('brands.edit' , $brand->id) }}"  class="btn btn-outline-primary btn-xs">
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            @endif
                            @if($submenudashboard->title == 'offers')
                                @can($submenudashboard->namayesh)
                                    <div class="col-sm-12 col-lg-12 col-xl-12">
                                        <div class="card custom-card mg-b-20">
                                            <div class="card-body" style="max-height: 500px; overflow: auto;">
                                                <div class="card-header border-bottom-0 pt-0 pl-0 pr-0 d-flex">
                                                    <div>
                                                        <label class="main-content-label mb-2">پیشنهاد فروش/خرید </label>
                                                    </div>
                                                </div>
                                                <div class="table-responsive tasks">
                                                    <table class="table card-table table-vcenter text-nowrap mb-0  border">
                                                        <thead>
                                                        <tr>
                                                            <th class="wd-10p">ردیف</th>
                                                            <th class="wd-10p"> عنوان آگهی </th>
                                                            <th class="wd-10p"> نام قطعه </th>
                                                            <th class="wd-10p"> برند قطعه </th>
                                                            <th class="wd-10p"> تعداد موجودی </th>
                                                            <th class="wd-10p"> پیشنهاد جهت </th>
                                                            <th class="wd-10p"> زمان ثبت </th>
                                                            <th class="wd-10p"> وضعیت </th>
                                                            <th class="wd-10p"> تغییر </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $i = 1 ?>
                                                        @foreach($offers as $offer)
                                                            <tr>
                                                                <td class="text-nowrap">{{$i++}}</td>
                                                                <td class="text-primary">{{$offer->title_offer}}</td>
                                                                <td class="text-primary">
                                                                    @foreach($products as $product)
                                                                        @if($offer->unicode_product == $product->unicode)
                                                                            {{$product->title_fa}}
                                                                        @endif
                                                                    @endforeach
                                                                    @if($offer->product_name != null)
                                                                        {{$offer->product_name}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-nowrap">
                                                                    @foreach($allbrands as $brand)
                                                                        @if($offer->brand_id == $brand->id)
                                                                            {{$brand->title_fa}}
                                                                        @endif
                                                                    @endforeach
                                                                    @if($offer->brand_name != null)
                                                                        {{$offer->brand_name}}
                                                                    @endif
                                                                </td>
                                                                <td class="text-nowrap">{{$offer->total}}</td>
                                                                <td>@if($offer->buyorsell == 'sell')
                                                                        فروش
                                                                    @elseif($offer->buyorsell == 'buy')
                                                                        خرید
                                                                    @endif
                                                                </td>

                                                                <td>{{jdate($offer->created_at)->ago()}}</td>

                                                                <td>
                                                                    @foreach($statuses as $status)
                                                                        @if($status->id == $offer->status)
                                                                            @if($status->id == 1)
                                                                                <button class="btn ripple btn-outline-warning">{{$status->title}}</button>
                                                                            @elseif($status->id == 2)
                                                                                <button class="btn ripple btn-outline-primary">{{$status->title}}</button>
                                                                            @elseif($status->id == 3)
                                                                                <button class="btn ripple btn-outline-info">{{$status->title}}</button>
                                                                            @elseif($status->id == 4)
                                                                                <button class="btn ripple btn-outline-success">{{$status->title}}</button>
                                                                            @elseif($status->id == 5)
                                                                                <button class="btn ripple btn-outline-light">{{$status->title}}</button>
                                                                            @elseif($status->id == 6)
                                                                                <button class="btn ripple btn-outline-danger">{{$status->title}}</button>
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td  class="text-nowrap">
                                                                    <a href="{{ route('offers.edit' , $offer->id) }}"  class="btn btn-outline-primary btn-xs">
                                                                        <i class="fe fe-edit-2"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@section('end')
    <script src="{{asset('admin/assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/index.js')}}"></script>
@endsection
@endsection
