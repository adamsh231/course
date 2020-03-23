@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Admin Daftar Nilai')

@section('add_style')
{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
<link href="{{ URL::asset('quixlab/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ asset('quixlab/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content-body">

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

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
                                            <a onclick="maintenance()" href="#" data-target="#edit_siswa" data-toggle="modal">
                                                <i class="fa fa-pencil color-muted m-r-5"></i>
                                            </a>
                                        </span>
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
@endsection

@section('add_script')
<script src="{{ URL::asset('quixlab/plugins/tables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('quixlab/plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('quixlab/plugins/toastr/js/toastr.min.js') }}"></script>
<script>
    $('#nilai_table').DataTable({
        pageLength: 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
    });
</script>
@endsection
