<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Pertemuan;
use App\Detail;
use App\Video;
use App\Kuis;
use App\Deskripsi;
use App\Presensi;

class AdminController extends Controller
{
    public function administrator()
    {
        $siswa = $this->getAllSiswa();
        $pertemuan = $this->getAllPertemuan();
        return view('admin',['siswa' => $siswa, 'pertemuan' => $pertemuan]);
    }

    public function pertemuanDetail(Pertemuan $id_pertemuan){
        $detail = $this->getDetailByPertemuan($id_pertemuan->id);
        $kuis = $this->getKuisByPertemuan($id_pertemuan->id);
        $video = $this->getVideoByPertemuan($id_pertemuan->id);
        $presensi = $this->getPresensiByPertemuan($id_pertemuan->id);
        $pertemuan = $this->getAllPertemuan();
        return view('admin_pertemuan',
        [
            'detail' => $detail,
            'kuis' => $kuis,
            'video' => $video,
            'presensi' => $presensi,
            'pertemuan' => $pertemuan,
            'id_pertemuan' => $id_pertemuan
        ]);
    }

    private function getDetailByPertemuan($key){
        $detail = Detail::with('deskripsi')->where('id_pertemuan',$key)->get();
        return $detail;
    }

    private function getKuisByPertemuan($key){
        $kuis = Kuis::where('id_pertemuan',$key)->first();
        return $kuis;
    }

    private function getVideoByPertemuan($key){
        $video = Video::where('id_pertemuan',$key)->get();
        return $video;
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
