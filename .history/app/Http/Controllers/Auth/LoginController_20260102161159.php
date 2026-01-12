<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        // This works because AuthenticatesUsers trait adds middleware support
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('view.login'); // your custom login view
    }

    // Google methods...
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // your google logic
    }
}