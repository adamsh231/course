@extends('layout/quixlab_auth')
@section('title', 'Pertemuan')

@section('content')
<link href="{{ URL::asset('quixlab/css/style_pertemuan.css') }}" rel="stylesheet">

<div class="content-body">

    <div class="container-fluid" style="margin-top:30px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pertemuan 1</h4>
                        <p> Materi: Volume Kubus dan Balok </p>
                        <p class="text-muted"><code></code> </p>
                        <div id="accordion-three" class="accordion">
                            <div class="card">
                                <div class="card-header" style="background-color:#4298C3;">
                                    <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4" style="color:white;">
                                        <i class="fa" aria-hidden="true"></i>
                                        Kompetensi Dasar dan Tujuan Pembelajaran
                                    </h5>
                                </div>

                                <div id="collapseOne4" class="collapse show" data-parent="#accordion-three">
                                    <div class="card-body">
                                        <b> Kompetensi Dasar: </b> <br>
                                        3.9 Membedakan dan menentukan luas
                                        permukaan dan volume bangun ruang sisi datar (kubus, balok, prima, dan limas). <br><br>
                                        <b> Tujuan Pembelajaran: </b> <br>
                                        Setalah mengikuti proses pembelajaran diharapkan siswa dapat menentukan volume kubus
                                        dan balok.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" style="background-color:#4298C3;">
                                    <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo5" aria-expanded="false" aria-controls="collapseTwo5" style="color:white;"><i class="fa" aria-hidden="true"></i> Langkah-Langkah Pembelajaran</h5>
                                </div>
                                <div id="collapseTwo5" class="collapse" data-parent="#accordion-three">
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

                            <div class="card">
                                <div class="card-header" style="background-color:#4298C3;">
                                    <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseThree6" aria-expanded="false" aria-controls="collapseThree6" style="color:white;"><i class="fa" aria-hidden="true"></i> Sumber Belajar</h5>
                                </div>
                                <div id="collapseThree6" class="collapse" data-parent="#accordion-three">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-pill badge-info" style="border-radius:100%; width:20px; height:20px; margin-bottom:3px;">1. </span>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <p style="margin-left:8px; margin-top: 14px;"> Soal Kuis </p>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-pill badge-info" style="border-radius:100%;  width:20px; height:20px; margin-bottom:3px;">2. </span>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <p style="margin-left:8px; margin-top: 14px;"> Materi Volume Kubus dan Balok </p>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-pill badge-info" style="border-radius:100%;  width:20px; height:20px; margin-bottom:3px;">3. </span>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <p style="margin-left:8px; margin-top: 14px;"> Materi Diskusi </p>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-pill badge-info" style="border-radius:100%;  width:20px; height:20px; margin-bottom:3px;">4. </span>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <p style="margin-left:8px; margin-top: 14px;"> Video 1 (Cara Menentukan Rumus Volume Kubus) </p>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-pill badge-info" style="border-radius:100%;  width:20px; height:20px; margin-bottom:3px;">5. </span>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <p style="margin-left:8px; margin-top: 14px;"> Video 2 (Cara Menentukan Rumus Volume Balok) </p>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-pill badge-info" style="border-radius:100%;  width:20px; height:20px; margin-bottom:3px;">6. </span>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <p style="margin-left:8px; margin-top: 14px;"> Tugas </p>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="badge badge-pill badge-info" style="border-radius:100%;  width:20px; height:20px; margin-bottom:3px;">7. </span>
                                                </td>
                                                <td>
                                                    <a href="#">
                                                        <p style="margin-left:8px; margin-top: 14px;"> Hasil Diskusi </p>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
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
