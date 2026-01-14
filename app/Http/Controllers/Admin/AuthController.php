<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = AdminUser::where('username', $request->username)->first();

        if (!$admin) {
            return back()->withErrors(['username' => 'Invalid credentials'])->withInput();
        }

        // Check password - handle both hashed and unhashed passwords
        if (Hash::check($request->password, $admin->password)) {
            // If password needs rehashing (old algorithm), update it
            if (Hash::needsRehash($admin->password)) {
                $admin->password = $request->password; // Will be auto-hashed by the model
                $admin->save();
            }
            
            Auth::guard('admin')->login($admin, $request->remember ?? false);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }
}
