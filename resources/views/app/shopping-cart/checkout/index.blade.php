@extends('app.layouts.app', ['title' => 'تکمیل خرید'])

@section('content')
    <section>
        <div class="container flex flex-wrap md:flex-nowrap py-5 gap-4">
            <div class="md:w-3/4 w-full space-y-3">
                <div class="border rounded-lg py-5 space-y-2 px-4">
                    <div class="flex justify-between">
                        <div class="flex items-center mb-8">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 stroke-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <h1 class="mx-2 font-bold text-gray-600">انتخاب آدرس</h1>
                        </div>
                        <div class="flex relative items-center gap-1 text-blue-600  px-4 py-2 rounded-lg text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>

                            <span>ثبت آدرس جدید</span>
                            <button id="addNewAddressBTN" class="absolute w-full h-full top-0 left-0"></button>
                            <div id="addNewAddressCountainer"
                                class="fixed flex items-center justify-center w-full h-full top-0 left-0 z-40 bg-black bg-opacity-20 hidden }}">
                                <div class="md:w-1/2 sm:w-2/3 w-full bg-white p-4 rounded-md m-3">
                                    <div class="flex justify-between mb-4">
                                        <span class="text-base font-medium text-black">آدرس جدید</span>
                                        <div class="relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12"></path>
                                            </svg>
                                            <button id="closeNewAddressBTN"
                                                class="absolute w-full h-full top-0 left-0"></button>
                                        </div>
                                    </div>
                                    <form action="http://127.0.0.1:8000/profile/addresses/store" method="post"
                                        class="flex flex-wrap text-gray-600">
                                        <input type="hidden" name="_token"
                                            value="LfcwTSqYh8PtkC3igrYokpVFq6rgA0t5dYsYwy7S" autocomplete="off">
                                        <div class="sm:w-1/2 w-full p-2">
                                            <label for="" class="block my-1">استان</label>
                                            <select name="province_id"
                                                class="w-full outline-none border province-select rounded-md p-1">
                                                <option>انتخاب کنید</option>
                                                <option value="1">گیلان</option>
                                            </select>
                                        </div>
                                        <div class="sm:w-1/2 w-full p-2">
                                            <label for="" class="block my-1">شهر</label>
                                            <select name="city_id"
                                                class="w-full outline-none border city-select rounded-md p-1">
                                                <option>انتخاب کنید</option>
                                            </select>
                                        </div>
                                        <div class="sm:w-1/2 w-full p-2">
                                            <label for="" class="block my-1">نام تحویل گیرنده</label>
                                            <input type="text" value="" name="receiver_full_name" id=""
                                                class="w-full outline-none border rounded-md p-1">
                                        </div>
                                        <div class="sm:w-1/2 w-full p-2">
                                            <label for="" class="block my-1">شماره تماس تحویل گیرنده</label>
                                            <input type="number" value="" name="receiver_phone_number" id=""
                                                class="w-full outline-none border rounded-md p-1">
                                        </div>
                                        <div class="sm:w-1/3 w-full p-2">
                                            <label for="" class="block my-1">کد پستی </label>
                                            <input type="number" value="" name="postal_code" id=""
                                                class="w-full outline-none border rounded-md p-1">
                                        </div>
                                        <div class="sm:w-1/3 w-full p-2">
                                            <label for="" class="block my-1">پلاک</label>
                                            <input type="number" value="" name="plaque" id=""
                                                class="w-full outline-none border rounded-md p-1">
                                        </div>

                                        <div class="sm:w-1/3 w-full p-2">
                                            <label for="" class="block my-1">واحد</label>
                                            <input type="number" value="" name="unit" id=""
                                                class="w-full outline-none border rounded-md p-1">
                                        </div>

                                        <div class="flex flex-col my-2 w-full p-2">
                                            <label for="" class="block my-1">آدرس دقیق
                                            </label>
                                            <textarea name="address" id="" cols="30" rows="10" class="h-20 outline-0 border rounded-md p-1"></textarea>
                                        </div>
                                        <div class="sticky bottom-0 w-full">
                                            <button class="w-full py-2 text-white bg-primary rounded-md">
                                                ثبت آدرس
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        @forelse($addresses as $address)
                            <li>
                                <input type="radio" id="address-{{ $address->id }}" name="address_id"
                                    value="{{ $address->id }}" class="hidden peer" required>
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 stroke-red-600 stroke-2">
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
                                <input type="radio" id="shipping_method-{{ $shippingMethod->id }}" name="shipping_method_id"
                                    value="{{ $shippingMethod->id }}" class="hidden peer" @checked($shippingMethods->count() == 1) required>
                                <label for="shipping_method-{{ $shippingMethod->id }}"
                                    class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:text-blue-500 hover:text-gray-600 hover:bg-gray-100">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">{{ $shippingMethod->name }}</div>
                                        <div class="w-full text-sm">هزینه ی ارسال {{ $shippingMethod->price }} تومان</div>
                                    </div>
                                </label>
                            </li>
                        @endforeach
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
                                    $optionColor = $productItem
                                        ->variationOptions()
                                        ->where('is_color', 1)
                                        ->first();
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
                        <span>قیمت کالاها (۲)</span>
                        <span>
                            ۱,۲۰۳,۰۰۰

                            <span class="text-xs">تومان</span>
                        </span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span> جمع سبد خرید </span>
                        <span>
                            ۱,۱۴۳,۰۰۰
                            <span class="text-xs">تومان</span>
                        </span>
                    </div>
                    <div class="flex justify-between text-red-500">
                        <span> سود شما از خرید </span>
                        <span>
                            <span>(۵٪)</span>
                            ۶۰,۰۰۰
                            <span class="text-xs">تومان</span>
                        </span>
                    </div>

                    <div class="my-3">
                        <div class="my-2 text-gray-700 font-bold">کد تخفیف داری ؟</div>
                        <div class="flex justify-between text-xs">
                            <input type="text" name="" id=""
                                class="outline-none border rounded-l p-2 w-4/5" />
                            <button class="w-1/5 bg-red-400 rounded-l p-1 py-2 text-white">
                                اعمال
                            </button>
                        </div>
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
@endsection

@section('script')
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
