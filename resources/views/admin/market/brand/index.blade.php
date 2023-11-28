@extends('admin.layouts.app', ['title' => 'برند ها'])

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
            <li class="breadcrumb-item active ">برندها </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title mt-2">برندها</h3>
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
                                        <li>
                                            <div class="drodown">
                                                <a href="#"
                                                    class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                    data-bs-toggle="dropdown">نمایش</a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li>
                                                            <a class="{{ request('paginate') == 10 ? 'active' : ''}}" href="{{ url()->current() }}?paginate=10"><span>10</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="{{ request('paginate') == 25 ? 'active' : ''}}" href="{{ url()->current() }}?paginate=25"><span>25</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="{{ request('paginate') == 50 ? 'active' : ''}}" href="{{ url()->current() }}?paginate=50"><span>50</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="{{ request('paginate') == 100 ? 'active' : ''}}" href="{{ url()->current() }}?paginate=100"><span>100</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="{{ request('paginate') == 250 ? 'active' : ''}}" href="{{ url()->current() }}?paginate=250"><span>250</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="{{ request('paginate') == 500 ? 'active' : ''}}" href="{{ url()->current() }}?paginate=500"><span>500</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            
                                            <a href="{{ route('admin.market.brands.create') }}" type=""
                                                class="btn btn-primary d-md-inline-flex"><em
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
                                
                            </div>
                            <div class="nk-tb-col "><span>نام فارسی برند</span></div>
                            <div class="nk-tb-col"><span>نام اصلی برند</span></div>
                            <div class="nk-tb-col text-end"><span>تنظیمات</span></div>


                        </div>
                        <!-- .nk-tb-item -->
                        @foreach ($brands as $brand)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        {{ $loop->iteration }}
                                    </div>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-product">
                                        <img src="{{ asset($brand->logo) }}" alt="" class="thumb">
                                        <span class="title">{{ $brand->persian_name }}</span>
                                    </span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-product">
                                        <span class="title">{{ $brand->original_name }}</span>
                                    </span>
                                </div>

                                <div class="nk-tb-col nk-tb-col-tools ">
                                    <ul class="nk-tb-actions gx-1">

                                        <li class="nk-tb-action">
                                            <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="نمایش محصولات این برند">
                                                <em class="icon ni ni-eye-fill"></em>
                                            </a>
                                        </li>
                                        <li class="nk-tb-action">
                                            <a href="{{ route('admin.market.brands.edit', $brand->id) }}"
                                                class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="ویرایش">
                                                <em class="icon ni ni-edit-fill"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach

                        <!-- .nk-tb-item -->

                    </div>
                </div>
                @empty($brands)
                    <div class="card">
                        <div class="card-inner">
                            <small>
                                هیچ برندی اضافه نشده
                            </small>
                        </div>
                    </div>
                @endempty

                {{ $brands->appends($_GET)->render() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.alerts.toastr.success')
@endsection

