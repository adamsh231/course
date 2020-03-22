@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Detail File Pertemuan')

@section('content')
<div class="content-body">
    <div class="container-fluid">

        @if ($errors->any())
        @component('component/alert')
        @slot('alert_type', 'warning')
        @slot('alert_message')
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endslot
        @endcomponent
        @endif

        @if (session('status'))
        @component('component/alert')
        @slot('alert_type', 'warning')
        @slot('alert_message')
        {{ session('status') }}
        @endslot
        @endcomponent
        @endif

        {{-- CARD2 --}}
        <div id="pertemuan-detail" class="card">
            <div class="card-header">
                <button onclick="window.location.href = 'javascript:history.back()'" class="btn mb-1 btn-rounded btn-outline-primary btn-sm d-inline">
                    <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
                    <h3 class="d-inline">{{ $id_pertemuan->nama }} ({{ date('d/m/Y', strtotime($id_pertemuan->tanggal)) }})</h3>
                </button>
            </div>

            <div class="row ml-2 mr-2">

                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="social-graph-wrapper widget-linkedin">
                            <span class="s-icon">Materi</span>
                        </div>
                        <div class="row">
                            <div class="col-6 border-right">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <button class="btn btn-info mt-2 ml-2">Lihat File</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    @if ($id_pertemuan->materi)
                                    <i class="fa fa-check-circle fa-4x  text-success"></i>
                                    @else
                                    <i class="fa fa-times-circle fa-4x  text-danger"></i>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 border-top">
                                <div class="m-auto text-center text-gray">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <h4 class="mt-1">Change / Upload File</h4>
                                            <form class="form-control" action="{{ url('/admin/pertemuan/'.$id_pertemuan->id.'/file') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="materi">
                                                <button type="submit" class="btn btn-info btn-sm float-right mt-4">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="social-graph-wrapper widget-linkedin">
                            <span class="s-icon">Diskusi</span>
                        </div>
                        <div class="row">
                            <div class="col-6 border-right">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <button class="btn btn-info mt-2 ml-2">Lihat File</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    @if ($id_pertemuan->diskusi)
                                    <i class="fa fa-check-circle fa-4x  text-success"></i>
                                    @else
                                    <i class="fa fa-times-circle fa-4x  text-danger"></i>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 border-top">
                                <div class="m-auto text-center text-gray">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <h4 class="mt-1">Change / Upload File</h4>
                                            <form class="form-control" action="{{ url('/admin/pertemuan/'.$id_pertemuan->id.'/file') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="diskusi">
                                                <button type="submit" class="btn btn-info btn-sm float-right mt-4">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="social-graph-wrapper widget-linkedin">
                            <span class="s-icon">Tugas</span>
                        </div>
                        <div class="row">
                            <div class="col-6 border-right">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <button class="btn btn-info mt-2 ml-2">Lihat File</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    @if ($id_pertemuan->tugas)
                                    <i class="fa fa-check-circle fa-4x  text-success"></i>
                                    @else
                                    <i class="fa fa-times-circle fa-4x  text-danger"></i>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 border-top">
                                <div class="m-auto text-center text-gray">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <h4 class="mt-1">Change / Upload File</h4>
                                            <form class="form-control" action="{{ url('/admin/pertemuan/'.$id_pertemuan->id.'/file') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="tugas">
                                                <button type="submit" class="btn btn-info btn-sm float-right mt-4">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="social-graph-wrapper widget-linkedin">
                            <span class="s-icon">Jawaban</span>
                        </div>
                        <div class="row">
                            <div class="col-6 border-right">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    <button class="btn btn-info mt-2 ml-2">Lihat File</button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                    @if ($id_pertemuan->materi)
                                    <i class="fa fa-check-circle fa-4x  text-success"></i>
                                    @else
                                    <i class="fa fa-times-circle fa-4x  text-danger"></i>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 border-top">
                                <div class="m-auto text-center text-gray">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <h4 class="mt-1">Change / Upload File</h4>
                                            <form class="form-control" action="">
                                                <input type="file" name="materi">
                                                <button type="submit" class="btn btn-info btn-sm float-right mt-4">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>



        </div>
    </div>
</div>
@endsection

@section('add_script')

@endsection
