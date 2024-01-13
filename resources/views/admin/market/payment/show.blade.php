@extends('admin.layouts.app', ['title' => 'جزیئات پرداخت'])

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">
                                    جزئیات پرداخت
                                </h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('admin.market.online-payments.index') }}"
                                    class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                        class="icon ni ni-arrow-left"></em><span>بازگشت</span></a>
                            </div>
                        </div>
                    </div>
                    <!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="invoice">
                            <!-- .invoice-actions -->
                            <div class="invoice-wrap">
                                <div class="invoice-brand text-center">
                                    <img src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="">
                                </div>
                                <div class="invoice-head">
                                    <div class="invoice-contact">
                                        <div class="invoice-contact-info">
                                            <h4 class="title">{{ $onlinePayment->user->full_name }}</h4>
                                            <ul class="list-plain">
                                                <li><em
                                                        class="icon ni ni-call-fill"></em><span>{{ $onlinePayment->user->phone_number }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="invoice-desc">
                                        <ul class="list-plain">
                                            <li class="invoice-date">
                                                <span>تاریخ</span>:<span>{{ getJalaliTime($onlinePayment->created_at, 'd F Y') }}</span>
                                            </li>
                                            <li class="invoice-date">
                                                <span>وضعیت</span>:<span>{{ $onlinePayment->is_processed ? 'در حال پردازش' : 'پایان یافته' }}</span>
                                            </li>
                                            <li class="invoice-date">
                                                <span>وضعیت
                                                    پرداخت</span>:<span>{{ $onlinePayment->is_succeed ? 'پرداخت شده' : 'پرداخت نشده' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- .invoice-head -->
                                <div class="invoice-bills">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="w-150px">کد پیگیری</th>
                                                    <th>کد وضعیت</th>
                                                    <th>پیام</th>
                                                    <th>شناسه پرداخت</th>
                                                    <th>مبلغ پرداخت شده</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $bankResponses['RefID'] }}</td>
                                                    <td>
                                                        {{ $bankResponses['Status'] }}
                                                    </td>
                                                    <td>
                                                        {{ $bankResponses['Message'] }}
                                                    </td>
                                                    <td>{{ $bankResponses['Authority'] }}</td>
                                                    <td><span class="money">{{ $onlinePayment->amount }}</span> تومان</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- .invoice-bills -->
                            </div>
                            <!-- .invoice-wrap -->
                        </div>
                        <!-- .invoice -->
                    </div>
                    <!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.querySelectorAll('.money').forEach((item) => {
            const regex = /(\d)(?=(\d{3})+$)/g;
            item.textContent = item.textContent.toString().replace(regex, '$1,');
        })
    </script>
@endsection
