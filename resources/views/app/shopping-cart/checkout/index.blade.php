@extends('app.layouts.app', ['title' => 'تکمیل خرید'])

@section('content')
    <div id="addNewAddressCountainer"
        class="fixed items-center justify-center w-full h-full top-0 left-0 z-40 bg-black bg-opacity-20 hidden">
        <div class="md:w-1/2 sm:w-2/3 w-full bg-white p-4 rounded-md m-3 max-h-screen overflow-auto">
            <div class="flex justify-between mb-4">
                <span class="text-base font-medium text-black">آدرس جدید</span>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                    </svg>
                    <button type="button" id="closeNewAddressBTN" class="absolute w-full h-full top-0 left-0"></button>
                </div>
            </div>
            <form action="{{ route('profile.addresses.store') }}" method="post" class="flex flex-wrap text-gray-600">
                @csrf
                <div class="sm:w-1/2 w-full p-2">
                    <label for="" class="block my-1">استان</label>
                    <select name="province_id" class="w-full outline-none border province-select rounded-md p-1">
                        <option>انتخاب کنید</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:w-1/2 w-full p-2">
                    <label for="" class="block my-1">شهر</label>
                    <select name="city_id" class="w-full outline-none border city-select rounded-md p-1">
                        <option>انتخاب کنید</option>
                    </select>
                </div>
                <div class="sm:w-1/2 w-full p-2">
                    <div class="flex">
                        <label for="" class="block my-1">نام تحویل گیرنده</label>
                    </div>
                    <input type="text" value="{{ old('receiver_full_name') }}" name="receiver_full_name" id=""
                        class="w-full outline-none border rounded-md p-1" />
                </div>
                <div class="sm:w-1/2 w-full p-2">
                    <label for="" class="block my-1">شماره تماس تحویل گیرنده</label>
                    <input type="number" value="{{ old('receiver_phone_number') }}" name="receiver_phone_number"
                        id="" class="w-full outline-none border rounded-md p-1" />
                </div>
                <div class="sm:w-1/3 w-full p-2">
                    <div class="flex">
                        <label for="" class="block my-1">کد پستی </label>
                    </div>
                    <input type="number" value="{{ old('postal_code') }}" name="postal_code" id=""
                        class="w-full outline-none border rounded-md p-1" />
                </div>
                <div class="sm:w-1/3 w-full p-2">
                    <div class="flex">
                        <label for="" class="block my-1">پلاک</label>
                        <label for="" class="block my-1 text-red-600 px-1"> * </label>
                    </div>
                    <input type="number" value="{{ old('plaque') }}" name="plaque" id=""
                        class="w-full outline-none border rounded-md p-1" />
                </div>

                <div class="sm:w-1/3 w-full p-2">
                    <div class="flex">
                        <label for="" class="block my-1">واحد</label>
                        <label for="" class="block my-1 text-red-600 px-1"> * </label>
                    </div>
                    <input type="number" value="{{ old('unit') }}" name="unit" id=""
                        class="w-full outline-none border rounded-md p-1" />
                </div>

                <div class="flex flex-col my-2 w-full p-2">
                    <div class="flex">
                        <label for="" class="block my-1">آدرس دقیق</label>
                        <label for="" class="block my-1 text-red-600 px-1"> * </label>
                    </div>
                    </label>
                    <textarea name="address" id="" cols="30" rows="10" class="h-20 outline-0 border rounded-md p-1">{{ old('address') }}</textarea>
                </div>
                <div class="sticky bottom-0 w-full">
                    <button class="w-full py-2 text-white bg-primary rounded-md">
                        ثبت آدرس
                    </button>
                </div>
            </form>
        </div>
    </div>
    <form action="{{ route('orders.store') }}" method="post">
        @csrf
        <section>
            <div class="container flex flex-wrap md:flex-nowrap py-5 gap-4">
                <div class="md:w-3/4 w-full space-y-3">
                    @if ($errors->any())
                        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Danger</span>
                            <div>
                                <span class="font-medium">لطفا خطاهای زیر را برطرف نمایید</span>
                                <ul class="mt-1.5 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if (auth()->user()->first_name && auth()->user()->last_name)
                        <input type="hidden" value="{{ auth()->user()->first_name }}" name="first_name">
                        <input type="hidden" value="{{ auth()->user()->last_name }}" name="last_name">
                    @else
                        <div class="border rounded-lg py-5 space-y-2 px-4">
                            <div class="flex justify-between">
                                <div class="flex items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <h1 class="mx-2 font-bold text-gray-600">تکمیل اطلاعات حساب کاربری</h1>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="sm:w-1/2 w-full p-2">
                                    <label for="" class="block my-1">نام </label>
                                    <input type="text" value="{{ old('first_name') }}" name="first_name"
                                        id="" class="w-full outline-none border rounded-md p-1">
                                </div>
                                <div class="sm:w-1/2 w-full p-2">
                                    <label for="" class="block my-1">نام خانوادگی </label>
                                    <input type="text" value="{{ old('last_name') }}" name="last_name"
                                        id="" class="w-full outline-none border rounded-md p-1">
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="border rounded-lg py-5 space-y-2 px-4">
                        <div class="flex justify-between">
                            <div class="flex items-center mb-8">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 stroke-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <h1 class="mx-2 font-bold text-gray-600">انتخاب آدرس</h1>
                            </div>
                            <div class="flex relative items-center gap-1 px-4 py-2 rounded-lg text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>

                                <span>ثبت آدرس جدید</span>
                                <button type="button" id="addNewAddressBTN"
                                    class="absolute w-full h-full top-0 left-0"></button>
                            </div>
                        </div>

                        <ul class="grid w-full gap-6 md:grid-cols-2">
                            @forelse($addresses as $address)
                                <li>
                                    <input type="radio" id="address-{{ $address->id }}" name="address_id"
                                        value="{{ $address->id }}" class="hidden peer">
                                    <label for="address-{{ $address->id }}"
                                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:text-blue-500 hover:text-gray-600 hover:bg-gray-100">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">{{ $address->province->name }} ،
                                                {{ $address->city->name }}</div>
                                            <div class="w-full text-sm">{{ $address->address }}</div>
                                        </div>
                                    </label>
                                </li>
                            @empty
                                <div class="py-3 text-gray-700">هنوز آدرسی ثبت نشده است</div>
                            @endempty
                    </ul>

                </div>

                <div class="border rounded-lg py-5 space-y-2 px-4">
                    <div class="flex gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-8 stroke-red-600 stroke-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        <div class="">
                            <div class="">
                                <span class="font-medium text-lg">روش های ارسال</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <ul class="grid w-full gap-6 md:grid-cols-3 my-8">
                            @foreach ($shippingMethods as $shippingMethod)
                                <li>
                                    <input type="radio" id="shipping_method-{{ $shippingMethod->id }}"
                                        name="shipping_method_id" value="{{ $shippingMethod->id }}"
                                        class="hidden peer" @checked($shippingMethods->count() == 1) required>
                                    <label for="shipping_method-{{ $shippingMethod->id }}"
                                        class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:text-blue-500 hover:text-gray-600 hover:bg-gray-100">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">{{ $shippingMethod->name }}
                                            </div>
                                            <div class="w-full text-sm">هزینه ی ارسال {{ $shippingMethod->price }}
                                                تومان
                                            </div>
                                        </div>
                                    </label>
                                </li>
                            @endforeach
                            <li>
                                <input type="radio" id="shipping_method-100" name="shipping_method_id"
                                    value="100" class="hidden peer">
                                <label for="shipping_method-100"
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:text-blue-500 hover:text-gray-600 hover:bg-gray-100">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">تیپاکش
                                        </div>
                                        <div class="w-full text-sm">
                                            پس کرایه
                                        </div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="flex divide-x divide-x-reverse">
                        @foreach ($shoppingCartItems as $shoppingCartItem)
                            @php
                                $productItem = $shoppingCartItem->productItem;
                            @endphp
                            <div class="space-y-1 px-2">
                                <img src="{{ asset($productItem->image) }}"
                                    class="aspect-square w-20 object-cover rounded-md" alt="" />

                                @if ($productItem->variationOptions->isNotEmpty())
                                    @php
                                        $optionColor = $productItem->variationOptions()->where('is_color', 1)->first();
                                    @endphp
                                    <div class="flex items-center w-max gap-1">
                                        <span class="w-3 h-min aspect-square rounded-md"
                                            style="background: {{ $optionColor->second_value }}"></span>
                                        <span class="text-sm">{{ $optionColor->value }}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="md:w-1/4 w-full">
                <div class="sticky top-2">
                    <div class="space-y-4 border rounded-lg font-medium p-5 text-sm">
                        <div class="flex justify-between text-gray-500">
                            <span>قیمت کل</span>
                            <span>
                                <span class="money" id="totalAmount"></span>

                                <span class="text-xs"></span>
                            </span>
                        </div>
                        <div class="flex justify-between items-center text-gray-500">
                            <span> هزینه ارسال </span>
                            <span>
                                <span class="money" id="shipping_amount"></span>
                                <span class="text-xs"></span>
                            </span>
                        </div>
                        <div class="flex justify-between items-center text-red-500">
                            <span> سود شما از خرید </span>
                            <span>
                                <span class="money" id="discountAmount"></span>
                                <span class="text-xs"></span>
                            </span>
                        </div>
                        <div class="my-3">
                            <div class="my-2 text-gray-700 font-bold">کد تخفیف داری ؟</div>
                            <div class="flex justify-between text-xs">
                                <input type="text" name="discount_code"
                                    class="outline-none border rounded-l p-2 w-4/5" />
                                <button type="button" onclick="checkDiscountCode()"
                                    class="w-1/5 bg-red-400 rounded-l p-1 py-2 text-white">
                                    اعمال
                                </button>
                            </div>
                            <span class="text-danger text-xs text-red-500 font-bold" id="discount_text"></span>
                        </div>
                        <div class="flex justify-between text-gray-600 mt-3">
                            <span> مبلغ قابل پرداخت </span>
                            <span>
                                <span class="money text-xl font-bold" id="final_amount"></span>
                                <span class="text-xs"></span>
                            </span>
                        </div>
                        <button type="submit" class="w-full block text-center py-3 bg-primary text-white rounded-lg">
                            پرداخت و ثبت سفارش
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 py-2 leading-relaxed">
                        هزینه این سفارش هنوز پرداخت نشده‌ و در صورت اتمام موجودی، کالاها
                        از سبد حذف می‌شوند
                    </p>
                </div>
            </div>
    </section>
</form>
<form action="{{ route('shopping-cart.checkout.get-amounts') }}" method="post" id="getAmountsForm">
    @csrf
</form>
@endsection

@section('script')
<script src="{{ asset('assets/app/js/custom.js') }}"></script>
<script src="{{ asset('assets/app/js/shoppingCart.js') }}"></script>

<script>
    getAmounts();

    function getAmounts() {
        const shc = new ShoppingCart();
        const shippingMethod = document.querySelector('input[name=shipping_method_id]');
        const discountCode = document.querySelector('input[name=discount_code]');
        shc.updateOrderAmounts(discountCode.value, shippingMethod.value);
    }

    function checkDiscountCode() {
        const discountCode = document.querySelector('input[name=discount_code]').value;
        if (discountCode.trim(' ') === '') {
            errorToast('کد تخفیف را وارد نمایید.');
            return;
        }

        getAmounts();
    }
</script>


<script src="{{ asset('assets/app/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/app/js/home.js') }}"></script>
<script src="{{ asset('assets/app/js/plugins.js') }}"></script>

<script>
    $('.province-select').change(function() {

        var provinceID = $(this).val();

        if (provinceID) {
            $.ajax({
                type: "GET",
                url: "{{ url('/get-province-cities-list') }}?province_id=" + provinceID,
                success: function(res) {
                    if (res) {
                        $(".city-select").empty();

                        $.each(res, function(key, city) {
                            console.log(city);
                            $(".city-select").append('<option value="' + city.id + '">' +
                                city.name + '</option>');
                        });

                    } else {
                        $(".city-select").empty();
                    }
                }
            });
        } else {
            $(".city-select").empty();
        }
    });
</script>
@endsection
