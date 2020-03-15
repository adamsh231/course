<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Pretest</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('quixlab/images/favicon.png') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ URL::asset('quixlab/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('quixlab/css/style_pertemuan.css') }}" rel="stylesheet">

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

        @for ($i = 0; $i < 10; $i++)
        <center>
            <table class="mt-4">
                <tr>
                    <td>
                        <div style="width:1000px;">
                            <!-- row -->
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title"><b>Questions 2 of 10 </b></h3>
                                                <p> Volum balok di bawah ini adalah ... cm <sup>3</sup></p>
                                                <img class="ml-3 mb-3" src="soal2.png" width="150px" height="80px;">
                                                <div class="form-group">
                                                    <div class="form-control input-default mb-2">
                                                        <div class="radio my-1">
                                                            <input type="radio" name="A"> 378
                                                        </div>
                                                    </div>
                                                    <div class="form-control input-default mb-2">
                                                        <div class="radio my-1">
                                                            <input type="radio" name="B"> 408
                                                        </div>
                                                    </div>
                                                    <div class="form-control input-default mb-2">
                                                        <div class="radio my-1">
                                                            <input type="radio" name="C"> 456
                                                        </div>
                                                    </div>
                                                    <div class="form-control input-default mb-2">
                                                        <div class="radio my-1">
                                                            <input type="radio" name="D"> 720
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn mb-1 btn-warning text-white float-left">
                                                        Sebelumnya
                                                        <span class="btn-icon-right">
                                                            <i class="fa fa-arrow-left text-white"></i>
                                                        </span>
                                                    </button>
                                                    <button type="button" class="btn mb-1 btn-warning text-white float-right">
                                                        Selanjutnya
                                                        <span class="btn-icon-right">
                                                            <i class="fa fa-arrow-right  text-white"></i>
                                                        </span>
                                                    </button>
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
        @endfor

    </div>

    <script src="{{ URL::asset('quixlab/plugins/common/common.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/custom.min.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/settings.js') }}"></script>
    <script src="{{ URL::asset('quixlab/js/gleek.js') }}"></script>

</body>

</html>
