<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\AccountCreated;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    // Show Signup Form
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Process Signup
    public function processSignup(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Send a confirmation email
    try {
        \Mail::to($user->email)->send(new AccountCreated($user));
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Mail sending failed: ' . $e->getMessage());
    }

    return response()->json([
        'message' => 'Account created successfully! A verification email has been sent to your email address.',
    ]);
}


    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Process Login
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on user role
            return redirect()->intended($this->redirectTo());
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Redirect to appropriate dashboard based on user role
    public function redirectTo()
    {
        if (Auth::user()->role === 'admin') {
            return '/admin'; // Admin dashboard
        }

        return '/dashboard'; // User dashboard
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
