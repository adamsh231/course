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

        $exist = Nilai::where([
            ['id_siswa', '=', Auth::user()->id],
            ['id_kuis', '=', $kuis->id]
        ])->count();

        if ($kuis) {
            if ($kuis->aktif) {
                if ($exist == 0) {
                    $soal = Soal::where('id_kuis', $kuis->id)->inRandomOrder()->get();
                    $nilai = new Nilai;
                    $nilai->id_siswa = Auth::user()->id;
                    $nilai->id_kuis = $kuis->id;
                    $nilai->nilai = 0;
                    $nilai->save();
                    return view('kuis', ['soal' => $soal, 'kuis' => $kuis]);
                } else {
                    return redirect('/pertemuan/' . $id_pertemuan)
                        ->with('status', 'Anda dianggap telah melakukan test, Hubungi Guru jika ingin mengulang test!');
                }
            } else {
                return redirect('/pertemuan/' . $id_pertemuan)->with('status', 'Kuis Tidak Aktif!');
            }
        } else {
            return redirect('/pertemuan/' . $id_pertemuan);
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
        $nilai_table = Nilai::where([
            ['id_siswa', '=', Auth::user()->id],
            ['id_kuis', '=', $kuis->id]
        ])->first();
        $nilai_table->id_siswa = Auth::user()->id;
        $nilai_table->id_kuis = $kuis->id;
        $nilai_table->nilai = $nilai;
        $nilai_table->save();

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
