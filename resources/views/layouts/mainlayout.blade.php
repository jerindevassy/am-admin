<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->






  @include('layouts.partials.head')





  <body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
  



  @include('layouts.partials.header')



  @yield('content')



  @include('layouts.partials.footer')



  @include('layouts.partials.footer-scripts')


  </body>
<!-- [Body] end -->

</html>