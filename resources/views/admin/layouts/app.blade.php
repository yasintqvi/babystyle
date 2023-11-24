<!DOCTYPE html>
<html lang="fa" class="js">

<head>
    @include('admin.layouts.partials.head-tag')
    @yield('head-tag')
</head>

<body class="has-rtl nk-body bg-lighter npc-default has-sidebar" dir="rtl">
    <div class="nk-app-root">
        {{-- all content --}}
        <div class="nk-main">
            @include('admin.layouts.partials.sidebar')

            <div class="nk-wrap">
                @include('admin.layouts.partials.header')
                <div class="nk-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @include('admin.layouts.partials.footer')
            </div>
        </div>
        {{-- end content --}}
    </div>

    @include('admin.layouts.partials.script')
    @yield('script')
</body>

</html>
