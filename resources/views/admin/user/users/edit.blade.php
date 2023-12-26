@extends('admin.layouts.app', ['title' => 'ویرایش کاربر'])

@section('content')
    <ul class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.market.brands.index') }}">کاربران</a></li>
        <li class="breadcrumb-item active">ویرایش کاربر </li>
    </ul>

    <!-- .nk-block-head-content -->
    <div class="nk-block-between mb-4 mt-2">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">ویرایش کاربر </h3>
        </div>
        <!-- .nk-block-head-content -->
        <a href="{{ route('admin.user.users.index') }}" class="btn btn-success">بازگشت</a>
        <!-- .nk-block-head-content -->
    </div>

    @if ($errors->has('password'))
        <div class="alert alert-danger d-flex flex-column" role="alert">
            @foreach ($errors->all() as $error)
                <div class="mt-2">{{ $error }}</div>
            @endforeach
        </div>
    @endif



    <div class="nk-block">
        <form class="row g-gs" action="{{ route('admin.user.users.update', $user->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-lg-4 col-xl-4 col-xxl-3">
                <div class="card">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            <div class="user-card user-card-s2 ">
                                <div class="profile-size lg bg-primary">
                                    <img id="avatar-image" class="profile-size" alt="">
                                    <input type="file" name="image" class="hide-file-input" id="file-input"
                                        onchange="displayImage(event)">
                                </div>
                                <label for="file-input" class="overline-title p-2">عکس کاربر را انتخاب کنید</label>
                                <h5>آپلود تصویر شاخص</h5>
                                @error('image')
                                    <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>

                        </div>


                        <div class="card-inner">
                            <div class="col-lg-7">
                                <h6 class="title mb-3">دسترسی های کاربر</h6>
                                <ul class="custom-control-group">
                                    <li>
                                        <div class="custom-control custom-checkbox custom-control-pro no-control">
                                            <input type="checkbox" name="is_banned" class="custom-control-input"
                                                id="btnIconRadio1" value="1" @checked(old('is_banned', $user->is_banned))>
                                            <label class="custom-control-label" for="btnIconRadio1"><em
                                                    class="icon ni ni-user-cross"></em><span>کاربر مسدود
                                                    باشد</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox custom-control-pro no-control">
                                            <input type="checkbox" name="phone_verified_at" class="custom-control-input"
                                                name="phone_verified_at" id="btnIconRadio2"
                                                @if ($user->phone_verified_at) disabled @endif value="1"
                                                @checked(old('phone_verified_at', $user->phone_verified_at ?? false))>
                                            <label class="custom-control-label" for="btnIconRadio2"><em
                                                    class="icon ni ni-mobile"></em></em><span>شماره تلفن تایید
                                                    شود</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox custom-control-pro no-control checked">
                                            <input type="checkbox" class="custom-control-input" name="email_verified_at"
                                                id="btnIconRadio3" @if ($user->email_verified_at) disabled @endif
                                                value="1" @checked(old('email_verified_at', $user->email_verified_at ?? false))>
                                            <label class="custom-control-label" for="btnIconRadio3"><em
                                                    class="icon ni ni-mail"></em><span>ایمیل تایید شود</span></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="custom-control custom-checkbox custom-control-pro no-control">
                                            <input type="checkbox" class="custom-control-input myButton" name="is_staff"
                                                id="btnIconRadio4" value="1" @checked(old('is_staff', $user->is_staff))>
                                            <label class="custom-control-label" for="btnIconRadio4">
                                                <em class="icon ni ni-account-setting-fill"></em><span>به این کاربر مجوز
                                                    داده شود</span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="card-inner">
                            <button type="button" class="btn btn-outline-info justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#modalDefault"><em
                                    class="icon ni ni-lock-alt ml-5"></em> تغییر کلمه عبور</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .col -->
            <div class="col-lg-8 col-xl-8 col-xxl-9">
                <div class="card">
                    <div class="card-inner">
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fv-first-name">نام :</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="fv-first-name" name="first_name"
                                            value="{{ old('first_name', $user->first_name) }}">
                                    </div>
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
                                    <label class="form-label" for="fv-last-name">نام خانوادگی :</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="fv-last-name" name="last_name"
                                            value="{{ old('last_name', $user->last_name) }}">
                                    </div>
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
                                    <label class="form-label" for="fv-email">ایمیل (اختیاری) : </label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="fv-email" name="email"
                                            value="{{ old('email', $user->email) }}">
                                    </div>
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
                                    <label class="form-label" for="fv-phone">شماره تلفن : </label>
                                    <div class="form-control-wrap">
                                        <input type="number" class="form-control" id="fv-phone" name="phone_number"
                                            value="{{ old('phone_number', 0 . $user->phone_number) }}">
                                    </div>
                                    @error('phone_number')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 mt-3">
                                <div class="form-group ">
                                    <label class="form-label" for="fv-full-name">وضعیت</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-control-lg custom-switch">
                                            <input type="checkbox" name="is_active" value="1"
                                                class="custom-control-input" @checked(old('is_active', $user->is_active)) id="is_active">
                                            <label class="custom-control-label" for="is_active">فعال</label>
                                        </div>
                                    </div>
                                    @error('is_active')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6 justify-content-start">
                                <div class="form-group d-flex justify-content-end">
                                    <button type="submit" class="btn btn-lg btn-primary">ویرایش اطلاعات</button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- .card-inner -->
                </div>
                <!-- .card -->
                <div class="card hide-on-unchecked">
                    <div class="card-inner">
                        یشس
                    </div>
                </div>
            </div>
            <!-- .col -->
        </form>
        <!-- کد محتوای مودال -->
        <form action="{{ route('admin.user.change-password', $user->id) }}" method="POST">
            @csrf
            <div class="modal fade zoom" tabindex="-1" id="modalDefault">
                <div class="modal-dialog " role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تغیر رمز عبور</h5>
                            <a href="#" class="close" data-bs-dismiss="modal" aria-label="بستن">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 p-2">
                                <div class="form-group">
                                    <label class="form-label" for="fv-password">کلمه عبور فعلی: </label>
                                    <div class="form-control-wrap">
                                        <input type="password" class="form-control" id="fv-password" name="password"
                                            value="{{ old('password') }}">
                                    </div>
                                    @error('password')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 p-2">
                                <div class="form-group">
                                    <label class="form-label" for="password_confirmation">تکرار کلمه عبور :
                                    </label>
                                    <div class="form-control-wrap">
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" value="{{ old('password_confirmation') }}">
                                    </div>
                                    @error('password_confirmation')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button class="btn btn-primary">تایید</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>




        <!-- .row -->
    </div>
@endsection

@section('script')
    <script>
        function displayImage(event) {
            var input = event.target;
            var image = document.getElementById('avatar-image');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    image.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        var checkbox = document.getElementById("btnIconRadio4");
        var div = document.querySelector(".hide-on-unchecked");

        checkbox.addEventListener("change", function() {
            if (this.checked) {
                div.style.display = "block";
            } else {
                div.style.display = "none";
            }
        });
        
        if (checkbox.checked) {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    </script>
@endsection
