@extends('Admin.admin')
@section('title')
    <title> تغییر دسته بندی </title>
@endsection
@section('first')
    <link href="{{ asset("css/admin/formlayout.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('main')
@section('menu')
    <li class="active"><a class="parent-item" href="{{url('admin/categories')}}">مدیریت دسته بندی ها</a><i class="fa fa-angle-left"></i></li>
    <li class="active">تغییرات دسته بندی&nbsp;</li>

@endsection

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card card-box">
                        <div class="card-head">
                            <header>ورود اطلاعات دسته بندی</header>
                        </div>
                        @foreach($categories as $category)
                        <div class="card-body" id="bar-parent">
                            <form action="{{ route('categories.update', $category->id )}}" method="post" id="form_sample_1" class="form-horizontal">
                                {{csrf_field()}}
                                {{ method_field('PATCH') }}
                                @include('error')
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">نام دسته بندی<span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <input type="text" name="title" data-required="1" value="{{$category->title}}" class="form-control input-height" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3">وضعیت نمایش<span class="required"> * </span>
                                        </label>
                                        <div class="col-md-5">
                                            <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-3">
                                                @if($category->status == 0)
                                                    <input type="checkbox" name="status"  id="switch-3" class="mdl-switch__input">
                                                @elseif($category->status == 1)
                                                    <input type="checkbox" name="status"  id="switch-3" class="mdl-switch__input" checked>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-t-20 text-center">
                                        <button type="submit" class="btn btn-info  btn-lg m-r-20">ذخیره اطلاعات</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                            @endforeach
                    </div>
                </div>
            </div>
@endsection
