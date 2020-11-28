<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Pertemuan;
use App\Detail;
use App\Video;
use App\Kuis;
use App\Soal;
use App\Nilai;
use App\Presensi;
use App\Latihan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function administrator()
    {
        $siswa = $this->getAllSiswa();
        $pertemuan = $this->getAllPertemuan();
        return view('admin', ['siswa' => $siswa, 'pertemuan' => $pertemuan]);
    }

    public function pertemuanDetail(Pertemuan $id_pertemuan)
    {
        $detail = $this->getDetailByPertemuan($id_pertemuan->id);
        $kuis = $this->getKuisByPertemuan($id_pertemuan->id);
        $video = $this->getVideoByPertemuan($id_pertemuan->id);
        $presensi = $this->getPresensiByPertemuan($id_pertemuan->id);
        $latihan = Latihan::where('id_pertemuan', $id_pertemuan->id)->get();
        $pertemuan = $this->getAllPertemuan();
        return view(
            'admin_pertemuan',
            [
                'detail' => $detail,
                'kuis' => $kuis,
                'video' => $video,
                'presensi' => $presensi,
                'pertemuan' => $pertemuan,
                'id_pertemuan' => $id_pertemuan,
                'latihan' => $latihan,
            ]
        );
    }

    public function filePertemuan(Pertemuan $id_pertemuan)
    {
        $kuis = Kuis::with(['soal'])->where('id_pertemuan', $id_pertemuan->id)->first();
        $pertemuan = $this->getAllPertemuan();
        return view('file_pertemuan', [
            'pertemuan' => $pertemuan,
            'id_pertemuan' => $id_pertemuan,
            'kuis' => $kuis
        ]);
    }

    public function addFilePertemuan(Request $request, Pertemuan $pertemuan)
    {
        $kuis = Kuis::where('id_pertemuan', $pertemuan->id)->first();
        $messages = "";
        if ($request->has('materi')) {
            $request->validate(['materi' => ['mimes:pdf']]);
            $file = $request->file('materi');
            $file_name = time() . $pertemuan->id . "." . $file->getClientOriginalExtension();
            $file->storeAs('file/materi/', $file_name, 'public');
            Storage::disk('public')->delete($pertemuan->materi);
            $pertemuan->materi = 'file/materi/' . $file_name;
            $pertemuan->save();
            $messages = "Upload Materi Sukses!";
        } else if ($request->has('diskusi')) {
            $request->validate(['diskusi' => ['mimes:html']]);
            $file = $request->file('diskusi');
            $file_name = time() . $pertemuan->id . "." . $file->getClientOriginalExtension();
            $file->storeAs('file/diskusi/', $file_name, 'public');
            Storage::disk('public')->delete($pertemuan->diskusi);
            $pertemuan->diskusi = 'file/diskusi/' . $file_name;
            $pertemuan->save();
            $messages = "Upload Diskusi Sukses!";
        } else if ($request->has('tugas')) {
            $request->validate(['tugas' => ['mimes:pdf']]);
            $file = $request->file('tugas');
            $file_name = time() . $pertemuan->id . "." . $file->getClientOriginalExtension();
            $file->storeAs('file/tugas/', $file_name, 'public');
            Storage::disk('public')->delete($pertemuan->tugas);
            $pertemuan->tugas = 'file/tugas/' . $file_name;
            $pertemuan->save();
            $messages = "Upload Tugas Sukses!";
        } else if ($request->has('jawaban')) {
            $request->validate(['jawaban' => ['mimes:pdf']]);
            $file = $request->file('jawaban');
            $file_name = time() . $pertemuan->id . "." . $file->getClientOriginalExtension();
            $file->storeAs('file/jawaban/', $file_name, 'public');
            Storage::disk('public')->delete($pertemuan->tugas);
            $kuis->jawaban = 'file/jawaban/' . $file_name;
            $kuis->save();
            $messages = "Upload Kunci Jawaban Sukses!";
        }

        return back()->with('status', $messages == "" ? 'Upload Gagal File Tidak Boleh Kosong!' : $messages);
    }

    public function addGambarPertemuan(Request $request, Soal $soal)
    {
        $request->validate(['gambar' => ['required', 'mimes:jpg,png,jpeg', 'max:2048']]);
        $file = $request->file('gambar');
        $file_name = time() . $soal->id . "." . strtolower($file->getClientOriginalExtension());
        $file->storeAs('file/gambar/', $file_name, 'public');
        Storage::disk('public')->delete($soal->gambar);
        $soal->gambar = 'file/gambar/' . $file_name;
        $soal->save();
        return back()->with('status', 'Upload Gambar Berhasil!');
    }

    public function deleteGambarPertemuan(Soal $soal)
    {
        Storage::disk('public')->delete($soal->gambar);
        $soal->gambar = NULL;
        $soal->save();
        $append =
        "
        <i class='fa fa-times-circle fa-4x  text-danger'></i>
        ";
        return response()->json(['append' => $append], 200);
    }

    public function hadir(Request $request)
    {
        $replace = "";
        $presensi = Presensi::find($request->id);

        if ($request->kehadiran) {
            $presensi->kehadiran = "Tidak Hadir";
            $replace =
                "
                <button id='btn_hadir$request->id' onclick='hadir($request->id, 0)' type='button' class='btn mb-1 btn-rounded btn-danger btn-sm'>
                    <i id='icon_hadir$request->id' class='fa fa-times fa-2x' aria-hidden='true'></i>
                </button>
                ";
        } else {
            $presensi->kehadiran = "Hadir";
            $replace =
                "
                <button id='btn_hadir$request->id' onclick='hadir($request->id, 1)' type='button' class='btn mb-1 btn-rounded btn-success btn-sm'>
                    <i id='icon_hadir$request->id' class='fa fa-check fa-2x text-white' aria-hidden='true'></i>
                </button>
                ";
        }
        $presensi->save();
        return response()->json(['replace' => $replace], 200); //! 200, 422
    }

    public function acakTeam(Request $request)
    {
        $siswa = Siswa::where('status', 0)->get();
        $jml_siswa = $siswa->count();
        $validator = Validator::make(
            $request->all(),
            [
                'jumlah' => ['required', 'numeric']
            ]
        );

        if ($request->has('ajax')) {
            if ($validator->fails()) {
                return response()->json([
                    'error'    => true,
                    'messages' => $validator->errors(),
                    'type' => 1
                ], 422);
            } else if ($jml_siswa < $request->jumlah) {
                return response()->json([
                    'error'    => true,
                    'messages' => 'Jumlah team tidak boleh lebih dari jumlah siswa: ' . $jml_siswa . ' siswa',
                    'type' => 2
                ], 417);
            } else {
                return response()->json([
                    'error'    => false,
                ], 200);
            }
        } else {
            $arr_id = [];
            $count = 0;
            foreach ($siswa as $s) {
                $arr_id[$count] = $s->id;
                $count++;
            }
            shuffle($arr_id);

            $kelompok = 1;
            for ($i = 0; $i < count($arr_id); $i++) {
                $siswa_id = Siswa::find($arr_id[$i]);
                $siswa_id->team = $kelompok;
                if (($i + 1) % ($jml_siswa / $request->jumlah) == 0) {
                    $kelompok++;
                }
                $siswa_id->save();
            }

            return back();
        }
    }

    public function nilai($kuis = 0)
    {
        $pertemuan = $this->getAllPertemuan();
        // $nilai = Nilai::with(['siswa', 'kuis'])->whereNotIn('id_siswa', function ($query) {
        //     $query->select('id')->from('siswa')->where('status', 1);
        // })->get();
        $current = $kuis;
        $nilai = "";
        if($kuis == 0){
            $nilai = Nilai::with(['siswa', 'kuis'])->get();
        }else{
            $nilai = Nilai::with(['siswa', 'kuis'])->where('id_kuis', $kuis)->get();
        }
        $kuis = Kuis::all();
        return view(
            'admin_nilai',
            [
                'nilai' => $nilai,
                'pertemuan' => $pertemuan,
                'kuis' => $kuis,
                'current' => $current
            ]
        );
    }

    private function getDetailByPertemuan($key)
    {
        $detail = Detail::with('deskripsi')->where('id_pertemuan', $key)->get();
        return $detail;
    }

    private function getKuisByPertemuan($key)
    {
        $kuis = Kuis::where('id_pertemuan', $key)->first();
        return $kuis;
    }

    private function getVideoByPertemuan($key)
    {
        $video = Video::where('id_pertemuan', $key)->get();
        return $video;
    }

    private function getPresensiByPertemuan($key)
    {
        $presensi = Presensi::with(['siswa'])->where('id_pertemuan', $key)->get();
        return $presensi;
    }

    private function getAllSiswa()
    {
        $siswa = Siswa::where('status', 0)->get();
        return $siswa;
    }

    private function getAllPertemuan()
    {
        $pertemuan = Pertemuan::orderBy('tanggal')->get();
        return $pertemuan;
    }
}
