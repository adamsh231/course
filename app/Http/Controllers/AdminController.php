<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Pertemuan;
use App\Detail;
use App\File;
use App\Kuis;
use App\Soal;
use App\Presensi;

class AdminController extends Controller
{
    function administrator()
    {
        $siswa = $this->getAllSiswa();
        $pertemuan = $this->getAllPertemuan();
        $detail = [];
        foreach ($pertemuan as $p) {
            $detail[$p->id] = $this->getDetailByPertemuan($p->id);
        }
        $file = [];
        foreach ($pertemuan as $p) {
            $file[$p->id] = $this->getFileByPertemuan($p->id);
        }
        $kuis = [];
        foreach ($pertemuan as $p) {
            $kuis[$p->id] = $this->getKuisByPertemuan($p->id);
        }
        return view(
            'admin',
            [
                'siswa' => $siswa,
                'pertemuan' => $pertemuan,
                'detail' => $detail,
                'file' => $file,
                'kuis' => $kuis
            ]
        );
    }

    function getAllSiswa()
    {
        $siswa = Siswa::all();
        return $siswa;
    }

    function getAllPertemuan()
    {
        $pertemuan = Pertemuan::all();
        return $pertemuan;
    }

    function getDetailByPertemuan($key)
    {
        $detail = Detail::where('id_pertemuan', $key)->get();
        return $detail;
    }

    function getFileByPertemuan($key)
    {
        $file = File::where('id_pertemuan', $key)->get();
        return $file;
    }

    function getKuisByPertemuan($key){
        $kuis = Kuis::where('id_pertemuan', $key)->get();
        return $kuis;
    }
}
