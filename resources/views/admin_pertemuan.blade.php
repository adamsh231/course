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
                <button onclick="window.location.href = '{{ url('/admin') }}'" class="btn mb-1 btn-rounded btn-outline-primary btn-sm d-inline">
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
                            <div class="table-responsive check-presensi">
                                <table id="table_presensi" class="table table-bordered table-striped verticle-middle table-md">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 10%" scope="col">No</th>
                                            <th style="width: 40%" scope="col">Nama</th>
                                            <th scope="col">Tugas</th>
                                            <th scope="col">Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presensi as $pr)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $pr->siswa->name }}</td>
                                            <td class="text-center">
                                                @if ($pr->tugas)
                                                <button onclick="window.open('{{ url('storage/'. $pr->tugas) }}');" type="button" class="btn mb-1 btn-rounded btn-success btn-sm">
                                                    <i class="fa fa-check fa-2x text-white" aria-hidden="true"></i>
                                                </button>
                                                @else
                                                <button type="button" class="btn mb-1 btn-rounded btn-danger btn-sm">
                                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                                </button>
                                                @endif
                                            </td>
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
                            <button data-toggle="modal" data-target="#add_detail" type="button" class="btn mb-1 btn-outline-success float-right">
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
                                                        <tbody id="detail_kegiatan{{ $d->id }}">
                                                            @foreach ($d->deskripsi as $ddes)
                                                            <tr>
                                                                <td>{{ $ddes->teks }}</td>
                                                                <td style="width: 15%" class="text-center">
                                                                    <span>
                                                                        <a class="mr-2" onclick="show_modal_edit_kegiatan({{ $ddes->id }}, '{{ $d->kegiatan }}')" href="#">
                                                                            <i class="fa fa-pencil color-muted m-r-5"></i>
                                                                        </a>
                                                                        <a onclick="confirm_delete_kegiatan({{ $ddes->id }}, '{{ $ddes->teks }}')" href="#">
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
                                            <td class="text-center">{{ $d->mulai }}</td>
                                            <td class="text-center">{{ $d->selesai }}</td>
                                            <td class="text-center">
                                                <span>
                                                    <a class="mr-2" onclick="show_modal_add_kegiatan({{ $d->id }}, '{{ $d->kegiatan }}')" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tambah Detail Kegiatan">
                                                        <i class="fa fa-plus color-muted m-r-5"></i>
                                                    </a>
                                                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                                        <a onclick="fill_edit_detail({{ $d->id }})" class="mr-2" href="#" data-toggle="modal" data-target="#edit_detail">
                                                            <i class="fa fa-pencil color-muted m-r-5"></i>
                                                        </a>
                                                    </span>
                                                    <a onclick="confirm_delete_detail({{ $d->id }},'{{ $d->kegiatan }}')" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
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
                            <button data-target="#add_video" data-toggle="modal" type="button" class="btn mb-1 btn-outline-success float-right">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <div class="table-responsive check-file">
                                <table class="table table-bordered table-striped verticle-middle table-md">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Link</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($video as $v)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $v->nama }}</td>
                                            <td class="text-justify">{{ $v->deskripsi }}</td>
                                            <td>
                                                <a href="{{ $v->path }}" target="_blank">{{ substr($v->path, 0, 40) }}</a>
                                            </td>
                                            <td class="text-center">
                                                <span>
                                                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                                        <a onclick="fill_edit_video({{ $v->id }})" data-target="#edit_video" data-toggle="modal" href="#">
                                                            <i class="fa fa-pencil color-muted m-r-5"></i>
                                                        </a>
                                                    </span>
                                                    <a onclick="confirm_delete_video({{ $v->id }}, '{{ $v->nama }}')" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
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
                                                <button onclick="fill_edit_kuis({{ $kuis->id }}, '{{ $kuis->nama }}', '{{ $kuis->waktu }}')" class="btn btn-transparent p-0 mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Kuis">
                                                    <i class="fa fa-pencil fa-2x"></i>
                                                </button>
                                            </li>
                                            <li class="d-inline-block">
                                                <button onclick="confirm_delete_kuis({{ $kuis->id }}, '{{ $kuis->nama }}')" class="btn btn-transparent p-0 mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Kuis">
                                                    <i class="fa fa-trash-o fa-2x"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ strtoupper($kuis->nama) }}</h5>
                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                        <a href="{{ url('admin/pertemuan/'.$id_pertemuan->id.'/file') }}" type="button" class="btn mb-4 btn-info">
                                            Manage Gambar dan Kunci Jawaban
                                        </a>
                                        @if ($kuis->aktif)
                                        <div id="block_button" class="d-inline">
                                            <button id="btn_aktif" onclick="aktivasi({{ $kuis->id }}, 1)" type="button" class="btn mb-4 btn-success text-white">
                                                Matikan Kuis
                                            </button>
                                        </div>
                                        @else
                                        <div id="block_button" class="d-inline">
                                            <button id="btn_aktif" onclick="aktivasi({{ $kuis->id }}, 0)" type="button" class="btn mb-4 btn-danger">
                                                Aktifkan Kuis
                                            </button>
                                        </div>
                                        @endif
                                        <div class="card-footer text-muted">Waktu Pengerjaan {{ $kuis->waktu }} Menit</div>
                                    </div>
                                    <div>
                                        <button data-target="#add_soal" data-toggle="modal" type="button" class="btn mb-1 btn-outline-success float-right">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <table class="table table-bordered table-striped verticle-middle table-md">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">No</th>
                                                <th scope="col">Pertanyaan</th>
                                                <th scope="col">A</th>
                                                <th scope="col">B</th>
                                                <th scope="col">C</th>
                                                <th scope="col">D</th>
                                                <th scope="col">E</th>
                                                <th scope="col">Jawaban</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_soal">
                                            @foreach ($kuis->soal as $ks)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-justify">{!! $ks->pertanyaan !!}</td>
                                                <td>{{ $ks->A }}</td>
                                                <td>{{ $ks->B }}</td>
                                                <td>{{ $ks->C }}</td>
                                                <td>{{ $ks->D }}</td>
                                                <td>{{ $ks->E }}</td>
                                                <td class="text-center">{{ $ks->jawaban }}</td>
                                                <td class="text-center">
                                                    <span>
                                                        <a onclick="fill_edit_soal({{ $ks->id }})" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                                            <i class="fa fa-pencil color-muted m-r-5"></i>
                                                        </a>
                                                        <a onclick="confirm_delete_soal({{ $ks->id }}, '{{ $ks->pertanyaan }}')" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
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
                                        <a href="#" data-toggle="modal" data-target="#add_kuis" class="btn btn-primary">Tambahkan</a>
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
</div>

{{-- Modal Add Detail --}}
@component('component/modal')
    @slot('modal_id', 'add_detail')
    @slot('modal_title', 'Add Detail Pertemuan')
    @slot('modal_body')
    <form id="form_add_detail">
        @csrf
        <div class="card-body">
            <div class="alert alert-danger" id="add_detail_error_bag">
                <ul class="mb-0" id="add_detail_error">
                </ul>
            </div>
            <div class="form-validation">

                <input type="hidden" name="id_pertemuan" value="{{ $id_pertemuan->id }}">

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Kegiatan</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="kegiatan" placeholder="Nama Kegiatan...">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Mulai</label>
                    <div class="col-lg-6">
                        <input type="time" class="form-control" name="mulai" placeholder="Mulai Jam..." >
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Selesai</label>
                    <div class="col-lg-6">
                        <input type="time" class="form-control" name="selesai" placeholder="Selesai Jam...">
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endslot
    @slot('modal_footer')
    <button onclick="add_detail()" class="btn btn-primary">Add</button>
    @endslot
@endcomponent

{{-- Modal Edit Detail --}}
@component('component/modal')
    @slot('modal_id', 'edit_detail')
    @slot('modal_title', 'Edit Detail Pertemuan')
    @slot('modal_body')
    <form id="form_edit_detail">
        @csrf
        <div class="card-body">
            <div class="alert alert-danger" id="edit_detail_error_bag">
                <ul class="mb-0" id="edit_detail_error">
                </ul>
            </div>
            <div class="form-validation">

                <input type="hidden" name="id_pertemuan" value="{{ $id_pertemuan->id }}">

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Kegiatan</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="kegiatan" placeholder="Nama Kegiatan...">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Mulai</label>
                    <div class="col-lg-6">
                        <input type="time" class="form-control" name="mulai" placeholder="Mulai Jam...">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Selesai</label>
                    <div class="col-lg-6">
                        <input type="time" class="form-control" name="selesai" placeholder="Selesai Jam...">
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endslot
    @slot('modal_footer')
    <button class="btn btn-primary submit">Update</button>
    @endslot
@endcomponent

{{-- Modal Add Kegiatan --}}
@component('component/modal')
    @slot('modal_id', 'add_kegiatan')
    @slot('modal_title', 'Add Detail Kegiatan')
    @slot('modal_body')
    <form id="form_add_kegiatan">
        @csrf
        <div class="card-body">
            <div class="alert alert-danger" id="add_kegiatan_error_bag">
                <ul class="mb-0" id="add_kegiatan_error">
                </ul>
            </div>
            <div class="form-validation">

                <input type="hidden" name="id_detail" value="">

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Deskripsi Kegiatan</label>
                    <div class="col-lg-6">
                        <textarea class="form-control h-150px teks" rows="6"></textarea>
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endslot
    @slot('modal_footer')
    <button onclick="add_kegiatan()" class="btn btn-primary">Add</button>
    @endslot
@endcomponent

{{-- Modal Edit Kegiatan --}}
@component('component/modal')
    @slot('modal_id', 'edit_kegiatan')
    @slot('modal_title', 'Edit Detail Kegiatan')
    @slot('modal_body')
    <form id="form_edit_kegiatan">
        @csrf
        <div class="card-body">
            <div class="alert alert-danger" id="edit_kegiatan_error_bag">
                <ul class="mb-0" id="edit_kegiatan_error">
                </ul>
            </div>
            <div class="form-validation">


                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Deskripsi Kegiatan</label>
                    <div class="col-lg-6">
                        <textarea class="form-control h-150px teks" rows="6"></textarea>
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endslot
    @slot('modal_footer')
    <button class="btn btn-primary submit">Update</button>
    @endslot
@endcomponent

{{-- Modal Add Video --}}
@component('component/modal')
    @slot('modal_id', 'add_video')
    @slot('modal_title', 'Add Video')
    @slot('modal_body')
    <form id="form_add_video">
        @csrf
        <div class="card-body">
            <div class="alert alert-danger" id="add_video_error_bag">
                <ul class="mb-0" id="add_video_error">
                </ul>
            </div>
            <div class="form-validation">

                <input type="hidden" name="id_pertemuan" value="{{ $id_pertemuan->id }}">

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Nama Video</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="nama" placeholder="Nama Deskripsi...">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Link</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="path" placeholder="Link URL Video">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Deskripsi</label>
                    <div class="col-lg-6">
                        <textarea class="form-control h-150px deskripsi" rows="3"></textarea>
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endslot
    @slot('modal_footer')
    <button onclick="add_video()" class="btn btn-primary">Add</button>
    @endslot
@endcomponent

{{-- Modal Edit Video --}}
@component('component/modal')
    @slot('modal_id', 'edit_video')
    @slot('modal_title', 'Edit Video')
    @slot('modal_body')
    <form id="form_edit_video">
        @csrf
        <div class="card-body">
            <div class="alert alert-danger" id="edit_video_error_bag">
                <ul class="mb-0" id="edit_video_error">
                </ul>
            </div>
            <div class="form-validation">

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Nama Video</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="nama" placeholder="Nama Deskripsi...">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Link</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="path" placeholder="Link url....">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Deskripsi</label>
                    <div class="col-lg-6">
                        <textarea class="form-control h-150px deskripsi" rows="3"></textarea>
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endslot
    @slot('modal_footer')
    <button class="btn btn-primary submit">Update</button>
    @endslot
@endcomponent

{{-- Modal Add Kuis --}}
@component('component/modal')
    @slot('modal_id', 'add_kuis')
    @slot('modal_title', 'Add Kuis')
    @slot('modal_body')
    <form id="form_add_kuis">
        @csrf
        <div class="card-body">
            <div class="alert alert-danger" id="add_kuis_error_bag">
                <ul class="mb-0" id="add_kuis_error">
                </ul>
            </div>
            <div class="form-validation">

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Nama Kuis</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="nama" placeholder="Nama Kuis...">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Waktu Pengerjaan</label>
                    <div class="col-lg-6">
                        <input type="number" class="form-control" name="waktu" placeholder="Waktu dalam menit...">
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endslot
    @slot('modal_footer')
    <button onclick="add_kuis({{ $id_pertemuan->id }})" class="btn btn-primary">Add</button>
    @endslot
@endcomponent

{{-- Modal Edit Kuis --}}
@component('component/modal')
    @slot('modal_id', 'edit_kuis')
    @slot('modal_title', 'Edit Kuis')
    @slot('modal_body')
    <form id="form_edit_kuis">
        @csrf
        <div class="card-body">
            <div class="alert alert-danger" id="edit_kuis_error_bag">
                <ul class="mb-0" id="edit_kuis_error">
                </ul>
            </div>
            <div class="form-validation">

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Nama Kuis</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="nama" placeholder="Nama Kuis...">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Waktu Pengerjaan</label>
                    <div class="col-lg-6">
                        <input type="number" class="form-control" name="waktu" placeholder="Waktu dalam menit...">
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endslot
    @slot('modal_footer')
    <button class="btn btn-primary submit">Update</button>
    @endslot
@endcomponent

{{-- Modal Add Soal --}}
@component('component/modal')
    @slot('modal_id', 'add_soal')
    @slot('modal_title', 'Add Soal')
    @slot('modal_body')
    <form id="form_add_soal">
        @csrf
        <div class="card-body">
            <div class="alert alert-danger" id="add_soal_error_bag">
                <ul class="mb-0" id="add_soal_error">
                </ul>
            </div>
            <div class="form-validation">

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Pertanyaan</label>
                    <div class="col-lg-6">
                        <textarea class="form-control h-150px pertanyaan" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">A</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="A" placeholder="Pilihan A">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">B</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="B" placeholder="Pilihan B">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">C</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="C" placeholder="Pilihan C">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">D</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="D" placeholder="Pilihan D">
                    </div>
                </div>
                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">E</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="E" placeholder="Pilihan E">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Jawaban</label>
                    <div class="col-lg-6">
                        <select class="form-control select">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endslot
    @slot('modal_footer')
    <button onclick="add_soal({{ $kuis->id ?? '' }})" class="btn btn-primary">Add</button>
    @endslot
@endcomponent

{{-- Modal Edit Soal --}}
@component('component/modal')
    @slot('modal_id', 'edit_soal')
    @slot('modal_title', 'Edit Soal')
    @slot('modal_body')
    <form id="form_edit_soal">
        @csrf
        <div class="card-body">
            <div class="alert alert-danger" id="edit_soal_error_bag">
                <ul class="mb-0" id="edit_soal_error">
                </ul>
            </div>
            <div class="form-validation">

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Pertanyaan</label>
                    <div class="col-lg-6">
                        <textarea class="form-control h-150px pertanyaan" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">A</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="A" placeholder="Pilihan A">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">B</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="B" placeholder="Pilihan B">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">C</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="C" placeholder="Pilihan C">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">D</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="D" placeholder="Pilihan D">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">E</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="E" placeholder="Pilihan E">
                    </div>
                </div>

                <div class="form-group row is-invalid">
                    <label class="col-lg-4 col-form-label">Jawaban</label>
                    <div class="col-lg-6">
                        <select class="form-control select">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </form>
    @endslot
    @slot('modal_footer')
    <button class="btn btn-primary submit">Update</button>
    @endslot
@endcomponent

@endsection



@section('add_script')
<script src="{{ URL::asset('quixlab/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('quixlab/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/admin_pertemuan.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=default'></script>
@endsection
