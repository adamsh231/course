<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertemuan;
use App\Detail;

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
            ]);
    }

    private function getAllPertemuan()
    {
        $pertemuan = Pertemuan::all();
        return $pertemuan;
    }

    private function getDetailByPertemuan($key)
    {
        $detail = Detail::where('id_pertemuan', $key)->get();
        return $detail;
    }
}
