<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;

class AdminController extends Controller
{
    function administrator(){
        $siswa = $this->getAllSiswa();
        return view('admin', ['siswa' => $siswa]);
    }

    function getAllSiswa(){
        $siswa = Siswa::all();
        return $siswa;
    }
}
