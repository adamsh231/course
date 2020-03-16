@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Admin By Pertemuan')

@section('add_style')
<link href="{{ URL::asset('quixlab/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        {{-- CARD2 --}}
        <div id="pertemuan-detail" class="card">
            <div class="card-header">
                <button onclick="window.location.href = 'javascript:history.back()'" class="btn mb-1 btn-rounded btn-outline-primary btn-sm d-inline">
                    <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
                    <h3 class="d-inline">{{ $id_pertemuan->nama }} ({{ date('d/m/Y', strtotime($id_pertemuan->tanggal)) }})</h3>
                </button>
            </div>
            <div class="card-body">
                <div class="default-tab">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link  active show" data-toggle="tab" href="#presensi">Presensi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#detail">Detail</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#video">Video</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kuis">Kuis</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade" id="detail" role="tabpanel">
                            <button onclick="maintenance()" type="button" class="btn mb-1 btn-outline-success float-right">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <div class="table-responsive check-kegiatan">
                                <table class="table table-bordered table-striped verticle-middle table-md">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Kegiatan</th>
                                            <th scope="col">Mulai</th>
                                            <th scope="col">Selesai</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail as $d)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $d->kegiatan }}</td>
                                            <td>{{ $d->mulai }}</td>
                                            <td>{{ $d->selesai }}</td>
                                            <td class="text-center">
                                                <span>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
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

                        <div class="tab-pane fade" id="video" role="tabpanel">
                            <button onclick="maintenance()" type="button" class="btn mb-1 btn-outline-success float-right">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <div class="table-responsive check-file">
                                <table class="table table-bordered table-striped verticle-middle table-md">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">File</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($video as $v)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $v->nama }}</td>
                                            <td class="text-justify">{{ $v->deskripsi }}</td>
                                            <td class="text-center">
                                                <span>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Change File">
                                                        <i class="fa fa-refresh color-muted m-r-5"></i>
                                                    </a>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Open File">
                                                        <i class="fa fa-eye color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
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

                        <div class="tab-pane fade" id="kuis" role="tabpanel">
                            <button onclick="maintenance()" type="button" class="btn mb-1 btn-outline-success float-right">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <div class="table-responsive check-kuis">
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
                                        @foreach ($kuis as $k)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $k->nama }}</td>
                                            <td class="text-center">
                                                <span>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Change File">
                                                        <i class="fa fa-refresh color-muted m-r-5"></i>
                                                    </a>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Open File">
                                                        <i class="fa fa-eye color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
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

                        <div class="tab-pane fade  active show" id="presensi" role="tabpanel">
                            <button onclick="maintenance()" type="button" class="btn mb-1 btn-outline-success float-right">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <div class="table-responsive check-presensi">
                                <table id="table_presensi" class="table table-bordered table-striped verticle-middle table-md">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 10%" scope="col">No</th>
                                            <th style="width: 40%" scope="col">Nama</th>
                                            <th scope="col">Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presensi as $pr)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $pr->siswa->name }}</td>
                                            <td class="text-center">
                                                @if ($pr->kehadiran == "Hadir")
                                                <input type="hidden" value="Hadir">
                                                <button onclick="maintenance()" type="button" class="btn mb-1 btn-rounded btn-success btn-sm">
                                                    <i class="fa fa-check fa-2x text-white" aria-hidden="true"></i>
                                                </button>
                                                @else
                                                <button onclick="maintenance()" type="button" class="btn mb-1 btn-rounded btn-outline-danger btn-sm">
                                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                                </button>
                                                @endif
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
        $('#table_presensi').DataTable({
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });
    });
</script>
@endsection
