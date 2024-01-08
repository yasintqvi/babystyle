@extends('app.layouts.app', ['title' => 'سبد خرید'])


@section('content')
    @php

        $totalAmount = 0;

        $discountAmount = 0;

    @endphp

    <section>
        <div class="container flex flex-wrap md:flex-nowrap py-5 gap-4">
            <div class="md:w-3/4 w-full">
                <div class="border rounded-lg py-5 space-y-2">
                    <div class="flex justify-between px-5">
                        <span class="font-semibold text-gray-700">سبد خرید شما</span>
                    </div>
                    <div class="text-gray-500 text-sm px-5">
                        <span>{{ $shoppingCartItems->sum('quantity') }}</span>
                        <span> کالا</span>
                    </div>
                    <div class="divide-y">
                        @forelse($shoppingCartItems as $shoppingCartItem)
                            @php
                                $productItem = $shoppingCartItem->productItem;
                            @endphp
                            <div class="p-5 relative">
                                <div class="flex gap-4">
                                    <img class="min-w-[3rem] w-1/2 md:w-1/6 aspect-square object-cover rounded"
                                        src="{{ $productItem->image }}" alt="{{ $productItem->product->title }}" />
                                    <div class="space-y-1 {{ $productItem->quantity < 1 ? 'blur-[1.5px]' : '' }}">
                                        <a href="{{ $productItem->product->path() }}" target="_blank"
                                            class="block font-medium pb-1 text-xs sm:text-base">{{ $productItem->product->title }}
                                            کد
                                            {{ $productItem->sku }}</a>
                                        @php
                                            $options = $productItem->variationOptions()->get();
                                        @endphp
                                        @foreach ($options as $option)
                                            @if ($option->is_color)
                                                <div class="flex items-center gap-1">

                                                    <span class="block w-5 h-5 rounded-full"
                                                        style="background: {{ $option->second_value }}"></span>

                                                    <span class="text-sm text-gray-600">{{ $option->value }}</span>
                                                </div>
                                            @else
                                                <div class="flex items-center gap-1">
                                                    <span class="flex justify-center w-5 fill-gray-600">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0 1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z" />
                                                        </svg>
                                                    </span>

                                                    <span class="text-sm text-gray-600">{{ $option->value }}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    @if ($productItem->quantity > 0)
                                        <div class="flex items-center mt-6 space-x-2 space-x-reverse">
                                            <form
                                                action="{{ route('shopping-cart.change-quantity', $shoppingCartItem->id) }}"
                                                method="POST" id="quantityForm"
                                                class="rounded px-2 quantity-form">
                                                @csrf
                                                <div class="flex flex-col sm:flex-row items-center">
                                                    <div
                                                        class="border min-w-[8rem] ml-3 flex justify-between items-center rounded-lg text-red-400">
                                                        <button class="text-2xl w-1/3 flex justify-center items-center py-1"
                                                            data-action="plus">
                                                            +
                                                        </button>
                                                        <input type="hidden" name="quantity"
                                                            value="{{ $shoppingCartItem->quantity }}">
                                                        <span class="text-lg w-1/3 flex justify-center items-center py-1"
                                                            id="currentQuantity">{{ $shoppingCartItem->quantity }}</span>
                                                        <button class="text-2xl w-1/3 flex justify-center items-center py-1"
                                                            data-action="minus">
                                                            -
                                                        </button>
                                                    </div>
                                                    @php
                                                        $totalAmount += $productItem->price * $shoppingCartItem->quantity;
                                                    @endphp
                                                    <div class="space-y-1">
                                                        @if ($productItem->hasDiscount())
                                                            @php
                                                                $discountAmountItem = ($productItem->price - $productItem->price_with_discount) * $shoppingCartItem->quantity;
                                                                $discountAmount += $discountAmountItem;
                                                            @endphp
                                                            <div class="text-sm text-red-400 font-medium">
                                                                <span class="money">{{ $discountAmountItem }}</span>
                                                                <span class="text-xs">تومان</span>
                                                                <span> تخفیف</span>
                                                            </div>
                                                        @endif
                                                        <div class="text-lg font-medium ">
                                                            <span
                                                                class="money product-price-unit" data-unit-price="{{ $productItem->price_with_discount }}">{{ $productItem->price_with_discount * $shoppingCartItem->quantity }}</span>
                                                            <span class="text-sm"> تومان </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <div
                                            class="text-gray-500 opacity-20 -rotate-[23deg] font-bold absolute right-[50%] top-[50%] text-3xl">
                                            ناموجود</div>
                                    @endif
                                    <form action="{{ route('shopping-cart.destroy', $shoppingCartItem->id) }}"
                                        method="POST" class="mr-auto">
                                        @method('DELETE')
                                        @csrf
                                        <button class="text-red-600 text-sm md:text-base mr-auto blur-0">
                                            حذف کالا
                                        </button>
                                    </form>

                                </div>
                            </div>
                        @empty
                            <div class="text-gray-600 text-center py-3">
                                سبد خرید خالی می باشد.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="md:w-1/4 w-full">
                <div class="sticky top-2">
                    <div class="space-y-4 border rounded-lg font-medium p-5 text-sm">
                        <form action="{{ route('shopping-cart.get-amounts') }}" method="post" id="getAmountsForm">
                            @csrf
                        </form>
                        <div class="flex justify-between text-gray-500">
                            <span>قیمت کل</span>
                            <span>
                                <span class="money" id="totalAmount">{{ $totalAmount }}</span>

                                <span class="text-xs">تومان</span>
                            </span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span> جمع سبد خرید (قابل پرداخت) </span>
                            <span>
                                <span class="money" id="final_amount">{{ $totalAmount - $discountAmount }}</span>
                                <span class="text-xs">تومان</span>
                            </span>
                        </div>
                        <div class="flex justify-between items-center text-red-500">
                            <span> سود شما از خرید </span>
                            <span>
                                <span class="money" id="discountAmount">{{ $discountAmount }}</span>
                                <span class="text-xs">تومان</span>
                            </span>
                        </div>
                        <button class="w-full py-3 bg-primary text-white rounded-lg">
                            ثبت سفارش
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 py-2 leading-relaxed">
                        هزینه این سفارش هنوز پرداخت نشده‌ و در صورت اتمام موجودی، کالاها
                        از سبد حذف می‌شوند
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container my-2">
            <a href="#">
                <img class="hover:scale-105 duration-300 transition-all" src="../dist/images/product-cute-ball.jpg"
                    alt="" />
            </a>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/app/js/shoppingCart.js') }}"></script>
    <script src="{{ asset('assets/app/js/custom.js') }}"></script>

    <script>
        const quantityForms = document.querySelectorAll('.quantity-form');
        document.addEventListener("DOMContentLoaded", () => {
            [...quantityForms].map((form) => {
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const {
                        target: qtyForm,
                        submitter
                    } = e;
                    const shc = new ShoppingCart();
                    shc.changeQuantity(qtyForm, submitter.dataset.action);
                })
            })
        })
    </script>
@endsection
