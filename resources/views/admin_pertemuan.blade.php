@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Admin By Detail Pertemuan')

@section('add_style')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                                            <td id="td_hadir{{ $pr->id }}" class="text-center">
                                                @if ($pr->kehadiran == "Hadir")
                                                <button id="btn_hadir{{ $pr->id }}" onclick="hadir({{ $pr->id }}, 1)" type="button" class="btn mb-1 btn-rounded btn-success btn-sm">
                                                    <i id="icon_hadir{{ $pr->id }}" class="fa fa-check fa-2x text-white" aria-hidden="true"></i>
                                                </button>
                                                @else
                                                <button id="btn_hadir{{ $pr->id }}" onclick="hadir({{ $pr->id }}, 0)" type="button" class="btn mb-1 btn-rounded btn-danger btn-sm">
                                                    <i id="icon_hadir{{ $pr->id }}" class="fa fa-times fa-2x" aria-hidden="true"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="detail" role="tabpanel">
                            <button onclick="maintenance()" type="button" class="btn mb-1 btn-outline-success float-right">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <div class="table-responsive check-kegiatan">
                                <table class="table table-bordered verticle-middle table-md">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Kegiatan</th>
                                            <th scope="col">Mulai</th>
                                            <th scope="col">Selesai</th>
                                            <th style="width: 15%" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail as $d)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>

                                                <a class="text-center">
                                                    <h4><b>{{ $d->kegiatan }}</b></h4>
                                                </a>

                                                <div class="table-responsive check-kegiatan">
                                                    <table class="table table-bordered table-striped verticle-middle table-sm">
                                                        <tbody>
                                                            @foreach ($d->deskripsi as $ddes)
                                                            <tr>
                                                                <td>{{ $ddes->teks }}</td>
                                                                <td style="width: 15%" class="text-center">
                                                                    <span>
                                                                        <a class="mr-2" onclick="maintenance()" href="#">
                                                                            <i class="fa fa-pencil color-muted m-r-5"></i>
                                                                        </a>
                                                                        <a onclick="maintenance()" href="#">
                                                                            <i class="fa fa-trash-o color-danger"></i>
                                                                        </a>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </td>
                                            <td>{{ $d->mulai }}</td>
                                            <td>{{ $d->selesai }}</td>
                                            <td class="text-center">
                                                <span>
                                                    <a class="mr-2" onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Detail Kegiatan">
                                                        <i class="fa fa-plus color-muted m-r-5"></i>
                                                    </a>
                                                    <a class="mr-2" onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
                                                        <i class="fa fa-trash-o color-danger"></i>
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
                                                        <i class="fa fa-trash-o color-danger"></i>
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
                            <div class="table-responsive check-kuis">
                                @isset($kuis)
                                <div class="card">
                                    <div>
                                        <ul class="mb-0 form-profile__icons float-right">
                                            <li class="d-inline-block">
                                                <button onclick="maintenance()" class="btn btn-transparent p-0 mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Kuis">
                                                    <i class="fa fa-pencil fa-2x"></i>
                                                </button>
                                            </li>
                                            <li class="d-inline-block">
                                                <button onclick="maintenance()" class="btn btn-transparent p-0 mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Kuis">
                                                    <i class="fa fa-trash-o fa-2x"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ strtoupper($kuis->nama) }}</h5>
                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                        <button onclick="maintenance()" type="button" class="btn mb-4 btn-info">
                                            Lihat Kunci Jawaban
                                        </button>
                                        @if ($kuis->aktif)
                                        <button onclick="maintenance()" type="button" class="btn mb-4 btn-success text-white">
                                            Matikan Kuis
                                        </button>
                                        @else
                                        <button onclick="maintenance()" type="button" class="btn mb-4 btn-danger">
                                            Aktifkan Kuis
                                        </button>
                                        @endif
                                        <div class="card-footer text-muted">Waktu Pengerjaan {{ $kuis->waktu }} Menit</div>
                                    </div>
                                    <div>
                                        <button onclick="maintenance()" type="button" class="btn mb-1 btn-outline-success float-right">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <table class="table table-bordered table-striped verticle-middle table-md">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">No</th>
                                                <th scope="col">Pertanyaan</th>
                                                <th scope="col">Gambar</th>
                                                <th scope="col">A</th>
                                                <th scope="col">B</th>
                                                <th scope="col">C</th>
                                                <th scope="col">D</th>
                                                <th scope="col">Jawaban</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kuis->soal as $ks)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-justify">{{ $ks->pertanyaan }}</td>
                                                <td class="text-center">
                                                    <span>
                                                        <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Open File">
                                                            <i class="fa fa-eye color-danger"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                                <td>{{ $ks->A }}</td>
                                                <td>{{ $ks->B }}</td>
                                                <td>{{ $ks->C }}</td>
                                                <td>{{ $ks->D }}</td>
                                                <td class="text-center">{{ $ks->jawaban }}</td>
                                                <td class="text-center">
                                                    <span>
                                                        <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                                            <i class="fa fa-pencil color-muted m-r-5"></i>
                                                        </a>
                                                        <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
                                                            <i class="fa fa-trash-o color-danger"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endisset
                                @if (!isset($kuis))
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">Tidak ada Kuis pada pertemuan ini</h5>
                                        <p class="card-text">Jika ingin menambahkan klik tambahkan</p>
                                        <a href="#" onclick="maintenance()" class="btn btn-primary">Tambahkan</a>
                                    </div>
                                </div>
                                @endif
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
    <script>
        function hadir(id, hadir) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
               type:'POST',
               url:'/admin/hadir',
               data: {
                   id: id,
                   kehadiran: hadir
               },
               dataType: 'json',
               beforeSend: function(data){
                    $("#btn_hadir"+id).removeClass('btn-success btn-danger').addClass('btn-warning');
                    $("#icon_hadir"+id).removeClass('fa-check').addClass('fa-spinner text-white');
               },
               success: function(data) {
                    $("#td_hadir"+id).html(data.replace);
               },
               error: function(data){
                    // var errors = $.parseJSON(data.responseText);
                    // $("#ajax"+id).html(errors.error);
                    $("#icon_hadir"+id).removeClass('fa-spinner').addClass('fa-exclamation-triangle');
                    setTimeout(function () {
                        if(hadir){
                            $("#btn_hadir"+id).removeClass('btn-warning').addClass('btn-success');
                            $("#icon_hadir"+id).removeClass('fa-exclamation-triangle').addClass('fa-check');
                        }else{
                            $("#btn_hadir"+id).removeClass('btn-warning').addClass('btn-danger');
                            $("#icon_hadir"+id).removeClass('fa-exclamation-triangle').addClass('fa-times');
                        }
                    }, 1500);

               }
            });
         }
    </script>

    @endsection
