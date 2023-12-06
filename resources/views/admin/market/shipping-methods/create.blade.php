@extends('admin.layouts.app', ['title' => 'ایجاد روش ارسال'])

@section('content')
    <ul class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="#">صفحه اصلی</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.market.shipping-methods.index') }}">روش های ارسال</a></li>
        <li class="breadcrumb-item active">ایحاد روش ارسال </li>
    </ul>

    <!-- .nk-block-head-content -->
    <div class="nk-block-between mb-4 mt-2">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">ایجاد روش ارسال </h3>
        </div>
        <!-- .nk-block-head-content -->
        <a href="{{ route('admin.market.shipping-methods.index') }}" class="btn btn-success">بازگشت</a>

        <!-- .nk-block-head-content -->
    </div>



    <div class="card">
        <div class="card-inner">
            <form action="{{ route('admin.market.shipping-methods.store') }}" method="post" enctype="multipart/form-data"
                id="form" class="form-validate" novalidate="novalidate">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="name">نام روش ارسال</label>
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

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="price">هزینه ارسال</label>
                            <div class="form-control-wrap">
                                <input type="number" id="priceInput" oninput="convertToToman()"
                                    oninput="convertToPersianCurrency()" class="form-control" id="price" name="price"
                                    value="{{ old('title') }}">
                                <p id="convertedPrice" class="breadcrumb-item mt-1" ></p>
                            </div>
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
                            <label class="form-label" for="delivery_time">مدت زمان ارسال</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="delivery_time" name="delivery_time"
                                    value="{{ old('title') }}">
                            </div>
                            @error('delivery_time')
                                <span class="alert_required text-danger xl-1 p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-lg btn-primary">ذخیره اطلاعات</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        const {
            numberToWords
        } = PersianTools;

    function convertToToman() {
        var price = document.getElementById("priceInput").value;
        var number = price;
        var words = numberToWords(number);
        document.getElementById("convertedPrice").innerText = words + " تومان";
    }
</script>
@endsection
