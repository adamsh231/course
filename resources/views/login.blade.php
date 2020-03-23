<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LINEARICONS -->
    <link rel="stylesheet" href="{{ URL::asset('quixlab/icons/fonts/linearicons/style.css') }}">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{ URL::asset('quixlab/css/style_login.css') }}">
</head>

<body>
    <div class="wrapper">
        <div class="inner">
            @if (session('status'))
            <button style="color:yellow; margin-top:0">
                <b>{{ session('status') }}</b>
            </button>
            @endif

            <img src="{{ URL::asset('assets/image-1.png') }}" alt="" class="image-1">
            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <h3>Sign In</h3>
                <div class="form-holder" @error('username') style="margin-bottom: 0" @enderror>
                    <span class="lnr lnr-user"></span>
                    <input type="text" class="form-control" value="{{ old('username') }}" name="username" placeholder="Username">
                </div>
                @error('username')
                <small style="color: red; margin-left:40px">{{ $message }}</small>
                @enderror
                <div class="form-holder" @error('password') style="margin-bottom: 0" @enderror>
                    <span class="lnr lnr-lock"></span>
                    <input type="password" class="form-control" value="{{ old('password') }}" name="password" placeholder="Password">
                </div>
                @error('password')
                <small style="color: red; margin-left:40px">{{ $message }}</small>
                @enderror
                <button type="submit">
                    <span>Sign In</span>
                </button>
                <br>
                <p style="float: right"><a href="{{ url('/register') }}"> Sign Up</a></p>
            </form>
            <img src="{{ asset('assets/image-2.png') }}" alt="" class="image-2">
        </div>
    </div>
</body>

</html>
