<div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{route('home')}}" target="blank" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('assets/app/images/Logo.jpg') }}" srcset="{{ asset('assets/app/images/Logo.jpg') }} alt="لوگو" />
                <img class="logo-dark logo-img" src="{{ asset('assets/app/images/Logo.jpg') }}" srcset="{{ asset('assets/app/images/Logo.jpg') }}"
                    alt="لوگوی تاریک" />
                <img class="logo-small logo-img logo-img-small" src="{{ asset('assets/app/images/Logo.jpg') }}"
                    srcset="{{ asset('assets/app/images/Logo.jpg') }}" alt="لوگوی کوچک" />
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div>
    <!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">
                            کاربران
                        </h6>
                    </li>
                    <!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.user.users.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                            <span class="nk-menu-text">مدیریت کاربران</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route('admin.user.roles.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-list"></em></span>
                            <span class="nk-menu-text">مدیریت نقش ها</span>
                        </a>
                    </li>
                    <!-- .nk-menu-item -->
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">فروشگاه</h6>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.market.products.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-cart-fill"></em></span>

                            <span class="nk-menu-text">محصولات</span>
                        </a>
                    </li>
                    <!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.market.brands.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-block-over"></em></span>
                            <span class="nk-menu-text">برندها</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.market.categories.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-list-thumb-alt"></em></span>

                            <span class="nk-menu-text">دسته بندی ها</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.market.sliders.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-layer"></em></span>
                            <span class="nk-menu-text">اسلایدر</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route('admin.market.pages.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-cards"></em></span>
                            <span class="nk-menu-text">صفحه ها</span>
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route('admin.market.faqs.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-question"></em></em></span>
                            <span class="nk-menu-text">سوالات متداول</span>
                        </a>
                    </li>
                    
                    <li class="nk-menu-item">
                        <a href="{{ route('admin.market.comments.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-comments"></em></span>
                            <span class="nk-menu-text">کامنت ها</span>
                            <span class="badge rounded-pill bg-primary" style="margin-left: 10px">{{ $comments->count() == 1 ? $comments->count() : null }}</span> 
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route('admin.market.shipping-methods.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-swap"></em></span>
                            <span class="nk-menu-text">روش های ارسال</span>
                            <span class="badge rounded-pill bg-primary" style="margin-left: 10px">{{ $comments->count() == 1 ? $comments->count() : null }}</span> 
                        </a>
                    </li>

                    <li class="nk-menu-item">
                        <a href="{{ route('admin.market.discount-codes.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-ticket"></em></span>
                            <span class="nk-menu-text">کد تخفیف</span>
                            <span class="badge rounded-pill bg-primary" style="margin-left: 10px">{{ $comments->count() == 1 ? $comments->count() : null }}</span> 
                        </a>
                    </li>
                </ul>
                <!-- .nk-menu -->
            </div>
            <!-- .nk-sidebar-menu -->
        </div>
        <!-- .nk-sidebar-content -->
    </div>
    <!-- .nk-sidebar-element -->
</div>
