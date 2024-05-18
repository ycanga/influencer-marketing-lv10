<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    // public function login(LoginRequest $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         return redirect()->intended('/');
    //     }

    //     return back()->with('error', 'Invalid credentials');
    // }

    public function login(LoginRequest $request)
    {
      $credentials = $request->only('email', 'password');
  
          if (Auth::attempt($credentials)) {
              // Oturum açma başarılı olduğunda doğrudan yönlendirme yapabilirsiniz.
              return redirect()->route('home');
          } else {
            dd("error");
              // Oturum açma başarısız olduğunda geri dönerken hata mesajını da gönderebilirsiniz.
              return redirect()->back()->withInput()->with(['status' => 'error', 'message' => 'Email veya şifre hatalı!']);
          }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
