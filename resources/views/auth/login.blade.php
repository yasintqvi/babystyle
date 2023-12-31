@extends('auth.layouts.app', ['title' => 'ورود'])

@section('content')
    <form onsubmit="checkLogin(event)" action="{{ route('login.check', ['backUrl' => request()->query('backUrl')] ) }}" method="post"
        class="md:w-1/2 xl:w-1/3 w-full flex flex-col items-start rounded-xl border border-gray-300 shadow-xl p-5 py-8">
        @csrf
        <a href="#" class="w-full flex justify-center">
            <img class="w-1/4 pb-2" src="{{ asset('assets/app/images/Logo.jpg') }}" alt="" /></a>
        <span class="font-bold my-2 text-xl flex items-center">
            <span class="pl-2">ورود </span>

            <span class="flex items-center border-r-2 border-black h-5 pr-2">ثبت نام</span>
        </span>
        <div class="flex flex-col text-xs text-gray-500 font-medium py-1">
            <span class="mb-2">خوش آمدید! </span>
            <span class="mb-4">
                لطفا شماره موبایل خود را وارد کنید
            </span>
        </div>
        
        <div class="mb-6 w-full">
            <input type="text" oninput="validatePhoneNumber(event)"
                class="border w-full rounded-lg outline-none p-3 dir-ltr" autofocus name="phone_number" />
            <span class="text-xs text-red-500 @if(session()->has('phone_number_error')) block @else hidden @endif" id="phoneNumberError">شماره تلفن نامعتبر می
                باشد.</span>

        </div>

        <button type="submit"
            class="border w-full h-max py-3 my-2 rounded-md bg-primary text-white flex items-center justify-center text-center">
            ورود
        </button>
        <div class="text-xs pt-2">
            ورود شما به معنای پذیرش

            <span class="text-blue-400"> شرایط سایت </span>
            و

            <span class="text-blue-400"> قوانین حریم‌خصوصی </span>

            است
        </div>
    </form>
@endsection

@section('script')
    <script>
        const loginButton = document.querySelector('button[type=submit]');
        const phoneInput = document.querySelector('input[name=phone_number]');
        
        localStorage.removeItem('remainingTime');

        function validatePhoneNumber(event) {

            const number = event.target.value;

            if (phoneValidate(number)) {
                phoneNumberError.classList.add('hidden');
            }
            else {
                phoneNumberError.classList.remove('hidden');
            }

        }

        function phoneValidate(phoneNumber) {
            const pattern = /^(\+98|0)?9\d{9}$/;

            if (pattern.test(phoneNumber)) {
                return true;
            }

            return false;
        }

        function checkLogin(event) {
            event.preventDefault();
            if (phoneValidate(phoneInput.value)) {
                event.target.submit();
                return true;
            }
            phoneNumberError.classList.remove('hidden');
            return false;
        }
    </script>
@endsection
