@extends('admin.layouts.app', ['title' => 'جزیئات سفارش'])

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">
                                    جزئیات سفارش
                                </h3>
                            </div>
                            <div class="nk-block-head-content">
                                <a href="{{ route('admin.market.orders.index') }}"
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
                                            <h4 class="title">{{ $order->user->full_name }}</h4>
                                            <ul class="list-plain">
                                                <li>
                                                    <em class="icon ni ni-map-pin-fill"></em>
                                                    <span>
                                                        {{ $order->address->address }}
                                                    </span>
                                                </li>
                                                <li><em
                                                        class="icon ni ni-call-fill"></em><span>{{ $order->user->phone_number }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="invoice-desc">
                                        <ul class="list-plain">
                                            <li class="invoice-date">
                                                <span>تاریخ</span>:<span>{{ getJalaliTime($order->created_at, 'd F Y') }}</span>
                                            </li>
                                            <li class="invoice-date">
                                                <span>وضعیت سفارش</span>:<span>{{ $order->getOrderStatus() }}</span>
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
                                                    <th class="w-150px">شناسه محصول</th>
                                                    <th class="w-60">توضیحات</th>
                                                    <th>قیمت واحد</th>
                                                    <th>تعداد</th>
                                                    <th>مبلغ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->lines as $orderLine)
                                                    @php
                                                        $productItem = $orderLine->productItem;
                                                    @endphp
                                                    <tr>
                                                        <td><a href="{{ route('admin.market.items.edit', [$productItem->product->id, $productItem->id]) }}"
                                                                target="_blank">#{{ $productItem->sku }}</a></td>
                                                        <td>
                                                            {{ $productItem->product->title }}
                                                        </td>
                                                        <td><span class="money">{{ $productItem->price }}</span> تومان</td>
                                                        <td>{{ $productItem->quantity }}</td>
                                                        <td class="money">{{ $productItem->price * $productItem->quantity }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">جمع کل محصولات</td>
                                                    <td><span class="money">{{ $order->total_products_amount }}</span> تومان</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">هزینه ی ارسال</td>
                                                    <td><span class="money">{{ $order->shipping_amount }}</span> تومان</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">مبلغ تخفیف</td>
                                                    <td><span class="money">{{ $order->order_discount }}</span> تومان</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">هزینه نهایی</td>
                                                    <td><span class="money">{{ $order->final_amount }}</span> تومان</td>
                                                </tr>
                                            </tfoot>
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
