<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('quixlab/images/favicon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ URL::asset('quixlab/css/style.css') }}" rel="stylesheet">
    @yield('add_css')

</head>

<body>
    {{-- PreLoader --}}
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    @yield('content')

    <script src="{{ URL::asset('quixlab/plugins/common/common.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/custom.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/settings.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/gleek.js') }}"></script>

    @yield('add_script')
</body>

</html>
