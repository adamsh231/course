@extends('layout/quixlab_auth')
@section('title', 'Admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="default-tab">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="tab" href="#siswa">Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#pertemuan">Pertemuan</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="siswa" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Pre Test</th>
                                            <th scope="col">Post Test</th>
                                            <th scope="col">Team</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $s)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $s->name }}</td>
                                            <td>{{ $s->username }}</td>
                                            <td class="text-center">
                                                <span>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Change Password">
                                                        <i class="fa fa-refresh color-muted m-r-5"></i>
                                                    </a>
                                                </span>
                                            </td>
                                            <td>{{ $s->email }}</td>
                                            <td>{{ $s->phone }}</td>
                                            <td class="text-center">{{ $s->pretest }}</td>
                                            <td class="text-center">{{ $s->posttest }}</td>
                                            <td class="text-center">{{ $s->team }}</td>
                                            <td class="text-center">
                                                <span>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pertemuan" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Diskusi</th>
                                            <th scope="col">Tugas</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pertemuan as $p)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $p->nama }}</td>
                                            <td class="text-center">{{ date('d/m/Y', strtotime($p->tanggal)) }}</td>
                                            <td class="text-center">
                                                <span>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Change File">
                                                        <i class="fa fa-refresh color-muted m-r-5"></i>
                                                    </a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Open File">
                                                        <i class="fa fa-eye color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Change File">
                                                        <i class="fa fa-refresh color-muted m-r-5"></i>
                                                    </a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Open File">
                                                        <i class="fa fa-eye color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                            <td>{{ $p->deskripsi }}</td>
                                            <td class="text-center">
                                                <span>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
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
@endsection
