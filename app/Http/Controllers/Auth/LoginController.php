<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function enter(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Авторизация успешна
//            dd('success');
            return redirect()->route('index');
        } else {
            // Неверные учетные данные
//            dd('error with credentials');
            return back()->withErrors([
                'email' => 'Неверный email или пароль.',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}

