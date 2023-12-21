@extends('admin.layouts.app', ['title' => $product->title])

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="nk-block-head col-md-6">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title">محصول {{ $product->title }}</h4>
            </div>
        </div>
        <div class="nk-block-head-sub mt-1">
            <a class="back-to" href="{{ route('admin.market.products.index') }}"><em
                    class="icon ni ni-arrow-left"></em><span>بازگشت</span></a>
        </div>
    </div>

    <div class="card">
        <div class="card-inner">
            @csrf
            @method('PUT')
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" id="general-link" data-bs-toggle="tab" href="#general">
                        <em class="icon ni ni-property"></em>
                        <span>اطلاعات محصول</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-disabled="true" id="store-link" data-bs-toggle="tab" href="#store">
                        <em class="icon ni ni-color-palette-fill"></em>
                        <span>تنوع محصول</span>
                    </a>
                </li>
                <li class="nav-item" onclick="getProductAttributes()">
                    <a class="nav-link" aria-disabled="true" data-bs-toggle="tab" href="#attributes">
                        <em class="icon ni ni-table-view-fill"></em>
                        <span>مشخصات محصول</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true" data-bs-toggle="tab" href="#seo">
                        <em class="icon ni ni-trend-up"></em>
                        <span>آدرس و سئو</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane" id="general">
                    <form action="{{ route('admin.market.products.update', $product->id) }}" method="post"
                        enctype="multipart/form-data" id="form" class="form-validate" novalidate="novalidate">
                        @csrf
                        @method('PUT')
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="title">عنوان <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="text" value="{{ old('title', $product->title) }}"
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
                                    <label class="form-label" for="fv-full-name">وضعیت نمایش</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-control-lg custom-switch">
                                            <input type="checkbox" name="is_active" value="1"
                                                class="custom-control-input" @checked(old('is_active', $product->is_active)) id="is_active">
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
                                                <option value="{{ $category->id }}" @selected($category->id == old('category_id', $product->category_id))>
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
                                                <option value="{{ $brand->id }}" @selected($brand->id == old('brand_id', $product->brand_id))>
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

                                    <textarea name="description" class="tinymce-toolbar form-control">{{ old('description', $product->description) }}</textarea>
                                </div>
                                @error('description')
                                    <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-5">
                                <input type="hidden" name="images"
                                    value="{{ old('images', $product->images->pluck('image')->implode(',')) }}">
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
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary mr-auto">ویرایش اطلاعات
                                    محصول</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane active" id="store">
                    {{-- start product variations --}}

                    <form action="{{ route('admin.market.items.store', $product->id) }}" id="store-form" method="post">
                        <div class="row g-gs">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="price">قیمت <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="number" required onkeyup="convertToToman(event)"
                                            class="form-control invalid" min="0" max="100000000" id="price"
                                            name="price">
                                    </div>
                                    <p id="convertedPrice" class="breadcrumb-item mt-1"></p>
                                    @error('price')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="quantity">موجودی <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="number" min="0" max="10000" required
                                            class="form-control invalid" id="quantity" name="quantity">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="product_image">تصویر </label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file" name="product_image" class="form-file-input"
                                                id="product_image">
                                            <label class="form-file-label product-image-label" for="product_image">انتخاب
                                                تصویر</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($product->category->variations as $variation)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label"
                                            for="variation-{{ $variation->id }}">{{ $variation->name }}</label>
                                        <div class="form-control-wrap d-flex">
                                            <input type="hidden" name="options[{{ $variation->id }}][variation_id]"
                                                value="{{ $variation->id }}">
                                            <input type="text" class="form-control invalid"
                                                name="options[{{ $variation->id }}][value]"
                                                id="variation-{{ $variation->id }}">
                                            @if ($variation->is_color)
                                                <div class="input-group-append" >
                                                    <span class="input-group-text" style="background: transparent !important; border:none;">
                                                        <input type="color"  id="variation-{{ $variation->id }}-second" name="options[{{ $variation->id }}][second_value]" class="custom-color-input border-0">
                                                        <input type="hidden" name="is_color" value="1">
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        @error('options.{{ $variation->id }}.value')
                                            <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                            @if ($product->items()->count() > 0) 
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-label" for="fv-full-name">انتخاب به عنوان محصول پیشفرض</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-control-lg custom-switch">
                                            <input type="checkbox" name="is_default" value="1"
                                                class="custom-control-input" @checked(old('is_default')) id="is_default">
                                            <label class="custom-control-label" for="is_default">فعال</label>
                                        </div>
                                    </div>
                                    @error('is_default')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @else 
                                <input type="hidden" name="is_default" value="1">
                            @endif
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary mr-auto">افزودن به انبار</button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-tranx" style="margin-top: 2rem" id="register-product-items">
                        <thead>
                            <tr>
                                <th class="small text-mute">ویژگی ها</th>
                                <th class="small text-mute">تصویر</th>
                                <th class="small text-mute">موجودی</th>
                                <th class="small text-mute">قیمت</th>
                                <th class="small text-mute">محصول پیشفرض</th>
                                <th class="small text-mute">اقدامات</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>


                    {{-- end product variations --}}
                </div>
                <div class="tab-pane" id="attributes">
                    <span class="preview-title-lg overline-title">مشخصه های محصول را اضافه و enter کنید</span>
                    <form action="{{ route('admin.market.attributes.store', $product->id) }}" id="attribute-form"
                        method="post">
                        <div class="row gy-4">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="attribute_name" name="key"
                                        placeholder="نام مشخصه (مثال: ابعاد)">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="attribute_value" name="value"
                                        placeholder="مقدار مشخصه">
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-primary" id="add-attribute-btn">اضافه
                                        کردن</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="table table-tranx my-4" id="register-attributes">
                        <thead>
                            <tr>
                                <th class="small text-mute">نام مشخصه</th>
                                <th class="small text-mute">مقدار مشخصه</th>
                                <th class="small text-mute">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="seo">
                    <p>بزار ببینیم چیکار میتونیم بکنیم</p>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    @include('admin.alerts.toastr.success')
    @include('admin.alerts.sweet-alert.confirm')

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

    {{-- script for product variations --}}
    <script src="{{ asset('assets/admin/js/persian-tools.min.js') }}"></script>

    <script>
        const {
            numberToWords,
            addCommas
        } = PersianTools;

        function convertToToman(event) {
            var price = event.target.value;
            var number = price;
            var words = numberToWords(number);
            document.getElementById("convertedPrice").innerText = words + " تومان";
        }


        const storeForm = document.getElementById('store-form');

        storeForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const formData = new FormData(storeForm);

            fetch(storeForm.action, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                }).then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (!data.success) {
                        NioApp.Toast(data.message, 'error');
                        return;
                    }
                    NioApp.Toast(data.message, 'success');
                    getProductItems();
                })
                .catch(err => {
                    NioApp.Toast('خطایی رخ داد !', 'error');
                    console.log(err);
                });
            storeForm.reset();
            document.querySelector('.product-image-label').innerHTML = 'انتخاب تصویر';
            document.getElementById("convertedPrice").innerText = "";
        })


        const getProductItems = async () => {
            const requestRoute = "{{ route('admin.market.items.fetch', $product->id) }}";
            await fetch(requestRoute, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    showDataItems(data)
                });
        }

        const showDataItems = (data) => {
            const attributeContainer = document.querySelector('#register-product-items tbody');
            attributeContainer.innerHTML = "";
            for (item in data.items) {
                const tr = document.createElement('tr');
                attributeTdContent = [];

                for (option in data.items[item].variation_options) {
                    attributeTdContent.push(data.items[item].variation_options[option]['value']);
                }

                const price = getPrice(data.items[item]['price'] , data.items[item]['price_with_discount']);
                tr.innerHTML = `
                    <td>${ attributeTdContent.join(' - ') }</td>
                    <td><img style="width:4rem; height:4rem" src="/${data.items[item]['product_image'] || 'defaults/no-image.jpg'}"</td>
                    <td>${data.items[item]['quantity']}</td>
                    <td>${price} تومان</td>
                    <td>${data.items[item].is_default == 1 ? '<h4><em class="icon ni ni-check-circle-fill text-success"></em></h4>' : ''}</td>
                    <td><a href="/admin/market/{{ $product->id }}/items/${data.items[item]['id']}/edit" target="_blank" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="ویرایش"><em class="icon ni ni-edit-fill"></em></a></td>
                `;

                attributeContainer.appendChild(tr);
            }

            document.querySelectorAll('.delete-attribute').forEach(delElement => delElement.addEventListener('click',
                removeAttribute));
        }

        const getPrice = (price, discountPrice) => {
            if (price == discountPrice) {
                return addCommas(price);
            }

            return `
                <s class='text-danger'>${addCommas(price)}</s> <span> ${addCommas(discountPrice)} </span>
            `
        }

        getProductItems();
    </script>

    {{-- script for product attributes --}}
    <script>
        const storeAttributeForm = document.querySelector('#attribute-form');

        storeAttributeForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const formData = new FormData(storeAttributeForm);

            let isFormDataEmpty = true;

            for (let value of formData.values()) {
                if (value.trim() !== "") {
                    isFormDataEmpty = false;
                    break;
                }
            }

            if (!isFormDataEmpty) {
                fetch(storeAttributeForm.action, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    }).then(response => response.json())
                    .then(data => {
                        NioApp.Toast('ویژگی جدید با موفقیت اضافه شد.', 'success');
                        return data;
                    })
                    .catch(err => {
                        NioApp.Toast('خطایی رخ داد !', 'error');
                        console.log(err.message);
                    });

                storeAttributeForm.reset();
                getProductAttributes();
            } else {
                NioApp.Toast('شما نمی توانید مشخصه ای با مقدار خالی وارد نمایید.', 'error');
            }

        })

        const getProductAttributes = async () => {
            const requestRoute = "{{ route('admin.market.attributes.index', $product->id) }}";
            console.log(requestRoute);
            await fetch(requestRoute, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    showDataAttribute(data)
                });
        }

        const showDataAttribute = (data) => {

            const attributeContainer = document.querySelector('#register-attributes tbody');
            attributeContainer.innerHTML = "";
            for (item in data) {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${data[item].key}</td>
                    <td>${data[item].value}</td>
                    <td><a href="javascript:void(0)" class="text-danger delete-attribute"><em data-id="${data[item].id}" class="icon ni ni-trash-fill"></em></a></td>
                `;

                attributeContainer.appendChild(tr);
            }

            document.querySelectorAll('.delete-attribute').forEach(delElement => delElement.addEventListener('click',
                removeAttribute));
        }

        const removeAttribute = async (event) => {
            const attributeId = event.target.dataset.id;

            const requestRoute = `/admin/market/{{ $product->id }}/attributes/${attributeId}`;
            await fetch(requestRoute, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    }
                })
                .then(response => {
                    if (response.ok) {
                        NioApp.Toast('مشخصه مورد نظر حذف گردید', 'success');
                    }
                })
                .catch(err => {
                    NioApp.Toast('خطایی رخ داد!', 'error');
                    console.log(err.message);
                });

            getProductAttributes();
        }
    </script>
@endsection
