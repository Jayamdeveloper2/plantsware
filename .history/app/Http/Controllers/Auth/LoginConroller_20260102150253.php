// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/'; // After login redirect

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Show login form (your blade)
    public function showLoginForm()
    {
        return view('auth.login'); // your login.blade.php path
    }

    // Google Login - Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google Callback - Login or Register user
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Existing user - just login
                Auth::login($user, true);
            } else {
                // New user - create and login
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(uniqid()), // random password
                    'email_verified_at' => now(),
                ]);

                Auth::login($user, true);
            }

            return redirect()->intended('/');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong with Google login.');
        }
    }
}