@extends('app.layouts.app', ['title' => 'سفارشات'])

@section('content')
    <div class="container flex flex-wrap py-5">

        @include('app.profile.partials.aside')
        <div class="md:w-3/4 w-full md:pr-2 space-y-4">
            <div class="border rounded-lg py-5 shadow md:block">
                <div class="flex justify-between px-5">
                    <div class="flex gap-2 items-center pb-4">
                        <a href="#" class="md:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <h3 class="font-medium">تاریخچه سفارشات</h3>
                    </div>
                </div>
                <div class="">
                    @php
                        $statuses = \App\Models\Market\Order::ORDER_STATUSES;
                        $requestStatus = request('status') ?? 'order_confirm';
                    @endphp
                    <div class="flex border-b gap-3 md:mt-2 mt-5 px-5 overflow-auto">
                        @foreach ($statuses as $key => $status)
                            <a href="{{ route('profile.orders.index', ['status' => $key]) }}"
                                class="w-max flex gap-1 text-sm font-medium p-1 px-3 py-2 rounded {{ $requestStatus == $key ? 'border-b-4 border-red-500' : '' }}">
                                <span class="w-max"> {{ $status }} </span>
                                <span
                                    class="flex items-center justify-center {{ $requestStatus == $key ? 'bg-red-500' : 'bg-gray-300' }} p-1 text-white aspect-square h-5 text-sm rounded">{{ $orderCounts[$key ?? 'order_confirm'] }}</span>
                            </a>
                        @endforeach
                    </div>
                    @forelse($orders as $order)
                        <a href="" class="block border rounded-lg my-3 mx-5">
                            <div class="flex justify-between p-4">
                                <div class="flex gap-2">
                                    <span class="font-medium">{{ $statuses[request('status')] ?? 'در حال پردازش' }}</span>
                                </div>
                            </div>
                            <div class="flex items-center mx-5 gap-4 pb-4">
                                <span class="text-sm font-medium text-gray-600">
                                    {{-- 9 بهمن 1399 --}}
                                    {{ getJalaliTime($order->created_at, 'd F Y') }}
                                </span>
                                <span
                                    class="flex justify-center text-2xl font-bold bg-gray-300 h-1 aspect-square rounded-full"></span>
                                <span
                                    class="hidden md:flex justify-center text-2xl font-bold bg-gray-300 h-1 aspect-square rounded-full"></span>

                                <span class="hidden md:block text-sm text-gray-600">
                                    مبلغ
                                    <span
                                        class="inline-block font-medium text-gray-800 mr-2 money">{{ $order->final_amount }}</span>
                                    <span class="text-xs"> تومان </span>
                                </span>
                                <span
                                    class="hidden md:flex justify-center text-2xl font-bold bg-gray-300 h-1 aspect-square rounded-full"></span>

                                <span class="hidden md:block text-sm text-gray-600">
                                    تخفیف
                                    <span
                                        class="inline-block font-medium text-gray-800 mr-2 money">{{ $order->order_discount }}</span>
                                    <span class="text-xs"> تومان </span>
                                </span>
                            </div>
                            <div class="border-t flex px-5 py-4 gap-4">
                                @foreach ($order->lines()->get() as $orderLine)
                                    @php 
                                        $productItem = $orderLine->productItem;
                                    @endphp
                                    <div class="flex items-center flex-col">
                                        <img class="aspect-square object-cover rounded-md w-20"
                                        src="{{ asset($productItem->image) }}" alt="" />
                                        <span class="text-xs text-gray-400">{{ $productItem->sku }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </a>
                    @empty
                        <div class="text-center text-gray-500 py-8">هیچ سفارشی یافت نشد</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/app/js/custom.js') }}"></script>
@endsection
