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
                        <a class="nav-link" data-bs-toggle="tab" href="#gallery">
                            <em class="icon ni ni-img-fill"></em>
                            <span> گالری محصول</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#store">
                            <em class="icon ni ni-package"></em>
                            <span>موجودی در انبار</span>
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
                                        <select name="category_id" class="form-select js-select2" data-search="on">
                                            <option>یک دسته را انتخاب کنید</option>
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
                                            <option>یک برند را انتخاب کنید</option>
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
                        </div>
                    </div>
                    <div class="tab-pane" id="gallery">
                        <div class="col-12">
                            <input type="hidden" name="images" value="{{ old('images') }}">
                            <label class="form-label">محدودیت حجم فایل ناحیه رها کردن (4 مگابایت)</label>
                            <div class="upload-zone">
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
                    <div class="tab-pane" id="store">

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
    @php
        $images = explode(',', old('images'));
        // dd($images);
    @endphp
@endsection

@section('script')
    <script>
        const imageInput = document.querySelector('input[name="images"]');

        const oldImages = @json($images);

        const csrfToken = "{{ csrf_token() }}"
        NioApp.Dropzone('.upload-zone', {
            url: "{{ route('admin.market.products.upload-image') }}",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            parallelUploads: 1, // تنها یک فایل به صورت همزمان آپلود شود

            success: function(file, response) {
                imageInput.value = imageInput.value === '' ? response.path : imageInput.value +=
                    `,${response.path}`;
            },

            init: function() {
                if (oldImages[0] !== "") {
                    for (const image in oldImages) {
                        const finalImage = oldImages[image];
                        console.log(finalImage);
                        const mockFile = {
                            name: finalImage,
                            size: "آپلود شده"
                        };
                        this.emit("addedfile", mockFile);
                        this.emit("thumbnail", mockFile, `/${finalImage}`);
                        this.emit("complete", mockFile);
                    }
                }
            }
        });
    </script>
@endsection
