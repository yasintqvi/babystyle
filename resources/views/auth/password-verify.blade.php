@extends('auth.layouts.app', ['title' => 'ورود'])

@section('content')
    <div class="flex flex-col items-center">
        <form action="{{ route('login.password', ['backUrl' => request()->query('backUrl')]) }}" method="post"
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
                    رمز عبور خود را وارد نمایید
                </span>
            </div>

            <div class="mb-6 w-full">
                <input type="password" class="border w-full rounded-lg outline-none p-3 dir-ltr" autofocus
                    name="password" />
            </div>
            <button type="submit"
                class="border w-full h-max py-3 my-2 rounded-md bg-primary text-white flex items-center justify-center text-center">
                ورود
            </button>
        </form>
    </div>
@endsection

@section('script')
    @include('app.alerts.toast.error')
@endsection
