<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg toggle-screen-lg"
    data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
    <div class="card-inner-group" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="left: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: auto; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <div class="card-inner">
                                <div class="user-card ">
                                    <div>
                                        @if (auth()->user()->image)
                                            <img src="{{ asset(auth()->user()->image) }}" alt=""
                                                class="user-avatar" id="avatar-image"
                                                style="width: 50px; height: 50px; object-fit: cover ">
                                        @else
                                            <img id="avatar-image" class="icon ni ni-user-alt user-avatar">
                                        @endif
                                    </div>
                                    <div class="user-info px-1">
                                        <span class="lead-text">{{ auth()->user()->fullName }}</span>
                                        <span class="sub-text">{{ auth()->user()->email ?? 'ایمیلی ندارید' }}</span>
                                    </div>
                                    <div class="user-action">
                                        <div class="dropdown">
                                            <a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown"
                                                href="#"><em class="icon ni ni-more-v"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <form action="{{ route('admin.user.profile.image', $user->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                     @csrf
                                                    @method('put')
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a style="cursor: pointer" for="file-input">
                                                                <input type="file" name="image"
                                                                    class="hide-file-input btn" id="file-input"
                                                                    onchange="displayImage(event)">
                                                                <label for="file-input"
                                                                    class="icon ni ni-camera-fill"></label><span for="file-input">تغییر
                                                                    عکس</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                           
                                                            <a style="cursor: pointer">
                                                                <button type="submit" style="background: transparent; border: none"><em
                                                                        class="icon ni ni-edit-fill"></em><span>به
                                                                        روز رسانی پروفایل</span>
                                                                </button>
                                                            </a>
                                                    </ul>
                                                    </li>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- .user-card -->
                            </div>
                            <!-- .card-inner -->
                            {{-- <div class="card-inner">
            <div class="user-account-info py-0">
                <h6 class="overline-title-alt">موجودی حساب</h6>
                <div class="user-balance">12,395,000 <small class="currency currency-btc">تومان</small></div>
                <div class="user-balance-sub">
                    در انتظار <span>1,344,000 <span class="currency currency-btc">تومان</span></span>
                </div>
            </div>
        </div> --}}
                            <!-- .card-inner -->
                            <div class="card-inner p-0">
                                <ul class="link-list-menu">
                                    <li>
                                        <a class="{{ isActiveLink('admin.user.profile.index') ? 'active' : '' }}"
                                            href="{{ route('admin.user.profile.index') }}"><em
                                                class="icon ni ni-user-fill-c"></em><span>اطلاعات شخصی</span></a>
                                    </li>
                                    {{-- <li class="disabled">
                    <a class="disabled" href="#"><em class="icon ni ni-bell-fill disabled"></em><span class="disabled">اطلاع رسانی ها</span></a>
                </li>
                <li>
                    <a href="#"><em class="icon ni ni-activity-round-fill"></em><span>فعالیت های حساب کاربری</span></a> --}}
                                    </li>
                                    <li>
                                        <a class="{{ isActiveLink('admin.user.profile.security') ? 'active' : '' }}"
                                            href="{{ route('admin.user.profile.security') }}"><em
                                                class="icon ni ni-lock-alt-fill"></em><span>تنظیمات امنیتی</span></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- .card-inner -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 451px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
        </div>
    </div>
    <!-- .card-inner-group -->
</div>


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
@endsection
