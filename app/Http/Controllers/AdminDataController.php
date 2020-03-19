<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Siswa;
use Illuminate\Support\Facades\Hash;

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
            'error'    => false,
        ], 200);
    }
}
