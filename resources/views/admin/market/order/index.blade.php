@extends('admin.layouts.app', ['title' => 'سفارشات'])

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">سفارشات</h3>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                <em class="icon ni ni-more-v"></em>
                            </a>
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
                                                    @foreach ([15, 25, 50, 100, 250, 500] as $num)
                                                        <li>
                                                            <a href="{{ route('admin.market.orders.fetch') }}?paginate={{ $num }}"
                                                                onclick="filterRequest(event, this)"><span>{{ $num }}</span></a>
                                                        </li>
                                                    @endforeach
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
                                                    <li><a href="{{ route('admin.market.orders.fetch') }}"
                                                            onclick="filterRequest(event,this)"><span>همه</span></a></li>
                                                    <li><a href="{{ route('admin.market.orders.fetch') }}?status=delivered"
                                                            onclick="filterRequest(event,this)"><span>تکمیل شده</span></a>
                                                    </li>
                                                    <li><a href="{{ route('admin.market.orders.fetch') }}?status=processing"
                                                            onclick="filterRequest(event,this)"><span>تایید و ارسال
                                                                مرسوله</span></a></li>
                                                    <li><a href="{{ route('admin.market.orders.fetch') }}?status=order_confirm"
                                                            onclick="filterRequest(event,this)"><span>در انتظار
                                                                تایید</span></a></li>
                                                    <li><a href="{{ route('admin.market.orders.fetch') }}?status=unpaid"
                                                            onclick="filterRequest(event,this)"><span>ناموفق</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
        </div>
    </div>

    <!-- Handlebars Template -->
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
        <div class="nk-tb-col nk-tb-col-tools"></div>
    </div>
    @verbatim
    {{#each data}}
        <div class="nk-tb-item">
            <div class="nk-tb-col nk-tb-col-check">
                <div class="custom-control custom-control-sm custom-checkbox notext">
                    <input type="checkbox" name="ids[]" data-edit="/admin/market/orders/{{ id }}" value="{{ id }}" class="custom-control-input batch-inputs" id="id-{{ id }}" />
                    <label class="custom-control-label" for="id-{{ id }}"></label>
                </div>
            </div>
            <div class="nk-tb-col"><span class="tb-product"><label for="id-{{ id }}" class="title">{{ customer_name }}</label></span></div>
            <div class="nk-tb-col tb-col-md"><span class="tb-product"><label for="id-{{ id }}">{{ shamsi_order_date }}</label></span></div>
            <div class="nk-tb-col tb-col-md"><span class="tb-product"><label for="id-{{ id }}"><span class="money">{{ shipping_amount }}</span> تومان</label></span></div>
            <div class="nk-tb-col tb-col-md"><span class="tb-product"><label for="id-{{ id }}"><span class="money">{{ order_discount }}</span> تومان</label></span></div>
            <div class="nk-tb-col tb-col-md"><span class="tb-product"><label for="id-{{ id }}"><span class="money">{{ total_products_amount }}</span> تومان</label></span></div>
            <div class="nk-tb-col tb-col-md"><span class="tb-product"><label for="id-{{ id }}" class="title"><span class="money">{{ final_amount }}</span> تومان</label></span></div>
            <div class="nk-tb-col tb-col-md">
                <span class="tb-product">
                    {{#ifEquals order_status '0'}}<span class="badge badge-sm badge-dot has-bg bg-danger">پرداخت ناموفق</span>{{/ifEquals}}
                    {{#ifEquals order_status '1'}}<span class="badge badge-sm badge-dot has-bg bg-warning">پرداخت شده - در انتظار تایید</span>{{/ifEquals}}
                    {{#ifEquals order_status '2'}}<span class="badge badge-sm badge-dot has-bg bg-info">آماده سازی و ارسال مرسوله</span>{{/ifEquals}}
                    {{#ifEquals order_status '3'}}<span class="badge badge-sm badge-dot has-bg bg-success">تحویل داده شده</span>{{/ifEquals}}
                </span>
            </div>
            <div class="nk-tb-col nk-tb-col-tools p-1">
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
                        {{#ifNotEquals order_status '0'}}
                       <li class="nk-tb-action">
                        {{#if tracking_code}}
                            <button type="button"
                                    class="btn btn-primary btn-sm btn-tracking"
                                    data-id="{{ id }}"
                                    data-tracking="{{ tracking_code }}">
                                رهگیری
                            </button>
                        {{else}}
                            <button type="button"
                                    class="btn btn-warning btn-sm btn-tracking"
                                    data-id="{{ id }}"
                                    data-tracking="">
                                رهگیری
                            </button>
                        {{/if}}
                    </li>
                {{/ifNotEquals}}
                    </ul>
                </div>
            
        </div>
    {{/each}}
    @endverbatim
</script>

    <!-- Tracking Modal (یکبار در صفحه) -->
    <div class="modal fade" id="trackingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">ثبت کد رهگیری</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="modal_order_id">
                    <div class="form-group">
                        <label for="tracking_code_input" class="form-label">کد رهگیری</label>
                        <input type="text" class="form-control" id="tracking_code_input"
                            placeholder="کد رهگیری را وارد کنید">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <button type="button" class="btn btn-primary" onclick="saveTrackingCode()">ذخیره</button>
                </div>
            </div>
        </div>
    </div>

    @include('admin.pagination')
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/handlebars.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/handle-data.js') }}"></script>
    <script>
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
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        order_status: orderStatus
                    })
                });
                const data = await response.json();
                if (data.success) {
                    NioApp.Toast(data.message, 'success');
                    handleData(defaultUrl);
                } else {
                    NioApp.Toast('عملیات غیر مجاز است.', 'error');
                }
            } catch (err) {
                console.error(err);
                NioApp.Toast('خطا در ارتباط با سرور', 'error');
            }
        }

        document.addEventListener('click', function(e) {
            if (e.target.matches('.btn-tracking')) {
                const orderId = e.target.dataset.id;
                const trackingCode = e.target.dataset.tracking;

                document.getElementById('modal_order_id').value = orderId;
                document.getElementById('tracking_code_input').value = trackingCode || '';

                const modal = new bootstrap.Modal(document.getElementById('trackingModal'));
                modal.show();
            }
        });
        async function saveTrackingCode() {
            const orderId = document.getElementById('modal_order_id').value;
            const trackingCode = document.getElementById('tracking_code_input').value;

            const url = `/admin/market/orders/${orderId}/tracking-code`;

            try {
                const response = await fetch(`/admin/market/orders/${orderId}/tracking-code`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        tracking_code: trackingCode
                    })
                });

                const data = await response.json();



                if (data.success) {
                    NioApp.Toast(data.message, 'success');
                    handleData(defaultUrl);

                    const modal = bootstrap.Modal.getInstance(document.getElementById('trackingModal'));
                    modal.hide();
                    document.getElementById('tracking_code_input').value = '';
                } else {
                    NioApp.Toast(data.message || 'خطا در ثبت کد رهگیری', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                NioApp.Toast('خطا در ارتباط با سرور', 'error');
            }
        }
    </script>
@endsection
