@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Admin')

@section('add_style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ URL::asset('quixlab/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content-body">

    <div class="container-fluid">

        <div id="status" class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
        </div>

        {{-- CARD1 --}}
        <div class="card">
            <div class="card-body">
                <div class="default-tab">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#siswa">Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active show" data-toggle="tab" href="#pertemuan">Pertemuan</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade" id="siswa" role="tabpanel">
                            <button type="button" class="btn mb-1 btn-outline-success float-right" data-toggle="modal" data-target="#add_siswa">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
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
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Change Password">
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

                        {{-- Modal Add Siswa --}}
                        <div class="bootstrap-modal">
                            <div id="add_siswa" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Siswa</h5>
                                            <button id="btn_close_modal_add" type="button" class="close" data-dismiss="modal"><span>×</span>
                                            </button>
                                        </div>
                                        <form id="form_add">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="alert alert-danger" id="add-error-bag">
                                                        <ul class="mb-0" id="add-task-errors">
                                                        </ul>
                                                    </div>
                                                    <div class="form-validation">

                                                        <div class="form-group row is-invalid">
                                                            <label class="col-lg-4 col-form-label">Nama</label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" name="name" placeholder="Enter your name...">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row is-invalid">
                                                            <label class="col-lg-4 col-form-label">Username</label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" name="username" placeholder="Enter username...">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row is-invalid">
                                                            <label class="col-lg-4 col-form-label">Password</label>
                                                            <div class="col-lg-6">
                                                                <input type="password" class="form-control" name="password" placeholder="Enter Password...">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row is-invalid">
                                                            <label class="col-lg-4 col-form-label">Email</label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" name="email" placeholder="Enter Email...">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row is-invalid">
                                                            <label class="col-lg-4 col-form-label">Phone</label>
                                                            <div class="col-lg-6">
                                                                <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number...">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="modal-footer">
                                            <button onclick="add()" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade active show" id="pertemuan" role="tabpanel">
                            <button onclick="maintenance()" type="button" class="btn mb-1 btn-outline-success float-right">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
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
                                            <th scope="col">Materi</th>
                                            <th scope="col">Kompetensi</th>
                                            <th scope="col">Tujuan</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pertemuan as $p)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td><a href="{{ url('/admin/pertemuan/'.$p->id) }}">{{ $p->nama }}</a></td>
                                            <td class="text-justify">{{ $p->judul }}</td>
                                            <td class="text-center">{{ date('d/m/Y', strtotime($p->tanggal)) }}</td>
                                            <td class="text-center">
                                                <span>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Open File">
                                                        <i class="fa fa-eye color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Open File">
                                                        <i class="fa fa-eye color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span>
                                                    <a onclick="maintenance()" href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Open File">
                                                        <i class="fa fa-eye color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                            <td class="text-justify">{{ $p->tujuan }}</td>
                                            <td class="text-justify">{{ $p->kompetensi }}</td>
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

                    </div>
                </div>
            </div>
        </div>
        {{-- END CARD1 --}}

    </div>
</div>
@endsection

@section('add_script')
<script src="{{ URL::asset('quixlab/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('quixlab/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('quixlab/plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#add-error-bag').hide();
        $('#status').hide();
        $('#siswa_table').DataTable({
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });
    });
</script>
<script>
    function add(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/admin/add/siswa',
            data: {
                name: $("#form_add input[name=name]").val(),
                username: $("#form_add input[name=username]").val(),
                password: $("#form_add input[name=password]").val(),
                email: $("#form_add input[name=email]").val(),
                phone: $("#form_add input[name=phone]").val(),
            },
            dataType: 'json',
            success: function(data) {
                $('#btn_close_modal_add').click();
                $('#status').show();
                $('#status').append("Data Siswa Berhasil Diinputkan");
                setInterval(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                $('#add-task-errors').html('');
                $.each(errors.messages, function(key, value) {
                    $('#add-task-errors').append('<li>' + value + '</li>');
                });
                $("#add-error-bag").show();
            }
        });
    }
</script>
@endsection
