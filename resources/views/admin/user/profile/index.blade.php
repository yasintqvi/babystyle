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
                                                <h4 class="nk-block-title">اطلاعات شخصی</h4>

                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">اطلاعات و ویرایش حساب کاربری</h6>
                                            </div>
                                            <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">نام کامل</span>
                                                    <span class="data-value">{{ auth()->user()->fullName }}</span>
                                                </div>
                                                <div class="data-col data-col-end">
                                                    <span class="data-more"><em class="icon ni ni-forward-ios"></em></span>
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">شماره تماس</span>
                                                    <span class="data-value">{{ auth()->user()->phone_number }}</span>
                                                </div>
                                                <div class="data-col">
                                                    <span class="data-label">ایمیل</span>
                                                    <span class="data-value">{{ auth()->user()->email }}</span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <!-- .nk-block -->
                                </div>
                                @include('admin.user.profile.aside')
                                <!-- card-aside -->
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
    <!-- .modal -->
    <form action="{{ route('admin.user.profile.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" role="dialog" id="profile-edit">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-lg">
                        <h5 class="title">به روز رسانی پروفایل</h5>
                        <ul class="nk-nav nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personal">شخصی</a>
                            </li>
                        </ul>
                        <!-- .nav-tabs -->

                        <div class="tab-content">
                            <div class="tab-pane active" id="personal">
                                <div class="row gy-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">نام </label>
                                            <input type="text" name="first_name" class="form-control form-control-lg"
                                                id="full-name" value="{{ auth()->user()->first_name }}"
                                                placeholder="نام  خود را وارد کنید" />
                                            @error('first_name')
                                                <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">نام خانوادگی</label>
                                            <input type="text" name="last_name" class="form-control form-control-lg"
                                                id="full-name" value="{{ auth()->user()->last_name }}"
                                                placeholder="نام خانوادگی خود را وارد کنید" />
                                            @error('last_name')
                                                <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no"> ایمیل:</label>
                                            <input type="email" name="email" class="form-control form-control-lg"
                                                id="phone-no" value="{{ auth()->user()->email }}" placeholder="ایمیل" />
                                            @error('email')
                                                <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">شماره تلفن</label>
                                            <input type="text" name="phone_number"
                                                class="form-control form-control-lg" id="phone-no"
                                                value="0{{ auth()->user()->phone_number }}" placeholder="شماره تلفن" />
                                            @error('phone_number')
                                                <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                                    <strong>
                                                        {{ $message }}
                                                    </strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                            <li>
                                                <button class="btn btn-lg btn-primary">به روز رسانی پروفایل</button>
                                            </li>
                                            <li>
                                                <a href="#" data-bs-dismiss="modal" class="link link-light">لغو</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .tab-content -->
                    </div>
                    <!-- .modal-body -->
                </div>
                <!-- .modal-content -->
            </div>
            <!-- .modal-dialog -->
        </div>
        <!-- .modal -->
    </form>
@endsection
