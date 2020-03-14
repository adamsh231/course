@extends('layout/quixlab_auth')
@section('title', 'Admin Add Siswa')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-center">
                            <h3 class="text-gray">Add Siswa</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="form-validation">

                            <form class="form-valide" action="{{ url('/admin/add/siswa') }}" method="POST">
                                @csrf

                                <input type="hidden" name="redirect" value="admin">

                                <div class="form-group row is-invalid">
                                    <label class="col-lg-4 col-form-label">Nama</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="{{ old('name') }}" class="form-control" name="name" placeholder="Enter your name...">
                                        @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row is-invalid">
                                    <label class="col-lg-4 col-form-label">Username</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="{{ old('username') }}" class="form-control" name="username" placeholder="Enter username...">
                                        @error('username')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row is-invalid">
                                    <label class="col-lg-4 col-form-label">Password</label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" name="password" placeholder="Enter Password...">
                                        @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row is-invalid">
                                    <label class="col-lg-4 col-form-label">Email</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="{{ old('email') }}" class="form-control" name="email" placeholder="Enter Email...">
                                        @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row is-invalid">
                                    <label class="col-lg-4 col-form-label">Phone</label>
                                    <div class="col-lg-6">
                                        <input type="text" value="{{ old('phone') }}" class="form-control" name="phone" placeholder="Enter Phone Number...">
                                        @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
