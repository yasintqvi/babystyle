@extends('auth.layouts.app', ['title' => 'ورود'])

@section('content')
    <div class="flex flex-col items-center">
        <form action="{{ route('login.otp', ['backUrl' => request()->query('backUrl')] ) }}" onsubmit="checkVerify(event)" method="post"
            class="md:w-1/2 xl:w-1/3 w-full flex flex-col items-start rounded-xl border border-gray-300 shadow-xl p-5 py-8">
            @csrf
            <a href="#" class="w-full flex justify-center">
                <img class="w-1/4 pb-2" src="{{ asset('assets/app/images/Logo.jpg') }}" alt="" /></a>
            <span class="font-bold my-2 text-xl flex items-center">
                <span class="pl-2">ورود </span>

                <span class="flex items-center border-r-2 border-black h-5 pr-2">ثبت نام</span>
            </span>
            <div class="flex justify-between  text-xs text-gray-500 font-medium py-1">
                <span class="mb-4">
                    کد تایید برای شماره {{ $verify['phone_number'] }} ( <a href="{{ route('login.form') }}"
                        class="mx-1 text-blue-600">تغییر شماره</a> ) پیامک شد
                </span>

            </div>

            <div class="mb-6 w-full">
                <input type="number" class="border w-full rounded-lg outline-none p-3 dir-ltr" autofocus name="code" />

                <div id="countdown" class="text-xs text-center font-bold mt-4 text-primary"></div>
            </div>
            <button type="submit"
                class="border w-full h-max py-3 my-2 rounded-md bg-primary text-white flex items-center justify-center text-center">
                ورود
            </button>
        </form>
        <form id="resendForm" class="hidden" action="{{ route('login.otp.resend') }}" method="post">
            @csrf
            <div class="mt-4">
                <a href="" class="text-gray-700 text-sm" onclick="resendOtpCode(event)">ارسال مجدد کد</a>
            </div>
        </form>
    </div>
@endsection

@section('script')
    @include('app.alerts.toast.error')

    <script src="{{ asset('assets/app/js/custom.js') }}"></script>
    <script src="{{ asset('assets/app/js/countdown.js') }}"></script>

    <script>

        if (localStorage.getItem('remainingTime') === 'resend') {
            resendForm.classList.remove('hidden');
        }   
        else {
            countdown.style.display = "block";
            const seconds = "{{ config('auth.resend_otp_time') }}";
            countdownTimer(parseInt(seconds));
        }

        async function resendOtpCode(event) {
            event.preventDefault();

            const form = event.target.closest('form');


            await fetch(form.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status == 'success') {
                        successToast(data.message);
                        form.classList.add('hidden');
                        countdown.style.display = "block";
                        const seconds = "{{ config('auth.resend_otp_time') }}";
                        countdownTimer(parseInt(seconds));
                    } else if (data.status == 'warning') {
                        warningToast(data.message);
                    }
                })

        }

        function checkVerify(event) {
            const codeInput = document.querySelector('input[name=code]');
            event.preventDefault();
            if (codeInput.value.trim() !== "") {
                event.target.submit();
                return true;
            }
            errorToast('کد تایید نمی تواند خالی باشد');
            return false;
        }
    </script>
@endsection
