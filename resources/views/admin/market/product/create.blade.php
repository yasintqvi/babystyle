@extends('admin.layouts.app', ['title' => 'افزودن محصول جدید'])

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="nk-block-head col-md-6">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title">افزودن محصول جدید</h4>
            </div>
        </div>
        <div class="nk-block-head-sub mt-1">
            <a class="back-to" href="{{ route('admin.market.products.index') }}"><em
                    class="icon ni ni-arrow-left"></em><span>بازگشت</span></a>
        </div>
    </div>

    <form action="{{ route('admin.market.products.store') }}" method="post" enctype="multipart/form-data" id="form"
        class="form-validate" novalidate="novalidate">
        <div class="card">
            <div class="card-inner">
                @csrf
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#general">
                            <em class="icon ni ni-property"></em>
                            <span>موارد عمومی</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#store">
                            <em class="icon ni ni-package"></em>
                            <span>موجودی در انبار</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#attributes">
                            <em class="icon ni ni-table-view-fill"></em>
                            <span>مشخصات محصول</span>
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
                                        <select name="category_id" onchange="getCategoryVariation(event, this)"
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
                                            <label class="form-file-label" for="customFile">انتخاب فایل</label>
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
                                            <label class="form-file-label" for="customFile">انتخاب فایل</label>
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
                    <div class="tab-pane" onclick="" id="store">
                        <table class="table table-store">
                            <thead class="tb-odr-head">
                                <tr class="tb-odr-item">
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">SKU</span>
                                        <span class="tb-odr-ptitle d-md-inline-block">عنوان</span>
                                    </th>
                                    <th class="tb-odr-img">آپلود تصویر (اختیاری)</th>
                                    <th class="tb-odr-amount ml-auto">
                                        <span class="tb-odr-total">مبلغ (تومان)</span>
                                        <span class="tb-odr-quantity">موجودی</span>
                                    </th>
                                    <th class="p-1">
                                        <div class="tb-odr-btns">
                                            <a href="javascript:void(0)"
                                                class="btn btn-sm btn-success d-none d-md-inline">ویژگی جدید</a>
                                            <a href="javascript:void(0)"
                                                class="btn btn-sm btn-success d-inline d-md-none">
                                                <em class="icon ni ni-plus"></em>
                                            </a>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="tb-odr-body">
                                <tr class="tb-odr-item">
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id"><a href="javasctipt:void(0)">-</a></span>
                                        <span class="tb-odr-ptitle">محصول شماره یک</span>
                                    </td>
                                    <td class="tb-odr-img">
                                        
                                    </td>
                                    <td class="tb-odr-amount">
                                        <span class="tb-odr-total">
                                            <input type="text" required name="pitems[0][price]" class="transparent-input"
                                                placeholder="قیمت">
                                        </span>
                                        <span class="tb-odr-quantity">
                                            <input type="text" name="pitems[0][quantity]" class="transparent-input"
                                                placeholder="موجودی">
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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

    {{-- script for store --}}
    <script>
        const getCategoryVariation = (event, element) => {
            const id = element.value;
            if (id.trim() != '') {
                 
            }
        }
    </script>

    {{-- script for product attributes --}}
    <script>
        // script for product attributes
        const registerAttributes = document.querySelector('#register-attributes tbody');
        // attribute inputs
        const attributeNameInput = document.querySelector('#attribute_name');
        const attributeValueInput = document.querySelector('#attribute_value');

        const addNewAttribute = () => {
            const dataIndex = registerAttributes.children.length;

            // check user input validation 
            if (attributeNameInput.value.trim() !== '' && attributeValueInput.value.trim() !== '') {
                const makeInputs = `
                    <input type='hidden' name="attributes[${dataIndex}][key]" value="${attributeNameInput.value}">
                    <input type='hidden' name="attributes[${dataIndex}][value]" value="${attributeValueInput.value}">
                    <td class="tb-tnx-info title">
                        ${attributeNameInput.value}
                    </td>
                    <td class="tb-tnx-info">
                        ${attributeValueInput.value}
                    </td>
                    <td>
                        <button type='button' class='btn text-danger delete-btn' ><em class="icon ni ni-trash"></em></button>
                    </td>
                `;

                const attributeParentElement = document.createElement('tr');
                attributeParentElement.innerHTML = makeInputs;

                attributeParentElement.querySelector('.delete-btn').addEventListener('click', removeAttribute);

                registerAttributes.appendChild(attributeParentElement);

                clearInputs();

            } else {
                NioApp.Toast('شما نمی توانید مشخصه ای با مقدار خالی اضافه نمایید.', 'error');
            }

        }

        const clearInputs = () => {
            attributeNameInput.value = "";
            attributeValueInput.value = "";
            attributeNameInput.focus();
        }

        const removeAttribute = (event) => {
            const attributeElement = event.srcElement.closest("tr");
            attributeElement.remove();
        }

        const handleNewAttribute = (event) => {
            if (event.key == "Enter") {
                event.preventDefault();
                addNewAttribute();
            }
        }
    </script>
@endsection
