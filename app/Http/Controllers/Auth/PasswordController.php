<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
	
	$email = $request->email; 
	$pw = $request -> password; 
	$user = User::where('email', $email)->first(); 

	$status = $user->update([
		'password'=> Hash::make($pw)
	]);

        
    
        return $status == true 
            ? redirect()->route('login')->with('status', 'Password reset successfully.')
            : back()->withErrors(['email' => __($status)]);
    }
}