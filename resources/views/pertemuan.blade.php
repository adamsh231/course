@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Pertemuan')

@section('add_style')
<link href="{{ URL::asset('quixlab/css/style_pertemuan.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/getar.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content-body">

    <div class="container-fluid" style="margin-top:30px;">

        @if (session('status'))
        <div class="alert alert-danger alert-dismissible fade show">
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

                        <button onclick="window.location.href='{{ url('/pertemuan/'.$id_pertemuan->id.'/materi/') }}'" type="button" class="btn mb-1 btn-info">
                            Materi
                            <span class="btn-icon-right">
                                <i class="fa fa-book text-white"></i>
                            </span>
                        </button>
                        @isset($kuis)
                        <a href="{{ url('/kuis/'.$id_pertemuan->id) }}" onclick="javascript:window.open('','_self').close();" target="_blank" class="btn mb-1 btn-warning float-right text-white @if(!$kuis->aktif) disabled @endif">
                            {{ ucwords($kuis->nama) }}
                            <span class="btn-icon-right">
                                <i class="fa fa-pencil-square-o text-white"></i>
                            </span>
                        </a>
                        @endisset
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
</script>
@endsection
