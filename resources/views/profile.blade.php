@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Home')

@section('content')

<div class="content-body">
    <div class="container-fluid">
        @if (session('status'))
        <div class="alert alert-info alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button> {{ session('status') }}
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center m-4">
                    <img class="mr-3" src="{{ asset('assets/profile.png') }}" width="80" height="80" alt="">
                    <div class="media-body">
                        <h3 class="mb-0">{{ $siswa->name }}</h3>
                        <p class="text-muted mb-0">{{ $siswa->email }}</p>
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12 col-sm-6">
                        <div class="card" id="profile">
                            <div class="custom-tab-1 m-4">
                                <ul class="nav nav-tabs mb-3">
                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profil">Profil</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#presensi">Presensi</a>
                                    </li>
                                </ul>
                                <div class="tab-content">

                                    <div class="tab-pane fade show active" id="profil" role="tabpanel">
                                        <form action="{{ url('/profile') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="p-t-15 ml-3 mt-4">
                                                <div class="form-group row ml-3">
                                                    <i class="fa fa-user-o mt-2"></i>
                                                    <label class="col-lg-4 col-form-label"> Nama </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="name" value="{{ $siswa->name }}">
                                                        @error('name')
                                                        <div class="invalid-feedback animated fadeInDown d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row ml-3">
                                                    <i class="fa fa-user-o mt-2"></i>
                                                    <label class="col-lg-4 col-form-label">Username </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="username" value="{{ $siswa->username }}">
                                                        @error('username')
                                                        <div class="invalid-feedback animated fadeInDown d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row ml-3">
                                                    <i class="icon-key mt-2"></i>
                                                    <label class="col-lg-4 col-form-label"> Password </label>
                                                    <div class="col-lg-6">
                                                        <input type="password" class="form-control" name="password" placeholder="Ganti Untuk Mengubah Password ...">
                                                        @error('password')
                                                        <div class="invalid-feedback animated fadeInDown d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row ml-3">
                                                    <i class="fa fa-envelope-o mt-2"></i><label class="col-lg-4 col-form-label">E-mail </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="email" value="{{ $siswa->email }}">
                                                        @error('email')
                                                        <div class="invalid-feedback animated fadeInDown d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row ml-3">
                                                    <i class="icon-phone mt-2"></i>
                                                    <label class="col-lg-4 col-form-label">Telepon </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" name="phone" value="{{ $siswa->phone }}">
                                                        @error('phone')
                                                        <div class="invalid-feedback animated fadeInDown d-block">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 text-center">
                                                    <button type="submit" class="btn btn-info px-5">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="presensi">
                                        <div class="p-t-15 mb-3">
                                            <h4 class="mt-4 ml-3">Data Presensi Siswa </h4>
                                            <div class="alert alert-warning mx-4">Apabila ada data yang tidak sesuai, konfirmasikan pada guru Anda untuk segera diubah. Jika Anda hadir akan muncul tanda
                                                centang hijau pada kolom absensi <i class="fa fa-check-circle-o fa-2x text-success"></i>, dan jika Anda tidak hadir akan muncul silang merah pada kolom
                                                absensi <td><i class="fa fa-times-circle-o fa-2x text-danger"></i></td>.
                                            </div>
                                            <div class="card mx-4 mt-3">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Tanggal</th>
                                                                <th class="text-center">Pertemuan</th>
                                                                <th class="text-center">Absensi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($presensi as $p)
                                                            <tr>
                                                                <td style="width: 20%" class="text-center">{{ date('d M Y', strtotime($p->pertemuan->tanggal)) }}</td>
                                                                <td>{{ $p->pertemuan->nama }}</td>
                                                                @if ($p->kehadiran == "Hadir")
                                                                <td style="width: 30%" class="text-center"><i class="fa fa-check-circle-o fa-2x text-success"></i></td>
                                                                @else
                                                                <td style="width: 30%" class="text-center"><i class="fa fa-times-circle-o fa-2x text-danger"></i></td>
                                                                @endif
                                                            </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-4 col-sm-6">
                        <div class="card" id="nilai">
                            <div class="card-body mt-0">
                                <div class="mb-3">
                                    <h3 class="text-center mb-2">Nilai Siswa </h3>
                                    <div class="alert alert-warning">Jika ada data yang tidak sesuai, segara konfirmasikan pada guru untuk segera diubah. </div>
                                    <hr>
                                    <div class="col-xl-12">
                                        <div class="basic-list-group">
                                            <ul class="list-group list-group-flush">

                                                @foreach ($nilai as $n)
                                                <li class="list-group-item">
                                                    <h4 class="mt-1 d-inline">{{ $n->kuis->nama }}</h4>
                                                    <button onclick="tombol({{ $n->nilai }},'{{ $n->kuis->nama }}')" class="btn btn-outline-info d-inline btn-rounded btn-sm float-right">Lihat Hasil</button>
                                                </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>



            </div>
        </div>
    </div>
</div>
@endsection

@section('add_script')
<script>
    function tombol(nilai, nama){
		Swal.fire({
		  type: 'success',
		  title: 'Anda telah mengerjakan '+ nama +'!',
		  text: 'Skor Anda: '+ nilai +'/100',
		});
	}
</script>
@endsection
