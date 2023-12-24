@extends('admin.layouts.app', ['title' => 'افزودن محصول جدید'])

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="nk-block-head col-md-6">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title mt-2">افزودن محصول جدید</h4>
            </div>
        </div>
        <a href="{{ route('admin.market.faqs.index') }}" class="btn btn-success">بازگشت</a>

    </div>

    <form action="{{ route('admin.market.products.store') }}" method="post" enctype="multipart/form-data" id="form"
        class="form-validate" novalidate="novalidate">
        <div class="card">
            <div class="card-inner">
                @csrf
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="general-link" data-bs-toggle="tab" href="#general">
                            <em class="icon ni ni-property"></em>
                            <span>اطلاعات محصول</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true" id="store-link" data-bs-toggle="tab"
                            href="#store">
                            <em class="icon ni ni-color-palette-fill"></em>
                            <span>تنوع محصول</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true" data-bs-toggle="tab" href="#attributes">
                            <em class="icon ni ni-table-view-fill"></em>
                            <span>مشخصات محصول</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true" data-bs-toggle="tab" href="#seo">
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
                                        <input type="text" value="{{ old('title') }}" class="form-control invalid"
                                            id="title" name="title">
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
                                    <label class="form-label" for="fv-full-name">وضعیت نمایش</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-control-lg custom-switch">
                                            <input type="checkbox" name="is_active" value="1"
                                                class="custom-control-input" @checked(old('is_active')) id="is_active">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="category">انتخاب دسته بندی <span
                                                class="text-danger">*</span></label>
                                        <select name="category_id" onchange="checkSelectCategory(this)"
                                            class="form-select js-select2" data-search="on">
                                            <option value="">یک دسته را انتخاب کنید</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>
                                                    {{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="category">انتخاب برند</label>
                                        <select name="brand_id" class="form-select js-select2" data-search="on">
                                            <option value="">یک برند را انتخاب کنید</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" @selected($brand->id == old('brand_id'))>
                                                    {{ $brand->persian_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('brand_id')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="customFileLabel">تصویر شاخص
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file" name="primary_image" class="form-file-input"
                                                id="customFile">
                                            <label class="form-file-label" for="customFile">انتخاب تصویر</label>
                                        </div>
                                    </div>
                                    @error('primary_image')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="customFileLabel">تصویر ثانویه</label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file" name="secondary_image" class="form-file-input"
                                                id="customFile">
                                            <label class="form-file-label" for="customFile">انتخاب تصویر</label>
                                        </div>
                                    </div>
                                    @error('secondary_image')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="customFileLabel">
                                        توضیحات محصول
                                        <span class="text-danger">*</span>
                                    </label>

                                    <textarea name="description" class="tinymce-toolbar form-control">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="hidden" name="images" value="{{ old('images') }}">
                                <label class="form-label">آپلود تصاویر محصول</label>
                                <div class="upload-zone dropzone-rtl" id="upload-zone">
                                    <div class="dz-message" data-dz-message data-max-file-size="4"
                                        data-accepted-files="jpg,png,jpeg,webp,gif">
                                        <span class="dz-message-text">فایل را بکشید و رها کنید</span>
                                        <span class="dz-message-or">یا</span>
                                        <button type="button" class="btn btn-primary">انتخاب</button>
                                    </div>
                                </div>
                            </div>
                            @error('images')
                                <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="tab-pane" id="store">
                        {{-- start product variations --}}

                        <div id="pitems-container">

                        </div>

                        <div class="d-flex justify-content-center" data-bs-target="#addItemModal" data-bs-toggle="modal">
                            <button type="button" class="btn btn-outline-primary">افزودن تنوع جدید</button>
                        </div>


                        {{-- end product variations --}}
                    </div>
                    <div class="tab-pane" id="attributes">
                        <span class="preview-title-lg overline-title">مشخصه های محصول را اضافه و enter کنید</span>
                        <div class="row gy-4">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <input type="text" onkeydown="handleNewAttribute(event)" class="form-control"
                                        id="attribute_name" placeholder="نام مشخصه (مثال: ابعاد)">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <input type="text" onkeydown="handleNewAttribute(event)" class="form-control"
                                        id="attribute_value" placeholder="مقدار مشخصه">
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-lim btn-success" onclick="addNewAttribute()"
                                        id="add-attribute-btn">اضافه
                                        کردن</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-tranx my-4" id="register-attributes">
                            <thead>
                                <tr>
                                    <th class="small text-mute">نام مشخصه</th>
                                    <th class="small text-mute">مقدار مشخصه</th>
                                    <th class="small text-mute">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (old('attributes', []) as $key => $attribute)
                                    <tr>
                                        <input type='hidden' name="attributes[{{ $key }}][key]"
                                            value="{{ $attribute['key'] }}">
                                        <input type='hidden' name="attributes[{{ $key }}][value]"
                                            value="{{ $attribute['value'] }}">
                                        <td class="tb-tnx-info title">
                                            {{ $attribute['key'] }}
                                        </td>
                                        <td class="tb-tnx-info">
                                            {{ $attribute['value'] }}
                                        </td>
                                        <td>
                                            <button type='button' onclick="this.closest('tr').remove()"
                                                class='btn text-danger'><em class="icon ni ni-trash"></em></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="seo">
                        <p>بزار ببینیم چیکار میتونیم بکنیم</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-lg btn-primary mr-auto">ذخیره اطلاعات</button>
            </div>
        </div>
    </form>
@endsection


@section('script')
    {{-- script for gallery --}}
    <script>
        // script for product gallery
        const imageInput = document.querySelector('input[name="images"]');
        const csrfToken = "{{ csrf_token() }}";

        NioApp.Dropzone.init = function() {

            const myDropzone = new Dropzone('.upload-zone', {
                url: "{{ route('admin.market.products.images.upload') }}",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                parallelUploads: 1,
                addRemoveLinks: true,

                success: function(file, response) {
                    imageInput.value = imageInput.value === '' ? response.path : imageInput.value +=
                        `,${response.path}`;
                },
            });


        };
    </script>
@endsection
