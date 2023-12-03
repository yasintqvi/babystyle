@extends('admin.layouts.app', ['title' => 'محصولات'])

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">محصولات</h3>
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
                                                        <a href="{{ route('admin.market.products.fetch') }}?paginate=10"
                                                            onclick="filterRequest(event, this)"><span>15</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.products.fetch') }}?paginate=25"
                                                            onclick="filterRequest(event, this)"><span>25</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.products.fetch') }}?paginate=50"
                                                            onclick="filterRequest(event, this)"><span>50</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.products.fetch') }}?paginate=100"
                                                            onclick="filterRequest(event, this)"><span>100</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.products.fetch') }}?paginate=250"
                                                            onclick="filterRequest(event, this)"><span>250</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.products.fetch') }}?paginate=500"
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
                                                        <a href="{{ route('admin.market.products.fetch') }}"
                                                            onclick="filterRequest(event, this)"><span>همه</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.products.fetch') }}?status=active"
                                                            onclick="filterRequest(event, this)"><span>فعال</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.market.products.fetch') }}?status=not-active"
                                                            onclick="filterRequest(event, this)"><span>غیرفعال</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="{{ route('admin.market.products.create') }}"
                                            class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                        <a href="{{ route('admin.market.products.create') }}"
                                            class="btn btn-primary d-none d-md-inline-flex"><em
                                                class="icon ni ni-plus"></em><span>افزودن محصول </span></a>
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

    <form action="{{ route('admin.market.products.batch-delete') }}" method="post" class="nk-tb-list is-separate mb-3"
        id="table-container">
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
            <div class="nk-tb-col"><span>عنوان</span></div>
            <div class="nk-tb-col tb-col-md"><span>دسته بندی</span></div>
            <div class="nk-tb-col tb-col-md"><span>برند</span></div>
            <div class="nk-tb-col tb-col-md"><span>موجودی</span></div>
            <div class="nk-tb-col tb-col-md"><span>وضعیت</span></div>
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
                                        <a href="" onclick="batchEdit(event)"><em class="icon ni ni-edit"></em><span>ویرایش انتخاب
                                                شده</span></a>
                                    </li>
                                    <li>
                                        <a href="" onclick="batchDelete(event)"><em class="icon ni ni-trash"></em><span>حذف انتخاب
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
                        <input type="checkbox" name="ids[]" data-edit="/admin/market/products/{{ id }}/edit" value="{{ id }}" class="custom-control-input batch-inputs" id="id-{{ id }}" />
                        <label class="custom-control-label" for="id-{{ id }}"></label>
                    </div>
                </div>
                <div class="nk-tb-col">
                    <span class="tb-product">
                        <img src="/{{ primary_image }}" alt="{{title}}" class="thumb">
                        <label for="id-{{ id }}" class="title">{{title}}</label>
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-product">
                        <label for="id-{{ id }}">{{ category.title }}</label>
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-product">
                        <label for="id-{{ id }}">{{ brand.persian_name }}</label>
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-product">
                        <label for="id-{{ id }}">{{ quantity }}</label>
                    </span>
                </div>
                <div class="nk-tb-col tb-col-md">
                    <span class="tb-product">
                        {{#if is_active}}
                            <span  class="badge bg-success">فعال</span>
                        {{else}}
                            <span class="badge bg-danger">غیر فعال</span>
                        {{/if}}                   
                    </span>
                </div>
                <div class="nk-tb-col nk-tb-col-tools">
                    <ul class="nk-tb-actions gx-1 my-n1">
                        <li class="me-n1">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(0px, -36.6667px, 0px);" data-popper-placement="top-start" data-popper-reference-hidden="">
                                    <ul class="link-list-opt no-bdr">
                                        <li>
                                            <a href="#"><em class="icon ni ni-eye"></em><span>مشاهده محصول</span></a>
                                        </li>
                                        <li>
                                            <a href="/admin/market/products/{{ id }}/edit"><em class="icon ni ni-edit"></em><span>ویرایش محصول</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><em class="icon ni ni-activity-round"></em><span>جزئیات در انبار</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
    {{-- include alerts --}}
    @include('admin.alerts.toastr.success')
    @include('admin.alerts.sweet-alert.confirm')

    <script src="{{ asset('assets/admin/js/handlebars.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/handle-data.js') }}"></script>
    <script>
        'use strict'
        const defaultUrl = "{{ route('admin.market.products.fetch') }}";
        handleData(defaultUrl);
    </script>
@endsection
