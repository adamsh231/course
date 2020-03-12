@extends('layout/quixlab_auth')
@section('title', 'Pertemuan')

@section('content')
<link href="{{ URL::asset('quixlab/css/style_pertemuan.css') }}" rel="stylesheet">

<div class="content-body">
    <div id="content">
        <div class="card mx-4">
            <div class="card-header">
                <h1>Daftar Kegiatan</h1>
            </div>
            <ul class="timeline">
                <li class="event" data-date="12:30 - 1:00pm">
                    <div class="member-infos">
                        <h1 class='member-title mb-2'>Kegiatan Awal (30 Menit)</h1>
                        <div class="member-location">
                            <p>
                                <i class="ti-angle-right"></i>
                                Siswa melakukan PRETES selama 20 menit. Klik tombol kuis untuk melakukan pretes.
                            </p>

                            <p>
                                <i class="ti-angle-right"></i>
                                Siswa diberikan gambaran awal mengenai volume kubus dan balok. Klik tombol materi untuk melihat materi ilustrasi.
                            </p>
                        </div>
                        <div class="member-contact">
                            <a href="#">
                                <i class="ti-pencil-alt" style="margin-right:8px;"></i>
                            </a>
                            <a href="#">
                                <i class="ti-trash"></i>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="event" data-date="12:30 - 1:00pm">
                    <div class="member-infos">
                        <h1 class='member-title mb-2'>Kegiatan Awal (30 Menit)</h1>
                        <div class="member-location">
                            <p>
                                <i class="ti-angle-right"></i>
                                Siswa melakukan PRETES selama 20 menit. Klik tombol kuis untuk melakukan pretes.
                            </p>

                            <p>
                                <i class="ti-angle-right"></i>
                                Siswa diberikan gambaran awal mengenai volume kubus dan balok. Klik tombol materi untuk melihat materi ilustrasi.
                            </p>
                        </div>
                        <div class="member-contact">
                            <a href="#">
                                <i class="ti-pencil-alt" style="margin-right:8px;"></i>
                            </a>
                            <a href="#">
                                <i class="ti-trash"></i>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
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
