<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('manager.auth.login');
    }
    public function postLogin(Request  $request){
        $credentials = $request->only('email', 'password');
//        dd($credentials);
        if (!Auth::attempt($credentials)) {
            return back()->with('error','Sai tên đăng nhập hoặc mật khẩu');
        }
        return redirect()->route('dashboard.index');
    }
}
