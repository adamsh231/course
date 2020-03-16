<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertemuan;
use App\Detail;
use App\Soal;
use App\Kuis;

class HomeController extends Controller
{
    public function home()
    {
        $pertemuan = $this->getAllPertemuan();
        return view('/home', ['pertemuan' => $pertemuan]);
    }

    public function pertemuan(Pertemuan $id_pertemuan)
    {
        $pertemuan = $this->getAllPertemuan();
        $detail = $this->getDetailByPertemuan($id_pertemuan->id);
        return view('/pertemuan',
            [
                'pertemuan' => $pertemuan,
                'id_pertemuan' => $id_pertemuan,
                'detail' => $detail
            ]
        );
    }

    public function kuis($id_pertemuan)
    {
        $kuis = Kuis::where('id_pertemuan', $id_pertemuan)->first();
        $soal = "";
        if (isset($kuis->id)) {
            $soal = Soal::where('id_kuis', $kuis->id)->get();
            return view('kuis', ['soal' => $soal, 'kuis' => $kuis]);
        } else {
            return back();
        }
    }

    private function getAllPertemuan()
    {
        $pertemuan = Pertemuan::all();
        return $pertemuan;
    }

    private function getDetailByPertemuan($key)
    {
        $detail = Detail::with(['deskripsi'])->where('id_pertemuan', $key)->get();
        return $detail;
    }
}
