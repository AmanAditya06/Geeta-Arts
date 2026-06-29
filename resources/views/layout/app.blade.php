<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <title>Geeta Art & Craft</title>
</head>

<body>
    @include('partials.header')

    @if(request()->routeIs('user.*'))
    <div class="page-wrapper user-layout">
        <div class="row g-0">
            <div class="col-md-3">
                @include('partials.user.sidebar')
            </div>

            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>
    @else
    @yield('content')
    @endif

    @include('partials.footer')

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>