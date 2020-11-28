@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Pertemuan')

@section('add_style')
<link href="{{ URL::asset('quixlab/css/style_pertemuan.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/getar.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content-body">

    <div class="container-fluid" style="margin-top:30px;">

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
        <div class="alert alert-warning alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button> {{ session('status') }}
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ ucwords($id_pertemuan->nama) }} ({{ date('d M Y', strtotime($id_pertemuan->tanggal)) }})</h4>
                        <p> Materi: {{ ucwords($id_pertemuan->judul) }} </p>
                    </div>
                    <div class="card-body">

                        <div class="row justify-content-start">
                            <div class="col-lg-3 bre">
                                <button onclick="window.location.href='{{ url('/pertemuan/'.$id_pertemuan->id.'/materi/') }}'" type="button" class="btn mb-1 btn-info">
                                    Materi
                                    <span class="btn-icon-right">
                                        <i class="fa fa-book text-white"></i>
                                    </span>
                                </button>
                            </div>

                            @if(count($latihan))
                            <div class="col offset-lg-2">
                                <a href="#" onclick="OpenAndRefresh('{{ url('/latihan/'.$id_pertemuan->id) }}')" class="btn float-right mb-1 btn-dark">
                                    Latihan Soal
                                    <span class="btn-icon-right">
                                        <i class="fa fa-pencil-square-o text-white"></i>
                                    </span>
                                </a>
                            </div>
                            @endif

                            @isset($kuis)
                            <div class="@if(count($latihan)) col-lg-4 @else col @endif">
                                @if ($exist)
                                <a href="#" class="btn float-right mb-1 btn-success text-white disabled">
                                    Kuis telah diikuti
                                    <span class="btn-icon-right">
                                        <i class="fa fa-check text-white"></i>
                                    </span>
                                </a>
                                @else
                                <a href="#" onclick="OpenAndRefresh('{{ url('/kuis/'.$id_pertemuan->id) }}')" class="btn float-right mb-1 text-white @if($kuis->aktif) btn-warning @else btn-danger disabled @endif">
                                    @if ($kuis->aktif)
                                    {{ ucwords($kuis->nama) }}
                                    @else
                                    Kuis tidak aktif
                                    @endif
                                    <span class="btn-icon-right">
                                        <i class="fa @if($kuis->aktif) fa-pencil-square-o @else fa-times @endif text-white"></i>
                                    </span>
                                </a>
                                @endif
                            </div>
                            @endisset

                        </div>

                        <hr>
                        <div id="accordion-three" class="accordion">
                            <div class="card mb-3">
                                <div class="card-header" style="background-color:#4298C3;">
                                    <h5 class="mb-0" style="color:white;">
                                        <i class="fa" aria-hidden="true"></i>
                                        Kompetensi Dasar dan Tujuan Pembelajaran
                                    </h5>
                                </div>

                                <div id="collapseOne4" class="collapse show">
                                    <div class="card-body">
                                        <b> Kompetensi Dasar: </b>
                                        <p>{{ $id_pertemuan->kompetensi}}</p>
                                        <b> Tujuan: </b>
                                        <p>{{ $id_pertemuan->tujuan }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" style="background-color:#4298C3;">
                                    <h5 class="mb-0" style="color:white;">
                                        <i class="fa" aria-hidden="true"></i>
                                        Langkah-Langkah Pembelajaran
                                    </h5>
                                </div>

                                <div id="collapseOne4" class="collapse show">
                                    <ul class="timeline">
                                        @foreach ($detail as $d)
                                        <li class="event" data-date="{{ date('h:i', strtotime($d->mulai)) }} - {{ date('h:i a', strtotime($d->selesai)) }}">
                                            <div class="member-infos">
                                                @php
                                                $diff_hour = (date('h', strtotime($d->selesai)) - date('h', strtotime($d->mulai))) * 60;
                                                $diff_minute = (date('i', strtotime($d->selesai)) - date('i', strtotime($d->mulai)));
                                                $diff = $diff_hour + $diff_minute;
                                                @endphp
                                                {{-- <h1 class='member-title mb-2'>{{ $d->kegiatan }} ({{ $diff }} menit)</h1> --}}
                                                <h1 class='member-title mb-2'>{{ $d->kegiatan }}</h1>
                                                <div class="member-location">
                                                    @foreach ($d->deskripsi as $ddes)
                                                    <p>
                                                        <i class="ti-angle-right"></i>
                                                        {{ $ddes->teks }}
                                                    </p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @isset($presensi)
        <div class="card">
            <div class="social-graph-wrapper widget-linkedin">
                <span class="s-icon text-white">Upload Tugas</span>
            </div>
            <div class="row">
                <div class="col-6 border-right">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        <a href="{{ url('storage/'. $presensi->tugas) }}" target="_blank" class="btn btn-info mt-2 ml-2">Lihat File</a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                        @if ($presensi->tugas)
                        <i class="fa fa-check-circle fa-4x text-success"></i>
                        @else
                        <i class="fa fa-times-circle fa-4x text-danger"></i>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="col-12 border-top">
                    <div class="m-auto text-center text-gray">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h4 class="mt-1">Change / Upload File</h4>
                                <form class="form-control" action="{{ url('/pertemuan/tugas/'.$presensi->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="tugas">
                                    <br>
                                    <button type="submit" class="btn btn-info btn-sm float-right mt-4">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endisset

    </div>

</div>

@endsection

@section('add_script')
<script>
    $('.member-title').click(function(e) {
        console.log("Clicked");
        $(this).next().slideToggle();
        $(this).next().next().next().slideToggle();
    })

    function OpenAndRefresh(url){
        window.open(url);
        location.reload();
    }
</script>
@endsection
