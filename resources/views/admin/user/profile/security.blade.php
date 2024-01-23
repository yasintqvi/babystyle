@extends('admin.layouts.app', ['title' => 'ادمین'])

@section('head-tag')
@endsection

@section('content')

<div class="nk-content">
    @if ($errors->any())
    <div class="alert alert-danger d-flex flex-column" role="alert">
        @foreach ($errors->all() as $error)
            <div class="mt-2">{{ $error }}</div>
        @endforeach
    </div>
@endif
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head nk-block-head-lg">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">تنظیمات امنیتی</h4>
                                            <div class="nk-block-des">
                                                <p>این تنظیمات به شما کمک می کند حساب خود را ایمن نگه دارید.</p>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content align-self-start d-lg-none">
                                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- .nk-block-head -->
                                <form action="{{route('admin.user.change-password', auth()->user()->id)}}" method="POST">
                                    @csrf
                                <div class="nk-block">
                                        <div class="form-group">
                                            <label class="form-label" for="default-01">کلمه عبور فعلی                                            </label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="old_password" class="form-control" id="default-01" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="default-02">کلمه عبور جدید                                            </label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="password" class="form-control" id="default-02">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="default-03">تایید کلمه عبور                                           </label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="password_confirmation" class="form-control" id="default-03">
                                            </div>
                                        </div>
                                        <!-- .card-inner-group -->

                                        <li class="col-sm-6 col-lg-3">
                                            <button class="btn btn-primary">تغییر رمز عبور</button>
                                        </li>
                                    <!-- .card -->
                                </div>
                            </form>
                                <!-- .nk-block -->
                            </div>
                            <!-- .card-inner -->
                            @include('admin.user.profile.aside')
                    
                            <!-- .card-aside -->
                        </div>
                        <!-- .card-aside-wrap -->
                    </div>
                    <!-- .card -->
                </div>
                <!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

@endsection