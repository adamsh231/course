@extends('layout/quixlab_auth')
@section('title', 'Home')

@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 m-b-30">
                <h4 class="card-title">Agenda Pembelajaran</h4>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="card-title">Pertemuan 1</h5>
                                <h6 class="card-subtitle mb-2 text-muted">29 Februari 2020</h6>
                            </div>
                            <img class="img-fluid" src="{{ URL::asset('assets/1.png') }}" alt="">
                            <div class="card-body">
                                <h5>Kompetensi Dasar dan Tujuan Pembelajaran: </h5>
                                <p class="card-text" style="text-align:justify;">Membedakan dan menentukan luas
                                    permukaan dan volume bangun ruang sisi datar (kubus, balok, prima, dan
                                    limas). Setalah
                                    mengikuti proses pembelajaran diharapkan siswa dapat menentukan volume kubus
                                    dan balok.
                                    <br>
                                    <br>
                                    <b>Note:</b> Siswa diharapkan membawa laptop pada saat pembelajaran di kelas
                                    dan sebelum pembelajaran di kelas diharapkan siswa sudah membaca bahan ajar
                                    pada menu materi .</p>
                                <br>
                            </div>
                            <div class="card-footer">
                                <a href="#">
                                    <p class="card-text d-inline"><small>Volume Kubus dan Balok</small>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Col -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="card-title">Pertemuan 2</h5>
                                <h6 class="card-subtitle mb-2 text-muted">2 Maret 2020</h6>
                            </div>
                            <img class="img-fluid" src="{{ URL::asset('assets/3.png') }}" alt="">
                            <div class="card-body">
                                <h5>Kompetensi Dasar dan Tujuan Pembelajaran: </h5>
                                <p class="card-text" style="text-align:justify;">
                                    Membedakan dan menentukan luas permukaan dan volume bangun ruang sisi datar
                                    (kubus, balok, prima, dan limas). Setalah
                                    mengikuti proses pembelajaran diharapkan siswa dapat menentukan volume
                                    prisma dan limas.
                                    <br>
                                    <br>
                                    <b>Note:</b> Siswa diharapkan membawa laptop pada saat pembelajaran di kelas
                                    dan sebelum pembelajaran di kelas diharapkan siswa sudah membaca bahan ajar
                                    pada menu materi.
                                </p>
                                <br>
                            </div>
                            <div class="card-footer">
                                <a href="#">
                                    <p class="card-text d-inline"><small>Volume Prisma dan Limas</small>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Col -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="card-title">Pertemuan 3</h5>
                                <h6 class="card-subtitle mb-2 text-muted">3 Maret 2020</h6>
                            </div>
                            <img class="img-fluid" src="{{ URL::asset('assets/4.png') }}" alt="">
                            <div class="card-body" style="margin-bottom:37px;">
                                <h5> Kompetensi Dasar dan Tujuan Pembelajaran: </h5>
                                <p class="card-text" style="text-align:justify;">
                                    Menyelesaikan masalah yang berkaitan dengan luas permukaan dan volume bangun
                                    ruang sisi datar (kubus, balok, prisma, dan limas),
                                    serta gabungannya. Setalah mengikuti proses pembelajaran diharapkan siswa
                                    dapat menentukan volume bangun ruang sisi datar gabungan.
                                    <br>
                                    <b>Note:</b> Siswa diharapkan membawa laptop pada saat pembelajaran di kelas
                                    dan sebelum pembelajaran di kelas diharapkan siswa sudah membaca bahan ajar
                                    pada menu materi.
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="#">
                                    <p class="card-text d-inline"><small>Volume Bangun Ruang Sisi Datar Gabungan
                                        </small>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <h4 class="card-title">Petunjuk Penggunaan </h4>
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home"><span><i class="ti-home"></i></span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pembelajaran"><span><i class="ti-notepad"></i></span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sumber"><span><i class="ti-book"></i></span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#evaluasi"><span><i class="ti-pencil-alt"></i></span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#user"><span><i class="ti-user"></i></span></a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <div class="p-t-15">
                            <h4>Home</h4>
                            <p style="text-align:justify;">Pada menu ini siswa dapat melihat agenda pembelajaran untuk setiap pertemuannya, petunjuk penggunaan setiap menu.
                                Agenda tersebut terdiri dari kompetensi dasar, indikator pembelajaran dan tujuan pembelajaran yang harus dicapai oleh siswa,
                                serta catatan-catatan khusus yang diberikan oleh guru agar siswa mempersiapkan diri sebelum pembelajaran di kelas.
                                Petunjuk penggunaan menu berisi deskripsi kegunaan dari setiap menu yang ada pada website.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pembelajaran" role="tabpanel">
                        <div class="p-t-15">
                            <h4>Pembelajaran</h4>
                            <p style="text-align:justify;">
                                Pada menu ini siswa dapat melihat rincian kegiatan pada setiap pertemuannya, dari kegiatan aspersepsi, kegiatan duskusi, melihat hasil acak anggota kelompok, kuis, dan pemberian tugas.
                                Menu ini akan diupdate untuk setiap pertemuannya.
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sumber" role="tabpanel">
                        <div class="p-t-15">
                            <h4>Sumber Belajar</h4>
                            <p style="text-align:justify;">
                                Menu ini berisi materi, bahan diskusi, dan tugastugas untuk setiap pertemuannya, buku matematika kelas VIII, dan link video untuk menambah sumber belajar siswa.
                                Setelah proses pembelajaran di kelas, guru akan mengupload hasil diskusi salah satu kelompok untuk bisa dipelajari
                                kembali oleh siswa. </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="evaluasi" role="tabpanel">
                        <div class="p-t-15">
                            <h4>Kuis</h4>
                            <p style="text-align:justify;">Pada menu ini siswa dapat melakukan kuis (pretes dan postes) sesuai dengan jadwal yang sudah
                                diberikan oleh guru. Menu ini hanya bisa di buka pada saat kuis tersebut dilaksanakan di kelas. Jadwal
                                kuis sesuai kesepakatan yang sudah dilakukan bersama guru. Selesai mengerjakan kuis, siswa dapat melihat
                                hasil kuis tersebut serta mendownload kunci jawaban dan pembahasannya.
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="user" role="tabpanel">
                        <div class="p-t-15">
                            <h4>Profil</h4>
                            <p style="text-align:justify;">Pada menu ini siswa dapat mengedit profil yang sudah dibuat sebelumnya pada saat mengisi
                                form register, melihat nilai kuis (pretes dan postes), dan melihat absesnsi untuk setiap pertemuannya. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
