@extends('layout/quixlab_auth')
@section('title', 'Pertemuan')

@section('content')
<link href="{{ URL::asset('quixlab/css/style_pertemuan.css') }}" rel="stylesheet">

<div class="content-body">
    <div id="content">
        <ul class="timeline">
            <li class="event" data-date="12:30 - 1:00pm">
                <div class="member-infos">
                    <h1 class='member-title'>Kegiatan Awal (30 Menit)</h1>
                    <h2 class="member-location ">
                        <br>
                        <li>
                            <i class="ti-angle-right"></i>
                            Siswa melakukan PRETES selama 20 menit. Klik tombol kuis untuk melakukan pretes.
                        </li>
                        <br>
                        <li>
                            <i class="ti-angle-right"></i>
                            Siswa diberikan gambaran awal mengenai volume kubus dan balok. Klik tombol materi untuk melihat materi ilustrasi.
                        </li>
                    </h2>
                    <ul class="member-contact">
                        <a href="#"><i class="ti-pencil-alt" style="margin-right:8px;"></i></a>
                        <a href="#"><i class="ti-book"></i></a>
                    </ul>
                    <div class="member-parameters">
                        <span class="follow entypo-plus"></span>
                        <span class="options entypo-cog"></span>
                    </div>
                </div>
            </li>
            <li class="event" data-date="1:00 - 2:20pm">
                <div class="member-infos">
                    <h1 class='member-title'>Kegiatan Inti (80 Menit)</h1>
                    <h2 class="member-location ">
                        <br>
                        <li><i class="ti-angle-right"></i>
                            Siswa berkumpul dengan anggota kelompok, untuk melihat anggota kelompol klik tombol acak kelompok yang berada di
                            sebelah kanan tulisan kegiatan inti.
                        </li>
                        <br>
                        <li><i class="ti-angle-right"></i>
                            Siswa membaca dan memahami ilustrasi dari volume kubus dan balok. Kemudian, siswa mendiskusikan masalah terkait
                            volume bangun tersebut dengan mencari informasi dari berbagai sumber yang sudah ada pada website (materi + video)
                            ataupun sumber lainnya. Klik tombol materi yang berada di sebelah kanan tulisan kegiatan inti.
                        </li>
                        <br>
                        <li><i class="ti-angle-right"></i>
                            Siswa mempresentasikan hasil diskusi dan melakukan tanya jawab mengenai materi yang belum dipahami.
                        </li>
                    </h2>
                    <ul class="member-contact">
                        <a href="#"><i class="ti-reload" style="margin-right:8px;"></i></a>
                        <a href="#"><i class="ti-book"></i></a>
                    </ul>
                    <div class="member-parameters">
                        <a href="" class="follow entypo-plus"></a>
                        <a href="" class="options entypo-cog"></a>
                    </div>
                </div>
            </li>
            <li class="event" data-date="02:20 - 02:30pm">
                <div class="member-infos">
                    <h1 class='member-title'>Kegiatan Akhir (10 Menit)</h1>
                    <h2 class="member-location ">
                        <br>
                        <li><i class="ti-angle-right"></i>
                            Siswa bersama-sama dengan guru membuat kesimpulan materi pelajaran hari ini.
                        </li>
                        <br>
                        <li><i class="ti-angle-right"></i>
                            Guru memberikan tugas untuk pertemuan hari ini. Klik tombol materi yang berada di sebelah kanan tulisan kegiatan akhir untuk melihat tugas.
                        </li>
                    </h2>
                    <ul class="member-contact">
                        <a href="#"><i class="ti-book"></i></a>
                    </ul>
                    <div class="member-parameters">
                        <span class="follow entypo-plus"></span>
                        <span class="options entypo-cog"></span>
                    </div>
                </div>
            </li>
        </ul>
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
