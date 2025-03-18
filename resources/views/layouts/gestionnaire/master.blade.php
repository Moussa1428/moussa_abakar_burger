<!doctype html>
<html lang="en">
@include('layouts.gestionnaire.head')
<body>
@include('layouts.gestionnaire.nav')
<div class="container-fluid">
    <div class="row">
        @include('layouts.gestionnaire.sidebar')
        {{--        main--}}
        <div class="col-md-9 ms-sm-auto col-lg-10 main-content">
          @yield('main')
        </div>

    </div>
</div>
</body>
</html>
