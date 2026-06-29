<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.unique' => 'This email is already registered. Please login instead.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password_confirmation.confirmed' => 'Password confirmation does not match.',

        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Registration successful. Please login.')
            ->with('show_login', true);
    }
}
