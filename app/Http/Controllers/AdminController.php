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
    public function administrator()
    {
        $siswa = $this->getAllSiswa();
        $pertemuan = $this->getAllPertemuan();
        return view('admin',['siswa' => $siswa, 'pertemuan' => $pertemuan]);
    }

    public function pertemuanDetail(Pertemuan $pertemuan){
        $detail = $this->getDetailByPertemuan($pertemuan->id);
        $kuis = $this->getKuisByPertemuan($pertemuan->id);
        $file = $this->getFileByPertemuan($pertemuan->id);
        $presensi = $this->getPresensiByPertemuan($pertemuan->id);
        return view('admin_pertemuan',
        [
            'detail' => $detail,
            'kuis' => $kuis,
            'file' => $file,
            'presensi' => $presensi,
            'pertemuan' => $pertemuan
        ]);
    }

    private function getDetailByPertemuan($key){
        $detail = Detail::where('id_pertemuan',$key)->get();
        return $detail;
    }

    private function getKuisByPertemuan($key){
        $kuis = Kuis::where('id_pertemuan',$key)->get();
        return $kuis;
    }

    private function getFileByPertemuan($key){
        $file = File::where('id_pertemuan',$key)->get();
        return $file;
    }

    private function getPresensiByPertemuan($key){
        $presensi = Presensi::with(['siswa'])->where('id_pertemuan',$key)->get();
        return $presensi;
    }

    private function getAllSiswa()
    {
        $siswa = Siswa::all();
        return $siswa;
    }

    private function getAllPertemuan()
    {
        $pertemuan = Pertemuan::all();
        return $pertemuan;
    }
}
