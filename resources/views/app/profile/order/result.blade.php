@extends('app.layouts.app', ['title' => 'نتیجه ی تراکنش'])

@section('content')
    <!-- component -->
    <div class="h-screen mt-12 md:mt-24">
        <div class="bg-white p-6 py-8 md:mx-auto">
            @if ($status)
                <div class="text-center w-full lg:w-1/3 py-8 mx-auto shadow-md rounded-md">
                    <svg viewBox="0 0 24 24" class="text-green-600 w-24 h-24 mx-auto my-6">
                        <path fill="currentColor"
                            d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                        </path>
                    </svg>
                    <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">تراکنش با موفقیت انجام شد
                    </h3>
                    <p class="text-gray-600 my-2">مبلغ تراکنش : {{ $result['Amount'] }}</p>
                    <p>کد پیگیری : {{ $result['RefID'] }}</p>
                    <div class="my-3">با تشکر از اعتماد شما ، شما می توانید از قسمت پروفایل بخش سفارشات ، سفارش خود را پیگیری نمایید.</div>
                    <div class="py-10 text-center">
                        <a href="{{ route('profile.orders.index', ['status' => 'order_confirm']) }}"
                            class="px-12 bg-sky-500 hover:bg-sky-600 rounded-lg text-white font-semibold py-3">
                            سفارشات من
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center w-full lg:w-1/3 py-8 mx-auto shadow-md rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="text-red-600 w-24 h-24 mx-auto my-6">
                        <path fill-rule="evenodd"
                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                            clip-rule="evenodd" />
                    </svg>

                    <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">پرداخت ناموفق</h3>

                    <p class="text-gray-600 my-2">کد پیگیری : {{ $result['Message'] }}</p>
                    <div class="py-10 text-center">
                        <a href="{{ route('profile.orders.index', ['status' => 'unpaid']) }}"
                            class="px-12 bg-sky-500 hover:bg-sky-600 rounded-lg text-white font-semibold py-3">
                            سفارشات من
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
