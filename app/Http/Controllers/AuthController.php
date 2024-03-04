<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    function login() {
        View::share('title', 'login');
        return view('login');
    }

    function temporaryRedirect() {
        return redirect('/login');
    }

    public function authenticate(Request $request)
{
    // Validate the form data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6'
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Authentication passed...
        return redirect()->intended('/');
    } else {
        // Authentication failed...
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}

    function register() {
        View::share('title', 'register');
        return view('register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
