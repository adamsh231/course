<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Detail;
use App\Deskripsi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

    public function addKegiatan(Request $request){
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
        $deskripsi->id_detail= $request->id_detail;
        $deskripsi->teks = $request->teks;
        $deskripsi->save();

        $detail = Detail::find($request->id_detail);
        $deskripsi = Deskripsi::where('id_detail', $request->id_detail)->get();
        $append = "";
        foreach($deskripsi as $d){
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

    public function getDeskripsiById(Deskripsi $kegiatan){
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
        foreach($deskripsi as $d){
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
        foreach($deskripsi as $d){
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
}
