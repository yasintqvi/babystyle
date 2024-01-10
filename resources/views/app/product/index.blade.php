@extends('app.layouts.app', ['title' => 'محصولات'])

@section('head-tag')
<link rel="stylesheet" href="{{ asset('assets/app/css/flowbite.min.css') }}" />

@endsection

@section('content')
    <div class="container flex flex-wrap py-5 min-h-screen">
        <div class="md:w-1/4 w-full md:pl-2 mb-4">
            <div id="filterContainer"
                class="border rounded-lg md:sticky fixed top-0 left-0 w-full h-full md:h-max md:translate-y-0 z-40 translate-y-full transition-all duration-1000 bg-white p-5">
                <form action="" id="filter-form" class="divide-y">
                    <div class="flex justify-between items-center pb-8">
                        <div class="flex font-medium items-center gap-2">
                            <button id="closeFilterBTN" class="md:hidden block">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <span>فیلترها </span>
                        </div>

                        <button href="editProfile.html">
                            <span class="text-xs font-medium text-cyan-500">
                                حذف فیلتر‌ها</span>
                        </button>
                    </div>

                    <div class="">
                        <div class="flex relative w-full items-center justify-between py-3 gap-2 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                            </svg>

                            <span class="font-medium"> دسته بندی ها </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>

                            <button id="brandBTN" class="absolute w-full h-full top-0"></button>
                        </div>
                        <div class="divide-y overflow-hidden">
                            @foreach ($categories as $category)
                                <div class="flex gap-2 items-center py-4 mr-1">
                                    <div class="flex items-center">
                                        <input id="category-{{ $category->id }}" type="checkbox" value=""
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 ">
                                    </div>
                                    <label for="category-{{ $category->id }}"
                                        class="flex w-full justify-between items-center text-gray-600 text-sm">
                                        <span> {{ $category->title }}</span>
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="">
                        <form action="" method="get">
                            <div class="flex relative w-full items-center justify-between py-3 gap-2 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                </svg>
                                <span class="font-medium"> محدوده قیمت </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>

                            <a id="priceRangeBTN" class="absolute cursor-pointer w-full h-full top-0"></a>
                        </div>
                        <div class="divide-y overflow-hidden h-0">
                            <div class="flex gap-2 items-center py-4">
                                <div class="flex items-center w-full gap-2">
                                    <span>از</span>
                                    <input type="text" dir="ltr" oninput="formatInput(event)" name="price[min]"
                                        value="{{ request('price')['min'] ?? '' }}"
                                        class="w-full border-none price-limiter text-lg font-bold tracking-widest outline-none focus:ring-0">
                                    <span> تومان </span>
                                </div>
                            </div>

                            <div class="flex gap-2 items-center py-4">
                                <div class="flex items-center w-full gap-2">
                                    <span>تا</span>
                                    <input type="text" dir="ltr" oninput="formatInput(event)" name="price[max]"
                                        value="{{ request('price')['max'] ?? '' }}"
                                        class="w-full border-none price-limiter text-lg font-bold tracking-widest outline-none focus:ring-0">
                                    <span> تومان </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-2 border-transparent bg-green-400 text-white rounded-md mt-4">
                        اعمال تغییرات
                    </button>
                </form>
            </div>
        </div>

        <div class="md:w-3/4 w-full md:pr-2 space-y-4">
            <div class="flex items-center my-2">
                <div class="md:hidden flex gap-3">
                    <button id="openFilterBTN" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>
                    </button>
                    <button id="openSortBTN" class="">
                        <svg class="w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                            <path
                                d="M151.6 469.6C145.5 476.2 137 480 128 480s-17.5-3.8-23.6-10.4l-88-96c-11.9-13-11.1-33.3 2-45.2s33.3-11.1 45.2 2L96 365.7V64c0-17.7 14.3-32 32-32s32 14.3 32 32V365.7l32.4-35.4c11.9-13 32.2-13.9 45.2-2s13.9 32.2 2 45.2l-88 96zM320 32h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 128h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 128H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 128H544c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32z" />
                        </svg>
                    </button>
                </div>
                <div class="md:flex hidden mx-2 items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                        <path
                            d="M151.6 469.6C145.5 476.2 137 480 128 480s-17.5-3.8-23.6-10.4l-88-96c-11.9-13-11.1-33.3 2-45.2s33.3-11.1 45.2 2L96 365.7V64c0-17.7 14.3-32 32-32s32 14.3 32 32V365.7l32.4-35.4c11.9-13 32.2-13.9 45.2-2s13.9 32.2 2 45.2l-88 96zM320 32h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 128h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 128H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32zm0 128H544c17.7 0 32 14.3 32 32s-14.3 32-32 32H320c-17.7 0-32-14.3-32-32s14.3-32 32-32z" />
                    </svg>
                    <span class="text-sm font-medium text-gray-600">مرتب سازی:</span>
                </div>
                <ul id="sortContainer"
                    class="flex flex-col md:flex-row items-center md:static fixed bg-white bottom-0 left-0 z-40 w-full rounded-t-2xl shadow-[0px_0px_10px_10px_#00000024] md:shadow-none md:w-auto text-xs font-medium text-gray-500 md:gap-2 divide-y md:divide-y-0 px-5 md:px-0 translate-y-full md:translate-y-0 transition-all duration-1000">
                    <li class="flex md:hidden items-center gap-2 w-full py-4 md:py-0 font-bold text-base">
                        <button id="closeSortBTN">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                        مرتب سازی بر اساس
                    </li>
                    <li class="w-full">
                        <a class="block w-max py-4 md:py-0"
                            href="{{ requestWithQuery(['sort' => 'newaest']) }}">جدیدترین</a>
                    </li>
                    <li class="w-full">
                        <a class="block w-max py-4 md:py-0"
                            href="{{ requestWithQuery(['sort' => 'most-seller']) }}">پرفروش‌
                            ترین‌</a>
                    </li>
                    <li class="w-full">
                        <a class="block w-max py-4 md:py-0"
                            href="{{ requestWithQuery(['sort' => 'cheapest']) }}">ارزان‌ترین</a>
                    </li>
                    <li class="w-full">
                        <a class="block w-max py-4 md:py-0"
                            href="{{ requestWithQuery(['sort' => 'most-expensive']) }}">گران‌ترین</a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-wrap">
                @forelse ($products as $product)
                    @php
                        $productItem = $product->items->where('is_default', 1)->first() ?? $product->items->first();
                    @endphp
                    <a href="{{ $product->path() }}" class="xl:w-1/4 sm:w-1/3 w-1/2 p-2">
                        <div
                            class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
                            <img class="aspect-square object-cover w-full group-hover:hidden"
                                src="{{ asset($product->primary_image) }}" alt="{{ $product->title }}" />
                            <img class="aspect-square object-cover w-full group-hover:block hidden"
                                src="{{ asset($product->secondary_image ?? $product->primary_image) }}"
                                alt="{{ $product->title }}" />
                            <div class="bg-white">
                                <div
                                    class="flex flex-col absolute bottom-0 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                    <span class="line-clamp-1 text-xs font-bold">
                                        {{ $product->title }}
                                    </span>
                                    @if ($product->quantity > 0)
                                        @if ($discount = $productItem->discounts()->active()->first())
                                            <div class="flex justify-between items-center w-full mt-2">
                                                <span
                                                    class="py-0.5 px-1.5 rounded-full text-xs font-bold bg-red-500 text-gray-50">{{ $discount->discount_rate }}%</span>
                                                <div class="flex items-center font-medium">
                                                    <span
                                                        class="mx-1 text-black">{{ calcDiscount($productItem->price, $discount->discount_rate) }}</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="25"
                                                        height="25" viewBox="0 0 152 143">
                                                        <image id="Layer_0" data-name="Layer 0" x="3" y="44"
                                                            width="143" height="75"
                                                            xlink:href="data:img/png;base64,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" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="mr-auto">
                                                <span
                                                    class="text-gray-600 line-through text-sm">{{ $productItem->price }}</span>
                                            </div>
                                        @else
                                            <div class="flex items-end justify-end font-medium mt-2">
                                                <span class="mx-1 text-black">{{ $productItem->price }}</span>
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="25"
                                                    height="25" viewBox="0 0 152 143">
                                                    <image id="Layer_0" data-name="Layer 0" x="3" y="44" width="143"
                                                        height="75"
                                                        xlink:href="data:img/png;base64,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" />
                                                </svg>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-center py-3">
                                            <span class="text-gray-400 font-bold">ناموجود</span>
                                        </div>
                                    @endif
                                </div>
                                <div
                                    class="flex py-2 justify-center items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">

                                    @foreach ($product->items as $item)
                                        @foreach ($item->variationOptions()->where('is_color', 1)->get() as $option)
                                            <div class="w-3 h-3 rounded-full ring-1 "
                                                style="background: {{ $option->second_value }}"></div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="flex ring-1 rounded-xl p-2 mt-3 bg-red-50 w-full justify-center items-center">
                        <p>محصولی وجود ندارد</p>
                    </div>
                @endforelse
            </div>
            <div class="my-4">
                {{ $products->render('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function formatInput(event) {
            const value = event.target.value.replace(/\D/g, '');
            const formattedValue = formatNumber(value);

            event.target.value = formattedValue;
        }

        function formatNumber(value) {
            const regex = /(\d)(?=(\d{3})+$)/g;
            return value.replace(regex, '$1,');
        }
    </script>

    <script>
        const filterForm = document.querySelector('#filter-form');

        filterForm.addEventListener('submit',(event) => {
            event.preventDefault();
            priceLimiterElements = document.querySelectorAll('.price-limiter');

            [...priceLimiterElements].map((item) => {
                item.value = parseInt(item.value.replaceAll(',', ''));
            });
            
            filterForm.submit();
        })
    </script>
@endsection
