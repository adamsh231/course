<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Kuis</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('assets/icon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ URL::asset('quixlab/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('quixlab/css/style_pertemuan.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('quixlab/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">

    <style>
        .centered {
            position: fixed;
            bottom: 2%;
            left: 50%;
            /* bring your own prefixes */
            transform: translate(-50%, -50%);
        }
    </style>

    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({ extensions: ["tex2jax.js"], jax: ["input/TeX", "output/HTML-CSS"], tex2jax: { inlineMath: [ ['$','$'], ["\\(","\\)"] ], displayMath: [ ['$$','$$'], ["\\[","\\]"] ], processEscapes: true }, "HTML-CSS": { availableFonts: ["TeX"] } });
</script>
    <script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML"></script>

</head>

<body>

    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">

        <div class="container" style="margin-top: 20px">
            <form id="form_kuis" action="{{ url('/nilai/'.$kuis->id) }}" method="POST">
                @csrf

                @foreach($soal as $s)
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
                                                        <h3 class="card-title"><b>Soal {{ $loop->iteration }} dari {{ count($soal) }} </b></h3>
                                                        <p> {!! $s->pertanyaan !!} </p>
                                                        @if ($s->gambar)
                                                        <img class="ml-3 mb-3" src="{{ url('storage/'.$s->gambar) }}" width="300px" height="300px;">
                                                        @endif
                                                        <div class="form-group">
                                                            <div class="form-control input-default mb-2">
                                                                <div class="radio my-1">
                                                                    <input id="soalA{{ $s->id }}" type="radio" name="answer{{ $s->id }}" value="A">
                                                                    <label class="ml-4 d-inline" for="soalA{{ $s->id }}">{{ $s->A }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-control input-default mb-2">
                                                                <div class="radio my-1">
                                                                    <input id="soalB{{ $s->id }}" type="radio" name="answer{{ $s->id }}" value="B">
                                                                    <label class="ml-4 d-inline" for="soalB{{ $s->id }}">{{ $s->B }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-control input-default mb-2">
                                                                <div class="radio my-1">
                                                                    <input id="soalC{{ $s->id }}" type="radio" name="answer{{ $s->id }}" value="C">
                                                                    <label class="ml-4 d-inline" for="soalC{{ $s->id }}">{{ $s->C }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-control input-default mb-2">
                                                                <div class="radio my-1">
                                                                    <input id="soalD{{ $s->id }}" type="radio" name="answer{{ $s->id }}" value="D">
                                                                    <label class="ml-4 d-inline" for="soalD{{ $s->id }}">{{ $s->D }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-control input-default mb-2">
                                                                <div class="radio my-1">
                                                                    <input id="soalE{{ $s->id }}" type="radio" name="answer{{ $s->id }}" value="E">
                                                                    <label class="ml-4 d-inline" for="soalE{{ $s->id }}">{{ $s->E }}</label>
                                                                </div>
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
                @endforeach

            </form>
        </div>
    </div>

    <button id="fab" type="button" class="btn btn-info btn-lg btn-rounded centered">
        <p id="fab_time" class="d-inline">00:00</p>
        <p id="fab_done" class="d-none">Selesai</p>
        <span class="btn-icon-right ml-0">
            <i id="fab_icon" class="fa fa-clock-o text-white"></i>
        </span>
    </button>

    <script src="{{ URL::asset('quixlab/plugins/common/common.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/custom.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/settings.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/gleek.js') }}"></script>
    <script src="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('quixlab/plugins/toastr/js/toastr.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var fab = document.getElementById("fab");
            var fab_time = document.getElementById("fab_time");
            var fab_done = document.getElementById("fab_done");
            var fab_icon = document.getElementById("fab_icon");
            var duration = 60 * {{ $kuis->waktu }} - 1;
            var timer = duration, minutes, seconds;
            var interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                fab_time.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
            setTimeout(function(){
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-full-width",
                    "timeOut": "5000",
                    "extendedTimeOut": "2000",
                }
                toastr.warning("Waktu sudah mau habis");
            }, ({{ $kuis->waktu * 60 * 1000 * 0.8}}));
            setTimeout(function(){
                clearInterval(interval);
                Swal.fire({
                    title: 'Waktu Telah Habis!',
                    text: "Form akan dikirim otomatis",
                    type: 'error',
                    showCancelButton: false,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });
                setTimeout(function(){
                    $('#form_kuis').submit();
                }, 2000);
            }, {{ $kuis->waktu * 60 * 1000 }});

            fab.addEventListener("mouseenter", function () {
                fab_done.classList.remove('d-none');
                fab_done.classList.add('d-inline');
                fab_time.classList.remove('d-inline');
                fab_time.classList.add('d-none');

                fab_icon.classList.remove('fa-clock-o');
                fab_icon.classList.add('fa-paper-plane-o');
            });
            fab.addEventListener("mouseleave", function () {
                fab_time.classList.remove('d-none');
                fab_time.classList.add('d-inline');
                fab_done.classList.remove('d-inline');
                fab_done.classList.add('d-none');

                fab_icon.classList.remove('fa-paper-plane-o');
                fab_icon.classList.add('fa-clock-o');
            });
            fab.addEventListener("click", function () {
                Swal.fire({
                    title: 'Apa anda yakin?',
                    text: "Ingin mengirim hasil test sekarang.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Saya yakin!'
                }).then((result) => {
                    if (result.value) {
                        Swal.fire({
                            title: 'Test terkirim!',
                            text: "Semoga beruntung",
                            type: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            $('#form_kuis').submit();
                            // window.location = "{{ url('/pertemuan/'.$kuis->id_pertemuan) }}";
                        });
                    }
                })
            });
        });

    </script>

</body>

</html>
