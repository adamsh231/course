<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Detail;
use App\Deskripsi;
use App\Video;
use App\Kuis;
use App\Soal;
use Illuminate\Support\Facades\Storage;

class AdminDetailController extends Controller
{
    public function addDetail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kegiatan' => ['required'],
                'mulai' => ['required'],
                'selesai' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $detail = new Detail;
        $detail->id_pertemuan = $request->id_pertemuan;
        $detail->kegiatan = $request->kegiatan;
        $detail->mulai = $request->mulai;
        $detail->selesai = $request->selesai;
        $detail->save();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function getDetailById(Detail $detail)
    {
        return response()->json([
            'error' => false,
            'detail' => $detail,
        ], 200);
    }

    public function editDetail(Request $request, Detail $detail)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kegiatan' => ['required'],
                'mulai' => ['required'],
                'selesai' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $detail->kegiatan = $request->kegiatan;
        $detail->mulai = $request->mulai;
        $detail->selesai = $request->selesai;
        $detail->save();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function deleteDetail(Detail $detail)
    {
        $detail->delete();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function addKegiatan(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'teks' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $deskripsi = new Deskripsi;
        $deskripsi->id_detail = $request->id_detail;
        $deskripsi->teks = $request->teks;
        $deskripsi->save();

        $detail = Detail::find($request->id_detail);
        $deskripsi = Deskripsi::where('id_detail', $request->id_detail)->get();
        $append = "";
        foreach ($deskripsi as $d) {
            $append .=
                "
            <tr>
                <td>$d->teks</td>
                <td style='width: 15%' class='text-center'>
                    <span>
                        <a class='mr-2' onclick='show_modal_edit_kegiatan($d->id, \"$detail->kegiatan\")' href='#'>
                            <i class='fa fa-pencil color-muted m-r-5'></i>
                        </a>
                        <a onclick='confirm_delete_kegiatan($d->id, \"$d->teks\")' href='#'>
                            <i class='fa fa-trash-o color-danger'></i>
                        </a>
                    </span>
                </td>
            </tr>
            ";
        }

        return response()->json([
            'error' => false,
            'append' => $append,
        ], 200);
    }

    public function getDeskripsiById(Deskripsi $kegiatan)
    {
        return response()->json([
            'error' => false,
            'kegiatan' => $kegiatan,
        ], 200);
    }

    public function editDeskripsi(Request $request, Deskripsi $kegiatan)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'teks' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $id_detail = $kegiatan->id_detail;
        $detail = Detail::find($id_detail);

        $kegiatan->teks = $request->teks;
        $kegiatan->save();

        $deskripsi = Deskripsi::where('id_detail', $id_detail)->get();
        $append = "";
        foreach ($deskripsi as $d) {
            $append .=
                "
            <tr>
                <td>$d->teks</td>
                <td style='width: 15%' class='text-center'>
                    <span>
                        <a class='mr-2' onclick='show_modal_edit_kegiatan($d->id, \"$detail->kegiatan\")' href='#'>
                            <i class='fa fa-pencil color-muted m-r-5'></i>
                        </a>
                        <a onclick='confirm_delete_kegiatan($d->id, \"$d->teks\")' href='#'>
                            <i class='fa fa-trash-o color-danger'></i>
                        </a>
                    </span>
                </td>
            </tr>
            ";
        }

        return response()->json([
            'error' => false,
            'append' => $append,
            'id_detail' => $id_detail,
        ], 200);
    }

    public function deleteDeskripsi(Deskripsi $kegiatan)
    {
        $id_detail = $kegiatan->id_detail;
        $kegiatan->delete();

        $detail = Detail::find($id_detail);
        $deskripsi = Deskripsi::where('id_detail', $id_detail)->get();

        $append = "";
        foreach ($deskripsi as $d) {
            $append .=
                "
            <tr>
                <td>$d->teks</td>
                <td style='width: 15%' class='text-center'>
                    <span>
                        <a class='mr-2' onclick='show_modal_edit_kegiatan($d->id, \"$detail->kegiatan\")' href='#'>
                            <i class='fa fa-pencil color-muted m-r-5'></i>
                        </a>
                        <a onclick='confirm_delete_kegiatan($d->id, \"$d->teks\")' href='#'>
                            <i class='fa fa-trash-o color-danger'></i>
                        </a>
                    </span>
                </td>
            </tr>
            ";
        }

        return response()->json([
            'error' => false,
            'append' => $append,
            'id_detail' => $id_detail
        ], 200);
    }

    public function addVideo(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'path' => ['required', 'url'],
                'deskripsi' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        parse_str( parse_url( $request->path, PHP_URL_QUERY ), $youtube_ids );
        $youtube_id = $youtube_ids['v'];

        $video = new Video;
        $video->id_pertemuan = $request->id_pertemuan;
        $video->nama = $request->nama;
        $video->path = 'https://www.youtube.com/embed/'.$youtube_id;
        $video->deskripsi = $request->deskripsi;
        $video->save();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function getVideoById(Video $video)
    {
        $video->path = 'https://www.youtube.com/watch?v='.substr($video->path, 30);
        return response()->json([
            'error' => false,
            'video' => $video,
        ], 200);
    }

    public function editVideo(Request $request, Video $video)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'path' => ['url'],
                'deskripsi' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $video->nama = $request->nama;
        parse_str( parse_url( $request->path, PHP_URL_QUERY ), $youtube_ids );
        $youtube_id = $youtube_ids['v'];
        $video->path = 'https://www.youtube.com/embed/'.$youtube_id;
        $video->deskripsi = $request->deskripsi;
        $video->save();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function deleteVideo(Video $video)
    {
        $video->delete();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function addKuis(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'waktu' => ['required', 'numeric'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $kuis = new Kuis;
        $kuis->id_pertemuan = $request->id_pertemuan;
        $kuis->nama = $request->nama;
        $kuis->waktu = $request->waktu;
        $kuis->save();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function editKuis(Request $request, Kuis $kuis)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'waktu' => ['required', 'numeric'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $kuis->nama = $request->nama;
        $kuis->waktu = $request->waktu;
        $kuis->save();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function deleteKuis(Kuis $kuis)
    {
        $soal = Soal::where('id_kuis',$kuis->id)->get();
        Storage::disk('public')->delete($kuis->jawaban);
        foreach($soal as $s){
            Storage::disk('public')->delete($s->gambar);
        }
        $kuis->delete();
        return response()->json([
            'error' => false,
        ], 200);
    }

    public function addSoal(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pertanyaan' => ['required'],
                'A' => ['required'],
                'B' => ['required'],
                'C' => ['required'],
                'D' => ['required'],
                'E' => ['required'],
                'jawaban' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $soal = new Soal;
        $soal->id_kuis = $request->id_kuis;
        $soal->pertanyaan = $request->pertanyaan;
        $soal->A = $request->A;
        $soal->B = $request->B;
        $soal->C = $request->C;
        $soal->D = $request->D;
        $soal->E = $request->E;
        $soal->jawaban = $request->jawaban;
        $soal->save();

        $all_soal = Soal::where('id_kuis', $request->id_kuis)->get();
        $append = "";

        $index = 0;
        foreach($all_soal as $s){
            $index++;
            $append .=
            "
            <tr>
                <td class='text-center'>$index</td>
                <td class='text-justify'>$s->pertanyaan</td>
                <td>$s->A</td>
                <td>$s->B</td>
                <td>$s->C</td>
                <td>$s->D </td>
                <td>$s->E </td>
                <td class='text-center'>$s->jawaban</td>
                <td class='text-center'>
                    <span>
                        <a onclick='fill_edit_soal($s->id)' href='#' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit Data'>
                            <i class='fa fa-pencil color-muted m-r-5'></i>
                        </a>
                        <a onclick='confirm_delete_soal($s->id, \"$s->pertanyaan\")' href='#' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete Data'>
                            <i class='fa fa-trash-o color-danger'></i>
                        </a>
                    </span>
                </td>
            </tr>
            ";
        }

        return response()->json([
            'error' => false,
            'append' => $append,
        ], 200);
    }

    public function getSoalById(Soal $soal)
    {
        return response()->json([
            'error' => false,
            'soal' => $soal,
        ], 200);
    }

    public function editSoal(Request $request, Soal $soal){
        $validator = Validator::make(
            $request->all(),
            [
                'pertanyaan' => ['required'],
                'A' => ['required'],
                'B' => ['required'],
                'C' => ['required'],
                'D' => ['required'],
                'E' => ['required'],
                'jawaban' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $soal->pertanyaan = $request->pertanyaan;
        $soal->A = $request->A;
        $soal->B = $request->B;
        $soal->C = $request->C;
        $soal->D = $request->D;
        $soal->E = $request->E;
        $soal->jawaban = $request->jawaban;
        $soal->save();

        $all_soal = Soal::where('id_kuis', $soal->id_kuis)->get();
        $append = "";

        $index = 0;
        foreach($all_soal as $s){
            $index++;
            $append .=
            "
            <tr>
                <td class='text-center'>$index</td>
                <td class='text-justify'>$s->pertanyaan</td>
                <td>$s->A</td>
                <td>$s->B</td>
                <td>$s->C</td>
                <td>$s->D </td>
                <td>$s->E </td>
                <td class='text-center'>$s->jawaban</td>
                <td class='text-center'>
                    <span>
                        <a onclick='fill_edit_soal($s->id)' href='#' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit Data'>
                            <i class='fa fa-pencil color-muted m-r-5'></i>
                        </a>
                        <a onclick='confirm_delete_soal($s->id, \"$s->pertanyaan\")' href='#' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete Data'>
                            <i class='fa fa-trash-o color-danger'></i>
                        </a>
                    </span>
                </td>
            </tr>
            ";
        }

        return response()->json([
            'error' => false,
            'append' => $append,
        ], 200);
    }

    public function deleteSoal(Soal $soal)
    {
        $id_kuis = $soal->id_kuis;
        $soal->delete();

        $all_soal = Soal::where('id_kuis', $id_kuis)->get();
        $append = "";

        $index = 0;
        foreach($all_soal as $s){
            $index++;
            $append .=
            "
            <tr>
                <td class='text-center'>$index</td>
                <td class='text-justify'>$s->pertanyaan</td>
                <td>$s->A</td>
                <td>$s->B</td>
                <td>$s->C</td>
                <td>$s->D </td>
                <td>$s->E </td>
                <td class='text-center'>$s->jawaban</td>
                <td class='text-center'>
                    <span>
                        <a onclick='fill_edit_soal($s->id)' href='#' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit Data'>
                            <i class='fa fa-pencil color-muted m-r-5'></i>
                        </a>
                        <a onclick='confirm_delete_soal($s->id, \"$s->pertanyaan\")' href='#' data-toggle='tooltip' data-placement='top' title='' data-original-title='Delete Data'>
                            <i class='fa fa-trash-o color-danger'></i>
                        </a>
                    </span>
                </td>
            </tr>
            ";
        }

        return response()->json([
            'error' => false,
            'append' => $append,
        ], 200);
    }

    public function aktivasiSoal(Request $request, Kuis $kuis){
        $replace = "";

        if ($request->aktif) {
            $kuis->aktif = 0;
            $replace =
                "
                <button id='btn_aktif' onclick='aktivasi($kuis->id, 0)' type='button' class='btn mb-4 btn-danger'>
                    Aktifkan Kuis
                </button>
                ";
        }else{
            $kuis->aktif = 1;
            $replace =
                "
                <button id='btn_aktif' onclick='aktivasi($kuis->id, 1)' type='button' class='btn mb-4 btn-success text-white'>
                    Matikan Kuis
                </button>
                ";
        }
        $kuis->save();
        return response()->json(['replace' => $replace], 200); //! 200, 422
    }
}
