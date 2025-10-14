@extends('admin.layouts.app', ['title' => 'داشبورد'])

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">داشبورد</h3>
                    </div>
                    <!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                    class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="drodown">
                                            <a href="#"
                                                class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                                data-bs-toggle="dropdown">
                                                <em class="d-none d-sm-inline icon ni ni-calender-date"></em><span>30 روز
                                                    <span class="d-none d-md-inline">گذشته</span></span>
                                                <em class="dd-indc icon ni ni-chevron-right"></em>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="#"><span>30 روز گذشته</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><span>6 ماه گذشته</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><span>1 سال گذشته</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="#" class="btn btn-primary"><em
                                                class="icon ni ni-reports"></em><span>گزارش ها</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- .nk-block-head-content -->
                </div>
                <!-- .nk-block-between -->
            </div>
            <!-- .nk-block-head -->
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">سفارشات امروز</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ $todayOrders }}</div>
                                            <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- .card-inner -->
                            </div>
                            <!-- .nk-ecwg -->
                        </div>
                        <!-- .card -->
                    </div>
                    <!-- .col -->
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">درآمد امروز</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div><span class="amount money">{{ $todayIncome }}</span> تومان</div>
                                            <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayRevenue"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- .card-inner -->
                            </div>
                            <!-- .nk-ecwg -->
                        </div>
                        <!-- .card -->
                    </div>
                    <!-- .col -->
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg6">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">مشتریان امروز</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ $todayCustomers }}</div>
                                            <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayCustomers"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- .card-inner -->
                            </div>
                            <!-- .nk-ecwg -->
                        </div>
                        <!-- .card -->
                    </div>
                    <div class="col-xxl-6">
                        <div class="card card-full shadow-sm">
                            <div class="nk-ecwg nk-ecwg8 h-100">
                                <div class="card-inner">
                                    <div class="card-title-group mb-4 d-flex justify-content-between align-items-center">
                                        <div class="card-title">
                                            <h6 class="title mb-0">👥 کاربران آنلاین</h6>
                                            <span class="text-muted small">وضعیت ۵ دقیقه اخیر</span>
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-5">
                                        <!-- کل کاربران آنلاین -->
                                        <div class="col-md-4 ">
                                            <div class="card bg-primary text-white text-center shadow-sm h-100 rounded-3">
                                                <div class="card-body p-3">
                                                    <div class="fs-3 fw-bold mb-1">{{ $onlineVisitors }}</div>
                                                    <div class="fw-semibold">کل آنلاین‌ها</div>
                                                    <small class="text-white-50">کاربران + مهمان‌ها</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- کاربران لاگین کرده -->
                                        <div class="col-md-4">
                                            <div class="card bg-success text-white text-center shadow-sm h-100 rounded-3">
                                                <div class="card-body p-3">
                                                    <div class="fs-3 fw-bold mb-1">{{ $onlineUsers }}</div>
                                                    <div class="fw-semibold">کاربران</div>
                                                    <small class="text-white-50">ورود کرده‌اند</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- مهمان‌ها -->
                                        <div class="col-md-4">
                                            <div class="card bg-warning text-dark text-center shadow-sm h-100 rounded-3">
                                                <div class="card-body p-3">
                                                    <div class="fs-3 fw-bold mb-1">{{ $onlineGuests }}</div>
                                                    <div class="fw-semibold">مهمان‌ها</div>
                                                    <small class="text-dark-50">بدون ورود</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- .card-inner -->
                            </div>
                        </div>
                        <!-- .card -->
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-title-group mb-2">
                                    <div class="card-title">
                                        <h6 class="title">آمار فروشگاه</h6>
                                    </div>
                                </div>
                                <ul class="nk-store-statistics">
                                    <li class="item">
                                        <div class="info">
                                            <div class="title">سفارشات</div>
                                            <div class="count">{{ $allOrders }}</div>
                                        </div>
                                        <em class="icon bg-primary-dim ni ni-bag"></em>
                                    </li>
                                    <li class="item">
                                        <div class="info">
                                            <div class="title">مشتریان</div>
                                            <div class="count">{{ $allUser }}</div>
                                        </div>
                                        <em class="icon bg-info-dim ni ni-users"></em>
                                    </li>
                                    <li class="item">
                                        <div class="info">
                                            <div class="title">محصولات</div>
                                            <div class="count">{{ $allProduct }}</div>
                                        </div>
                                        <em class="icon bg-pink-dim ni ni-box"></em>
                                    </li>
                                    <li class="item">
                                        <div class="info">
                                            <div class="title">سفارشات هفته اخیر</div>
                                            <div class="count">{{ $paidOrdersLastWeek }}</div>
                                        </div>
                                        <em class="icon bg-purple-dim ni ni-server"></em>
                                    </li>
                                </ul>
                            </div>
                            <!-- .card-inner -->
                        </div>
                        <!-- .card -->
                    </div>
                    <!-- .col -->
                    <div class="col-xxl-9">
                        <div class="card card-full">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">سفارشات اخیر</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-list mt-n2">
                                <div class="nk-tb-item nk-tb-head">
                                    <div class="nk-tb-col">
                                        {{-- <span>شماره سفارش</span> --}}
                                    </div>
                                    <div class="nk-tb-col tb-col-sm">
                                        <span>مشتری</span>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span>تاریخ</span>
                                    </div>
                                    <div class="nk-tb-col"><span>مبلغ</span></div>
                                    <div class="nk-tb-col">
                                        <span class="d-none d-sm-inline">وضعیت</span>
                                    </div>
                                </div>
                                @foreach ($recentOrders as $order)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"><a href="#">{{ $loop->iteration }}</a></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <div class="user-card">
                                                <div class="user-avatar sm bg-purple-dim">
                                                    <span>{{ mb_substr($order->user->first_name ?? '', 0, 1) }}{{ mb_substr($order->user->last_name ?? '', 0, 1) }}</span>
                                                </div>
                                                <div class="user-name">
                                                    <span class="tb-lead">{{ $order->user->full_name ?? '---' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                            <span class="tb-sub">{{ getJalaliTime($order->created_at, 'd F Y') }}</span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub tb-amount">{{ number_format($order->final_amount) }}
                                                <span>تومان</span></span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="badge badge-dot badge-dot-xs bg-success">پرداخت شده</span>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <!-- .card -->
                    </div>
                    {{-- <div class="col-xxl-4 col-md-8 col-lg-6">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-title-group mb-2">
                                    <div class="card-title">
                                        <h6 class="title">محصولات برتر</h6>
                                    </div>
                                    <div class="card-tools">
                                        <div class="dropdown">
                                            <a href="#"
                                                class="dropdown-toggle link link-light link-sm dropdown-indicator"
                                                data-bs-toggle="dropdown">هفتگی</a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="#"><span>روزانه</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="active"><span>هفتگی</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><span>ماهانه</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nk-top-products">
                                    <li class="item">
                                        <div class="thumb">
                                            <img src="./images/product/a.png" alt="" />
                                        </div>
                                        <div class="info">
                                            <div class="title">ردیاب تناسب اندام صورتی</div>
                                            <div class="price">99,000 تومان</div>
                                        </div>
                                        <div class="total">
                                            <div class="amount">990,000 تومان</div>
                                            <div class="count">10 عدد فروخته شده</div>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="thumb">
                                            <img src="./images/product/b.png" alt="" />
                                        </div>
                                        <div class="info">
                                            <div class="title">ساعت هوشمند بنفش</div>
                                            <div class="price">99,000 تومان</div>
                                        </div>
                                        <div class="total">
                                            <div class="amount">990,000 تومان</div>
                                            <div class="count">10 عدد فروخته شده</div>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="thumb">
                                            <img src="./images/product/c.png" alt="" />
                                        </div>
                                        <div class="info">
                                            <div class="title">ساعت هوشمند مشکی</div>
                                            <div class="price">99,000 تومان</div>
                                        </div>
                                        <div class="total">
                                            <div class="amount">990,000 تومان</div>
                                            <div class="count">10 عدد فروخته شده</div>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="thumb">
                                            <img src="./images/product/d.png" alt="" />
                                        </div>
                                        <div class="info">
                                            <div class="title">هدفون مشکی</div>
                                            <div class="price">99,000 تومان</div>
                                        </div>
                                        <div class="total">
                                            <div class="amount">990,000 تومان</div>
                                            <div class="count">10 عدد فروخته شده</div>
                                        </div>
                                    </li>
                                    <li class="item">
                                        <div class="thumb">
                                            <img src="./images/product/e.png" alt="" />
                                        </div>
                                        <div class="info">
                                            <div class="title">هدفون آیفون 7</div>
                                            <div class="price">99,000 تومان</div>
                                        </div>
                                        <div class="total">
                                            <div class="amount">990,000 تومان</div>
                                            <div class="count">10 عدد فروخته شده</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- .card-inner -->
                        </div>
                        <!-- .card -->
                    </div> --}}
                    <!-- .col -->
                </div>
                <!-- .row -->
            </div>
            <!-- .nk-block -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.querySelectorAll('.money').forEach((item) => {
            const regex = /(\d)(?=(\d{3})+$)/g;
            item.textContent = item.textContent.toString().replace(regex, '$1,');
        })
    </script>

    <script src="{{ asset('assets/admin/js/charts/chart-ecommerce.js') }}"></script>
@endsection
