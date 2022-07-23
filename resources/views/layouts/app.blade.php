<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/feather-icons-web/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
    <!-- <link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2"> -->
    @yield('head')
</head>
<body>
    @guest
        @yield('login-content')
        @else
        <section class="main container-fluid">
            <div class="row">
                                <!-- navbar -->
                @include('layouts.aside')
                                <!-- navbar -->
                <div class="col-12 col-lg-9 col-xl-10 vh-100 py-3 content">
                    @include('layouts.header')
                    <!-- content-start -->
                    @yield('content')
                      <!-- content-end-->
                </div>
            </div>
        </section>
    @endguest

<script src="{{ asset('dashboard/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
{{-- <script src="{{ asset('dashboard/js/app.js') }}"></script> --}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('dashboard/vendor/counter_up/counter_up.js') }}"></script>
<script src="{{ asset('dashboard/vendor/way_point/jquery.waypoints.js') }}"></script>
<script src="{{ asset('dashboard/vendor/chart/Chart.min.js') }}"></script>
@yield('foot')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js"></script> -->

<!-- <script src="https://unpkg.com/@popperjs/core@2"></script> -->
@auth

@empty(Auth::user()->phone)
@include("user-profile.user-info")
@endempty

@if (session('toast'))
<script>
  let toastinfo = @json(session('toast'));
  showToast(toastinfo.icon,toastinfo.title);
</script>
@endif

@endauth
@if (session('banStatus'))
    <script>
        let baninfo = @json(session('banStatus'));
        showBanInfo(baninfo.icon,baninfo.title);
    </script>
@endif
</body>
</html>