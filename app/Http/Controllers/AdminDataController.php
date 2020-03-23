<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Siswa;
use App\Pertemuan;
use App\Presensi;
use App\Nilai;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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

        $pertemuan = Pertemuan::all();
        foreach($pertemuan as $p){
            $presensi = new Presensi;
            $presensi->id_pertemuan = $p->id;
            $presensi->id_siswa = $siswa->id;
            $presensi->save();
        }

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
        $siswa->team = $request->team;
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

    public function addPertemuan(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'judul' => ['required'],
                'tanggal' => ['required'],
                'kompetensi' => ['required'],
                'tujuan' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $pertemuan = new Pertemuan;
        $pertemuan->nama = $request->nama;
        $pertemuan->judul = $request->judul;
        $pertemuan->tanggal = $request->tanggal;
        $pertemuan->kompetensi = $request->kompetensi;
        $pertemuan->tujuan = $request->tujuan;
        $pertemuan->save();

        $siswa = Siswa::where('status', 0)->get();
        foreach($siswa as $s){
            $presensi = new Presensi;
            $presensi->id_pertemuan = $pertemuan->id;
            $presensi->id_siswa = $s->id;
            $presensi->save();
        }

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function getPertemuanById(Pertemuan $pertemuan)
    {
        return response()->json([
            'error' => false,
            'pertemuan' => $pertemuan,
        ], 200);
    }

    public function editPertemuan(Request $request, Pertemuan $pertemuan)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'judul' => ['required'],
                'tanggal' => ['required'],
                'kompetensi' => ['required'],
                'tujuan' => ['required'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $pertemuan->nama = $request->nama;
        $pertemuan->judul = $request->judul;
        $pertemuan->tanggal = $request->tanggal;
        $pertemuan->kompetensi = $request->kompetensi;
        $pertemuan->tujuan = $request->tujuan;
        $pertemuan->save();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function deletePertemuan(Pertemuan $pertemuan)
    {
        Storage::disk('public')->delete($pertemuan->diskusi);
        Storage::disk('public')->delete($pertemuan->materi);
        Storage::disk('public')->delete($pertemuan->tugas);
        $pertemuan->delete();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function editNilai(Request $request,Nilai $nilai){
        $validator = Validator::make(
            $request->all(),
            [
                'nilai' => ['required','numeric'],
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $nilai->nilai = $request->nilai;
        $nilai->save();

        return response()->json([
            'error' => false,
        ], 200);
    }

    public function deleteNilai(Nilai $nilai){
        $nilai->delete();
        return response()->json([
            'error' => false,
        ], 200);
    }
}
