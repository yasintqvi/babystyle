<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    @yield('head-tag')
    @include('app.layouts.partials.head-tag')
  </head>
  <body class="font-vazir scroll-smooth">
    
    @include('app.layouts.partials.header')


    <section class="min-h-screen overflow-x-hidden">
      @yield('content')
    </section>

    
    @include('app.layouts.partials.footer')

    @include('app.layouts.partials.script')
    
    @yield('script')
  </body>
</html>
