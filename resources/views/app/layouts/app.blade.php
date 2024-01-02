<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    @include('app.layouts.partials.head-tag')
    @yield('head-tag')
  </head>
  <body class="font-vazir scroll-smooth">
    
    @include('app.layouts.partials.header')


    @yield('content')

    
    @include('app.layouts.partials.footer')

    @include('app.layouts.partials.script')
    
    @yield('script')
  </body>
</html>
