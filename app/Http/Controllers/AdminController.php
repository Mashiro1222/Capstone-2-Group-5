<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // Check if the user is logged in and has the 'admin' role
        if (auth()->check() && auth()->user()->role === 'admin') {
            $users = User::all(); // Fetch all users
            return view('admin.dashboard', compact('users'));
        }
        else
        return redirect('/dashboard')->with('error', 'Unauthorized access.');
    }

    /**
     * Display all users.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function users()
    {
        // Check if the user is logged in and has the 'admin' role
        if (auth()->check() && auth()->user()->role === 'admin') {
            $users = User::all();
            return view('admin.users', compact('users'));
        }

        // Redirect non-admin users to the home page with an error message
        return redirect('/')->with('error', 'Unauthorized access.');
    }

    /**
     * Delete a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id)
    {
        // Check if the user is logged in and has the 'admin' role
        if (auth()->check() && auth()->user()->role === 'admin') {
            $user = User::find($id);

            if ($user) {
                $user->delete();
                return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
            }

            return redirect()->route('admin.dashboard')->with('error', 'User not found.');
        }

        // Redirect non-admin users to the home page with an error message
        return redirect('/')->with('error', 'Unauthorized access.');
    }

    /**
     * Edit a user (display edit form).
     *
     * @param  int  $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function editUser($id)
    {
        // Check if the user is logged in and has the 'admin' role
        if (auth()->check() && auth()->user()->role === 'admin') {
            $user = User::find($id);

            if ($user) {
                return view('admin.edit-user', compact('user'));
            }

            return redirect()->route('admin.users')->with('error', 'User not found.');
        }

        // Redirect non-admin users to the home page with an error message
        return redirect('/')->with('error', 'Unauthorized access.');
    }

    /**
     * Update user details (process the form submission).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request, $id)
    {
        // Check if the user is logged in and has the 'admin' role
        if (auth()->check() && auth()->user()->role === 'admin') {
            // Validate the input data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $id, // Exclude current user
                'role' => 'required|string|in:user,admin', // Limit roles to specific values
            ]);

            // Find the user by ID
            $user = User::find($id);

            if ($user) {
                // Update user details
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->role = $request->input('role');
                $user->save();

                // Redirect to the admin dashboard with a success message
                return redirect()->route('admin.dashboard')->with('success', 'User updated successfully.');
            }

            // Redirect to the admin dashboard with an error message if user not found
            return redirect()->route('admin.dashboard')->with('error', 'User not found.');
        }

        // Redirect non-admin users to the home page with an error message
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
