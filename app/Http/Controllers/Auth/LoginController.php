<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    // No constructor needed — middleware applied in routes

    public function showLoginForm()
    {
        return view('view.login'); // your custom login view path
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                Auth::login($user, true);
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(uniqid()),
                    'email_verified_at' => now(),
                ]);
                Auth::login($user, true);
            }

            return redirect()->intended('/');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google login failed.');
        }
    }
}