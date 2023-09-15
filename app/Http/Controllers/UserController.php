<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Gate::denies('is-admin')) {
            abort(403, 'Unauthorized');
        }
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        if (Gate::denies('is-admin')) {
            abort(403, 'Unauthorized');
        }
        return view('users.create');
    }

    public function store(Request $request)
    {
        if (Gate::denies('is-admin')) {
            abort(403, 'Unauthorized');
        }
        // Validation for the user creation form
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4',
        ]);

        // Create the new user
        User::create([
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => 0, // Assuming new users are not admins
        ]);
        // dd($request->all());
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Check if the user has admin role and is_admin is not 1
        if (Gate::denies('is-admin') || ($user->is_admin === 1)) {
            abort(403, 'Unauthorized');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Check if the user has admin role and is_admin is not 1
        if (Gate::denies('is-admin') || ($user->is_admin === 1)) {
            abort(403, 'Unauthorized');
        }

        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update([
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Check if the user has admin role and is_admin is not 1
        if (Gate::denies('is-admin') || ($user->is_admin === 1)) {
            abort(403, 'Unauthorized');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
