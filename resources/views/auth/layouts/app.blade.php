<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/app/images/Logo.jpeg') }}" />
    <link rel="stylesheet" href="{{ asset('assets/app/css/vazir.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/plugins/toast/toastify.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/app/css/all.css') }}" />

    <title>
        {{ "بیبی استایل  - $title" ?? '<بدون عنوان>' }}
    </title>

</head>

<body class="font-vazir">
    <section id="login" class="p-40">
        <div
            class="container flex flex-col md:flex-row justify-center items-center w-full h-screen bg-white bg-opacity-70 z-10">
            @yield('content')
        </div>
    </section>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/app/plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset("assets/app/plugins/toast/toastify-js.js") }}"></script>
    
    @include('app.alerts.toast.success')
    
    @include('app.alerts.toast.warning')

    @yield('script')

</body>

</html>
