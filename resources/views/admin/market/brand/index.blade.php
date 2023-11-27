@extends('admin.layouts.app', ['title' => 'برند ها'])

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
            <li class="breadcrumb-item active">برندها </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">برندها</h3>
                        </div>
                        <!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                    data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input type="text" class="form-control" id="default-04"
                                                    placeholder="جستجو بر اساس نام">
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" 
                                                class="toggle btn btn-icon btn-primary d-md-none"><em
                                                    class="icon ni ni-plus"></em></a>
                                            <a href="{{ route('admin.market.brands.create') }}" type=""
                                                class="btn btn-primary d-none d-md-inline-flex"><em
                                                    class="icon ni ni-plus"></em><span>افزودن برند</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- .nk-block-head-content -->
                    </div>
                    <!-- .nk-block-between -->
                </div>





                <div class="nk-block">
                    <div class="nk-tb-list is-separate mb-3">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="pid">
                                    <label class="custom-control-label" for="pid"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-sm"><span>نام فارسی برند</span></div>
                            <div class="nk-tb-col"><span>نام اصلی برند</span></div>
                            <div class="nk-tb-col"><span>تنظیمات</span></div>


                        </div>
                        <!-- .nk-tb-item -->
                        @foreach ($brands as $brand)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="pid1">
                                        <label class="custom-control-label" for="pid1"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <span class="tb-product">
                                        <img src="{{ asset($brand->logo) }}" alt="" class="thumb">
                                        <span class="title">{{ $brand->persian_name }}</span>
                                    </span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <span class="tb-product">
                                        <span class="title">{{ $brand->original_name }}</span>
                                    </span>
                                </div>

                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class=" gx-1 my-n1">
                                        <li class="me-n1">
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                    data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a href="{{ route('admin.market.brands.edit', $brand->id) }}"><em
                                                                    class="icon ni ni-edit"></em><span>ویرایش
                                                                    برند</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        <!-- .nk-tb-item -->

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
                                    <div
                                        class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                        <div>صفحه</div>
                                        <div>
                                            <select class="form-select js-select2 select2-hidden-accessible"
                                                data-search="on" data-dropdown="xs center" data-select2-id="1"
                                                tabindex="-1" aria-hidden="true">
                                                <option value="page-1" data-select2-id="3">1</option>
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
                                            </select><span class="select2 select2-container select2-container--default"
                                                dir="rtl" data-select2-id="2" style="width: 81px;"><span
                                                    class="selection"><span
                                                        class="select2-selection select2-selection--single"
                                                        role="combobox" aria-haspopup="true" aria-expanded="false"
                                                        tabindex="0" aria-disabled="false"
                                                        aria-labelledby="select2-cstw-container"><span
                                                            class="select2-selection__rendered"
                                                            id="select2-cstw-container" role="textbox"
                                                            aria-readonly="true" title="1">1</span><span
                                                            class="select2-selection__arrow" role="presentation"><b
                                                                role="presentation"></b></span></span></span><span
                                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
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
    </div>
@endsection
