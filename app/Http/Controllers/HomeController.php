<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertemuan;

class HomeController extends Controller
{
    public function home(){
        $pertemuan = $this->getAllPertemuan();
        return view('/home', ['pertemuan' => $pertemuan]);
    }

    public function pertemuan(Pertemuan $id_pertemuan){
        $pertemuan = $this->getAllPertemuan();
        return view('/pertemuan', ['pertemuan' => $pertemuan, 'id_pertemuan' => $id_pertemuan]);
    }

    private function getAllPertemuan(){
        $pertemuan = Pertemuan::all();
        return $pertemuan;
    }
}
