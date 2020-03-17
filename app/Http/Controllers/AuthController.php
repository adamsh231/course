<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Siswa;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $messages = [
            'required' => 'The :attribute field is required.',
        ];
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ], $messages);

        if (Auth::attempt($request->only('username', 'password'), $remember = false)) {
            return redirect('/home');
        } else {
            return back()->with('status', 'Login Failed! Wrong Email or Password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => ':attribute has been taken'
        ];
        $request->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:siswa'],
            'password' => ['required', 'min:8'],
            'email' => ['required', 'unique:siswa', 'email'],
            'phone' => ['required', 'unique:siswa', 'numeric'],
        ], $messages);

        //! Mass Assigment => Vulnerable for Injection, Require Fillable or Guarded ['*'] for All
        // Siswa::create([
        //     'name' => $request->name,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        // ]);

        //! Manual Assignment
        $siswa = new Siswa;
        $siswa->name = $request->name;
        $siswa->username = $request->username;
        $siswa->password = Hash::make($request->password);
        $siswa->email = $request->email;
        $siswa->phone = $request->phone;
        $siswa->save();

        if($request->redirect == "admin"){
            return redirect('/admin')->with('status', 'Siswa Berhasil Di Daftarkan!');
        }else{
            return redirect('/login')->with('status', 'Account Anda Berhasil Di Daftarkan!');
        }
    }

}
