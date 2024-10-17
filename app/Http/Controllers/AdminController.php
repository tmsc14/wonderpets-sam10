<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the Manage Users page.
     */
    public function manageUsers()
    {
        // Fetch all users
        $users = User::paginate(10);

        // Return the view with the list of users
        return view('admin.manage-users', compact('users'));
    }

    /**
     * Handle user updates.
     */
    public function updateUser(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'role' => ['required', 'in:admin,user'], // Restrict valid roles
        ]);

        // Find the user by ID and update their details
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        // Redirect back to manage users page with a success message
        return redirect()->route('admin.manageUsers')->with('success', 'User updated successfully.');
    }

    /**
     * Handle user deletion.
     */
    public function deleteUser($id)
    {
        // Find the user by ID and delete them
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('admin.manageUsers')->with('success', 'User deleted successfully.');
    }
}
