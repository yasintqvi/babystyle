@extends('admin.layouts.app', ['title' => 'سفارشات'])

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">سفارشات</h3>
                    </div>
                    <!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                    class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-search"></em>
                                        </div>
                                        <input type="text" name="search" required onkeyup="searchRequest(this)"
                                            class="form-control" id="default-04" placeholder="جستجوی سریع بر اساس شناسه" />
                                    </li>
                                    <li>
                                        <div class="drodown">
                                            <a href="#"
                                                class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                data-bs-toggle="dropdown">نمایش</a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}?paginate=10"
                                                            onclick="filterRequest(event, this)"><span>15</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}?paginate=25"
                                                            onclick="filterRequest(event, this)"><span>25</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}?paginate=50"
                                                            onclick="filterRequest(event, this)"><span>50</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}?paginate=100"
                                                            onclick="filterRequest(event, this)"><span>100</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}?paginate=250"
                                                            onclick="filterRequest(event, this)"><span>250</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}?paginate=500"
                                                            onclick="filterRequest(event, this)"><span>500</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="drodown">
                                            <a href="#"
                                                class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                data-bs-toggle="dropdown">وضعیت</a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}"
                                                            onclick="filterRequest(event, this)"><span>همه</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}?status=delivered"
                                                            onclick="filterRequest(event, this)"><span>تکمیل شده</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}?status=processing"
                                                            onclick="filterRequest(event, this)"><span>تایید و ارسال مرسوله</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}?status=order_confirm"
                                                            onclick="filterRequest(event, this)"><span>در انتظار تایید</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.orders.fetch') }}?status=unpaid"
                                                            onclick="filterRequest(event, this)"><span>ناموفق</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- .nk-block-head-content -->
                </div>
                <!-- .nk-block-between -->
            </div>
        </div>
    </div>

    <form action="" method="post" class="nk-tb-list is-separate mb-3" id="table-container">
        <div class="d-flex justify-content-center align-items-center" style="height: 20rem">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">در حال بارگذاری...</span>
            </div>
        </div>
    </form>


    <div id="pagination-container"></div>


    <script id="table-template" type="text/x-handlebars-template">
        <div class="nk-tb-item nk-tb-head">
            <div class="nk-tb-col nk-tb-col-check">
                <div class="custom-control custom-control-sm custom-checkbox notext">
                    <input type="checkbox" class="custom-control-input" id="selectAll" />
                    <label class="custom-control-label" for="selectAll"></label>
                </div>
            </div>
            <div class="nk-tb-col"><span>نام سفارش دهنده</span></div>
            <div class="nk-tb-col tb-col-md"><span>تاریخ سفارش</span></div>
            <div class="nk-tb-col tb-col-md"><span>هزینه ارسال</span></div>
            <div class="nk-tb-col tb-col-md"><span>مبلغ تخفیف</span></div>
            <div class="nk-tb-col tb-col-md"><span>مبلغ کل محصولات</span></div>
            <div class="nk-tb-col tb-col-md"><span>مبلغ نهائی</span></div>
            <div class="nk-tb-col tb-col-md"><span>وضعیت سفارش</span></div>
            <div class="nk-tb-col nk-tb-col-tools">
                <ul class="nk-tb-actions gx-1 my-n1">
                    <li class="me-n1">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon px-2 d-none" id="btn-batch-operation" data-bs-toggle="dropdown">
                                عملیات گروهی
                                <em class="icon ni ni-more-h"></em>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                    <li>
                                        <a href="" onclick="batchEdit(event)"><em class="icon ni ni-eye"></em><span>نمایش انتخاب
                                                شده</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @csrf
        @verbatim
        {{#each data}}
            <div class="nk-tb-item">
                <div class="nk-tb-col nk-tb-col-check">
                    <div class="custom-control custom-control-sm custom-checkbox notext">
                        <input type="checkbox" name="ids[]" data-edit="/admin/market/orders/{{ id }}" value="{{ id }}" class="custom-control-input batch-inputs" id="id-{{ id }}" />
                        <label class="custom-control-label" for="id-{{ id }}"></label>
                    </div>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-product">
                        <label for="id-{{ id }}" class="title">{{ customer_name }}</label>
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-product">
                        <label for="id-{{ id }}">{{ shamsi_order_date }}</label>
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-product">
                        <label for="id-{{ id }}"><span class="money">{{ shipping_amount }}</span> تومان</label>
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-product">
                        <label for="id-{{ id }}"><span class="money">{{ order_discount }}</span> تومان</label>
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-product">
                        <label for="id-{{ id }}"><span class="money">{{ total_products_amount }}</span> تومان</label>
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-product">
                        <label for="id-{{ id }}" class="title"><span class="money">{{ final_amount }}</span> تومان</label>
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-product">
                        {{#ifEquals order_status '0' }}
                            <span class="badge badge-sm badge-dot has-bg bg-danger d-none d-sm-inline-flex">پرداخت ناموفق</span>
                        {{/ifEquals}}   

                        {{#ifEquals order_status '1' }}
                            <span class="badge badge-sm badge-dot has-bg bg-warning d-none d-sm-inline-flex">پرداخت شده - در انتظار تایید</span>
                        {{/ifEquals}}    
                        
                        {{#ifEquals order_status '2' }}
                            <span class="badge badge-sm badge-dot has-bg bg-info d-none d-sm-inline-flex">آماده سازی و ارسال مرسوله</span>
                        {{/ifEquals}}    

                        {{#ifEquals order_status '3' }}
                            <span class="badge badge-sm badge-dot has-bg bg-success d-none d-sm-inline-flex">تحویل داده شده</span>
                        {{/ifEquals}}   
                    </span>
                </div>
                <div class="nk-tb-col nk-tb-col-tools">
                    <ul class="nk-tb-actions gx-1">
                        {{#ifNotEquals order_status '2' }}
                        {{#ifNotEquals order_status '0' }}
                        <li class="nk-tb-action">
                            <button onclick="changeStatus(event)" data-id="{{ id }}" data-status="2" class="btn btn-icon btn-trigger btn-tooltip" data-toggle="tooltip" data-placement="top" title="تایید سفارش و ارسال مرسوله"> <em class="icon ni ni-truck"></em></button></li>
                        {{/ifNotEquals}}  
                        {{/ifNotEquals}}  

                        {{#ifNotEquals order_status '3' }}
                        {{#ifNotEquals order_status '0' }}
                        <li class="nk-tb-action">
                            <button onclick="changeStatus(event)" data-id="{{ id }}" data-status="3" class="btn btn-icon btn-trigger btn-tooltip" data-toggle="tooltip" data-placement="top" title="علامت گذاری به عنوان تحویل داده شده"> <em class="icon ni ni-check-thick"></em></button></li>
                        {{/ifNotEquals}}   
                        {{/ifNotEquals}}   

                        <li class="nk-tb-action">
                            <a href="/admin/market/orders/{{ id }}" class="btn btn-icon btn-trigger btn-tooltip" data-toggle="tooltip" data-placement="top" title="مشاهده جزئیات سفارش"> <em class="icon ni ni-eye"></em></a>
                        </li>
                    </ul>
                </div>
            </div>
        {{/each}}
        @endverbatim
    </script>

    @include('admin.pagination')
@endsection

@section('script')
    <script src="{{ asset('assets/app/js/popper.min.js') }}"></script>
    {{-- include alerts --}}
    @include('admin.alerts.toastr.success')
    @include('admin.alerts.sweet-alert.confirm')

    <script src="{{ asset('assets/admin/js/handlebars.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/handle-data.js') }}"></script>

    <script>
        'use strict'
        const defaultUrl = "{{ route('admin.market.orders.fetch') }}";
        handleData(defaultUrl);

        async function changeStatus(event) {
            event.preventDefault();

            const {
                currentTarget
            } = event;

            const orderId = currentTarget.dataset.id;
            const orderStatus = currentTarget.dataset.status;

            try {
                const response = await fetch(`/admin/market/orders/${orderId}/change-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        'order_id': orderId,
                        'order_status': orderStatus,
                        '_token': "{{ csrf_token() }}"
                    })
                });

                const data = await response.json();

                if (data.success) {
                    NioApp.Toast('به عنوان تحویل داده شده علامت گذاری شد.', 'success');
                    handleData(defaultUrl);
                } else {
                    NioApp.Toast('عملیات غیر مجاز است.', 'error')
                }

            } catch (err) {
                console.error('Error: ', err);
            }
        }
    </script>
@endsection
