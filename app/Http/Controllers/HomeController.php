<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertemuan;
use App\Detail;
use App\Soal;
use App\Nilai;
use App\Kuis;
use Illuminate\Support\Facades\Auth;

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
        $kuis = Kuis::where('id_pertemuan', $id_pertemuan->id)->first();
        // dd($kuis);
        return view(
            '/pertemuan',
            [
                'pertemuan' => $pertemuan,
                'id_pertemuan' => $id_pertemuan,
                'detail' => $detail,
                'kuis' => $kuis
            ]
        );
    }

    public function kuis($id_pertemuan)
    {
        $kuis = Kuis::where('id_pertemuan', $id_pertemuan)->first();
        $soal = "";
        if (isset($kuis)) {
            if ($kuis->aktif) {
                $soal = Soal::where('id_kuis', $kuis->id)->inRandomOrder()->get();
                return view('kuis', ['soal' => $soal, 'kuis' => $kuis]);
            } else {
                return back()->with('status', 'Kuis Tidak Aktif!');
            }
        } else {
            return back();
        }
    }

    public function nilai(Request $request, Kuis $kuis)
    {
        $soal = Soal::where('id_kuis', $kuis->id)->get();
        $nilai = 0;
        foreach ($soal as $s) {
            if ($request['answer' . $s->id] == $s->jawaban) {
                $nilai++;
            }
        }
        $exist = Nilai::where([
            ['id_siswa', '=', Auth::user()->id],
            ['id_kuis', '=', $kuis->id]
        ])->count();
        $nilai =  (int) ($nilai / count($soal) * 100);
        if ($exist == 0) {
            $nilai_table = new Nilai;
            $nilai_table->id_siswa = Auth::user()->id;
            $nilai_table->id_kuis = $kuis->id;
            $nilai_table->nilai = $nilai;
            $nilai_table->save();
        } else {
            $nilai_table = Nilai::where([
                ['id_siswa', '=', Auth::user()->id],
                ['id_kuis', '=', $kuis->id]
            ])->first();
            $nilai_table->id_siswa = Auth::user()->id;
            $nilai_table->id_kuis = $kuis->id;
            $nilai_table->nilai = $nilai;
            $nilai_table->save();
        }
        return redirect('/pertemuan/' . $kuis->id_pertemuan)->with('status', 'Nilai anda adalah ' . $nilai);
    }

    private function getAllPertemuan()
    {
        $pertemuan = Pertemuan::orderBy('tanggal')->get();
        return $pertemuan;
    }

    private function getDetailByPertemuan($key)
    {
        $detail = Detail::with(['deskripsi'])->where('id_pertemuan', $key)->get();
        return $detail;
    }
}
