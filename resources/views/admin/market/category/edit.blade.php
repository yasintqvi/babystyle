@extends('admin.layouts.app', ['title' => 'ویرایش دسته '])

@section('content')
    {{-- help modal --}}
    <div class="modal fade zoom" tabindex="-1" id="modalZoom">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">راهنما</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="بستن">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <p>
                        ویژگی هایی که منجر به تنوع یا اختلاف این دسته از محصولات می شوند را انتخاب کنید برای مثال ویژگی رنگ
                        میتواند روی قیمت و موجودی یک محصول تاثیر بگذارد.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- new attribute modal --}}
    <div class="modal fade zoom" tabindex="-1" id="newAttribute">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ویژگی جدید</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="بستن">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <input type="text" placeholder="نام ویژگی" class="form-control" id="attribute-name" required>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary" onclick="addAttribute()">افزودن</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">

        <div class="nk-block-head col-md-6">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title">ویرایش دسته {{ $category->title }}</h4>
            </div>
        </div>
        <div class="nk-block-head-sub mt-1">
            <a class="back-to" href="{{ route('admin.market.categories.index') }}"><em
                    class="icon ni ni-arrow-left"></em><span>بازگشت</span></a>
        </div>
    </div>

    <div class="card">
        <div class="card-inner">

            <form action="{{ route('admin.market.categories.update', $category->id) }}" method="post"
                enctype="multipart/form-data" id="form" class="form-validate" novalidate="novalidate">
                @csrf
                @method('PUT')
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#general">
                            <em class="icon ni ni-property"></em>
                            <span>موارد عمومی</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#seo">
                            <em class="icon ni ni-trend-up"></em>
                            <span>آدرس و سئو</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="general">
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="title">عنوان <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" value="{{ old('title', $category->title) }}"
                                            class="form-control invalid" id="title" name="title">
                                    </div>
                                    @error('title')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-label" for="fv-full-name">وضعیت</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-control-lg custom-switch">
                                            <input type="checkbox" name="is_active" value="1"
                                                class="custom-control-input" @checked(old('is_active', $category->is_active)) id="is_active">
                                            <label class="custom-control-label" for="is_active">فعال</label>
                                        </div>
                                    </div>
                                    @error('is_active')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="form-label" for="fv-full-name">انتخاب ویژگی ها</label>
                                <a href="javascript:void(0)" class="d-block" data-bs-toggle="modal"
                                    data-bs-target="#modalZoom">
                                    <small><em class="icon ni ni-question"></em>
                                        راهنما</small>
                                </a>
                                <div>
                                    <button type="button" class="btn btn-sm btn-success my-2" data-bs-toggle="modal"
                                        data-bs-target="#newAttribute">
                                        ویژگی جدید
                                    </button>
                                </div>
                                <ul class="custom-control-group mt-2" id="attribute-list">
                                    @foreach (old('variations', $category->variations->pluck('name')) as $key => $variation)
                                        <div class="custom-control custom-checkbox custom-control-pro no-control">
                                            <input type="checkbox" checked value="{{ $variation }}"
                                                class="custom-control-input" name="variations[]"
                                                id="{{ $key }}">
                                            <label class="custom-control-label"
                                                for="{{ $key }}">{{ $variation }}</label>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="seo">
                        <p>بزار ببینیم چیکار میتونیم بکنیم</p>
                    </div>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">ذخیره اطلاعات</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const addAttribute = () => {
            const attributeInput = document.querySelector("#attribute-name");

            if (attributeInput.value.trim() !== "") {
                const attributeListElement = document.querySelector('#attribute-list');
                const inputId = Math.floor(Math.random() * 10000);
                const newAttrElement = `
            <div class="custom-control custom-checkbox custom-control-pro no-control">
                <input type="checkbox" checked value="${attributeInput.value}" class="custom-control-input"
                    name="variations[]" id="${ inputId }">
                <label class="custom-control-label" for="${inputId}">${attributeInput.value}</label>
            </div>`;

                const parentAttributeElement = document.createElement('div');
                parentAttributeElement.innerHTML = newAttrElement;

                attributeListElement.appendChild(parentAttributeElement);

                attributeInput.value = "";
                attributeInput.focus();
            } else {
                NioApp.Toast('شما نمی توانید یک ویژگی با مقدار خالی اضافه نمایید.', 'error');
            }
        }
    </script>
@endsection
