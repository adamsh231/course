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
    <link href="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    @yield('add_style')

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


    <div id="main-wrapper">

        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{ url('/home') }}">
                    <b class="logo-abbr"><img src="{{ URL::asset('quixlab/images/logo.png') }}" alt=""> </b>
                    <span class="logo-compact"><img src="{{ URL::asset('quixlab/images/logo-compact.png') }}" alt=""></span>
                    <span class="brand-title">
                        <img src="{{ URL::asset('quixlab/images/logo-text.png') }}" alt="">
                    </span>
                </a>
            </div>
        </div>

        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <button onclick="window.location.href='{{ url('/kelompok') }}'" class="btn mb-1 btn-primary btn-sm mb-2 mr-4">
                                Daftar kelompok
                                <span class="btn-icon-right text-white">
                                    <i class="fa fa-sticky-note"></i>
                                </span>
                            </button>
                        </li>
                        <li class="icons dropdown" style="margin-right:10px;">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{ asset('assets/profile.png') }}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="{{ url('/profile') }}"><i class="ti-user"></i> <span>Profile</span></a>
                                        </li>
                                        <hr class="my-2">
                                        <li>
                                            <a href="{{ url('/logout') }}"><i class="icon-key"></i> <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label"></li>
                    <li>
                        <a href="{{ url('/home') }}">
                            <i class="ti-home" style="margin-bottom:5px;"></i><span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="has-arrow" aria-expanded="false">
                            <i class="ti-notepad" style="margin-bottom:5px;"></i><span class="nav-text">Pembelajaran</span>
                        </a>
                        <ul aria-expanded="false">
                            @foreach ($pertemuan as $p)
                            <li><a href="{{ url('/pertemuan/'.$p->id) }}">{{ $p->nama }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
            @if (Auth::user()->status == 1)
            <a href="{{ url('/admin') }}" class="text-primary" style="position: fixed;bottom: 20px;left: 20px;"><i class="fa fa-cog fa-3x"></i></a>
            @endif
        </div>

        @yield('content')

    </div>

    <script src="{{ URL::asset('quixlab/plugins/common/common.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/custom.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/settings.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/gleek.js') }}"></script>

    <script src="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script>
        function maintenance(){
            Swal.fire(
                'We\'re Sorry',
                'this feature is under construction',
                'warning'
            )
        }
    </script>
    @yield('add_script')
</body>

</html>
