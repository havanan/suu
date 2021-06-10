<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('manager.auth.login');
    }
    public function postLogin(LoginRequest  $request){
        $credentials = $request->only('email', 'password');
        $check = Auth::attempt($credentials);
        if (!$check) {
            return back()->withErrors('Sai tên đăng nhập hoặc mật khẩu');
//                ->with('error','Sai tên đăng nhập hoặc mật khẩu');
        }
        return redirect()->route('dashboard.index');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('manager.login_form');
    }
}
