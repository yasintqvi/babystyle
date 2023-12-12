@extends('admin.layouts.app', ['title' => $product->title])

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="nk-block-head col-md-6">
            <div class="nk-block-head-content">
                <h5 class="title nk-block-title h6">محصول {{ $product->title }} -
                    {{ $item->variationOptions->pluck('value')->implode('-') }} - کد محصول {{ $item->sku }}</h5>
            </div>
        </div>
        <div class="nk-block-head-sub mt-1">
            <a class="back-to" href="{{ route('admin.market.products.index') }}"><em
                    class="icon ni ni-arrow-left"></em><span>بازگشت</span></a>
        </div>
    </div>

    <div class="card">
        <div class="card-inner">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="general-link" data-bs-toggle="tab" href="#general">
                        <em class="icon ni ni-property"></em>
                        <span>مشخصات</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true" data-bs-toggle="tab" href="#discount">
                        <em class="icon ni ni-percent"></em>
                        <span>تخفیفات محصول</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-disabled="true" data-bs-toggle="tab" href="#statistics">
                        <em class="icon ni ni-growth"></em>
                        <span>آمار فروش</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <form action="{{ route('admin.market.items.update', [$product->id, $item->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row d-flex justify-content-start">
                            <div class="col-md-2">
                                <label for="file-input" class="overline-title upload-zone p-2">
                                    <div class="product-size lg">
                                        <img id="product-item-image" src="{{ asset($item->image) }}" class="product-size"
                                            alt="">
                                        <input type="file" name="product_image" class="hide-file-input" id="file-input"
                                            onchange="displayImage(event)">
                                    </div>
                                    <p class="text-center">برای آپلود روی تصویر کلیک کنید </p>
                                </label>
                            </div>
                            <div class="row mt-0 col-md-10">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="price">قیمت <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="number" required onkeyup="convertToToman(event)"
                                                value="{{ old('price', $item->price) }}" class="form-control invalid"
                                                min="0" max="100000000" id="price" name="price">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="quantity">موجودی <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="number" min="0" max="10000"
                                                value="{{ old('quantity', $item->quantity) }}" required
                                                class="form-control invalid" id="quantity" name="quantity">
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
                                                    value="{{ $item->variationOptions->where('variation_id', $variation->id)->first()->value ?? '' }}"
                                                    id="variation-{{ $variation->id }}">
                                                @if ($variation->is_color)
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            style="background: transparent !important; border:none;">
                                                            <input type="color"
                                                                value="{{ $item->variationOptions->where('variation_id', $variation->id)->first()->second_value ?? '' }}"
                                                                id="variation-{{ $variation->id }}-second"
                                                                name="options[{{ $variation->id }}][second_value]"
                                                                class="custom-color-input border-0">
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
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary mr-auto">ویرایش</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane active" id="discount">
                    <form action="{{ route('admin.market.items.update', [$product->id, $item->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row d-flex justify-content-start">
                            <div class="col-md-2">
                                <label for="file-input" class="overline-title upload-zone p-2">
                                    <div class="product-size lg">
                                        <img id="product-item-image" src="{{ asset($item->image) }}" class="product-size"
                                            alt="">
                                        <input type="file" name="product_image" class="hide-file-input" id="file-input"
                                            onchange="displayImage(event)">
                                    </div>
                                    <p class="text-center">برای آپلود روی تصویر کلیک کنید </p>
                                </label>
                            </div>
                            <div class="row mt-0 col-md-10">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="price">قیمت <span
                                                class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="number" required onkeyup="convertToToman(event)"
                                                value="{{ old('price', $item->price) }}" class="form-control invalid"
                                                min="0" max="100000000" id="price" name="price">
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
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary mr-auto">ویرایش</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane active" id="statistics"></div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    @include('admin.alerts.toastr.success')
    @include('admin.alerts.sweet-alert.confirm')

    {{-- script for product variations --}}
    <script src="{{ asset('assets/admin/js/persian-tools.min.js') }}"></script>

    <script>
        const {
            numberToWords,
            addCommas
        } = PersianTools;

        function convertToToman(event) {
            var price = event.target?.value;
            var number = price;
            var words = numberToWords(number);
            document.getElementById("convertedPrice").innerText = words + " تومان";
        }
    </script>

    <script>
        function displayImage(event) {
            var input = event.target;
            var image = document.getElementById('product-item-image');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    image.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
