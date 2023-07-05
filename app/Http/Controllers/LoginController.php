<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public  function  index() {
        return view('/auth/login');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],
        [
            'email.required' => 'Заполните поле',
            'password.required' => 'Заполните поле',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->email == 'admin@admin.com') {
                return redirect()->intended(route('admin'));
            } else {
                return redirect()->intended(route('catalog'));
            }
        }

        return redirect()->intended(route('login'))->withErrors(['error' => 'Неверный логин или пароль']);

    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }

}
