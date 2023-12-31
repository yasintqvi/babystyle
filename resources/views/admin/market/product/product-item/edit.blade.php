@extends('admin.layouts.app', ['title' => $product->title])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/persian-datepicker.css') }}" />
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="nk-block-head col-md-6">
            <div class="nk-block-head-content">
                <h5 class="title nk-block-title h6">محصول {{ $product->title }} -
                    {{ $item->variationOptions->pluck('value')->implode('-') }} - کد محصول {{ $item->sku }}</h5>
            </div>
        </div>
        <a href="{{ route('admin.market.products.edit', $product->id) }}" class="btn btn-success">بازگشت</a>

    </div>

    <div class="card">
        <div class="card-inner">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ session()->has('tab') ? '' : 'active' }}" id="general-link" data-bs-toggle="tab"
                        href="#general">
                        <em class="icon ni ni-property"></em>
                        <span>مشخصات</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ session()->get('tab') == 'discount' ? 'active' : '' }}" aria-disabled="true"
                        data-bs-toggle="tab" href="#discount">
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
                <div class="tab-pane {{ session()->has('tab') ? '' : 'active' }}" id="general">
                    <form action="{{ route('admin.market.items.update', [$product->id, $item->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row d-flex justify-content-start">
                            <div class="col-md-3">
                                <label for="file-input" class="overline-title p-2">
                                    <div class="product-size lg">
                                        <img id="product-item-image" src="{{ asset($item->image) }}" class="product-size"
                                            alt="">
                                        <input type="file" name="product_image" class="hide-file-input" id="file-input"
                                            onchange="displayImage(event)">
                                    </div>
                                    <p class="text-center">برای آپلود روی تصویر کلیک کنید </p>
                                </label>
                            </div>
                            <div class="row mt-0 col-md-9">
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
                                                                value="{{ $item->variationOptions->where('variation_id', $variation->id)->first()->second_value }}"
                                                                id="variation-{{ $variation->id }}-second"
                                                                name="options[{{ $variation->id }}][second_value]"
                                                                class="custom-color-input border-0">
                                                            <input type="hidden" name="options[{{ $variation->id }}][is_color]" value="1">
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
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="form-label" for="fv-full-name">انتخاب به عنوان محصول پیشفرض</label>
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-control-lg custom-switch">
                                                <input type="checkbox" name="is_default" value="1"
                                                    class="custom-control-input" @checked(old('is_default', $item->is_default))
                                                    id="is_default">
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
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary mr-auto">ویرایش</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane {{ session()->get('tab') == 'discount' ? 'active' : '' }}" id="discount">
                    <form action="{{ route('admin.market.items.discount', $item->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row d-flex justify-content-start">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="price">درصد تخفیف <span
                                            class="text-danger">*</span></label>
                                    <div class="form-control-wrap">
                                        <input type="number" oninput="calcDiscount(event)" required name="discount_rate"
                                            value="{{ old('discount_rate') }}" class="form-control invalid">
                                    </div>
                                    <div class="text-danger mt-2 small d-none">
                                        <span> قیمت بعد از تخفیف</span>
                                        <span class="price_after_discount"></span>
                                    </div>
                                    @error('discount_rate')
                                        <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">تاریخ شروع</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input type="text" id="start_date_view"
                                            class="form-control persiandate pwt-datepicker-input-element text-right">
                                        <input type="text" name="start_date" value="{{ old('start_date') }}"
                                            id="start_date" class="d-none">
                                    </div>
                                    <div class="form-note">فرمت تاریخ <code>روز/ماه/سال</code></div>
                                </div>
                                @error('start_date')
                                    <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">تاریخ پایان</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input type="text" id="end_date_view"
                                            class="form-control persiandate pwt-datepicker-input-element text-right">
                                        <input type="text" name="end_date" value="{{ old('end_date') }}"
                                            id="end_date" class="d-none">
                                    </div>
                                    <div class="form-note">فرمت تاریخ <code>روز/ماه/سال</code></div>
                                </div>
                                @error('end_date')
                                    <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                        <strong>
                                            {{ $message }}
                                        </strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary mr-auto">اعمال تخفیف</button>
                            </div>
                        </div>
                    </form>


                    <table class="table table-tranx" style="margin-top: 2rem" id="register-product-items">
                        <thead>
                            <tr>
                                <th class="small text-mute">درصد تخفیف</th>
                                <th class="small text-mute">تاریخ شروع</th>
                                <th class="small text-mute">فعال تا تاریخ</th>
                                <th class="small text-mute">وضعیت</th>
                                <th class="small text-mute">اقدامات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->discounts()->latest()->get() as $discount)
                                <tr>
                                    <td class="small">{{ $discount->discount_rate }}%</td>
                                    <td class="small">{{ getJalaliTime($discount->start_date) }}</td>
                                    <td class="small">{{ getJalaliTime($discount->end_date) }}</td>
                                    @if ($discount->is_active)
                                        <td class="small">
                                            <span class="badge rounded-pill bg-success">فعال</span>
                                        </td>
                                        <td class="small">
                                            <form method="post"
                                                action="{{ route('admin.market.items.discount.expiration', $discount->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">منقضی کردن</button>
                                            </form>
                                        </td>
                                    @else
                                        <td class="small">
                                            @if ($discount->end_date < now())
                                                <span class="badge rounded-pill bg-danger">منقضی شده</span>
                                            @else
                                                <span class="badge rounded-pill bg-warning">در صف</span>
                                            @endif
                                        </td>
                                        <td>-</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane active" id="statistics"></div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    @include('admin.alerts.toastr.success')
    @include('admin.alerts.toastr.error')
    @include('admin.alerts.sweet-alert.confirm')

    <script src="{{ asset('assets/admin/js/persian-date.js') }}"></script>
    <script src="{{ asset('assets/admin/js/persian-datepicker.js') }}"></script>

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

    {{-- discount script --}}
    <script>
        $(document).ready(function() {
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date',
                minDate: 'today',
                timePicker: {
                    enabled: true
                }
            })

            $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date',
                minDate: 'today',
                timePicker: {
                    enabled: true
                }
            })
        });
    </script>

    <script>
        const price = parseInt("{{ $item->price }}");

        const calcDiscount = (event) => {
            const precent = event.target.value;

            const priceLabel = document.querySelector('.price_after_discount');

            if (precent > 100 || precent < 1) {
                event.preventDefault();
                priceLabel.parentNode.classList.add('d-none');
                NioApp.Toast('درصد تخفیف نمیتواند کوچکتر از 1 یا بزرگتر از 100 باشد.', 'error')
            } else {
                priceLabel.parentNode.classList.remove('d-none');
                const priceAfterDiscount = price - (price * (parseInt(precent) / 100));
                priceLabel.innerText = addCommas(priceAfterDiscount) + " تومان";
            }

        }
    </script>
@endsection
