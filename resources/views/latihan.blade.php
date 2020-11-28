<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Latihan Soal</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/icon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ URL::asset('quixlab/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('quixlab/css/style_pertemuan.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('quixlab/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">

    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({ extensions: ["tex2jax.js"], jax: ["input/TeX", "output/HTML-CSS"], tex2jax: { inlineMath: [ ['$','$'], ["\\(","\\)"] ], displayMath: [ ['$$','$$'], ["\\[","\\]"] ], processEscapes: true }, "HTML-CSS": { availableFonts: ["TeX"] } });
    </script>

    <script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML"></script>
    <style>
        .centered {
            position: fixed;
            bottom: 2%;
            left: 50%;
            /* bring your own prefixes */
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body onload="hideKotak(1, {{ count($latihan) }})">

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">

        <div class="container" style="margin-top: 20px">
            <form id="form_latihan" action="" method="POST">

                @foreach($latihan as $l)
                <div id="kotak{{ $loop->iteration }}">
                    <center>
                        <table>
                            <tr>
                                <td>
                                    <div style="width:1000px;">
                                        <!-- row -->
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3 class="card-title"><b>Soal {{ $loop->iteration }} dari {{ count($latihan) }} </b></h3>
                                                            <p> {!! $l->pertanyaan !!} </p>
                                                            @if ($l->gambar)
                                                            <img class="ml-3 mb-3" src="{{ url('storage/'.$l->gambar) }}" width="300px" height="300px;">
                                                            @endif
                                                            <div class="form-group">
                                                                <div class="form-control input-default mb-2">
                                                                    <div class="radio my-1">
                                                                        <input onchange="showJawaban({{ $loop->iteration }})" id="soalA{{ $l->id }}" type="radio" name="answer{{ $loop->iteration }}" value="A">
                                                                        <label class="ml-4 d-inline" for="soalA{{ $l->id }}">{!! $l->A !!}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-control input-default mb-2">
                                                                    <div class="radio my-1">
                                                                        <input onchange="showJawaban({{ $loop->iteration }})" id="soalB{{ $l->id }}" type="radio" name="answer{{ $loop->iteration }}" value="B">
                                                                        <label class="ml-4 d-inline" for="soalB{{ $l->id }}">{!! $l->B !!}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-control input-default mb-2">
                                                                    <div class="radio my-1">
                                                                        <input onchange="showJawaban({{ $loop->iteration }})" id="soalC{{ $l->id }}" type="radio" name="answer{{ $loop->iteration }}" value="C">
                                                                        <label class="ml-4 d-inline" for="soalC{{ $l->id }}">{!! $l->C !!}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-control input-default mb-2">
                                                                    <div class="radio my-1">
                                                                        <input onchange="showJawaban({{ $loop->iteration }})" id="soalD{{ $l->id }}" type="radio" name="answer{{ $loop->iteration }}" value="D">
                                                                        <label class="ml-4 d-inline" for="soalD{{ $l->id }}">{!! $l->D !!}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-control input-default mb-2">
                                                                    <div class="radio my-1">
                                                                        <input onchange="showJawaban({{ $loop->iteration }})" id="soalE{{ $l->id }}" type="radio" name="answer{{ $loop->iteration }}" value="E">
                                                                        <label class="ml-4 d-inline" for="soalE{{ $l->id }}">{!! $l->E !!}</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="d-none" id="jawaban{{ $loop->iteration }}">
                                                                <hr>
                                                                <div class="btn btn-info d-block" onclick="showJawabanSoal({{ $loop->iteration }}, '{{ $l->jawaban }}')">Jawaban dan Pembahasan</div>
                                                                <div class="d-none" id="jawabanSoal{{ $loop->iteration }}">
                                                                    <hr>
                                                                    <div class="card">

                                                                        <div id="result" class="container">
                                                                            <div class="card-title text-center text-white mt-2">
                                                                                <b id="result_title"></b>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="card-body">
                                                                            {!! $l->jawaban_lengkap !!}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div class="row justify-content-around">
                                                                <div class="col-lg-6">
                                                                    <div class="btn btn-primary @if($loop->iteration - 1 == 0) d-none @endif" onclick="hideKotak({{ $loop->iteration - 1 }}, {{ count($latihan) }})">Previous</div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="btn btn-primary @if($loop->iteration + 1 > count($latihan)) d-none @endif float-right" onclick="hideKotak({{ $loop->iteration + 1 }}, {{ count($latihan) }})">Next</div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </center>
                </div>
                @endforeach

            </form>
        </div>
    </div>

    <button id="fab" type="button" onclick="window.location.href = '{{ url('/pertemuan/'.$latihan[0]->id_pertemuan) }}'" class="btn btn-info btn-lg btn-rounded centered">
        <p id="fab_done" class="d-inline">Kembali ke pertemuan</p>
        <span class="btn-icon-right ml-0">
            <i id="fab_icon" class="fa fa-arrow-left text-white"></i>
        </span>
    </button>

    <script src="{{ URL::asset('quixlab/plugins/common/common.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/custom.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/settings.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/gleek.js') }}"></script>
    <script src="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('quixlab/plugins/toastr/js/toastr.min.js') }}"></script>

    <script>
        function hideKotak(id, count){
            for (let index = 1; index <= count; index++) {
                if(index != id){
                    $('#kotak'+index).hide();
                }else{
                    $('#kotak'+index).show();
                }
            }
        }

        function showJawaban(id){
            $('#jawaban'+id).removeClass('d-none');
            $('#jawabanSoal'+id).addClass('d-none');
        }

        function showJawabanSoal(id, kunci){
            $('#jawabanSoal'+id).removeClass('d-none');
            jawaban = $("#form_latihan input[name=answer"+ id +"]:checked").val();
            if(kunci == jawaban){
                $('#result').removeClass('bg-danger').addClass('bg-success');
                $('#result_title').html('B E N A R');
            }else{
                $('#result').removeClass('bg-success').addClass('bg-danger');
                $('#result_title').html('S A L A H');
            }
        }
    </script>

</body>

</html>
