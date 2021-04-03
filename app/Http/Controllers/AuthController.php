<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Session;

class AuthController extends Controller
{

    public function regsterView(){
        return view('custompage/auth/register');
    }

    public function loginView(){
        return view('custompage/auth/login');
    }


    public function register(Request $request)
    {
        
        $users =  User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password_confirm),
            'role' => 2
        ]);

        UserDetail::create([
            'users_id' => $users->id,
            'alamat' => $request->alamat,
            'nomor_hp' => $request->nomor_hp,
            'kode_pos' => $request->kode_pos,
            'jenis_klamin' => $request->jenis_klamin
        ]);

 
        return redirect()->back()->with('sukses','data berhasil di Registrasi lakukan login');
    }

    public function login(Request $request)
    {
        
        if(Auth::attempt($request->only('email','password'))){
           return redirect('/dashboard');
        } 
        Session::flash('peringatan','Password atau sandi anda salah');
        return redirect('/login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');

    }
}
