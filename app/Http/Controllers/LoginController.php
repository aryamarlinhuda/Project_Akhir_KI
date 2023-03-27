<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register() {
        return view('register');
    }

    public function register_process(Request $request) {
        $data = $request->validate([
            "name" => "required",
            "email" => "required | email",
            "password" => "required",
            "confpassword" => "required"
        ]);

        if($request->confpassword !== $request->password) {
            return redirect('register')->withErrors('Password and Confirm Password do not match!');
        }

        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ];

        User::create($data);
        return redirect('/')->with('register','Registrasi berhasil. Silahkan Login!');
    } 

    public function login() {
        return view('login');
    }

    public function login_process(Request $request) {
        $data = $request->validate([
            "email" => "required | email",
            "password" => "required"
        ]);

        $data = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if(Auth::attempt($data)) {
            if(Auth::user()->role == "admin") {
                return redirect('admin/dashboard')->with('data',$data)->with('admin','login Berhasil');
            } else {
                return redirect('user/dashboard')->with('data',$data)->with('user','login Berhasil');
            }
        } else {
            return redirect('/')->withErrors('Email dan Password tidak sesuai');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/')->with('logout', 'Logout Berhasil');
    }
}
