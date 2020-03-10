@extends('layout/quixlab')
@section('title','Login')
@section('content')
<div class="container mt-5">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                @if(session('status'))
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>{{ session('status') }}
                                </div>
                                @endif
                                <a class="text-center" href="{{ url('/') }}">
                                    <h4>Rosella</h4>
                                </a>

                                <form class="mt-5 mb-5 login-input" action="{{ url('/login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{ old('username') }}" name="username" placeholder="Username">
                                        @error('username')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" value="{{ old('password') }}" name="password" placeholder="Password">
                                        @error('password')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Sign In</button>
                                </form>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="{{ url('/register') }}" class="text-primary">Sign Up</a> now</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
