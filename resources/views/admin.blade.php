@extends('layout/quixlab_auth')
@section('title', 'Admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">

        {{-- CARD1 --}}
        <div class="card">
            <div class="card-body">
                <div class="default-tab">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" onclick="info_pertemuan(0)" data-toggle="tab" href="#siswa">Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="info_pertemuan(1)" data-toggle="tab" href="#pertemuan">Pertemuan</a>
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
                                            <th scope="col">Judul</th>
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
                                            <td onclick="info_kegiatan({{ $loop->index }})"><a href="#kegiatan">{{ $p->nama }}</a></td>
                                            <td>{{ $p->judul }}</td>
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
        {{-- END CARD1 --}}

        {{-- CARD2 --}}
        <div id="pertemuan-detail" class="card d-none">
            <div class="card-body">
                <div class="default-tab">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="tab" href="#kegiatan">Kegiatan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#file">File</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kuis">Kuis</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="kegiatan" role="tabpanel">
                            @foreach ($pertemuan as $p)
                            <div class="table-responsive check-kegiatan d-none">
                                <div class="card-title text-center">
                                    <h3>{{ ucwords($p->nama) }}</h3>
                                </div>
                                <table class="table table-bordered table-striped verticle-middle">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Kegiatan</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Mulai</th>
                                            <th scope="col">Selesai</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail[$p->id] as $d)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $d->kegiatan }}</td>
                                            <td>{{ $d->deskripsi }}</td>
                                            <td>{{ $d->mulai }}</td>
                                            <td>{{ $d->selesai }}</td>
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
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="file" role="tabpanel">
                            @foreach ($pertemuan as $p)
                            <div class="table-responsive check-file d-none">
                                <div class="card-title text-center">
                                    <h3>{{ ucwords($p->nama) }}</h3>
                                </div>
                                <table class="table table-bordered table-striped verticle-middle">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">File</th>
                                            <th scope="col">Jenis</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($file[$p->id] as $f)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $f->nama }}</td>
                                            <td>{{ $f->deskripsi }}</td>
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
                                            <td>{{ $f->jenis }}</td>
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
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="kuis" role="tabpanel">
                            @foreach ($pertemuan as $p)
                            <div class="table-responsive check-kuis d-none">
                                <div class="card-title text-center">
                                    <h3>{{ ucwords($p->nama) }}</h3>
                                </div>
                                <table class="table table-bordered table-striped verticle-middle">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jawaban</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kuis[$p->id] as $k)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $k->nama }}</td>
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END CARD2 --}}

    </div>
</div>
@endsection

@section('add_script')
<script>
    function info_pertemuan(bool){
        var pert_det = document.getElementById('pertemuan-detail');
        if(bool){
            pert_det.classList.remove('d-none');
        }else{
            pert_det.classList.add('d-none');
        }
    }
    function info_kegiatan(id){
        var keg = document.getElementsByClassName('check-kegiatan');
        var file = document.getElementsByClassName('check-file');
        var kuis = document.getElementsByClassName('check-kuis');
        for (let index = 0; index < keg.length; index++) {
            if(index == id){
                keg[index].classList.remove('d-none');
                file[index].classList.remove('d-none');
                kuis[index].classList.remove('d-none');
            }else{
                keg[index].classList.remove('d-none');
                keg[index].classList.add('d-none');
                file[index].classList.remove('d-none');
                file[index].classList.add('d-none');
                kuis[index].classList.remove('d-none');
                kuis[index].classList.add('d-none');
            }
        }
    }
</script>
@endsection
