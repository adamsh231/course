@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Kelompok')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title mt-4">
                    <h1 class="card-title text-center">Daftar kelompok {!! (Auth::user()->team ? '(<b class="text-primary">'.Auth::user()->team.'</b>)' : '(<b class="text-primary">Belum Terdaftar</b>)') !!}</h1>
                </div>
            </div>
            <hr>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                            <tr>
                                <td style="width: 25%" class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $s->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
