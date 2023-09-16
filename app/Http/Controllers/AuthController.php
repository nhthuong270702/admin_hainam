<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/admin')->with('msg-success', 'Đăng nhập thành công');
        }
        return back()->withInput(
            $request->only('email')
        )->with('msg-error', 'Email hoặc mật khẩu không đúng');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
