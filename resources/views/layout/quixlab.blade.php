<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('quixlab/images/favicon.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ URL::asset('quixlab/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ URL::asset('quixlab/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('quixlab/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ URL::asset('quixlab/css/style.css') }}" rel="stylesheet">

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
    <script src="{{ URL::asset('quixlab/js/styleSwitcher.js') }}"></script>

    {{-- Chart Js --}}
    <script src="{{ URL::asset('quixlab/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    {{-- Circle Progress --}}
    <script src="{{ URL::asset('quixlab/plugins/circle-progress/circle-progress.min.js') }}"></script>
    {{-- Data Map --}}
    <script src="{{ URL::asset('quixlab/plugins/d3v3/index.js') }}"></script>
    <script src="{{ URL::asset('quixlab/plugins/topojson/topojson.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/plugins/datamaps/datamaps.world.min.js') }}"></script>
    {{-- Morris Js --}}
    <script src="{{ URL::asset('quixlab/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/plugins/morris/morris.min.js') }}"></script>
    {{-- Pignose Calender --}}
    <script src="{{ URL::asset('quixlab/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
    {{-- Chartis Js --}}
    <script src="{{ URL::asset('quixlab/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>
    {{-- Dashboard --}}
    <script src="{{ URL::asset('quixlab/js/dashboard/dashboard-1.js') }}"></script>
    @yield('add_script')
</body>

</html>
