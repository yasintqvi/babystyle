@extends('admin.layouts.app', ['title' => 'ایجاد کد تخفیف'])

@section('head-tag')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/persian-datepicker.css') }}" />
@endsection

@section('content')
    <ul class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.market.faqs.index') }}"> کد تخفیف</a></li>
        <li class="breadcrumb-item active">ایجاد کد تخفیف</li>
    </ul>

    <!-- .nk-block-head-content -->
    <div class="nk-block-between mb-4 mt-2">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">ایجاد کد تخفیف</h3>
        </div>
        <!-- .nk-block-head-content -->
        <a href="{{ route('admin.market.discount-codes.index') }}" class="btn btn-success">بازگشت</a>

        <!-- .nk-block-head-content -->
    </div>



    <div class="card">
        <div class="card-inner">
            <form action="{{ route('admin.market.discount-codes.store') }}" method="post" enctype="multipart/form-data"
                id="form" class="form-validate" novalidate="novalidate">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="name">نام</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
                            </div>
                            @error('name')
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
                            <label class="form-label" for="code">کد</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="code" name="code"
                                    value="{{ old('code') }}">
                            </div>
                            @error('code')
                                <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="form-label" for="type">نوع</label>
                        <div class="form-control-wrap">
                            <select onchange="selectDiscountType(this.value)" id="selectOptions" class="form-select"
                                id="type" name="type">
                                <option class="option" title="مبلغی" value="1"
                                    @if (old('type') == 1) selected @endif>مبلغی</option>
                                <option class="option" title="درصدی" value="0"
                                    @if (old('type') == 0) selected @endif>درصدی</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 mt-2" id="amount_all">
                        <div class="form-group">
                            <label class="form-label" for="amount">قیمت</label>
                            <div class="form-control-wrap">
                                <input type="number" id="priceInput" oninput="convertToToman(event)" class="form-control"
                                    id="amount" name="amount" value="{{ old('amount') }}">
                                <p id="convertedPrice" class="breadcrumb-item mt-1"></p>
                            </div>
                            @error('amount')
                                <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6" id="discount_rate">
                        <div class="form-group">
                            <label class="form-label" for="discount_rate">درصد</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="discount_rate" name="discount_rate"
                                    value="{{ old('discount_rate') }}">



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

                    <div class="col-md-6" id="discount_ceiling">
                        <div class="form-group">
                            <label class="form-label" for="discount_ceiling">حداکثر مبلغ برای نوع درصدی</label>
                            <div class="form-control-wrap">


                                <input type="number" id="priceInput1" oninput="convertToToman(event)" class="form-control"
                                    name="discount_ceiling" value="{{ old('discount_ceiling') }}">
                                <p id="convertedPrice1" class="breadcrumb-item mt-1"></p>

                            </div>
                            @error('discount_ceiling')
                                <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mt-2">
                        <div class="form-group">
                            <label class="form-label">تاریخ انتشار</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    <em class="icon ni ni-calendar"></em>
                                </div>
                                <input type="text" id="start_date_view"
                                    class="form-control persiandate pwt-datepicker-input-element text-right">
                                <input type="text" name="start_date" id="start_date" class="d-none">
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

                    <div class="col-md-4 mt-2">
                        <div class="form-group">
                            <label class="form-label">تاریخ انقضاء</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    <em class="icon ni ni-calendar"></em>
                                </div>
                                <input type="text" id="end_date_view"
                                    class="form-control persiandate pwt-datepicker-input-element text-right">
                                <input type="text" name="end_date" id="end_date" class="d-none">
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

                    <div class="px-3 mt-3">
                        <label class="form-label" for="customFileLabel">توضیحات کد تخفیف</label>
                        <textarea name="description" class="tinymce-menubar form-control">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                        @enderror
                    </div>



                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">ذخیره اطلاعات</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/admin/js/persian-date.js') }}"></script>
    <script src="{{ asset('assets/admin/js/persian-datepicker.js') }}"></script>
    <script>
        var selectOptions = document.getElementById("selectOptions");
        var amountInput = document.querySelector("#amount_all");
        var discountRateInput = document.getElementById("discount_rate");
        var discountCeilingInput = document.getElementById("discount_ceiling");

        let rate = selectOptions.value
        selectDiscountType(rate);

        function selectDiscountType(rate = 0) {
            if (selectOptions.value === "0") {
                amountInput.classList.add("d-none")
                discountRateInput.classList.remove("d-none")
                discountCeilingInput.classList.remove("d-none")

            } else if (selectOptions.value === "1") {
                amountInput.classList.remove("d-none")
                discountRateInput.classList.add("d-none")
                discountCeilingInput.classList.add("d-none")
            }
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date'
                // minDate: 'today'
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date',
                // minDate: 'today'
            })
        });
    </script>


    <script>
        const {
            numberToWords
        } = PersianTools;

        function convertToToman(event) {
            var price = event.target.value;
            var number = price;
            var words = numberToWords(number);
            event.target.nextElementSibling.innerText = words + " تومان";
        }
    </script>
@endsection
