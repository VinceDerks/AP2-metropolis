<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function create()
    {

    }

    public function store(LoginRequest $request)
    {

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials, $request->get('remember_me'))){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    public function delete()
    {

    }

}
