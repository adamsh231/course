<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertemuan;
use App\Detail;
use App\Soal;
use App\Nilai;
use App\Siswa;
use App\Kuis;
use App\Video;
use App\Presensi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $pertemuan = $this->getAllPertemuan();
        return view('/home', ['pertemuan' => $pertemuan]);
    }

    public function profile()
    {
        $pertemuan = $this->getAllPertemuan();
        $siswa = Siswa::find(Auth::user()->id);
        $nilai = Nilai::with(['kuis'])->where('id_siswa', $siswa->id)->get();
        $presensi = Presensi::with(['pertemuan'])->where('id_siswa', $siswa->id)->get();
        return view(
            'profile',
            [
                'pertemuan' => $pertemuan,
                'siswa' => $siswa,
                'presensi' => $presensi,
                'nilai' => $nilai
            ]
        );
    }

    public function kelompok()
    {
        $pertemuan = $this->getAllPertemuan();
        $siswa = Siswa::where(
            [
                ['team', Auth::user()->team],
                ['status', 0]
            ])->get();
        return view(
            'kelompok',
            [
                'siswa' => $siswa,
                'pertemuan' => $pertemuan
            ]
        );
    }

    public function materi(Pertemuan $id_pertemuan)
    {
        $pertemuan = $this->getAllPertemuan();
        $kuis = Kuis::where('id_pertemuan', $id_pertemuan->id)->first();
        $video = Video::where('id_pertemuan', $id_pertemuan->id)->get();
        return view(
            'materi',
            [
                'video' => $video,
                'kuis' => $kuis,
                'id_pertemuan' => $id_pertemuan,
                'pertemuan' => $pertemuan
            ]
        );
    }

    public function editProfile(Request $request)
    {
        $siswa = Siswa::find(Auth::user()->id);
        $request->validate(
            [
                'name' => ['required'],
                'username' => ['required', Rule::unique('siswa')->ignore($siswa->id)],
                'password' => [($request->filled('password') ? 'min:8' : '')],
                'email' => ['required', Rule::unique('siswa')->ignore($siswa->id), 'email'],
                'phone' => ['required', Rule::unique('siswa')->ignore($siswa->id), 'numeric'],
            ]
        );
        $siswa->name = $request->name;
        $siswa->username = $request->username;
        $siswa->email = $request->email;
        $siswa->phone = $request->phone;
        if ($request->filled('password')) {
            $siswa->password = Hash::make($request->password);
        }
        $siswa->save();
        return redirect('/profile')->with('status', 'Data Tersimpan!');
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

        if(!$kuis){
            return redirect('/home');
        }

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

        return redirect('/profile');
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
