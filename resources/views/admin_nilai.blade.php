@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Admin Daftar Nilai')

@section('add_style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ URL::asset('quixlab/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ asset('quixlab/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <div class="form-row">
                    <div class="form-group col-md-2 ml-4">
                        <select onChange="window.location.href=this.value" class="form-control">
                            <option value="{{ url('/admin/nilai/') }}" {{ ($current == 0 ? 'selected' : '') }}>Semua Nilai</option>
                            @foreach ($kuis as $k)
                            <option value="{{ url('/admin/nilai/'.$k->id) }}" {{ ($current == $k->id ? 'selected' : '') }}>{{ $k->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="nilai_table" class="table table-bordered table-striped verticle-middle table-md">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kuis</th>
                                <th scope="col">Nilai</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai as $n)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $n->siswa->name }}</td>
                                <td class="text-center">{{ $n->kuis->nama }}</td>
                                <td class="text-center">{{ $n->nilai }}</td>
                                <td class="text-center">
                                    <span>
                                        <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                                            <a onclick="fill_edit_nilai({{ $n->id }}, '{{ $n->siswa->name }}', '{{ $n->kuis->nama }}', {{ $n->nilai }})" href="#" data-target="#edit_nilai" data-toggle="modal">
                                                <i class="fa fa-pencil color-muted m-r-5"></i>
                                            </a>
                                        </span>
                                        <a onclick="confirm_delete_nilai({{ $n->id }}, '{{ $n->siswa->name }}', '{{ $n->kuis->nama }}')" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Data">
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
        </div>
    </div>
</div>

{{-- Modal Edit Nilai --}}
@component('component/modal')
@slot('modal_id', 'edit_nilai')
@slot('modal_title', 'Edit Nilai')
@slot('modal_body')
<form id="form_edit_nilai">
    @csrf
    <div class="card-body">
        <div class="alert alert-danger" id="edit_nilai_error_bag">
            <ul class="mb-0" id="edit_nilai_error">
            </ul>
        </div>
        <div class="form-validation">

            <div class="form-group row is-invalid">
                <label class="col-lg-4 col-form-label">Nama Siswa</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="nama" readonly>
                </div>
            </div>

            <div class="form-group row is-invalid">
                <label class="col-lg-4 col-form-label">Nama Kuis</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="kuis" readonly>
                </div>
            </div>

            <div class="form-group row is-invalid">
                <label class="col-lg-4 col-form-label">Nilai</label>
                <div class="col-lg-6">
                    <input type="number" class="form-control" name="nilai">
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
<script src="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('quixlab/plugins/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('js/admin_nilai.js') }}"></script>
@endsection
