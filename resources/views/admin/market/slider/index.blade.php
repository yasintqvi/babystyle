@extends('admin.layouts.app', ['title' => 'اسلایدر'])

@section('content')
    <nav>
        <ul class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
            <li class="breadcrumb-item active ">اسلایدر </li>
        </ul>
    </nav>



    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title mt-2">اسلایدر</h3>
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
                                                            <a class="{{ request('paginate') == 10 ? 'active' : '' }}"
                                                                href="{{ url()->current() }}?paginate=10"><span>10</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="{{ request('paginate') == 25 ? 'active' : '' }}"
                                                                href="{{ url()->current() }}?paginate=25"><span>25</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="{{ request('paginate') == 50 ? 'active' : '' }}"
                                                                href="{{ url()->current() }}?paginate=50"><span>50</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="{{ request('paginate') == 100 ? 'active' : '' }}"
                                                                href="{{ url()->current() }}?paginate=100"><span>100</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="{{ request('paginate') == 250 ? 'active' : '' }}"
                                                                href="{{ url()->current() }}?paginate=250"><span>250</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="{{ request('paginate') == 500 ? 'active' : '' }}"
                                                                href="{{ url()->current() }}?paginate=500"><span>500</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" class="toggle btn btn-icon btn-primary d-md-none"><em
                                                    class="icon ni ni-plus"></em></a>
                                            <a href="{{ route('admin.market.sliders.create') }}" type=""
                                                class="btn btn-primary d-none d-md-inline-flex"><em
                                                    class="icon ni ni-plus"></em><span>افزودن اسلایدر</span></a>
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
                            <div class="nk-tb-col tb-col-sm"><span>alt نصویر</span></div>
                            <div class="nk-tb-col"><span>وضعیت</span></div>
                            <div class="nk-tb-col"><span>تنظیمات</span></div>


                        </div>
                        <!-- .nk-tb-item -->
                        @foreach ($sliders as $slider)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        {{ $loop->iteration }}
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <span class="tb-product">
                                        <img src="{{ asset($slider->image) }}" alt="" class="thumb">
                                        <span class="title">{{ $slider->alt }}</span>
                                    </span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <span class="tb-product">
                                        <span
                                            class="{{ $slider->getRawOriginal('is_active') ? 'bg-success' : 'bg-danger' }} badge-dot has-bg  d-none d-sm-inline-flex">{{ $slider->is_active }}</span>
                                        <span class="title"></span>
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
                                                            <a
                                                                href="{{ route('admin.market.sliders.edit', $slider->id) }}"><em
                                                                    class="icon ni ni-edit"></em><span>ویرایش
                                                                    برند</span></a>
                                                        </li>
                                                        <form
                                                            action="{{ route('admin.market.sliders.destroy', $slider->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <li>
                                                                <a>
                                                                    <em class="icon ni ni-trash">
                                                                    </em><button type="submit"
                                                                        class="border-none btn-transparent bg-transparent text-decoration-none  ml-3">حذف
                                                                        اسلاید</button>
                                                                </a>
                                                            </li>
                                                        </form>
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

                    @empty($sliders)
                        <div class="card">
                            <div class="card-inner">
                                <small>
                                    هیچ دسته ای وجود ندارد.
                                </small>
                            </div>
                        </div>
                    @endempty

                    {{ $sliders->appends($_GET)->render() }}
                </div>
            </div>
        </div>
    </div>
@endsection
