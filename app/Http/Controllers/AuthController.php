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
            'full_name' => ['required'],
            'email' => ['required', 'unique:user'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            // 'birth_day' => ['required'],
            'phone' => ['required', 'unique:user'],
            'gender' => ['required'],
            'agree' => ['required'],
        ]);

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'birth_day' => $request->birth_day,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);
        return redirect('/login')->with('status', 'Account Anda Berhasil Di Daftarkan!');
    }
}
