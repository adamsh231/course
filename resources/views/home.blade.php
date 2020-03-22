@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Home')

@section('content')

<div class="content-body">

    <div class="container-fluid">

        <div id="accordion-one" class="accordion">

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa" aria-hidden="true"></i> Petunjuk Penggunaan</h5>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion-one">
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

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa" aria-hidden="true"></i> Agenda Pembelajaran</h5>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordion-one" style="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 m-b-30">
                                <div class="row">
                                    @foreach ($pertemuan as $p)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card">
                                            <div class="card-header bg-white">
                                                <h5 class="card-title">{{ $p->nama }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">{{ date('d M Y', strtotime($p->tanggal)) }}</h6>
                                            </div>
                                            <img class="img-fluid" src="https://robohash.org/{{ $p->id }}" alt="">
                                            <div class="card-body">
                                                <h5>Kompetensi Dasar: </h5>
                                                <p class="card-text" style="text-align:justify;">
                                                    {{ substr($p->kompetensi,0,100) }}...
                                                </p>
                                                <h5>Tujuan: </h5>
                                                <p class="card-text" style="text-align:justify;">
                                                    {{ substr($p->tujuan,0,100) }}...
                                                </p>
                                            </div>
                                            <div class="card-footer">
                                                <a href="{{ url('/pertemuan/'.$p->id) }}">
                                                    <p class="card-text d-inline">
                                                        <small>{{ $p->judul }}</small>
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
