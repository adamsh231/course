@extends('layout/quixlab')
@section('title','Landing')
@section('content')
<div class="container mt-5">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="error-content">
                        <div class="card mb-0">
                            <div class="card-body text-center">
                                <form class="mt-5 mb-5">
                                    <div class="text-center mb-4 mt-4 d-inline"><a href="{{ url('/login') }}" class="btn btn-primary">Go to Login</a>
                                    </div>
                                    <div class="text-center mb-4 mt-4 d-inline"><a href="{{ url('/register') }}" class="btn btn-danger">Go to Register</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
