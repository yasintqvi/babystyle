@extends('admin.layouts.app', ['title' => 'ادمین'])

@section('head-tag')
    <script src="https://cdn.jsdelivr.net/npm/handlebars@4.7.8/dist/cjs/handlebars.min.js"></script>
@endsection

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">ادمین</h3>
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
                                                        <a href="{{ route('admin.user.users.fetch') }}?paginate=10"
                                                            onclick="filterRequest(event, this)"><span>15</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.user.users.fetch') }}?paginate=25"
                                                            onclick="filterRequest(event, this)"><span>25</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.user.users.fetch') }}?paginate=50"
                                                            onclick="filterRequest(event, this)"><span>50</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.user.users.fetch') }}?paginate=100"
                                                            onclick="filterRequest(event, this)"><span>100</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.user.users.fetch') }}?paginate=250"
                                                            onclick="filterRequest(event, this)"><span>250</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.user.users.fetch') }}?paginate=500"
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
                                                        <a href="{{ route('admin.user.users.fetch') }}"
                                                            onclick="filterRequest(event, this)"><span>همه</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.user.users.fetch') }}?status=active"
                                                            onclick="filterRequest(event, this)"><span>فعال</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.user.users.fetch') }}?status=not-active"
                                                            onclick="filterRequest(event, this)"><span>غیرفعال</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="{{ route('admin.user.users.create') }}"
                                            class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                        <a href="{{ route('admin.user.users.create') }}"
                                            class="btn btn-primary d-none d-md-inline-flex"><em
                                                class="icon ni ni-plus"></em><span>افزودن کاربر </span></a>
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

    <form action="" method="post" class="nk-tb-list is-separate mb-3"
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
                    <input type="checkbox" name="ids[]" data-edit="/admin/user/users/{{ id }}/edit" value="{{ id }}" class="custom-control-input batch-inputs" id="id-{{ id }}" />
                    <label class="custom-control-label" for="id-{{ id }}"></label>
                </div>
            </div>
            <div class="nk-tb-col">
                <span class="tb-product">
                    <label for="id-{{ id }}" class="title">{{#if first_name}} {{first_name}} {{last_name}} {{else}} 0{{phone_number}} {{/if}}  </label>
                </span>
            </div>
            <div class="nk-tb-col nk-tb-col-tools">
                <ul class="nk-tb-actions gx-1">
                    <li class="nk-tb-action">
                        {{#if is_active}}
                            <span  class="badge bg-success">فعال</span>
                        {{else}}
                            <span class="badge bg-danger">غیر فعال</span>
                        {{/if}}
                    </li>
                  
                    <li class="nk-tb-action">
                        <a href="/admin/user/users/{{ id }}/edit"
                            class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="ویرایش">
                            <em class="icon ni ni-edit-fill"></em>
                        </a>
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
    @include('admin.alerts.toastr.success')
    @include('admin.alerts.sweet-alert.confirm')
    <script src="{{ asset('assets/admin/js/handlebars.min.js') }}"
        integrity="sha512-E1dSFxg+wsfJ4HKjutk/WaCzK7S2wv1POn1RRPGh8ZK+ag9l244Vqxji3r6wgz9YBf6+vhQEYJZpSjqWFPg9gg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/admin/js/handle-data.js') }}"></script>
    <script>
        'use strict'
        const defaultUrl = "{{ route('admin.user.users.fetch') }}";
        handleData(defaultUrl);
    </script>
@endsection
