@extends('admin.layouts.app', ['title' => 'داشبورد - BABYSTYLE'])

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
                                            <div class="amount">1,945</div>
                                            <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <span class="change up text-danger"><em
                                                    class="icon ni ni-arrow-long-up"></em>4.63%</span><span> در مقایسه با
                                                هفته گذشته</span>
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
                                            <div class="amount">2,338,000 تومان</div>
                                            <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayRevenue"></canvas>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <span class="change down text-danger"><em
                                                    class="icon ni ni-arrow-long-down"></em>2.34%</span><span> در مقایسه با
                                                هفته گذشته</span>
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
                                            <div class="amount">847</div>
                                            <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayCustomers"></canvas>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <span class="change up text-danger"><em
                                                    class="icon ni ni-arrow-long-up"></em>4.63%</span><span> در مقایسه با
                                                هفته گذشته</span>
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
                                            <h6 class="title">بازدیدکنندگان امروز</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">23,485</div>
                                            <div class="nk-ecwg6-ck">
                                                <canvas class="ecommerce-line-chart-s3" id="todayVisitors"></canvas>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <span class="change down text-danger"><em
                                                    class="icon ni ni-arrow-long-down"></em>2.34%</span><span> در مقایسه با
                                                هفته گذشته</span>
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
                    <div class="col-xxl-6">
                        <div class="card card-full">
                            <div class="nk-ecwg nk-ecwg8 h-100">
                                <div class="card-inner">
                                    <div class="card-title-group mb-3">
                                        <div class="card-title">
                                            <h6 class="title">آمار فروش</h6>
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
                                    <ul class="nk-ecwg8-legends">
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#6576ff"></span>
                                                <span>کل سفارش</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#eb6459"></span>
                                                <span>سفارش لغو شده</span>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="nk-ecwg8-ck">
                                        <canvas class="ecommerce-line-chart-s4" id="salesStatistics"></canvas>
                                    </div>
                                    <div class="chart-label-group ps-5">
                                        <div class="chart-label">01 فروردین 1402</div>
                                        <div class="chart-label">30 فروردین 1402</div>
                                    </div>
                                </div>
                                <!-- .card-inner -->
                            </div>
                        </div>
                        <!-- .card -->
                    </div>
                    <!-- .col -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card card-full overflow-hidden">
                            <div class="nk-ecwg nk-ecwg7 h-100">
                                <div class="card-inner flex-grow-1">
                                    <div class="card-title-group mb-4">
                                        <div class="card-title">
                                            <h6 class="title">آمار سفارش</h6>
                                        </div>
                                    </div>
                                    <div class="nk-ecwg7-ck">
                                        <canvas class="ecommerce-doughnut-s1" id="orderStatistics"></canvas>
                                    </div>
                                    <ul class="nk-ecwg7-legends">
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#816bff"></span>
                                                <span>تکمیل شده</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#13c9f2"></span>
                                                <span>در حال پردازش</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">
                                                <span class="dot dot-lg sq" data-bg="#ff82b7"></span>
                                                <span>لغو شده</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- .card-inner -->
                            </div>
                        </div>
                        <!-- .card -->
                    </div>
                    <!-- .col -->
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
                                            <div class="count">1,795</div>
                                        </div>
                                        <em class="icon bg-primary-dim ni ni-bag"></em>
                                    </li>
                                    <li class="item">
                                        <div class="info">
                                            <div class="title">مشتریان</div>
                                            <div class="count">2,327</div>
                                        </div>
                                        <em class="icon bg-info-dim ni ni-users"></em>
                                    </li>
                                    <li class="item">
                                        <div class="info">
                                            <div class="title">محصولات</div>
                                            <div class="count">674</div>
                                        </div>
                                        <em class="icon bg-pink-dim ni ni-box"></em>
                                    </li>
                                    <li class="item">
                                        <div class="info">
                                            <div class="title">دسته بندی ها</div>
                                            <div class="count">68</div>
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
                    <div class="col-xxl-8">
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
                                        <span>شماره سفارش</span>
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
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-lead"><a href="#">#95954</a></span>
                                    </div>
                                    <div class="nk-tb-col tb-col-sm">
                                        <div class="user-card">
                                            <div class="user-avatar sm bg-purple-dim">
                                                <span>ف‌ت</span>
                                            </div>
                                            <div class="user-name">
                                                <span class="tb-lead">فرشید ترنیان</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="tb-sub">1402/08/21</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="tb-sub tb-amount">4,597,000 <span>تومان</span></span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="badge badge-dot badge-dot-xs bg-success">پرداخت شده</span>
                                    </div>
                                </div>
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-lead"><a href="#">#95850</a></span>
                                    </div>
                                    <div class="nk-tb-col tb-col-sm">
                                        <div class="user-card">
                                            <div class="user-avatar sm bg-azure-dim">
                                                <span>ف‌ا</span>
                                            </div>
                                            <div class="user-name">
                                                <span class="tb-lead">فریبا آتش دامن</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="tb-sub">1402/02/02</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="tb-sub tb-amount">597,000 <span>تومان</span></span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="badge badge-dot badge-dot-xs bg-danger">لغو شده</span>
                                    </div>
                                </div>
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-lead"><a href="#">#95812</a></span>
                                    </div>
                                    <div class="nk-tb-col tb-col-sm">
                                        <div class="user-card">
                                            <div class="user-avatar sm bg-warning-dim">
                                                <img src="./images/avatar/b-sm.jpg" alt="" />
                                            </div>
                                            <div class="user-name">
                                                <span class="tb-lead">دانیال عطاران</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="tb-sub">1402/01/02</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="tb-sub tb-amount">200,000 <span>تومان</span></span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="badge badge-dot badge-dot-xs bg-success">پرداخت شده</span>
                                    </div>
                                </div>
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-lead"><a href="#">#95256</a></span>
                                    </div>
                                    <div class="nk-tb-col tb-col-sm">
                                        <div class="user-card">
                                            <div class="user-avatar sm bg-purple-dim">
                                                <span>م‌ج</span>
                                            </div>
                                            <div class="user-name">
                                                <span class="tb-lead">مهدیه جباری</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="tb-sub">1402/01/29</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="tb-sub tb-amount">1,100,000 <span>تومان</span></span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="badge badge-dot badge-dot-xs bg-success">پرداخت شده</span>
                                    </div>
                                </div>
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-lead"><a href="#">#95135</a></span>
                                    </div>
                                    <div class="nk-tb-col tb-col-sm">
                                        <div class="user-card">
                                            <div class="user-avatar sm bg-success-dim">
                                                <span>ی‌چ</span>
                                            </div>
                                            <div class="user-name">
                                                <span class="tb-lead">یاسمن چگینی</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="tb-sub">1402/01/29</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="tb-sub tb-amount">1,100,000 <span>تومان</span></span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="badge badge-dot badge-dot-xs bg-warning">موعد پرداخت</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .card -->
                    </div>
                    <div class="col-xxl-4 col-md-8 col-lg-6">
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
                    </div>
                    <!-- .col -->
                </div>
                <!-- .row -->
            </div>
            <!-- .nk-block -->
        </div>
    </div>
@endsection
