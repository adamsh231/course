@extends('layout/quixlab')
@section('title','Landing')
@section('content')
<div class="center">
    <table style="margin-top:8px; margin-left:120px; margin-right:15px;">
        <tr>
            <td>
            <td>
                <h6 style="text-align:right; letter-spacing:1px;"><a href="#"><b> PENGELOLAAN PEMBELAJARAN </b></h6></a>
            <td>
                <h6 style="text-align:center; letter-spacing:1px;"><a href="#"><b> SUMBER BELAJAR <b></h6></a>
            <td>
                <h6 style="text-align:center; letter-spacing:1px;"><a href="#"><b> EVALUASI <b></h6></a>
            <td>
                <div class="center">
                    <button onclick="window.location.href = '{{ url('/login') }}'" type="button" class="btn mb-1 btn-primary" style="height:45px;"> LOGIN </button>
                </div>
            </td>
        </tr>

        <tr>
            <td>
                <h4 style="color:#4169E1; letter-spacing:2px;"><b> WEBSITE </b></h4>
                <p style="font-size:55px; color:black; line-height:50px;"><b> Pengelolaan </b></p>
                <p style="font-size:55px; color:black; line-height:50px;"><b> Pembelajaran </b></p>
                <p style="font-size:55px; color:black; line-height:50px;"><b> Matematika. </b></p>
                <p style="text-align:justify; line-height:25px; color:#000000;">
                    Website ini memiliki fitur-fitur untuk menunjang
                    proses pembelajaran matematika di dalam kelas maupun di luar kelas.
                    Klik tombol register untuk membuat akun, dan klik tombol jika kamu
                    sudah mempunyai akun.
                </p>
                <button onclick="window.location.href = '{{ url('/register') }}'" type="button" class="btn mb-1 btn-rounded btn-primary" style="height:50px; width:100px;">Register</button>
            </td>
            <td colspan="4" style="width:1500px;">
                <img src="{{ URL::asset('assets/bg.png') }}">
            </td>
        </tr>

    </table>
</div>
@endsection
