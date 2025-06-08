<?php

// HINT : Tambahkan method index, create, store, edit, update dan destroy pada UserController

namespace App\Http\Controllers;


// 1. Import model User

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    function index(){
        return view('sesi/index');
    }
    function login(Request $request){
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'email harus terisi',
            'password.required' => 'password harus terisi',
        ]);
        $infologin = [
        'email'=>$request->email,
        'password'=>$request->password
    ];

    if(Auth::attempt($infologin)){
        // SUKSES
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard')->with('success', 'Login sebagai Admin berhasil!');
        }
        return redirect('dashboard')->with('success', 'Login Berhasil');
    } else {
        // GAGAL
        return redirect('sesi')->withErrors(['login' => 'Email atau password salah']);
    }
}
    }

    function logout(){
        Auth::logout();
        return redirect('sesi')->with('success', 'Logout Berhasil');
    }
    function signup(){
        return view('sesi/signup');
    }
    function create(Request $request){
         Session::flash('name', $request->name);
         Session::flash('email', $request->email);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'name harus terisi',
            'email.required' => 'email harus terisi',
            'email.email' => 'silahkan masukkan email yang valid',
            'email.unique' => 'email sudah terdaftar',
            'password.required' => 'password harus terisi',
            'password.min' => 'password minimal 6 karakter',
        ]);

        $data = [
            'name'=> $request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ];
        User::create($data);
        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if(Auth::attempt($infologin)){
            //sukses
            return redirect('dashboard')->with('success', Auth::user()->name.' Login Berhasil');
        }
        else{
    //gagal
        return redirect('sesi')->withErrors(['login' => 'error Email atau password salah']);
    }
}
