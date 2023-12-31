@extends('app.layouts.app', ['title' => 'پروفایل - ویرایش'])


@section('content')
    <div class="container flex flex-wrap py-5">
        @include('app.profile.partials.aside')
        
        <div class="md:w-3/4 w-full md:pr-2 space-y-4">
            <div class="border rounded-lg p-5 shadow md:block hidden">
                <form action="{{ route('profile.update') }}" method="post" class="flex flex-wrap">
                    @csrf
                    @method('PUT')
                    <div class="w-1/2 flex flex-col border-b border-l p-2">
                        <label class="text-gray-400 font-medium" for="">
                            نام</label>
                        <input type="text" value="{{ auth()->user()->first_name }}" name="first_name" id="" class="outline-none py-1" />
                        @error('first_name')
                        <span class="text-red-500 text-bold text-xs">{{ $message }}</span>
                        @endif
                    </div>
                    <div class="w-1/2 flex flex-col border-b border-l p-2">
                        <label class="text-gray-400 font-medium" for="">
                            نام خانوادگی</label>
                        <input type="text" name="last_name" value="{{ auth()->user()->last_name }}" id="" class="outline-none py-1" />
                        @error('last_name')
                        <span class="text-red-500 text-bold text-xs">{{ $message }}</span>
                        @endif
                    </div>
                    <div class="w-1/2 flex flex-col border-b border-l p-2">
                        <label class="text-gray-400 font-medium" for="">
                            شماره موبایل</label>
                        <input type="text" disabled value="{{ auth()->user()->phone_number }}" id="" class="outline-none py-1" />
                        @error('phone_number')
                        <span class="text-red-500 text-bold text-xs">{{ $message }}</span>
                        @endif
                    </div>
                    <div class="w-1/2 flex flex-col p-2 border-l border-b">
                        <label class="text-gray-400 font-medium" for=""> ایمیل</label>
                        <input type="text" name="email" value="{{ auth()->user()->email }}" id="" class="outline-none py-1" />
                        @error('email')
                        <span class="text-red-500 text-bold text-xs">{{ $message }}</span>
                        @endif
                    </div>
                    <div class="w-1/2 flex flex-col p-2 border-l">
                        <label class="text-gray-400 font-medium" for=""> کد ملی</label>
                        <input type="text" name="national_code" value="{{ auth()->user()->national_code }}" id="" class="outline-none py-1" />
                        @error('national_code')
                        <span class="text-red-500 text-bold text-xs">{{ $message }}</span>
                        @endif
                    </div>
                    <div class="w-full flex flex-col p-2 border-b">
                        <h2>تنظیم کلمه عبور</h2>
                    </div>
                    @if (isset(auth()->user()->password))
                    <div class="w-1/2 flex flex-col p-2 border-l border-b">
                        <label class="text-gray-400 font-medium" for=""> کلمه عبور فعلی</label>
                        <input type="password" name="current_password" id="" class="outline-none py-1" />
                        @error('current_password')
                        <span class="text-red-500 text-bold text-xs">{{ $message }}</span>
                        @endif
                    </div>
                    @endif

                    <div class="w-1/2 flex flex-col p-2 border-b">
                        <label class="text-gray-400 font-medium" for=""> کلمه عبور جدید</label>
                        <input type="password" name="password" id="" class="outline-none py-1" />
                        @error('password')
                        <span class="text-red-500 text-bold text-xs">{{ $message }}</span>
                        @endif
                    </div>
                    <div class="w-1/2 flex flex-col p-2 border-l">
                        <label class="text-gray-400 font-medium" for=""> تایید کلمه عبور</label>
                        <input type="password" name="password_confirmation" id="" class="outline-none py-1" />
                    </div>

                    <button class="w-full bg-blue-500 p-2 rounded-lg mt-4 text-white">
                        ویرایش اطلاعات
                    </button>
                </form>
            </div>
        </div>
    </div>
    </section>
@endsection
