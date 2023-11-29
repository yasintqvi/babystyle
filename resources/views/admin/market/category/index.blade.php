@extends('admin.layouts.app', ['title' => 'دسته بندی های محصولات'])

@section('head-tag')
    <script src="https://cdn.jsdelivr.net/npm/handlebars@4.7.8/dist/cjs/handlebars.min.js"></script>
@endsection

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
                                        <form action="" class="form-control-wrap">
                                            <div class="form-icon form-icon-right">
                                                <em class="icon ni ni-search"></em>
                                            </div>
                                            <input type="text" name="search" required class="form-control"
                                                id="default-04" placeholder="جستجوی سریع بر اساس شناسه" />
                                        </form>
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
                                    <li>
                                        <div class="drodown">
                                            <a href="#"
                                                class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white"
                                                data-bs-toggle="dropdown">وضعیت</a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a class="{{ request('active') == 'true' ? 'active' : '' }}"
                                                            href="{{ url()->current() }}?active=true"><span>فعال</span></a>
                                                    </li>
                                                    <li>
                                                        <a class="{{ request('active') == 'false' ? 'active' : '' }}"
                                                            href="{{ url()->current() }}?active=false"><span>غیرفعال</span></a>
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
            @if (request()->query())
                <div class="nk-block">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            @if (request('search'))
                                <span class="badge p-1 w-10 bg-outline-secondary">جستجو:
                                    {{ request('search') }}</span>
                            @endif
                            @if (request('paginate'))
                                <span class="badge p-1 w-10 bg-outline-secondary mx-2">نمایش در هر صفحه :
                                    {{ request('paginate') }}</span>
                            @endif
                            @if (request('page'))
                                <span class="badge p-1 w-10 bg-outline-secondary">صفحه :
                                    {{ request('page') }}</span>
                            @endif
                            @if (request('active'))
                                <span class="badge p-1 w-10 bg-outline-secondary mx-2">وضعیت:
                                    {{ request('active') == 'true' ? 'فعال' : 'غیرفعال' }}</span>
                            @endif
                        </div>
                        <a href="{{ url()->current() }}" class="btn btn-dark">
                            <em class="icon ni ni-filter mx-1"></em>
                            حذف فیلتر
                        </a>
                    </div>
                </div>
            @endif
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
                        <div class="nk-tb-col"><span>عنوان</span></div>
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
                    @foreach ($categories as $category)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="pid1" />
                                    <label class="custom-control-label" for="pid1"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-product">
                                    <span class="title">{{ $category->title }}</span>
                                </span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li class="nk-tb-action">
                                        @if ($category->is_active)
                                            <span class="badge bg-success">فعال</span>
                                        @else
                                            <span class="badge bg-danger">غیر فعال</span>
                                        @endif
                                    </li>
                                    <li class="nk-tb-action">
                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="نمایش داخل سایت">
                                            <em class="icon ni ni-eye-fill"></em>
                                        </a>
                                    </li>
                                    <li class="nk-tb-action">
                                        <a href="{{ route('admin.market.categories.edit', $category->id) }}"
                                            class="btn btn-trigger btn-icon" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="ویرایش">
                                            <em class="icon ni ni-edit-fill"></em>
                                        </a>
                                    </li>
                                    <li class="nk-tb-action">
                                        <form action="{{ route('admin.market.categories.destroy', $category->id) }}"
                                            method="post" class="delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-trigger btn-icon"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="حذف ">
                                                <em class="icon ni ni-cross-fill-c"></em>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
                @empty($categories)
                    <div class="card">
                        <div class="card-inner">
                            <small>
                                هیچ دسته ای وجود ندارد.
                            </small>
                        </div>
                    </div>
                @endempty

                {{ $categories->appends($_GET)->render() }}

            </div>
        </div>
    </div>
@endsection

@section('script')

    @include('admin.alerts.toastr.success')
    @include('admin.alerts.sweet-alert.confirm')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.8/handlebars.min.js" integrity="sha512-E1dSFxg+wsfJ4HKjutk/WaCzK7S2wv1POn1RRPGh8ZK+ag9l244Vqxji3r6wgz9YBf6+vhQEYJZpSjqWFPg9gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var data = {
            users: [{
                    name: 'John Doe',
                    email: 'john@example.com'
                },
                {
                    name: 'Jane Smith',
                    email: 'jane@example.com'
                },
            ]
        };

        // دریافت قالب و کامپایل آن
        var templateSource = document.getElementById("table-template").innerHTML;
        var template = Handlebars.compile(templateSource);

        // اعمال داده‌های متغیر به قالب
        var html = template(data);

        // نمایش قالب در المان مورد نظر
        document.getElementById("table-container").innerHTML = html;
    </script> --}}
@endsection
