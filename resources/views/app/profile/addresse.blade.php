@extends('app.layouts.app', ['title' => 'آدرس ها'])

@section('content')

    @if ($errors->any())
        <div class="flex p-4 mt-10 mb-4 text-sm text-red-800 rounded-lg bg-red-50 md:mx-32" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only"></span>
            <div>
                <span class="font-medium">مقادیر الزامی آدرس را کامل کنید:</span>
                <ul class="mt-1.5 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- {{dd($errors)}} --}}
    <section>
        <div class="container flex flex-wrap py-5">
            @include('app.profile.partials.aside')
            <div class="md:w-3/4 w-full md:pr-2 space-y-4">
                <div class="border rounded-lg py-5 shadow md:block">
                    <div class="flex justify-between px-5">
                        <div class="flex gap-2 items-center pb-4">
                            <a href="#" class="md:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                            <h3 class="font-medium">آدرس‌ها</h3>
                        </div>
                        <div
                            class="flex relative items-center gap-1 border border-red-500 text-red-500 px-4 py-2 rounded-lg text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>

                            <span>ثبت آدرس جدید</span>
                            <button id="addNewAddressBTN" class="absolute w-full h-full top-0 left-0"></button>
                            <div id="addNewAddressCountainer"
                                class="fixed flex items-center justify-center w-full h-full top-0 left-0 z-40 bg-black bg-opacity-20 hidden">
                                <div class="md:w-1/2 sm:w-2/3 w-full bg-white p-4 rounded-md m-3">
                                    <div class="flex justify-between mb-4">
                                        <span class="text-base font-medium text-black">آدرس جدید</span>
                                        <div class="relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                            <button id="closeNewAddressBTN"
                                                class="absolute w-full h-full top-0 left-0"></button>
                                        </div>
                                    </div>
                                    <form action="{{ route('profile.addresses.store') }}" method="post"
                                        class="flex flex-wrap text-gray-600">
                                        @csrf
                                        <div class="sm:w-1/2 w-full p-2">
                                            <label for="" class="block my-1">استان</label>
                                            <select name="province_id"
                                                class="w-full outline-none border province-select rounded-md p-1">
                                                <option>انتخاب کنید</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
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
                                            <input type="text" value="{{ old('receiver_full_name') }}"
                                                name="receiver_full_name" id=""
                                                class="w-full outline-none border rounded-md p-1" />
                                        </div>
                                        <div class="sm:w-1/2 w-full p-2">
                                            <label for="" class="block my-1">شماره تماس تحویل گیرنده</label>
                                            <input type="number" value="{{ old('receiver_phone_number') }}"
                                                name="receiver_phone_number" id=""
                                                class="w-full outline-none border rounded-md p-1" />
                                        </div>
                                        <div class="sm:w-1/2 w-full p-2">
                                            <label for="" class="block my-1">کد پستی </label>
                                            <input type="number" value="{{ old('postal_code') }}" name="postal_code"
                                                id="" class="w-full outline-none border rounded-md p-1" />
                                        </div>
                                        <div class="sm:w-1/2 w-full p-2">
                                            <label for="" class="block my-1">پلاک</label>
                                            <input type="number" value="{{ old('plaque') }}" name="plaque" id=""
                                                class="w-full outline-none border rounded-md p-1" />
                                        </div>

                                        <div class="sm:w-1/2 w-full p-2">
                                            <label for="" class="block my-1">واحد</label>
                                            <input type="number" value="{{ old('unit') }}" name="unit"
                                                id="" class="w-full outline-none border rounded-md p-1" />
                                        </div>

                                        <div class="flex flex-col md:w-1/2 w-full p-2">
                                            <label for="" class="block my-1" class="">آدرس دقیق
                                            </label>
                                            <textarea name="address" id="" cols="30" rows="10" class="h-20 outline-0 border rounded-md p-1">{{ old('address') }}</textarea>
                                        </div>
                                        <div class="sticky bottom-0 w-full">
                                            <button class="w-full py-2 text-white bg-red-600 rounded-md">
                                                ثبت آدرس
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divide-y">
                        @foreach ($addresses as $address)
                            <div class="py-5 px-5">
                                <div class="flex">
                                    <p class="w-full pb-3 text-sm font-medium">
                                        {{ $address->address }}
                                    </p>
                                    <div class="relative">
                                        <div class="relative">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                            </svg>
                                            <button class="addressUDBTN absolute w-full h-full top-0 left-0"></button>
                                        </div>
                                        <!--  addressUDContainer means adress update reade container  -->
                                        <div
                                            class="addressUDContainer absolute left-1/2 bg-white w-52 border rounded-md divide-y hidden">
                                            <a href="#" class="relative flex gap-2 px-2 py-3 text-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                  stroke="currentColor" class="w-4">
                                                  <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>
                          
                                                <div class="">
                                                  <span class="w-max">ویرایش آدرس</span>
                                                  <button class="editAddressBTN absolute w-full h-full top-0 left-0"></button>
                          
                                                  <div
                                                    class="editAddressContainer fixed flex items-center justify-center w-full h-full top-0 left-0 z-40 bg-black bg-opacity-20 hidden">
                                                    <div class="md:w-1/2 sm:w-2/3 w-full bg-white p-4 rounded-md m-3">
                                                      <div class="flex justify-between mb-4">
                                                        <span class="text-base font-medium text-black">ویرایش آدرس
                                                        </span>
                                                        <div class="relative">
                                                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
                                                          </svg>
                                                          <button class="closeEditAddressBTN absolute w-full h-full top-0 left-0"></button>
                                                        </div>
                                                      </div>
                                                      <form action="{{ route('profile.addresses.update' , $address->id) }}"
                                                        method="post" class="flex flex-wrap text-gray-600">
                                                        @csrf
                                                        @method('put')
                                                        <div class="sm:w-1/2 w-full p-2">
                                                            <label for="" class="block my-1">استان</label>
                                                            <select name="province_id"
                                                                class="w-full outline-none border province-select rounded-md p-1">
                                                                @foreach ($provinces as $province)
                                                                    <option value="{{ $province->id }}" {{ $province->id == $address->province_id ? 'selected' : ''}}>
                                                                        {{ $province->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="sm:w-1/2 w-full p-2">
                                                            <label for="" class="block my-1">شهر</label>
                                                            <select name="city_id"
                                                                class="w-full outline-none border city-select rounded-md p-1">
                                                                <option value="{{ $address->city_id }}">
                                                                    {{ city_name($address->city_id) }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="sm:w-1/2 w-full p-2">
                                                            <label for="" class="block my-1">نام تحویل
                                                                گیرنده</label>
                                                            <input type="text"
                                                                value="{{ old('receiver_full_name' , $address->receiver_full_name)  }}"
                                                                name="receiver_full_name" id=""
                                                                class="w-full outline-none border rounded-md p-1" />
                                                                @error('receiver_full_name')
                                                                <span class="text-red-500 text-bold text-xs">{{ $message }}</span>
                                                                @endif
                                                        </div>
                                                       
                                                        <div class="sm:w-1/2 w-full p-2">
                                                            <label for="" class="block my-1">شماره تماس تحویل
                                                                گیرنده</label>
                                                            <input type="number"
                                                                value="{{ old('receiver_phone_number', $address->receiver_phone_number) }}"
                                                                name="receiver_phone_number" id=""
                                                                class="w-full outline-none border rounded-md p-1" />
                                                        </div>
                                                        <div class="sm:w-1/2 w-full p-2">
                                                            <label for="" class="block my-1">کد پستی </label>
                                                            <input type="number" value="{{ old('postal_code', $address->postal_code) }}"
                                                                name="postal_code" id=""
                                                                class="w-full outline-none border rounded-md p-1" />
                                                        </div>
                                                        <div class="sm:w-1/2 w-full p-2">
                                                            <label for="" class="block my-1">پلاک</label>
                                                            <input type="number" value="{{ old('plaque', $address->plaque) }}"
                                                                name="plaque" id=""
                                                                class="w-full outline-none border rounded-md p-1" />
                                                        </div>
                        
                                                        <div class="sm:w-1/2 w-full p-2">
                                                            <label for="" class="block my-1">واحد</label>
                                                            <input type="number" value="{{ old('unit', $address->unit) }}"
                                                                name="unit" id=""
                                                                class="w-full outline-none border rounded-md p-1" />
                                                        </div>
                        
                                                        <div class="flex flex-col md:w-1/2 w-full p-2">
                                                            <label for="" class="block my-1"
                                                                class="">آدرس دقیق
                                                            </label>
                                                            <textarea name="address" id="" cols="30" rows="10" class="h-20 outline-0 border rounded-md p-1">{{ old('address', $address->address) }}</textarea>
                                                        </div>
                                                        <div class="sticky bottom-0 w-full">
                                                            <button
                                                                class="w-full py-2 text-white bg-red-600 rounded-md">
                                                                ویرایش آدرس
                                                            </button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                  </div>
                                                </div>
                                              </a>
                                            <a href="#" class="flex gap-2 px-2 py-3 text-sm">
                                                <svg class="w-3 fill-red-500" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 448 512">
                                                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                                    <path
                                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                </svg>
                                                <span class="w-max">حذف آدرس</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div class="flex flex-col justify-evenly text-gray-500 text-sm">
                                        <div class="flex gap-2 items-center">
                                            <svg class="w-4 stroke-1 fill-gray-500" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 512 512">
                                                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.-->
                                                <path
                                                    d="M512 96c0 50.2-59.1 125.1-84.6 155c-3.8 4.4-9.4 6.1-14.5 5H320c-17.7 0-32 14.3-32 32s14.3 32 32 32h96c53 0 96 43 96 96s-43 96-96 96H139.6c8.7-9.9 19.3-22.6 30-36.8c6.3-8.4 12.8-17.6 19-27.2H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320c-53 0-96-43-96-96s43-96 96-96h39.8c-21-31.5-39.8-67.7-39.8-96c0-53 43-96 96-96s96 43 96 96zM117.1 489.1c-3.8 4.3-7.2 8.1-10.1 11.3l-1.8 2-.2-.2c-6 4.6-14.6 4-20-1.8C59.8 473 0 402.5 0 352c0-53 43-96 96-96s96 43 96 96c0 30-21.1 67-43.5 97.9c-10.7 14.7-21.7 28-30.8 38.5l-.6 .7zM128 352a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM416 128a32 32 0 1 0 0-64 32 32 0 1 0 0 64z" />
                                            </svg>
                                            <span>{{ province_name($address->province_id) }} ,
                                                {{ city_name($address->city_id) }}</span>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 stroke-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                            </svg>
                                            <span>{{ $address->postal_code }}</span>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 stroke-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                            </svg>

                                            <span>{{ $address->receiver_phone_number }}</span>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 stroke-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                            </svg>

                                            <span>{{ $address->receiver_full_name }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <img class="aspect-square rounded-lg max-h-32" src="../dist/images/location.png"
                                            alt="" />
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>
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
