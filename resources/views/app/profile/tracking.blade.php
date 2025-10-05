@extends('app.layouts.app', ['title' => 'پروفایل - ویرایش'])


@section('content')
    <div class="container flex flex-wrap py-5">
        @include('app.profile.partials.aside')
        <div class="md:w-3/4 w-full md:pr-2 space-y-4">
            <div class="border rounded-lg py-5 shadow md:block">
                <div class="flex justify-between px-5">
                    <div class="flex gap-2 items-center pb-4">
                        <!-- back arrow -->
                        <a href="#" class="md:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"></path>
                            </svg>
                        </a>
                        <h3 class="font-medium">دیدگاه‌ها</h3>
                    </div>
                </div>
                <div class="container py-5">
                    <h3 class="font-medium mb-4">کدهای رهگیری سفارشات شما</h3>

                    @if ($orders->isEmpty())
                        <div class="text-center text-gray-500 py-8">هیچ سفارشی یافت نشد.</div>
                    @else
                        <div class="w-full overflow-x-auto">
                            <table class="table-auto min-w-[600px] w-full border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 border">#</th>
                                        <th class="px-4 py-2 border">تاریخ سفارش</th>
                                        <th class="px-4 py-2 border">کد رهگیری</th>
                                        <th class="px-4 py-2 border">کپی</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="text-center">
                                            <td class="px-4 py-2 border">{{ $order->id }}</td>
                                            <td class="px-4 py-2 border">
                                                {{ getJalaliTime($order->created_at, 'd F Y') }}
                                            </td>
                                            <td class="px-4 py-2 border font-medium">{{ $order->tracking_code }}</td>
                                            <td class="px-4 py-2 border">
                                                <button
                                                    onclick="navigator.clipboard.writeText('{{ $order->tracking_code }}')"
                                                    class="bg-gray-200 hover:bg-gray-300 text-sm px-2 py-1 rounded">
                                                    کپی
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
