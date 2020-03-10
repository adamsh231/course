@extends('layout/quixlab')
@section('title','Register')
@section('content')
<div class="container mt-5">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">

                                <a class="text-center" href="{{ url('/') }}">
                                    <h4>Rosella</h4>
                                </a>

                                <form class="mt-5 mb-5 login-input" method="POST" action="{{ url('/register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name" value="{{ old('name') }}" name="name">
                                        @error('name')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Username" value="{{ old('username') }}" name="username">
                                        @error('username')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                        @error('password')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email">
                                        @error('email')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Phone Number" value="{{ old('phone') }}" name="phone">
                                        @error('phone')
                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button class="btn login-form__btn submit w-100">Sign Up</button>
                                </form>
                                <p class="mt-5 login-form__footer">
                                    Have account <a href="{{ url('/login') }}" class="text-primary">Sign In </a> now</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
