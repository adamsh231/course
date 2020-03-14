<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Pertemuan;

class AdminController extends Controller
{
    function administrator()
    {
        $siswa = $this->getAllSiswa();
        $pertemuan = $this->getAllPertemuan();
        return view(
            'admin',
            [
                'siswa' => $siswa,
                'pertemuan' => $pertemuan
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
}
