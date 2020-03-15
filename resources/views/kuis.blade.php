<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Kuis</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('quixlab/images/favicon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ URL::asset('quixlab/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('quixlab/css/style_pertemuan.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('quixlab/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

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
                                                    <p> {{ $s->pertanyaan }} </p>
                                                    <img class="ml-3 mb-3" src="soal2.png" width="150px" height="80px;">
                                                    <div class="form-group">
                                                        <div class="form-control input-default mb-2">
                                                            <div class="radio my-1">
                                                                <input type="radio" name="answer{{ $s->id }}">
                                                                <p class="ml-4 d-inline">{{ $s->A }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-control input-default mb-2">
                                                            <div class="radio my-1">
                                                                <input type="radio" name="answer{{ $s->id }}">
                                                                <p class="ml-4 d-inline">{{ $s->B }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-control input-default mb-2">
                                                            <div class="radio my-1">
                                                                <input type="radio" name="answer{{ $s->id }}">
                                                                <p class="ml-4 d-inline">{{ $s->C }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-control input-default mb-2">
                                                            <div class="radio my-1">
                                                                <input type="radio" name="answer{{ $s->id }}">
                                                                <p class="ml-4 d-inline">{{ $s->D }}</p>
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

    <script src="{{ URL::asset('js/kuis.js') }}"></script>

    <script>
        fab.addEventListener("click", function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({
                        title: 'Test Send!',
                        text: "Test has been sent, Great work!",
                        type: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        window.location = "{{ url('/pertemuan/'.$kuis->id_pertemuan) }}";
                    });
                }
            })
        });
    </script>

</body>

</html>
