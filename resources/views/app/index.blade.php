@extends('app.layouts.app', ['title' => 'صفحه اصلی'])

@section('content')
    <section id="intro">
        <div id="intro-slider" class="md:w-3/4 w-full swiper mb-3 md:mb-0 my-8">
            <div class="flex justify-between absolute top-1/2 -translate-y-1/2 z-20 w-full px-4 items-center">
                <button type="button"
                    class="intro-swiper-button-prev rotate-180 md:bg-primary w-10 h-10 py-2 px-2 md:mr-2 mb-2 flex items-center text-xs font-medium focus:outline-none rounded-xl hover:bg-primary focus:z-10 md:focus:ring-2 focus:ring-yellow-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-20 h-20 text-yellow-900 md:text-white group-hover:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>

                <button type="button"
                    class="intro-swiper-button-next rotate-180 md:bg-primary w-10 h-10 py-2 px-2 md:mr-2 mb-2 flex items-center text-xs font-medium focus:outline-none rounded-xl hover:bg-primary focus:z-10 md:focus:ring-2 focus:ring-yellow-600 group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-20 h-20 text-yellow-900 md:text-white group-hover:text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
            <section class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <section class="swiper-slide">
                        <a href="#">
                            <div
                                class="md:h-full aspect-[16/8.5] md:min-h-[20rem] bg-no-repeat bg-center bg-cover rounded-lg flex items-end">
                                <img src="{{ $slider->image }}" alt="{{ $slider->alt }}">
                            </div>
                        </a>
                    </section>
                @endforeach

            </section>
        </div>
    </section>
    <section id="category" class="container">
        <div class="text-center">
            <span class="title">
                <h4 class="w-max relative right-1/2 translate-x-1/2">دسته بندی ها</h4>
            </span>
        </div>
        <div class="flex justify-between items-center">
            <img class="w-1/3" src="../dist/images/categoryGirl.jpg" alt="" />
            <img class="w-1/3" src="../dist/images/categoryBoy.jpg" alt="" />
            <img class="w-1/3" src="../dist/images/categoryAccessory.jpg" alt="" />
        </div>
    </section>
    <section id="newProducts" class="p-2">
        <div class="container">
            <div class="text-center">
                <span class="title">
                    <h4 class="w-max relative right-1/2 translate-x-1/2">
                        جدیدترین محصولات
                    </h4>
                </span>
            </div>
            <div id="newProducts-slider" class="w-full swiper mb-3 md:mb-0 my-8">
                <div class="flex justify-between absolute top-1/2 -translate-y-1/2 z-20 w-full px-4 items-center">
                    <button type="button"
                        class="newProducts-swiper-button-prev rotate-180 md:bg-primary w-10 h-10 py-2 px-2 md:mr-2 mb-2 flex items-center text-xs font-medium focus:outline-none rounded-xl hover:bg-primary focus:z-10 md:focus:ring-2 focus:ring-yellow-600 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-20 h-20 text-yellow-900 md:text-white group-hover:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <button type="button"
                        class="newProducts-swiper-button-next rotate-180 md:bg-primary w-10 h-10 py-2 px-2 md:mr-2 mb-2 flex items-center text-xs font-medium focus:outline-none rounded-xl hover:bg-primary focus:z-10 md:focus:ring-2 focus:ring-yellow-600 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-20 h-20 text-yellow-900 md:text-white group-hover:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
                <section class="swiper-wrapper">
                    @forelse ($latestProducts as $product)
                        @php
                            $productItem = $product->items->where('is_default', 1)->first() ?? $product->items->first();
                        @endphp
                        <section class="swiper-slide lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                            <a href="{{$product->path()}}">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs xs:text-sm md:text-base">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="   {{ asset($product->primary_image) }}" alt="{{ $product->title }}" />
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
                                                            <image id="Layer_0" data-name="Layer 0" x="3" y="44"
                                                                width="143" height="75"
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
                                    </div>
                            </a>
                        </section>
                    @endforeach
                </section>
            </div>
        </div>
    </section>
    <section id="someProducts" class="container p-2">
        <div class="text-center">
            <span class="title">
                <h4 class="w-max relative right-1/2 translate-x-1/2">
                    نمونه محصولات
                </h4>
            </span>
        </div>
        <div class="container flex flex-wrap">
            <a href="#" class="w-1/2 md:w-1/4 px-2">
                <img class="w-full rounded-lg" src="../dist/images/someProducts1.jpg" alt="" />
            </a>
            <a href="#" class="w-1/2 md:w-1/4 px-2">
                <img class="w-full rounded-lg" src="../dist/images/someProducts2.jpg" alt="" />
            </a>
            <a href="#" class="w-1/2 md:w-1/4 px-2">
                <img class="w-full rounded-lg" src="../dist/images/someProducts3.jpg" alt="" />
            </a>
            <a href="#" class="w-1/2 md:w-1/4 px-2">
                <img class="w-full rounded-lg" src="../dist/images/someProducts4.jpg" alt="" />
            </a>
        </div>
    </section>
    <section id="topProducts">
        <div class="text-center">
            <span class="title">
                <h4 class="w-max relative right-1/2 translate-x-1/2">
                    جدیدترین محصولات
                </h4>
            </span>
        </div>
        <div class="container">
            <div class="flex flex-wrap space-y-3 space-y-reverse">
                @forelse ($productPaginators as $product)
                    @php
                        $productItem = $product->items->where('is_default', 1)->first() ?? $product->items->first();
                    @endphp
                    <section class="lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                        <a href="{{$product->path()}}">
                            <div
                                class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs xs:text-sm md:text-base">
                                <img class="aspect-square object-cover w-full group-hover:hidden"
                                    src="   {{ asset($product->primary_image) }}" alt="{{ $product->title }}" />
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
                                                        <image id="Layer_0" data-name="Layer 0" x="3" y="44"
                                                            width="143" height="75"
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
                                </div>
                        </a>
                    </section>
                @endforeach
            </div>
            <div class="my-4">
                {{ $productPaginators->render('pagination::tailwind') }}
            </div>
          
            
        </div>
    </section>
    <section id="questions">
        <div class="text-center">
            <span class="title">
                <h4 class="w-max relative right-1/2 translate-x-1/2">
                    سوالات پرتکرار
                </h4>
            </span>
        </div>
        <div id="questions-accordion" class="container space-y-5">
            <div id="question-item-1" class="border shadow rounded-lg">
                <div class="relative flex justify-between items-center bg-gray-50 p-5 py-3 font-bold rounded-lg">
                    <span>آیا برای خرید لازم است از قبل در وبسایت ثبت‌نام کرده باشم؟</span>
                    <span id="IsShowing" data-isShowing="false"
                        class="flex justify-center items-center aspect-square text-xl w-8 bg-gray-200 rounded-full text-gray-600 rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                    </span>
                    <div class="questionItems absolute w-full !h-full top-0 left-0"></div>
                </div>
                <div class="content h-0 overflow-hidden">
                    <p class="p-5 border-t-2 bg-gray-100">
                        خیر، شما با انتخاب و اضافه کردن محصولات به سبد خریدتان می‌توانید
                        اطلاعات فردی و ارسالتان را کامل کنید و پرداخت را انجام دهید.
                    </p>
                </div>
            </div>
            <div id="question-item-2" class="border shadow rounded-lg">
                <div class="relative flex justify-between items-center bg-gray-50 p-5 py-3 font-bold rounded-lg">
                    <span> چطور هزینه سفارش را پرداخت کنم؟ </span>
                    <span id="IsShowing"
                        class="flex justify-center items-center aspect-square text-xl w-8 bg-gray-200 rounded-full text-gray-600 rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                    </span>
                    <div class="questionItems absolute w-full !h-full top-0 left-0"></div>
                </div>
                <div class="content h-0 overflow-hidden">
                    <p class="p-5 border-t-2 bg-gray-100">
                        تمامی کاربران می‌توانند از طریق درگاه بانکی با تمام کارت‌های عضو
                        شتاب هزینه سفارش را به صورت اینترنتی پرداخت نمایند.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container my-2">
            <a href="#">
                <img class="hover:scale-105 duration-300 transition-all" src="../dist/images/come to insta.jpg"
                    alt="" />
            </a>
        </div>
    </section>

    
@endsection
