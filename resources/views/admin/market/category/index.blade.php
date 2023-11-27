@extends('admin.layouts.app', ['title' => 'دسته بندی های محصولات'])

@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">دسته بندی ها</h3>
                    </div>
                    <!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em
                                    class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                            <input type="text" class="form-control" id="default-04"
                                                placeholder="جستجوی سریع بر اساس شناسه" />
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
                                                        <a href="#"><span>دسته بندی ها جدید</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><span>ویژه</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><span>ناموجود</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nk-block-tools-opt">
                                        <a href="{{ route('admin.market.categories.create') }}"
                                            class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                        <a href="{{ route('admin.market.categories.create') }}"
                                            class="btn btn-primary d-none d-md-inline-flex"><em
                                                class="icon ni ni-plus"></em><span>افزودن دسته </span></a>
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
                <div class="nk-tb-list is-separate mb-3">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="pid" />
                                <label class="custom-control-label" for="pid"></label>
                            </div>
                        </div>
                        <div class="nk-tb-col tb-col-sm"><span>عنوان</span></div>
                        <div class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1 my-n1">
                                <li class="me-n1">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                            data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li>
                                                    <a href="#"><em class="icon ni ni-edit"></em><span>ویرایش انتخاب
                                                            شده</span></a>
                                                </li>
                                                <li>
                                                    <a href="#"><em class="icon ni ni-trash"></em><span>حذف انتخاب
                                                            شده</span></a>
                                                </li>
                                                <li>
                                                    <a href="#"><em class="icon ni ni-bar-c"></em><span>به روز رسانی
                                                            موجودی</span></a>
                                                </li>
                                                <li>
                                                    <a href="#"><em class="icon ni ni-invest"></em><span>به روز رسانی
                                                            قیمت</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- .nk-tb-item -->
                    @foreach($categories as $category)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="pid1" />
                                    <label class="custom-control-label" for="pid1"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <span class="tb-product">
                                    <img src="./images/product/a.png" alt="{{ $category->image }}" class="thumb" />
                                    <span class="title">{{ $category->name }}</span>
                                </span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li class="nk-tb-action">
                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="نمایش داخل سایت">
                                            <em class="icon ni ni-eye-fill"></em>
                                        </a>
                                    </li>
                                    <li class="nk-tb-action">
                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="ویرایش">
                                            <em class="icon ni ni-edit-fill"></em>
                                        </a>
                                    </li>
                                    <li class="nk-tb-action">
                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="حذف ">
                                            <em class="icon ni ni-cross-fill-c"></em>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
            </div>
            <div class="card">
                <div class="card-inner">
                    <small>
                        هیچ دسته ای وجود ندارد.    
                    </small>    
                </div>
            </div>
            <!-- .nk-tb-list -->
            <div class="card">
                <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                        <div class="g">
                            <ul class="pagination justify-content-center justify-content-md-start">
                                <li class="page-item">
                                    <a class="page-link" href="#"><em
                                            class="icon ni ni-chevrons-left"></em></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item">
                                    <span class="page-link"><em class="icon ni ni-more-h"></em></span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                <li class="page-item"><a class="page-link" href="#">7</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><em
                                            class="icon ni ni-chevrons-right"></em></a>
                                </li>
                            </ul>
                            <!-- .pagination -->
                        </div>
                        <div class="g">
                            <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                <div>صفحه</div>
                                <div>
                                    <select class="form-select js-select2" data-search="on"
                                        data-dropdown="xs center">
                                        <option value="page-1">1</option>
                                        <option value="page-2">2</option>
                                        <option value="page-4">4</option>
                                        <option value="page-5">5</option>
                                        <option value="page-6">6</option>
                                        <option value="page-7">7</option>
                                        <option value="page-8">8</option>
                                        <option value="page-9">9</option>
                                        <option value="page-10">10</option>
                                        <option value="page-11">11</option>
                                        <option value="page-12">12</option>
                                        <option value="page-13">13</option>
                                        <option value="page-14">14</option>
                                        <option value="page-15">15</option>
                                        <option value="page-16">16</option>
                                        <option value="page-17">17</option>
                                        <option value="page-18">18</option>
                                        <option value="page-19">19</option>
                                        <option value="page-20">20</option>
                                    </select>
                                </div>
                                <div>از 102</div>
                            </div>
                        </div>
                        <!-- .pagination-goto -->
                    </div>
                    <!-- .nk-block-between -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
