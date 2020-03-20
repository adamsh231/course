<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Detail;
use App\Pertemuan;
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
}
