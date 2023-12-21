@extends('auth.layouts.app', ['title' => 'ورود'])

@section('content')
    <div class="flex flex-col items-center">
        <form action="{{ route('login.otp') }}" method="post"
            class="md:w-1/2 xl:w-1/3 w-full flex flex-col items-start rounded-xl border border-gray-300 shadow-xl p-5 py-8">
            @csrf
            <a href="#" class="w-full flex justify-center">
                <img class="w-1/4 pb-2" src="{{ asset('assets/app/images/Logo.jpg') }}" alt="" /></a>
            <span class="font-bold my-2 text-xl flex items-center">
                <span class="pl-2">ورود </span>

                <span class="flex items-center border-r-2 border-black h-5 pr-2">ثبت نام</span>
            </span>
            <div class="flex flex-col text-xs text-gray-500 font-medium py-1">
                <span class="mb-4">
                    کد تایید برای شماره {{ $verify['phone_number'] }} پیامک شد
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
        <form id="resendForm" action="{{ route('login.otp.resend') }}" method="post">
            @csrf
            <div class="mt-4">
                <a href="" class="text-gray-700 text-sm" onclick="resendOtpCode(event)">ارسال مجدد کد</a>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let seconds = "{{ $verify['code_expire'] }}";

            seconds = parseInt(seconds);

            function updateCountdown() {
                var countdownElement = document.getElementById('countdown');
                countdownElement.innerHTML = seconds + ' تا دریافت مجدد کد ';

                seconds--;

                if (seconds < 0) {
                    clearInterval(countdownInterval);

                    countdownElement.style.display = 'none';
                }
            }

            var countdownInterval = setInterval(updateCountdown, 1000);
        });
    </script>

    <script>
        async function resendOtpCode(event) {
            event.preventDefault();

            const form = event.target.closest('form');

            const requestData = { verify: {!! json_encode($verify) !!} };

            await fetch(form.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(requestData)
                })
                .then(response => response.json())
                .then(data => {
                    
                })

        }
    </script>
@endsection
