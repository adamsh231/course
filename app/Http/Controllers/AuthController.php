<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Siswa;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($request->only('username', 'password'), $remember = false)) {
            return redirect('/home');
        } else {
            return back()->with('status', 'Login Failed! Wrong Email/Password!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request){
        $request->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:siswa'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            'email' => ['required', 'unique:siswa'],
            'phone' => ['required', 'unique:siswa'],
        ]);

        Siswa::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect('/login')->with('status', 'Account Anda Berhasil Di Daftarkan!');
    }
}
