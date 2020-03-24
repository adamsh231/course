@extends('layout/quixlab_auth', ['pertemuan' => $pertemuan])
@section('title', 'Materi')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $id_pertemuan->nama }}</h4>
                    <p> Materi: {{ $id_pertemuan->nama }} ({{ date('d M Y', strtotime($id_pertemuan->tanggal)) }}) </p>
                    @isset($kuis)
                    <div class="float-right text-white">
                        <a href="{{ url('storage/'.$kuis->jawaban) }}" target="_blank" class="btn mb-1 btn-primary">
                            Kunci Jawaban
                            <span class="btn-icon-right">
                                <i class="fa fa-download"></i>
                            </span>
                        </a>
                    </div>
                    @endisset
                    <br>
                    <div class="basic-list-group mt-5">
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start list-group-item-secondary">
                                <div class="d-flex w-100 justify-content-between mt-2">
                                    <a href="{{ url('storage/'.$id_pertemuan->materi) }}" target="_blank">
                                        <h5 class="mb-3"><i class="fa fa-file-pdf-o mr-2"></i>Baca dan Download Materi</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between mt-2">
                                    <a href="{{ url('storage/'.$id_pertemuan->diskusi) }}" target="_blank">
                                        <h5 class="mb-3"><i class="fa fa-file-powerpoint-o mr-2"></i>Diskusi </h5>
                                    </a>
                                </div>
                                <ul class="list-icons">
                                    <p><b>Note:</b> Setelah proses pembelajaran selesai guru akan mengupload hasil diskusi terbaik siswa untuk dipelajari kembali oleh siswa </p>
                                </ul>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start list-group-item-secondary">
                                <div class="d-flex w-100 justify-content-between mt-2">
                                    <a href="{{ url('storage/'.$id_pertemuan->tugas) }}" target="_blank">
                                        <h5 class="mb-3"><i class="fa fa-file-pdf-o mr-2"></i>Baca dan Download Tugas</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between mt-2">
                                    <h5 class="mb-3"><i class="fa fa-youtube mr-2"></i>Video</h5>
                                </div>
                                <ul class="list-icons">
                                    @foreach ($video as $v)
                                    <li>
                                        <a href="#" onclick="youtube('{{ $v->path }}')" data-target="#modal_youtube" data-toggle="modal">
                                            <i class="fa fa-chevron-right"></i>
                                            {{ $v->nama }}: {{ $v->deskripsi }}
                                        </a>
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modal_youtube">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

@endsection

@section('add_script')
<script>
$("#modal_youtube").on('hidden.bs.modal', function (e) {
    $("#modal_youtube iframe").attr("src", $("#modal_youtube iframe").attr("src"));
});
function youtube(path){
    $('#modal_youtube iframe').attr('src', path);
}
</script>
@endsection
