<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        if(!Session::get('login')){
            return view('login');
        }
        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $email      = $request->email;
        $password   = $request->password;

        $result = User::where('email', $email)->first();
        if($result){
            if(Hash::check($password, $result->password)){
                Session::put('id', $result->id);
                Session::put('name', $result->name);
                Session::put('login', TRUE);
                return redirect()->route('home');
            } else {
                return redirect('/')->with('message','<div class="alert alert-danger">Password Salah !</div>');
            }
        } else {
            return redirect('/')->with('message','<div class="alert alert-danger">Email Salah !</div>');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/')->with('message', '<div class="alert alert-success">Anda berhasil logout.</div>');
    }
}
