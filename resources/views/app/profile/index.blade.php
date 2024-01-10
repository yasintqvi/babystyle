@extends('app.layouts.app', ['title' => 'پروفایل'])

@section('content')
    <div class="container flex flex-wrap py-5">
        <div class="border md:hidden w-full rounded-lg p-5 shadow mb-4">
            <div class="flex justify-between mb-10 mt-3">
                <h3 class="text-lg text-gray-700 font-medium">سفارش‌های من</h3>
                <a href="#" class="flex items-center text-sm text-cyan-500 gap-0.5">
                    <span>مشاهده همه</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <div class="flex divide-x divide-x-reverse">
                <div class="w-1/3 flex flex-col md:flex-row items-center gap-2 px-10">
                    <div class="relative">
                        <img class="min-w-[50px]" src="{{ asset('defaults/profilePageOrders.svg') }}" alt="" />
                        <span
                            class="absolute bottom-0 left-0 p-1 bg-white rounded-md shadow font-medium text-sm h-6">5</span>
                    </div>
                    <div class="space-y-2">
                        <div class="font-medium"></div>
                        <span class="block text-sm w-max">جاری</span>
                    </div>
                </div>
                <div class="w-1/3 flex flex-col md:flex-row items-center gap-2 px-10">
                    <div class="relative">
                        <img class="min-w-[50px]" src="{{ asset('defaults/profilePageDelivered.svg') }}" alt="" />
                        <span
                            class="absolute bottom-0 left-0 p-1 bg-white rounded-md shadow font-medium text-sm h-6">5</span>
                    </div>
                    <div class="space-y-2">
                        <div class="font-medium"></div>
                        <span class="block text-sm w-max">تحویل شده</span>
                    </div>
                </div>
                <div class="w-1/3 flex flex-col md:flex-row items-center gap-2 px-10">
                    <div class="relative">
                        <img class="min-w-[50px]" src="{{ asset('defaults/profilePageRejected.svg') }}" alt="" />
                        <span
                            class="absolute bottom-0 left-0 p-1 bg-white rounded-md shadow font-medium text-sm h-6">5</span>
                    </div>
                    <div class="space-y-2">
                        <div class="font-medium"></div>
                        <span class="block text-sm w-max">مرجوع شده</span>
                    </div>
                </div>
            </div>
        </div>
        
        @include('app.profile.partials.aside')

        <div class="md:w-3/4 w-full md:pr-2 space-y-4">
            <div class="border rounded-lg p-5 shadow md:block hidden">
                <div class="flex justify-between mb-10 mt-5">
                    <h3 class="text-lg text-gray-700 font-medium">سفارش‌های من</h3>
                    <a href="#" class="flex items-center text-sm text-cyan-500 gap-0.5">
                        <span>مشاهده همه</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div class="flex divide-x divide-x-reverse">
                    <div class="w-full flex flex-col md:flex-row items-center gap-2 px-10">
                        <img src="{{ asset('defaults/profilePageOrders.svg') }}" alt="" />
                        <div class="space-y-2">
                            <div class="font-medium w-max">
                                <span>۰</span>
                                <span> سفارش </span>
                            </div>
                            <span class="block text-sm w-max">جاری</span>
                        </div>
                    </div>
                    <div class="w-full flex items-center gap-2 px-10">
                        <img src="{{ asset('defaults/profilePageDelivered.svg') }}" alt="" />
                        <div class="space-y-2">
                            <div class="font-medium w-max">
                                <span>4</span>
                                <span> سفارش </span>
                            </div>
                            <span class="block text-sm w-max">تحویل شده</span>
                        </div>
                    </div>
                    <div class="w-full flex items-center gap-2 px-10">
                        <img src="{{ asset('defaults/profilePageRejected.svg') }}" alt="" />
                        <div class="space-y-2">
                            <div class="font-medium w-max">
                                <span>2</span>
                                <span> سفارش </span>
                            </div>
                            <span class="block text-sm w-max">مرجوع شده</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border rounded-lg p-5 shadow">
                <div class="flex justify-between mb-10 mt-5">
                    <h3 class="text-lg text-gray-700 font-medium">از لیست‌های شما</h3>
                    <a href="{{ route('products.index') }}" class="flex items-center text-sm text-cyan-500 gap-0.5">
                        <span>مشاهده همه</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <div id="customerList" class="w-full swiper mb-3 md:mb-0 my-8">
                    <button type="button"
                        class="customerList-button-prev rotate-180 md:bg-primary w-10 h-10 py-2 px-2 md:ml-2 mb-2 flex items-center text-xs font-medium focus:outline-none rounded-xl hover:bg-primary focus:z-10 md:focus:ring-2 focus:ring-yellow-600 group absolute top-1/2 -translate-y-1/2 right-0 z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-20 h-20 text-yellow-900 md:text-white group-hover:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <button type="button"
                        class="customerList-button-next rotate-180 md:bg-primary w-10 h-10 py-2 px-2 md:mr-2 mb-2 flex items-center text-xs font-medium focus:outline-none rounded-xl hover:bg-primary focus:z-10 md:focus:ring-2 focus:ring-yellow-600 group absolute top-1/2 -translate-y-1/2 left-0 z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-20 h-20 text-yellow-900 md:text-white group-hover:text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>

                    <section class="swiper-wrapper">
                        <section class="swiper-slide xl:w-1/4 sm:w-1/3 w-1/2 px-2">
                            <a href="#">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs lg:text-sm">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="../dist/images/top-product1.jpeg" alt="" />
                                    <img class="aspect-square object-cover w-full group-hover:block hidden"
                                        src="../dist/images/top-product2.jpeg" alt="" />
                                    <div class="bg-white">
                                        <div
                                            class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                            <span class="line-clamp-1 text-center">ست آستین خرسی کد 002
                                            </span>
                                            <span class="block font-medium">695,000 تومان</span>
                                        </div>
                                        <div
                                            class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                            <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 lg:w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </button>
                                            <button class="w-2/3 bg-primary text-white text-center rounded p-1 py-2">
                                                مشاهده و خرید
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                        <section class="swiper-slide xl:w-1/4 sm:w-1/3 w-1/2 px-2">
                            <a href="#">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs lg:text-sm">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="../dist/images/top-product1.jpeg" alt="" />
                                    <img class="aspect-square object-cover w-full group-hover:block hidden"
                                        src="../dist/images/top-product2.jpeg" alt="" />
                                    <div class="bg-white">
                                        <div
                                            class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                            <span class="line-clamp-1 text-center">ست آستین خرسی کد 002
                                            </span>
                                            <span class="block font-medium">695,000 تومان</span>
                                        </div>
                                        <div
                                            class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                            <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 lg:w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </button>
                                            <button class="w-2/3 bg-primary text-white text-center rounded p-1 py-2">
                                                مشاهده و خرید
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                        <section class="swiper-slide xl:w-1/4 sm:w-1/3 w-1/2 px-2">
                            <a href="#">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs lg:text-sm">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="../dist/images/top-product1.jpeg" alt="" />
                                    <img class="aspect-square object-cover w-full group-hover:block hidden"
                                        src="../dist/images/top-product2.jpeg" alt="" />
                                    <div class="bg-white">
                                        <div
                                            class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                            <span class="line-clamp-1 text-center">ست آستین خرسی کد 002
                                            </span>
                                            <span class="block font-medium">695,000 تومان</span>
                                        </div>
                                        <div
                                            class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                            <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 lg:w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </button>
                                            <button class="w-2/3 bg-primary text-white text-center rounded p-1 py-2">
                                                مشاهده و خرید
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                        <section class="swiper-slide xl:w-1/4 sm:w-1/3 w-1/2 px-2">
                            <a href="#">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs lg:text-sm">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="../dist/images/top-product1.jpeg" alt="" />
                                    <img class="aspect-square object-cover w-full group-hover:block hidden"
                                        src="../dist/images/top-product2.jpeg" alt="" />
                                    <div class="bg-white">
                                        <div
                                            class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                            <span class="line-clamp-1 text-center">ست آستین خرسی کد 002
                                            </span>
                                            <span class="block font-medium">695,000 تومان</span>
                                        </div>
                                        <div
                                            class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                            <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 lg:w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </button>
                                            <button class="w-2/3 bg-primary text-white text-center rounded p-1 py-2">
                                                مشاهده و خرید
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                        <section class="swiper-slide xl:w-1/4 sm:w-1/3 w-1/2 px-2">
                            <a href="#">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs lg:text-sm">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="../dist/images/top-product1.jpeg" alt="" />
                                    <img class="aspect-square object-cover w-full group-hover:block hidden"
                                        src="../dist/images/top-product2.jpeg" alt="" />
                                    <div class="bg-white">
                                        <div
                                            class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                            <span class="line-clamp-1 text-center">ست آستین خرسی کد 002
                                            </span>
                                            <span class="block font-medium">695,000 تومان</span>
                                        </div>
                                        <div
                                            class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                            <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 lg:w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </button>
                                            <button class="w-2/3 bg-primary text-white text-center rounded p-1 py-2">
                                                مشاهده و خرید
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                        <section class="swiper-slide xl:w-1/4 sm:w-1/3 w-1/2 px-2">
                            <a href="#">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs lg:text-sm">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="../dist/images/top-product1.jpeg" alt="" />
                                    <img class="aspect-square object-cover w-full group-hover:block hidden"
                                        src="../dist/images/top-product2.jpeg" alt="" />
                                    <div class="bg-white">
                                        <div
                                            class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                            <span class="line-clamp-1 text-center">ست آستین خرسی کد 002
                                            </span>
                                            <span class="block font-medium">695,000 تومان</span>
                                        </div>
                                        <div
                                            class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                            <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 lg:w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </button>
                                            <button class="w-2/3 bg-primary text-white text-center rounded p-1 py-2">
                                                مشاهده و خرید
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                        <section class="swiper-slide xl:w-1/4 sm:w-1/3 w-1/2 px-2">
                            <a href="#">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs lg:text-sm">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="../dist/images/top-product1.jpeg" alt="" />
                                    <img class="aspect-square object-cover w-full group-hover:block hidden"
                                        src="../dist/images/top-product2.jpeg" alt="" />
                                    <div class="bg-white">
                                        <div
                                            class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                            <span class="line-clamp-1 text-center">ست آستین خرسی کد 002
                                            </span>
                                            <span class="block font-medium">695,000 تومان</span>
                                        </div>
                                        <div
                                            class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                            <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 lg:w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </button>
                                            <button class="w-2/3 bg-primary text-white text-center rounded p-1 py-2">
                                                مشاهده و خرید
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                        <section class="swiper-slide xl:w-1/4 sm:w-1/3 w-1/2 px-2">
                            <a href="#">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs lg:text-sm">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="../dist/images/top-product1.jpeg" alt="" />
                                    <img class="aspect-square object-cover w-full group-hover:block hidden"
                                        src="../dist/images/top-product2.jpeg" alt="" />
                                    <div class="bg-white">
                                        <div
                                            class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                            <span class="line-clamp-1 text-center">ست آستین خرسی کد 002
                                            </span>
                                            <span class="block font-medium">695,000 تومان</span>
                                        </div>
                                        <div
                                            class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                            <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 lg:w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </button>
                                            <button class="w-2/3 bg-primary text-white text-center rounded p-1 py-2">
                                                مشاهده و خرید
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                        <section class="swiper-slide xl:w-1/4 sm:w-1/3 w-1/2 px-2">
                            <a href="#">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs lg:text-sm">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="../dist/images/top-product1.jpeg" alt="" />
                                    <img class="aspect-square object-cover w-full group-hover:block hidden"
                                        src="../dist/images/top-product2.jpeg" alt="" />
                                    <div class="bg-white">
                                        <div
                                            class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                            <span class="line-clamp-1 text-center">ست آستین خرسی کد 002
                                            </span>
                                            <span class="block font-medium">695,000 تومان</span>
                                        </div>
                                        <div
                                            class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                            <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 lg:w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </button>
                                            <button class="w-2/3 bg-primary text-white text-center rounded p-1 py-2">
                                                مشاهده و خرید
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                        <section class="swiper-slide xl:w-1/4 sm:w-1/3 w-1/2 px-2">
                            <a href="#">
                                <div
                                    class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs lg:text-sm">
                                    <img class="aspect-square object-cover w-full group-hover:hidden"
                                        src="../dist/images/top-product1.jpeg" alt="" />
                                    <img class="aspect-square object-cover w-full group-hover:block hidden"
                                        src="../dist/images/top-product2.jpeg" alt="" />
                                    <div class="bg-white">
                                        <div
                                            class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white px-2">
                                            <span class="line-clamp-1 text-center">ست آستین خرسی کد 002
                                            </span>
                                            <span class="block font-medium">695,000 تومان</span>
                                        </div>
                                        <div
                                            class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                            <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 lg:w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                </svg>
                                            </button>
                                            <button class="w-2/3 bg-primary text-white text-center rounded p-1 py-2">
                                                مشاهده و خرید
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </section>
                    </section>
                </div>
            </div>
           
        </div>
    </div>
@endsection
