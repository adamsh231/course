<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Siswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminDataController extends Controller
{
    public function addSiswa(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'username' => ['required', 'unique:siswa'],
                'password' => ['required', 'min:8'],
                'email' => ['required', 'unique:siswa', 'email'],
                'phone' => ['required', 'unique:siswa', 'numeric'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $siswa = new Siswa;
        $siswa->name = $request->name;
        $siswa->username = $request->username;
        $siswa->password = Hash::make($request->password);
        $siswa->email = $request->email;
        $siswa->phone = $request->phone;
        $siswa->save();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function getSiswaById(Siswa $siswa)
    {
        return response()->json([
            'error' => false,
            'siswa' => $siswa,
        ], 200);
    }

    public function editSiswa(Request $request, Siswa $siswa)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'username' => ['required', Rule::unique('siswa')->ignore($siswa->id)],
                'password' => [($request->filled('password') ? 'min:8' : '')],
                'email' => ['required', Rule::unique('siswa')->ignore($siswa->id), 'email'],
                'phone' => ['required', Rule::unique('siswa')->ignore($siswa->id), 'numeric'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $siswa->name = $request->name;
        $siswa->username = $request->username;
        if ($request->filled('password')) {
            $siswa->password = Hash::make($request->password);
        }
        $siswa->email = $request->email;
        $siswa->phone = $request->phone;
        $siswa->save();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function deleteSiswa(Siswa $siswa)
    {
        $siswa->delete();

        return response()->json([
            'error' => false,
        ], 200);
    }
}
