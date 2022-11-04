<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function check(Request $request)
    {
        $check = $request->only('acount', 'password');
        if (Auth::attempt($check)) {
            $request->session()->regenerate();
            return redirect(route('home'));
        }

        return back()->withErrors(['message' => 'アカウントまたはパスワードが正しくありません']);
    }


    public function logout(
        Request $request
    ) {
        Auth::logout();
        $request->session()->flush();
        return redirect(route('login'));
    }
}
