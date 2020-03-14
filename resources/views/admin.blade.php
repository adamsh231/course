@extends('layout/quixlab_auth')
@section('title', 'Admin')

@section('add_scrpt')
<link href="{{ URL::asset('quixlab/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">

        {{-- CARD1 --}}
        <div class="card">
            <div class="card-body">
                <div class="default-tab">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" onclick="info_pertemuan(0)" data-toggle="tab" href="#siswa">Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active show" onclick="info_pertemuan(1)" data-toggle="tab" href="#pertemuan">Pertemuan</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade" id="siswa" role="tabpanel">
                            <div class="table-responsive">
                                <table id="siswa_table" class="table table-bordered table-striped verticle-middle table-md">
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

                        <div class="tab-pane fade active show" id="pertemuan" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped verticle-middle table-md">
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
                                            <td onclick="info_kegiatan({{ $loop->index }}, '{{ $p->nama }}')"><a href="#pertemuan-detail">{{ $p->nama }}</a></td>
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
        <div id="pertemuan-detail" class="card">
            <div class="card-header">
                <h3 id="card_title" class="text-gray"></h3>
            </div>
            <div class="card-body">
                <div class="default-tab">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link  active show" data-toggle="tab" href="#presensi">Presensi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kegiatan">Kegiatan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#file">File</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kuis">Kuis</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade" id="kegiatan" role="tabpanel">
                            @foreach ($pertemuan as $p)
                            <div class="table-responsive check-kegiatan d-none">
                                <table class="table table-bordered table-striped verticle-middle table-md">
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
                                <table class="table table-bordered table-striped verticle-middle table-md">
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
                                <table class="table table-bordered table-striped verticle-middle table-md">
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

                        <div class="tab-pane fade  active show" id="presensi" role="tabpanel">
                            @foreach ($pertemuan as $p)
                            <div class="table-responsive check-presensi d-none">
                                <table id="presensi_table{{ $loop->index }}" class="table table-bordered table-striped verticle-middle table-md">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 10%" scope="col">No</th>
                                            <th style="width: 40%" scope="col">Nama</th>
                                            <th scope="col">Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presensi[$p->id] as $pr)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $pr->siswa->name }}</td>
                                            <td class="text-center">
                                                @if ($pr->kehadiran == "Hadir")
                                                <button type="button" class="btn mb-1 btn-rounded btn-success btn-sm">
                                                    <i class="fa fa-check fa-2x text-white" aria-hidden="true"></i>
                                                </button>
                                                @else
                                                <button type="button" class="btn mb-1 btn-rounded btn-outline-danger btn-sm">
                                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                                </button>
                                                @endif
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
<script src="{{ URL::asset('quixlab/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('quixlab/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('quixlab/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#siswa_table').DataTable({
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });
    });
    function info_pertemuan(bool){
        var pert_det = document.getElementById('pertemuan-detail');
        if(bool){
            pert_det.classList.remove('d-none');
        }else{
            pert_det.classList.add('d-none');
        }
    }
    function info_kegiatan(id, nama){
        var keg = document.getElementsByClassName('check-kegiatan');
        var file = document.getElementsByClassName('check-file');
        var kuis = document.getElementsByClassName('check-kuis');
        var title = document.getElementById('card_title');
        var presensi = document.getElementsByClassName('check-presensi');
        for (let index = 0; index < keg.length; index++) {
            if(index == id){
                keg[index].classList.remove('d-none');
                file[index].classList.remove('d-none');
                kuis[index].classList.remove('d-none');
                presensi[index].classList.remove('d-none');
                $('#presensi_table'+id).DataTable({
                    pageLength : -1,
                    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
                });
                title.innerHTML = nama;
            }else{
                keg[index].classList.remove('d-none');
                keg[index].classList.add('d-none');
                file[index].classList.remove('d-none');
                file[index].classList.add('d-none');
                kuis[index].classList.remove('d-none');
                kuis[index].classList.add('d-none');
                presensi[index].classList.remove('d-none');
                presensi[index].classList.add('d-none');
            }
        }
    }
</script>
@endsection
