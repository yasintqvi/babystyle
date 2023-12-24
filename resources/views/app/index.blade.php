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
                            <img src="{{ $slider->image }}" alt="{{ $slider->aalt }}">
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
                    <section class="swiper-slide lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                        <a href="#">
                            <div
                                class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </button>
                                        <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                            مشاهده و خرید
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                    <section class="swiper-slide lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                        <a href="#">
                            <div
                                class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
                                <img class="aspect-square object-cover w-full group-hover:hidden"
                                    src="../dist/images/top-product1.jpeg" alt="" />
                                <img class="aspect-square object-cover w-full group-hover:block hidden"
                                    src="../dist/images/top-product2.jpeg" alt="" />
                                <div class="bg-white">
                                    <div
                                        class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white">
                                        <span class="line-clamp-1 text-center">ست آستین خرسی کد 002</span>
                                        <span class="block font-medium">695,000 تومان</span>
                                    </div>
                                    <div
                                        class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                        <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </button>
                                        <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                            مشاهده و خرید
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                    <section class="swiper-slide lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                        <a href="#">
                            <div
                                class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
                                <img class="aspect-square object-cover w-full group-hover:hidden"
                                    src="../dist/images/top-product1.jpeg" alt="" />
                                <img class="aspect-square object-cover w-full group-hover:block hidden"
                                    src="../dist/images/top-product2.jpeg" alt="" />
                                <div class="bg-white">
                                    <div
                                        class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white">
                                        <span class="line-clamp-1 text-center">ست آستین خرسی کد 002</span>
                                        <span class="block font-medium">695,000 تومان</span>
                                    </div>
                                    <div
                                        class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                        <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </button>
                                        <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                            مشاهده و خرید
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                    <section class="swiper-slide lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                        <a href="#">
                            <div
                                class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
                                <img class="aspect-square object-cover w-full group-hover:hidden"
                                    src="../dist/images/top-product1.jpeg" alt="" />
                                <img class="aspect-square object-cover w-full group-hover:block hidden"
                                    src="../dist/images/top-product2.jpeg" alt="" />
                                <div class="bg-white">
                                    <div
                                        class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white">
                                        <span class="line-clamp-1 text-center">ست آستین خرسی کد 002</span>
                                        <span class="block font-medium">695,000 تومان</span>
                                    </div>
                                    <div
                                        class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                        <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </button>
                                        <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                            مشاهده و خرید
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                    <section class="swiper-slide lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                        <a href="#">
                            <div
                                class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
                                <img class="aspect-square object-cover w-full group-hover:hidden"
                                    src="../dist/images/top-product1.jpeg" alt="" />
                                <img class="aspect-square object-cover w-full group-hover:block hidden"
                                    src="../dist/images/top-product2.jpeg" alt="" />
                                <div class="bg-white">
                                    <div
                                        class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white">
                                        <span class="line-clamp-1 text-center">ست آستین خرسی کد 002</span>
                                        <span class="block font-medium">695,000 تومان</span>
                                    </div>
                                    <div
                                        class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                        <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </button>
                                        <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                            مشاهده و خرید
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                    <section class="swiper-slide lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                        <a href="#">
                            <div
                                class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
                                <img class="aspect-square object-cover w-full group-hover:hidden"
                                    src="../dist/images/top-product1.jpeg" alt="" />
                                <img class="aspect-square object-cover w-full group-hover:block hidden"
                                    src="../dist/images/top-product2.jpeg" alt="" />
                                <div class="bg-white">
                                    <div
                                        class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white">
                                        <span class="line-clamp-1 text-center">ست آستین خرسی کد 002</span>
                                        <span class="block font-medium">695,000 تومان</span>
                                    </div>
                                    <div
                                        class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                        <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </button>
                                        <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                            مشاهده و خرید
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </section>
                    <section class="swiper-slide lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                        <a href="#">
                            <div
                                class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
                                <img class="aspect-square object-cover w-full group-hover:hidden"
                                    src="../dist/images/top-product1.jpeg" alt="" />
                                <img class="aspect-square object-cover w-full group-hover:block hidden"
                                    src="../dist/images/top-product2.jpeg" alt="" />
                                <div class="bg-white">
                                    <div
                                        class="flex flex-col justify-center items-center absolute bottom-0 gap-3 py-2 text-gray-600 w-full transition-all duration-300 md:group-hover:-translate-y-2/3 bg-white">
                                        <span class="line-clamp-1 text-center">ست آستین خرسی کد 002</span>
                                        <span class="block font-medium">695,000 تومان</span>
                                    </div>
                                    <div
                                        class="flex justify-evenly items-center absolute top-full text-gray-600 px-2 gap-2 w-full transition-all duration-300 md:group-hover:-translate-y-[125%]">
                                        <button class="flex w-1/3 bg-green-500 text-white justify-center rounded p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </button>
                                        <button class="w-2/3 bg-primary text-white text-center rounded p-2">
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
                <section class="lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                    <a href="#">
                        <div
                            class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-xs xs:text-sm md:text-base">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </button>
                                    <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                        مشاهده و خرید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
                <section class="lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                    <a href="#">
                        <div
                            class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </button>
                                    <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                        مشاهده و خرید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
                <section class="lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                    <a href="#">
                        <div
                            class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </button>
                                    <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                        مشاهده و خرید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
                <section class="lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                    <a href="#">
                        <div
                            class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </button>
                                    <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                        مشاهده و خرید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
                <section class="lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                    <a href="#">
                        <div
                            class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </button>
                                    <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                        مشاهده و خرید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
                <section class="lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                    <a href="#">
                        <div
                            class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </button>
                                    <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                        مشاهده و خرید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
                <section class="lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                    <a href="#">
                        <div
                            class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </button>
                                    <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                        مشاهده و خرید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
                <section class="lg:w-1/4 xs:w-1/3 w-1/2 px-2">
                    <a href="#">
                        <div
                            class="relative group aspect-[6/8] rounded-lg overflow-hidden bg-white border shadow text-sm md:text-base">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    </button>
                                    <button class="w-2/3 bg-primary text-white text-center rounded p-2">
                                        مشاهده و خرید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </a>
                </section>
            </div>
            <div class="w-full flex justify-between items-center p-2 rounded-lg bg-gray-200">
                <button disabled class="bg-primary text-white px-4 p-2 rounded-lg hover:bg-opacity-80">
                    صفحه قبلی
                </button>
                <span class="">
                    <span> 1</span>
                    <span class="inline-block px-2">از</span>
                    <span> 12</span>
                </span>
                <button class="bg-primary text-white px-4 p-2 rounded-lg hover:bg-opacity-80">
                    صفحه بعدی
                </button>
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